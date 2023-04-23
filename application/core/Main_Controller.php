<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_Controller extends CI_Controller
{

    public $response_data;
    public $user_data;
    public function __construct()
    {
        parent::__construct();

        $this->response_data["header"] = 'global/admin_header';
        $this->response_data["footer"] = 'global/admin_footer';

        $this->response_data['app'] = $this->config->config['app'];
        $this->response_data['security']['csrf_name'] = $this->security->get_csrf_token_name();
        $this->response_data['security']['csrf_hash'] = $this->security->get_csrf_hash();




        $toast = $this->session->userdata("toast");
        if (!empty($toast)) {
            $this->response_data['toast'] = $toast;
            //empty it..
            $this->session->set_userdata("toast", null);

            //set the form
            $this->response_data["form"] =  $this->session->userdata("form");
            //empty it
            $this->session->set_userdata("form", null);
        }
    }


    public function render($view)
    {

        echo $this->load->view($this->response_data["header"], $this->response_data, TRUE);
        echo $this->load->view($view, $this->response_data, TRUE);
        echo $this->load->view($this->response_data["footer"], $this->response_data, tRUE);
        die;
    }

    public function showError($text)
    {

        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        echo $text;
        die;
    }
}
