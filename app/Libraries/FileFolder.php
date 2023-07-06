<?php

namespace App\Libraries;

use \Config\FileTypes;
use \App\Libraries\Storage\FileSystemStorage;

class FileFolder
{

    /**
     * id of the entry
     *
     * @var mixed
     */
    private $id;
    private $name;
    private $file_name;
    private $description;
    private $mime;
    private $created_at;
    private $updated_at;
    private $deleted_at;
    private $user_id;
    private $size;
    private $extension;
    private $parent_id;
    private $type;
    private $file_type;
    private $path;
    private $children;

    private $drive_model;
    private $error;
    private $storage_id;
    public $storage;



    public function __construct($id)
    {
        $this->id = $id;
        $db = db_connect();
        $this->drive_model = model('DriveModel', true, $db);

        $entry = $this->drive_model->getFile($this->id);

        $response = $this->initializeFields($entry);
        if ($response == true) {
            $this->initializeStorage();
        }
    }


    /**
     * Populates the public fields of this entry during initialization
     *
     * @param array $entries An array of file/folder entries
     *
     * @return bool
     */
    public function initializeFields($entries): bool
    {
        if (count($entries) < 1) {
            $this->error = "Invalid file or folder";
            return false;
        }
        foreach ($entries as $entry); {
            $this->name = $entry["name"];
            $this->file_name = $entry["file_name"];
            $this->description = $entry["description"];
            $this->mime = $entry["mime"];
            $this->created_at = $entry["created_at"];
            $this->updated_at = $entry["updated_at"];
            $this->user_id = $entry["user_id"];
            if ($entry["type"] == "FILE")
                $this->size = $entry["size"];
            else
                $this->size = null;
            $this->file_type = FileTypes::guessFileTypeFromExtension((string) $entry["extension"]);
            $this->type = $entry["type"];
            $this->extension = $entry["extension"];
            $this->parent_id = $entry["parent_id"];
            $this->storage_id = $entry["storage_id"];
        }

        return true;
    }


    public function initializeStorage(): bool
    {
        $db = db_connect();
        $storage_model = model('StorageModel', true, $db);
        $storage_data = $storage_model->find($this->storage_id);


        switch ($storage_data["type"]) {
            case "FileSystemStorage":
                $this->storage = new FileSystemStorage($this, $storage_data);
                break;
        }
        return true;
    }


    /**
     * Fetch a field of this file/folder
     *
     * @param string $name  Name of the field
     *
     * @return string
     */
    public function getField($name): string
    {
        return (string)$this->$name;
    }


    /**
     * Add a stream to this file's storage
     *
     *
     * @param $stream $stream Streamed data to add
     *
     * @return bool
     */
    public function addStream($stream): bool
    {

        //TODO if versioning is enabled...
        return true;
    }


    /**
     * Gets a link to this file
     *
     * @return bool
     */
    public function getLink(): string
    {
        //TODO if versioning is enabled...
        return true;
    }

    public function getPath(): array
    {
        return $this->drive_model->path($this->id);
    }

    public function getChildren(): array
    {
        return array();
    }

    /**
     * Move this file/folder to a destination
     *
     * @param int $destination_id The ID of the destination folder
     *
     * @return bool
     */
    public function move($destination_id): bool
    {

        //make sure the destination is a folder
        if (!empty($destination_id)) {
            $destination_folder = new FileFolder($destination_id);

            if ($destination_folder->getField("type") != "FOLDER") {
                $this->error = "Destination must be a folder";
                return false;
            }

            //if current parent is destination, skip
            if ($this->parent_id == $destination_folder->getField("id")) return true;

            //make sure that the destination is not a child
            $destination_path = $destination_folder->getPath();

            foreach ($destination_path as $path) {
                if ($path["id"] == $this->id) {
                    $this->error = "Cannot move item into one of it's children";
                    return false;
                }
            }
        }else{
            $destination_id = null;
        }

        //move
        $this->drive_model->update($this->id, ["parent_id" => $destination_id]);

        return true;
    }

    /**
     * Make a copy of this file/folder
     *
     * @return int returns the id of the new file / folder
     */
    public function copy(): int
    {
        return 0;
    }

    public function render()
    {
    }

    public function star($user_id)
    {
    }

    public function delete()
    {
    }

    public function tags()
    {
    }

    public function addTag($user_id, $tag)
    {
    }

    public function comments()
    {
    }

    public function addComment($user_id, $comment)
    {
    }

    public function annotations()
    {
    }

    public function getLastError()
    {
        $error = $this->error;
        $this->error = null;

        return $error;
    }
}
