<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    /**
     * Homepage controller
     */
	public function index()
	{
	    $data['header']  = $this->load->view('partials/header', null, true);
		$data['content'] = $this->load->view('main',            null, true);
		$data['footer']  = $this->load->view('partials/footer', null, true);

		$this->load->view('layout', $data);
	}
}
