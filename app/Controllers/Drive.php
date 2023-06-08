<?php

namespace App\Controllers;

class Drive extends AdminController
{
    public function index()
    {

        $this->data["page_schema"]["title"] = "Files and folders";

        $this->data["content"]["table_src_url"] = "api/drive/file-entries";
        $view = "drive/drive_index";

        return $this->render($view);
    }
}
