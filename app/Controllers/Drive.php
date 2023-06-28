<?php

namespace App\Controllers;

use App\Controllers\APIController;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;

class Drive extends AdminController
{
    public function index($folder_hash = null)
    {
        $this->data["page_schema"]["title"] = "Files and folders";

        if (!empty($folder_hash)) {
            $this->data["content"]["folder_id"] = (int) explode('|', base64_decode($folder_hash))[0];

            if ($this->data["content"]["folder_id"] == 0) unset($this->data["content"]["folder_id"]);
        }

        //var_dump($this->data["content"]["folder_id"]); die;

        $this->data["content"]["table_src_url"] = "/api/drive/file-entries";
        $view = "drive/drive_index";

        return $this->render($view);
    }
}
