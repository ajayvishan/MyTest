<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}

	public function registration()
	{
		$this->load->view("registration");
	}

    public function edit($id)
    {
        $this->load->view("edit", array('id' => $id));
    }

}
