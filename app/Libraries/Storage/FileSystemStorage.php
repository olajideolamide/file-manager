<?php

namespace App\Libraries\Storage;

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;
use League\Flysystem\UnableToReadFile;

class FileSystemStorage implements StorageInterface
{
    private $file_folder;
    private $error; //saves the last error
    public function __construct(&$file_folder, $storage_data)
    {
        $this->file_folder = $file_folder;
    }
    public function addStream($stream, $name): bool
    {

        try {
            $adapter = new LocalFilesystemAdapter(WRITEPATH . "/storage");
            $filesystem = new Filesystem($adapter);
            $filesystem->writeStream(
                $name,
                $stream
            );
        } catch (FilesystemException | UnableToWriteFile $exception) {
            $this->error = "Unable to write file";
            return false;
        }

        return true;
    }
    public function readStream()
    {
        $stream = "";
        try {
            $adapter = new LocalFilesystemAdapter(WRITEPATH . "/storage");
            $filesystem = new Filesystem($adapter);
            $stream = $filesystem->readStream($this->file_folder->getField('file_name'));
        } catch (FilesystemException | UnableToReadFile $exception) {
            $this->error = "Unable to read file";
            return null;
        }
        return $stream;
    }
    public function delete(): bool
    {
        return true;
    }

    public function getLastError()
    {
        $error = $this->error;
        $this->error = null;

        return $error;
    }
}
