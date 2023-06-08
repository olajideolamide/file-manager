<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class APIController extends BaseController
{

    use ResponseTrait;
    /**
     * Data sent back for the request
     *
     * @var array
     */

    public $data;

    public $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form'];
    public $db;
    public $session;

    public function initController($request, $response, $logger)
    {
        $this->db = \Config\Database::connect();

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->session = \Config\Services::session();

        $this->request =  \Config\Services::request();
    }




}
