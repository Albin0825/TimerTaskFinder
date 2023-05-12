<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class main_controllers extends CI_Controller {
		public function index() {
			$this->load->view('main_view');
		}

		function helper() {
			$data = [];
			$data['id']          = !empty($_POST['id'])          ? $_POST['id']          : null;
			$data['title']       = !empty($_POST['title'])       ? $_POST['title']       : null;
			$data['text']        = !empty($_POST['text'])        ? $_POST['text']        : null;
			$data['updateDate']  = !empty($_POST['updateDate'])  ? $_POST['updateDate']  : null;
			$data['priority']    = !empty($_POST['priority'])    ? $_POST['priority']    : null;
			return $data;
		}

		public function getTask() {
			$this->load->model('post_models');
			$data = $this->post_models->getTask();
			
			echo json_encode($data);
		}

		public function showTask() {
			$helperData = $this->helper();

			$this->load->model('post_models');
			$data = $this->post_models->getOneTask($helperData['id']);
			
			echo json_encode($data);
		}

		public function sendTask() {
			$helperData = $this->helper();
			
			$this->load->model('post_models');
			$data = $this->post_models->insertTask($helperData['title'], $helperData['text'], $helperData['updateDate'], $helperData['priority']);
			
			echo json_encode($data);
		}
		
		public function updateTask() {
			$helperData = $this->helper();
			
			$this->load->model('post_models');
			$data = $this->post_models->updateTask($helperData['id'], $helperData['title'], $helperData['text'], $helperData['updateDate'], $helperData['priority']);
			
			echo json_encode($data);
		}
		
		public function deleteTask() {
			$helperData = $this->helper();

			$this->load->model('post_models');
			$data = $this->post_models->deleteTask($helperData['id']);

			echo json_encode($data);
		}

		public function task() {
			$this->load->view('main_view');
			$this->load->view('post_view');
		}
	}