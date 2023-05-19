<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class task_controllers extends MY_projectTask_controllers {
		public function index() {
			$this->load->view('header_view');
			$this->load->view('task_view');
		}
		
		public function task() {
			$this->load->view('header_view');
			$this->load->view('task_view');
			$this->load->view('openTask_view');
		}

		//the rest of the functions are in "core -> MY_Controller.php"
	}