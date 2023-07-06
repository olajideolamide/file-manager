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


    public function move($ids)
    {

        $ids = explode(",", $ids);
        $folder_ids = array();
        foreach ($ids as $id) {
            if (is_numeric($id)) $folder_ids[] = $id;
        }

        $drive_model = model('DriveModel', true, $this->db);
        $response_data = array();
        //if we have just one ID to move, name it. else count them
        $response_data["folder_name"] = "";
        if (count($folder_ids) == 1) {
            //TODO PHP 8 will return an error if the file does not exists. WATCH OUT
            $response_data["folder_name"] = $drive_model->getFile($id)[0]["name"];
        } else {
            $response_data["folder_name"] = count($folder_ids) . " items";
        }

        //next we fetch all the parent of the ids... We cannot move a folder/file into its parent. Thats redundant.
        $parent_ids = array();

        foreach ($folder_ids as $id) {
            $item = $drive_model->getFile($id);

            $parent_ids[] = $item[0]["parent_id"] ? $item[0]["parent_id"] : 0;
        }

        $parent_ids = array_unique($parent_ids);

        $final_ids = array_merge($folder_ids, $parent_ids);


        $response_data["ids"] = implode(",", $folder_ids);
        $response_data["items_parents"] = implode(",", $final_ids);
        $data = view("drive/modal/move_modal", $response_data);
        $response = array("status" => "complete", "data" => $data);
        return $this->respondCreated($response);
    }
}
