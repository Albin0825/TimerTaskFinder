<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class timeReport_controllers extends CI_Controller {
        public function index() {
			$this->load->view('header_view');
			$this->load->view('timeReport_view');
		}
    }