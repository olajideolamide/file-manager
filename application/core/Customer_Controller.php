<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/Main_Controller.php';
class Customer_Controller extends Main_Controller
{


    public function __construct()
    {
        parent::__construct();


        //if (!isLoggedIn()) {
            //redirect("login");
       // }

    }


}
