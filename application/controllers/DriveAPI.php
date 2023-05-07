<?php
defined('BASEPATH') or exit('No direct script access allowed');



require_once APPPATH . 'core/Admin_Controller.php';


class DriveAPI extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("DriveModel");
    }


    public function index()
    {
        sleep(1);
        $options = $this->input->post(NULL);
        $result["data"] = $this->DriveModel->getDrive($this->response_data["user"]["id"], $options, true);

        $result["folders"] = $this->DriveModel->getFolders($this->response_data["user"]["id"], true);

        echo json_encode($result);
        die;
    }
}
