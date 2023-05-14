<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class main_controllers extends CI_Controller {
		public function index() {
			$this->load->view('header_view');
			$this->load->view('main_view');
		}
		
		public function task() {
			$this->load->view('header_view');
			$this->load->view('main_view');
			$this->load->view('task_view');
		}

		function helper() {
			$this->load->model('task_models');

			$data = [];
			$data['id']          = !empty($_POST['id'])          ? $_POST['id']          : null;
			$data['title']       = !empty($_POST['title'])       ? $_POST['title']       : null;
			$data['description'] = !empty($_POST['description']) ? $_POST['description'] : null;
			$data['updateDate']  = !empty($_POST['updateDate'])  ? $_POST['updateDate']  : null;
			$data['priority']    = !empty($_POST['priority'])    ? $_POST['priority']    : null;
			return $data;
		}

		/**==================================================
		 * getTask
		==================================================**/
		public function getTask() {
			$helperData = $this->helper();
			$data = $this->task_models->getTask();
			
			echo json_encode($data);
		}

		/**==================================================
		 * showTask
		==================================================**/
		public function showTask() {
			$helperData = $this->helper();
			$data = $this->task_models->getOneTask($helperData['id']);
			
			echo json_encode($data);
		}

		/**==================================================
		 * sendTask
		==================================================**/
		public function sendTask() {
			$helperData = $this->helper();
			$data = $this->task_models->insertTask($helperData['title'], $helperData['description'], $helperData['updateDate'], $helperData['priority']);
			
			echo json_encode($data);
		}
		
		/**==================================================
		 * updateTask
		==================================================**/
		public function updateTask() {
			$helperData = $this->helper();
			$data = $this->task_models->updateTask($helperData['id'], $helperData['title'], $helperData['description'], $helperData['updateDate'], $helperData['priority']);
			
			echo json_encode($data);
		}
		
		/**==================================================
		 * deleteTask
		==================================================**/
		public function deleteTask() {
			$helperData = $this->helper();
			$data = $this->task_models->deleteTask($helperData['id']);

			echo json_encode($data);
		}

		/**==================================================
		 * priority
		==================================================**/
		public function priorityTask() {
			$helperData = $this->helper();
			$data = $this->task_models->priority();

			echo json_encode($data);
		}
	}