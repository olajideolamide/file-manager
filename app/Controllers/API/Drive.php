<?php

namespace App\Controllers\API;

use App\Controllers\APIController;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;


class Drive extends APIController
{
    /**
     * List files and folders based on a set of options for the logged in user
     */
    public function fileEntries()
    {
        $drive_model = model('DriveModel', true, $this->db);
        $options = $this->request->getGet();
        $response = $drive_model->getDrive(session()->get('id'), $options, true);

        return $this->respond($response, 200);
    }


    /**
     * Get all folders in a workspace
     */
    public function folders()
    {
        $drive_model = model('DriveModel', true, $this->db);

        //TODO limit it to a workspace
        $options = $this->request->getGet();
        $response = $drive_model->getFolders($options,  true);

        return $this->respond($response, 200);
    }

    /**
     * Get path for a given file entry
     */
    public function path($file_id)
    {
        $drive_model = model('DriveModel', true, $this->db);
        $response = $drive_model->path($file_id);

        return $this->respond($response, 200);
    }


    public function createFolder()
    {

        $rules = [
            'name' => 'required|min_length[3]|max_length[50]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->listErrors(), 400);
        }

        $file_data = array();
        $file_data["name"] = $this->request->getPost('name');
        $file_data["type"] = "FOLDER";
        $file_data["created_at"] = date("Y-m-d H:i:s");
        $file_data["updated_at"] = date("Y-m-d H:i:s");
        $file_data["user_id"] =  session()->get('id');
        if (!empty($this->request->getPost('parent'))) $file_data["parent_id"] =  $this->request->getPost('parent');


        $drive_model = model('DriveModel', true, $this->db);
        $id = $drive_model->createFolder($file_data);

        $folder_data = $drive_model->getFile($id, TRUE);

        $response = array("status" => "complete", "data" => $folder_data);

        //$response["folders"] = $drive_model->getFolders(session()->get('id'), true);

        return $this->respondCreated($response);
    }


    public function upload()
    {
        //sleep(6000);
        $adapter = new LocalFilesystemAdapter(WRITEPATH . "/storage");
        $filesystem = new Filesystem($adapter);

        $stream = fopen($_FILES['file']['tmp_name'], 'r+');


        try {

            //first find out if this file contains a folder
            $path_array = explode("/", (string)$this->request->getPost('name'));

            $parent = $this->request->getPost('parent');

            $drive_model = new \App\Models\DriveModel($this->db);

            if (count($path_array) >= 2) {
                //this is a path,
                //get the real parent of this file
                $parent = $drive_model->getRealParent($this->request->getPost('name'), $parent, $this->request->getPost('queue_id'), session()->get('id'));
            }


            //if this file already exist for this parent, overwrite it and update its last modified
            $file = $drive_model->getFileFolderByName($path_array[count($path_array) - 1], $parent);

            $id = null;

            if (empty($file)) {

                //create it
                $file_data = array();
                $file_data["name"] = $path_array[count($path_array) - 1];
                $file_data["file_name"] = bin2hex(random_bytes(4)) . "-" . bin2hex(random_bytes(2)) . "-" . bin2hex(random_bytes(2)) . "-" . bin2hex(random_bytes(4));
                $file_data["mime"] = $this->request->getPost('mime');
                $file_data["type"] = $this->request->getPost('type');
                $file_data["size"] = $this->request->getPost('size');
                $file_data["created_at"] = date("Y-m-d H:i:s");
                $file_data["updated_at"] = date("Y-m-d H:i:s");
                $file_data["user_id"] =  session()->get('id');
                $file_data["extension"] =  pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if (!empty($parent)) $file_data["parent_id"] =  $parent;

                $id = $drive_model->create($file_data);
            } else {
                //TODO if no versioning (like as it is today), delete the old entry from storage and update the DB
                //TODO add the new entry
                //update it,

                $file_data = array();
                $file_data["name"] = $path_array[count($path_array) - 1];
                $file_data["file_name"] = bin2hex(random_bytes(4)) . "-" . bin2hex(random_bytes(2)) . "-" . bin2hex(random_bytes(2)) . "-" . bin2hex(random_bytes(4));
                $file_data["mime"] = $this->request->getPost('mime');
                $file_data["type"] = $this->request->getPost('type');
                $file_data["size"] = $this->request->getPost('size');
                $file_data["updated_at"] = date("Y-m-d H:i:s");
                $file_data["extension"] =  pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if (!empty($parent)) $file_data["parent_id"] =  $parent;

                $id = $file["id"];
                $drive_model->update($id, $file_data);
            }



            $filesystem->writeStream(
                $file_data["file_name"],
                $stream
            );
            if (is_resource($stream)) {
                fclose($stream);
            }


            $file_data = $drive_model->getFile($id, TRUE);



            $file_data[0]["local_id"] = $this->request->getPost("local_id");

            $response = $file_data;

            return $this->respondCreated($response);
        } catch (FilesystemException | UnableToWriteFile $exception) {
            return $this->fail("Unable to process file upload", 400);
        }
    }
}
