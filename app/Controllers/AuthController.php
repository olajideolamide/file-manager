<?php

namespace App\Controllers;

class AuthController extends BaseController
{

    /**
     * Data sent back for the request
     *
     * @var array
     */

    public $data;

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

    }



    public function render($view)
    {
        return view('global/auth_header', $this->data) . view($view, $this->data) . view('global/auth_footer', $this->data);
    }
}
