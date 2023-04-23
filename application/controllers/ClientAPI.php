<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Main_Controller.php';


class ClientAPI extends Main_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ClientModel");
        header('Content-Type: application/json');
    }


    public function index()
    {
        $options = $this->input->post(NULL);


        $result = $this->ClientModel->getClients(true, $options);

        $result["data"] = $this->ClientModel->formatData($result["data"]);
        echo json_encode($result);
        die;
    }

    public function add_client_form()
    {
        $this->response_data["currency_list"] = getCurrencyList();
        $this->load->helper("country");
        $this->response_data["country_list"] = getCountryList();
        $result["data"] = $this->load->view('client/modal/add_client_modal', $this->response_data, TRUE);
        $result["submit_url"] = "api/client/add_client";
        $result["modal"] = "large-modal";
        $result["trigger"] = $this->input->post("trigger");
        echo json_encode($result);
        die;
    }


    /**
     * Country filter options
     */
    public function filter_country_options()
    {
        $this->load->helper("country");
        $this->response_data["country_list"] = getCountryList();
        $this->response_data["name"] = $this->input->post("filter_name");
        $this->response_data["selection"] = $this->input->post("selection");
        $result["data"] = $this->load->view('client/modal/country_filter_modal', $this->response_data, TRUE);
        $result["submit_url"] = "api/clients/filter-options/country";
        $result["trigger"] = $this->input->post("trigger");
        $result["modal"] = "small-modal";


        echo json_encode($result);
        die;
    }

    public function add_client()
    {
        $payload = $this->input->post(NULL);

        $this->load->library('form_validation');
        $this->form_validation->set_data($payload);
        $this->form_validation->set_rules('name', 'Company Name', 'required');



        if ($this->form_validation->run() == FALSE) {
            $this->showError(validation_errors());
        }

        $data["name"] = $payload["name"];
        $data["vat"] = $payload["vat"];
        $data["phone"] = $payload["phone"];
        $data["website"] = $payload["website"];
        $data["currency"] = $payload["currency"];
        $data["address"] = $payload["address"];
        $data["city"] = $payload["city"];
        $data["state"] = $payload["state"];
        $data["country"] = $payload["country"];
        $data["zip"] = $payload["zip"];
        $data["date_created"] = date("Y-m-d H:i:s");
        $data["active"] = true;

        $client_id = $this->ClientModel->insertClient($data);

        //insert the client groups..
        foreach ($payload["groups"] as $group) {
            $this->ClientModel->mapClientToGroup($client_id, $group);
        }

        $response["type"] = "close";
        $response["toast_message"] = "Client added successfully";
        echo json_encode($response);
        die;
    }
}
