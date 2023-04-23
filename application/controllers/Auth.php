<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/Main_Controller.php';

class Auth extends Main_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->response_data["header"] = 'global/auth_header';
        $this->response_data["footer"] = 'global/auth_footer';
    }


    public function login()
    {
        $this->response_data["page"]["title"] = "Login";
        $this->response_data["page"]["canonical"] =  "/auth/login";

        if (!$this->input->post(NULL)) {
            $view = "auth/login";
            $this->render($view);
        } else {
            $email = $this->input->post("email");
            $password = $this->input->post("password");

            $toast = null;

            if (empty($email)) {
                $toast["type"] = "danger";
                $toast["message"] = "Email field cannot be empty";
            }

            if (empty($password)) {
                $toast["type"] = "danger";
                $toast["message"] = "Password field cannot be empty";
            }

            if ($toast != null) {
                $this->session->set_userdata("toast", $toast);
                $this->session->set_userdata("form", $this->input->post(NULL));
                redirect("auth/login");
            }

            $user = $this->UserModel->getUserByEmail($email);

            $verify_response = verifyPassword($password, $user['password']);

            if ($verify_response === false || empty($password) || empty($user['password']) || empty($user["id"])) {

                $toast["type"] = "danger";
                $toast["message"] = "Invalid email / password combination";

                $this->session->set_userdata("toast", $toast);
                $this->session->set_userdata("form", $this->input->post(NULL));
                redirect("auth/login");
            }

            createUserSession($user['id']);

            redirect('drive');
        }
    }


    public function logout()
    {
        clearSession($this->response_data["user"]["id"]);
        redirect("auth/login");
    }
}
