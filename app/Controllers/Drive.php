<?php

namespace App\Controllers;

use App\Controllers\APIController;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;

class Drive extends AdminController
{
    public function index()
    {


        /**$adapter = new LocalFilesystemAdapter(WRITEPATH . "/storage");
        $filesystem = new Filesystem($adapter);


        try {
            $stream = $filesystem->readStream("b7fe799f-6a29-7cd6-67630d34");
            $contents = stream_get_contents($stream);
            fclose($stream);

            header("Content-type: application/octet-stream");
            header('Content-Disposition: inline; filename="' . basename("myfile.jpg") . '"');
            //header("Content-Length: " . filesize($file));

            echo $contents;
            die;
        } catch (FilesystemException | UnableToReadFile $exception) {
            // handle the error
        } */


        $this->data["page_schema"]["title"] = "Files and folders";

        $this->data["content"]["table_src_url"] = "api/drive/file-entries";
        $view = "drive/drive_index";

        return $this->render($view);
    }
}
