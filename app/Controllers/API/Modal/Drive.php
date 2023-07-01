<?php

namespace App\Controllers\API\Modal;

use App\Controllers\APIController;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;


class Drive extends APIController
{



    public function newFolder()
    {

        $data = view("drive/modal/new_folder_modal", array());
        $response = array("status" => "complete", "data" => $data);
        return $this->respondCreated($response);
    }
}
