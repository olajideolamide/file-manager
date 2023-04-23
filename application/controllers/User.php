<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/Admin_Controller.php';
class User extends Admin_Controller
{


	public function dashboard()
	{
		$view = "user/dashboard";
		$this->render($view);
	}
}
