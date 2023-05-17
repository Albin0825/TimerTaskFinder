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
			$this->load->model('projectTask_models');

			$data = [];
			$data['module']      = 'task';
			$data['moduleID']    = !empty($_POST['moduleID'])    ? $_POST['moduleID']    : null;
			$data['secModuleID'] = !empty($_POST['secModuleID']) ? $_POST['secModuleID'] : null;
			$data['id']          = !empty($_POST['id'])          ? $_POST['id']          : null;
			$data['title']       = !empty($_POST['title'])       ? $_POST['title']       : null;
			$data['description'] = !empty($_POST['description']) ? $_POST['description'] : null;
			$data['eta']         = !empty($_POST['eta'])         ? $_POST['eta']         : null;
			$data['time']        = !empty($_POST['time'])        ? $_POST['time']        : null;
			$data['updateDate']  = !empty($_POST['updateDate'])  ? $_POST['updateDate']  : null;
			$data['priority']    = !empty($_POST['priority'])    ? $_POST['priority']    : null;
			return $data;
		}

		/**==================================================
		 * getTask
		==================================================**/
		public function get() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->get(
				$helperData['module']
			);
			
			echo json_encode($data);
		}

		/**==================================================
		 * showTask
		==================================================**/
		public function getOne() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->getOne(
				$helperData['id']
			);
			
			echo json_encode($data);
		}

		/**==================================================
		 * sendTask
		==================================================**/
		public function insert() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->insert(
				$helperData['module'],
				$helperData['title'],
				$helperData['description'],
				$helperData['eta'],
				$helperData['time'],
				$helperData['updateDate'],
				$helperData['priority'],
				$helperData['moduleID'],
				$helperData['secModuleID']
			);
			
			echo json_encode($data);
		}
		
		/**==================================================
		 * updateTask
		==================================================**/
		public function update() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->update(
				$helperData['id'],
				$helperData['title'],
				$helperData['description'],
				$helperData['eta'],
				$helperData['time'],
				$helperData['updateDate'],
				$helperData['priority']
			);
			
			echo json_encode($data);
		}
		
		/**==================================================
		 * deleteTask
		==================================================**/
		public function delete() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->delete(
				$helperData['module'],
				$helperData['moduleID'],
				$helperData['id']
			);

			echo json_encode($data);
		}

		/**==================================================
		 * priority
		==================================================**/
		public function priority() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->priority(
				$helperData['module']
			);

			echo json_encode($data);
		}
	}