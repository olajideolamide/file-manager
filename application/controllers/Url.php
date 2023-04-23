<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/Main_Controller.php';
class Url extends Main_Controller
{

    public function __construct()
    {
        parent::__construct();



        $this->load->model("UrlModel");
    }



    public function add_link()
    {
        $this->UrlModel->addURL($this->input->post());
        echo json_encode(array());
        die;
    }

    public function gen_vanity()
    {
        $vanity = $this->UrlModel->generateVanity();

        echo json_encode(array("vanity" => $vanity));
        die;
    }


    public function validate_vanity()
    {

        $valid = $this->UrlModel->vanityUsed($this->input->post("vanity"));

        if ($valid !== true) {
            echo json_encode(array());
        } else {
            $this->output->set_status_header(400);
            echo "The vanity your provided is not available.";
        }

        die;
    }


    public function meeting($vanity)
    {
       
        $is_crawler = $this->UrlModel->isCrawler();

        $view = "url/meeting";
        $data = $this->UrlModel->getLink($vanity);


        if (empty($data["title"])) {
            die("Invalid link");
        }

        if ($is_crawler === FALSE) {
            header('Location: ' . $data['zoom_link']);
        }

        echo $this->load->view($view, $data, TRUE);
    }
}
