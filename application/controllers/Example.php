<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends REST_Controller 
{
	public function __construct()
	{
		parent::__construct(); //Make sure you call it
	}

	public function index()
	{
		$this->load->view('page.php');
	}

}
