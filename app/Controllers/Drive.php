<?php

namespace App\Controllers;

use App\Libraries\FileFolder;
use CodeIgniter\Files\File;

class Drive extends AdminController
{
    public function index($folder_hash = null)
    {
        //var_dump(base_convert("1f", 36, 10));
        ///var_dump(base_convert("1", 10, 36));

        //die;

        //helper("validator");
        //singleError([1 => "jide", 2 => "Bimbo"]);

        $this->data["page_schema"]["title"] = "Files and folders";

        if (!empty($folder_hash)) {
            $this->data["content"]["folder_id"] = (int) explode('|', base64_decode($folder_hash))[0];

            if ($this->data["content"]["folder_id"] == 0) unset($this->data["content"]["folder_id"]);
        }

        $this->data["content"]["table_src_url"] = "/api/drive/file-entries";
        $view = "drive/drive_index";

        return $this->render($view);
    }
}
