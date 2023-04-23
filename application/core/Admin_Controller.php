<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/Main_Controller.php';
class Admin_Controller extends Main_Controller
{


    public function __construct()
    {
        parent::__construct();


        if (!isLoggedIn()) {
            redirect("auth/login");
        }
        $this->response_data["user"] = $this->UserModel->getUser($this->session->userdata("id"));




    }
}
