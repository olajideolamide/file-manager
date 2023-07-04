<?php

namespace App\Controllers\API\Modal\Child;

use App\Controllers\APIController;



class Drive extends APIController
{



    public function newFolder()
    {

        $data = view("drive/modal/new_folder_modal", array());
        $response = array("status" => "complete", "data" => $data);
        return $this->respondCreated($response);
    }



}
