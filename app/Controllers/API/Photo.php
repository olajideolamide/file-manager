<?php

namespace App\Controllers\API;

use App\Controllers\APIController;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;
use Intervention\Image\ImageManager;


class Photo extends APIController
{


    public function thumb($file_id)
    {
        //first make sure that this file is a photo type
        $drive_model = new \App\Models\DriveModel($this->db);
        $file = $drive_model->getFile($file_id);

        if (empty($file)) {
            return $this->failNotFound("The photo specified does not exist");
        }


        $width = 300;
        $height = 300;


        $adapter = new LocalFilesystemAdapter(WRITEPATH . "/storage");
        $filesystem = new Filesystem($adapter);

        $file_contents = "";
        try {
            $stream = $filesystem->readStream($file[0]["file_name"]);
            $file_contents = stream_get_contents($stream);
            fclose($stream);
        } catch (FilesystemException | UnableToReadFile $exception) {
            return $this->failNotFound("Unable to read file");
        }

        $manager = new ImageManager(['driver' => 'gd']);
        $img = $manager->make($file_contents);



        if ($img->height() < $height || $img->width() < $width) {
            $img->resizeCanvas(300, 300);
        } else {
            $img->fit($width, $height, function ($constraint) {
                //$constraint->aspectRatio();
                $constraint->upsize();
            }, 'top');
        }







        $resized = $img->encode();
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $resized);
        rewind($stream);

        $filesystem->writeStream(
            $file[0]["file_name"] . "_thumb",
            $stream
        );
        if (is_resource($stream)) {
            fclose($stream);
        }

        $this->response->setHeader("Content-type: ", "image/jpeg");
        $this->response->setStatusCode(200);
        return $this->response->setBody((string)$resized);
    }

    public function resize($options, $file_id)
    {
        //first make sure that this file is a photo type
        $drive_model = new \App\Models\DriveModel($this->db);
        $file = $drive_model->getFile($file_id);

        if (empty($file)) {
            return $this->failNotFound("The photo specified does not exist");
        }

        //TODO Make sure the file type is image type
        //TODO If the resize has already been generated for this option(s), show that instead of wasting processing time
        //TODO If memory limit is not enough, increase it
        //TODO check if GD is enabled before doing image manipulations


        $options = $options ? $options : "";

        $options_array = explode(",", $options);

        $adapter = new LocalFilesystemAdapter(WRITEPATH . "/storage");
        $filesystem = new Filesystem($adapter);

        $file_contents = "";
        try {
            $stream = $filesystem->readStream($file[0]["file_name"]);
            $file_contents = stream_get_contents($stream);
            fclose($stream);
        } catch (FilesystemException | UnableToReadFile $exception) {
            return $this->failNotFound("Unable to read file");
        }

        $manager = new ImageManager(['driver' => 'gd']);
        $img = $manager->make($file_contents);


        $width = 150;
        $height = 150;

        if (in_array("thumb", $options_array)) {
            //send back a thumbail for this photo
            $width = 150;
            $height = 150;
        }

        $img->fit(200, 200, function ($constraint) {
            //$constraint->aspectRatio();
            $constraint->upsize();
        });

        $resized = $img->encode();
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $resized);
        rewind($stream);

        $filesystem->writeStream(
            $file[0]["file_name"] . "_thumb",
            $stream
        );
        if (is_resource($stream)) {
            fclose($stream);
        }

        $this->response->setHeader("Content-type: ", "image/jpeg");
        $this->response->setStatusCode(200);
        return $this->response->setBody((string)$resized);
    }
}
