<?php

namespace App\Controllers\API\Modal\Child;

use App\Controllers\APIController;



class Drive extends APIController
{



    public function newFolder()
    {

        $response_data = array();
        $parent = $this->request->getGet("parent");
        if(empty($parent)) $parent = "";
        $response_data["parent"] = $parent;
        $response_data["callback"] = $this->request->getGet("callback");

        $data = view("drive/modal/child/new_folder_modal", $response_data);
        $response = array("status" => "complete", "data" => $data);
        return $this->respondCreated($response);
    }
}
