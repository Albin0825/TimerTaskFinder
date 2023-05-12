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
			$data['description'] = !empty($_POST['description']) ? $_POST['description'] : null;
			$data['updateDate']  = !empty($_POST['updateDate'])  ? $_POST['updateDate']  : null;
			$data['priority']    = !empty($_POST['priority'])    ? $_POST['priority']    : null;
			return $data;
		}

		public function getTask() {
			$this->load->model('task_models');
			$data = $this->task_models->getTask();
			
			echo json_encode($data);
		}

		public function showTask() {
			$helperData = $this->helper();

			$this->load->model('task_models');
			$data = $this->task_models->getOneTask($helperData['id']);
			
			echo json_encode($data);
		}

		public function sendTask() {
			$helperData = $this->helper();
			
			$this->load->model('task_models');
			$data = $this->task_models->insertTask($helperData['title'], $helperData['description'], $helperData['updateDate'], $helperData['priority']);
			
			echo json_encode($data);
		}
		
		public function updateTask() {
			$helperData = $this->helper();
			
			$this->load->model('task_models');
			$data = $this->task_models->updateTask($helperData['id'], $helperData['title'], $helperData['description'], $helperData['updateDate'], $helperData['priority']);
			
			echo json_encode($data);
		}
		
		public function deleteTask() {
			$helperData = $this->helper();

			$this->load->model('task_models');
			$data = $this->task_models->deleteTask($helperData['id']);

			echo json_encode($data);
		}

		public function task() {
			$this->load->view('main_view');
			$this->load->view('task_view');
		}
	}