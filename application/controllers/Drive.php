<?php
defined('BASEPATH') or exit('No direct script access allowed');

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;

require_once APPPATH . 'core/Admin_Controller.php';


class Drive extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->response_data["data"]["table_src_url"] = "api/drive";
        $this->load->model("DriveModel");
    }


    public function index()
    {

        $this->response_data["page"]["title"] = "Files and folders";

        $view = "drive/drive_index";

        $this->render($view);
    }


    public function create_folder()
    {

        $file_data = array();
        $file_data["name"] = $this->input->post('name');
        $file_data["type"] = "FOLDER";
        $file_data["created_at"] = date("Y-m-d H:i:s");
        $file_data["updated_at"] = date("Y-m-d H:i:s");
        $file_data["user_id"] =  $this->response_data["user"]["id"];
        if (!empty($this->input->post('parent'))) $file_data["parent_id"] =  $this->input->post('parent');


        $id = $this->DriveModel->createFolder($file_data);

        $folder_data = $this->DriveModel->getFile($id, TRUE);

        echo json_encode(array("status" => "complete", "data" => $folder_data));
    }

    public function upload()
    {
        $filename = $_FILES['file']['name'];

        $adapter = new LocalFilesystemAdapter(APPPATH . "/../storage");
        $filesystem = new Filesystem($adapter);

        sleep(1);

        $stream = fopen($_FILES['file']['tmp_name'], 'r+');

        try {
            $filesystem->writeStream(
                $_FILES['file']['name'],
                $stream
            );
            if (is_resource($stream)) {
                fclose($stream);
            }

            //first find out if this file contains a folder
            $path_array = explode("/", $this->input->post('name'));
            $parent = $this->input->post('parent');

            if (count($path_array) > 1) {
                //we have a folder named
                //grab the folder and create it.

                $file_data = array();
                $file_data["name"] = $path_array[count($path_array) - 2];
                $file_data["type"] = "FOLDER";
                $file_data["created_at"] = date("Y-m-d H:i:s");
                $file_data["updated_at"] = date("Y-m-d H:i:s");
                $file_data["user_id"] =  $this->response_data["user"]["id"];
                if (!empty($this->input->post('parent'))) $file_data["parent_id"] =  $this->input->post('parent');

                $parent = $this->DriveModel->createFolder($file_data);
            }

            $file_data = array();
            $file_data["name"] = $path_array[count($path_array) - 1];
            $file_data["mime"] = $this->input->post('mime');
            $file_data["type"] = $this->input->post('type');
            $file_data["size"] = $this->input->post('size');
            $file_data["created_at"] = date("Y-m-d H:i:s");
            $file_data["updated_at"] = date("Y-m-d H:i:s");
            $file_data["user_id"] =  $this->response_data["user"]["id"];
            $file_data["extension"] =  pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if (!empty($parent)) $file_data["parent_id"] =  $parent;

            $id = $this->DriveModel->create($file_data);

            $file_data = $this->DriveModel->getFile($id, TRUE);
            $file_data[0]["full_path"] = $this->input->post('name');

            echo json_encode(array("status" => "complete", "id" => $this->input->post("local_id"), "data" => $file_data));
        } catch (FilesystemException | UnableToWriteFile $exception) {
            echo json_encode(array("status" => "failed", "id" => $this->input->post("local_id")));
        }









        die;
    }
}


/**
 *  //
        header('Content-Type: application/zip');
        header('Content-Disposition: filename=jide.txt');
        //header('Content-length: ' . $filesize);
        header('Cache-Control: no-cache');
        header("Content-Transfer-Encoding: chunked");
        readfile(APPPATH . "/../storage/transcript.txt");
        die;
 */
