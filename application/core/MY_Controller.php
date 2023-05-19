<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class MY_projectTask_controllers extends CI_Controller {
		public function __construct() {
			parent::__construct();
		}
		
		/**==================================================
		 * helper
		==================================================**/
        function helper() {
			$this->load->model('task_models');
			$this->load->model('projectTask_models');
			$this->load->model('userProject_models');
			$this->load->model('user_models');

			$data = [];
			$data['module']      = !empty($_POST['module'])      ? $_POST['module']      : null;;
			$data['moduleID']    = !empty($_POST['moduleID'])    ? $_POST['moduleID']    : null;
			$data['id']          = !empty($_POST['id'])          ? $_POST['id']          : null;
			$data['title']       = !empty($_POST['title'])       ? $_POST['title']       : null;
			$data['description'] = !empty($_POST['description']) ? $_POST['description'] : null;
			$data['eta']         = !empty($_POST['eta'])         ? $_POST['eta']         : null;
			$data['time']        = !empty($_POST['time'])        ? $_POST['time']        : 0;
			$data['updateDate']  = !empty($_POST['updateDate'])  ? $_POST['updateDate']  : null;
			$data['priority']    = !empty($_POST['priority'])    ? $_POST['priority']    : 0;
			return $data;
		}

/**====================================================================================================
 * project or tasks
====================================================================================================**/
		/**==================================================
		 * get all project or tasks
		==================================================**/
        public function get() {
			$helperData = $this->helper();
			$data = $this->task_models->get(
				$helperData['module']
			);

			echo json_encode($data);
		}

		/**==================================================
		 * gets one project or task
		==================================================**/
        public function getOne() {
			$helperData = $this->helper();
			$data = $this->task_models->getOne(
				$helperData['id']
			);

			echo json_encode($data);
		}

		/**==================================================
		 * adds one new project or task
		==================================================**/
        public function insert() {
			$helperData = $this->helper();
			$data = $this->task_models->insert(
				$helperData['module'],
				$helperData['title'],
				$helperData['description'],
				$helperData['eta'],
				$helperData['time'],
				$helperData['updateDate'],
				$helperData['priority'],
				$helperData['moduleID']
			);

			echo json_encode($data);
		}

		/**==================================================
		 * updates a project or task
		==================================================**/
        public function update() {
			$helperData = $this->helper();
			$data = $this->task_models->update(
				$helperData['module'],
				$helperData['id'],
				$helperData['title'],
				$helperData['description'],
				$helperData['eta'],
				$helperData['time'],
				$helperData['updateDate'],
				$helperData['priority'],
				$helperData['moduleID']
			);

			echo json_encode($data);
		}

		/**==================================================
		 * deletes a project or task
		==================================================**/
        public function delete() {
			$helperData = $this->helper();
			$data = $this->task_models->delete(
				$helperData['module'],
				$helperData['moduleID'],
				$helperData['id']
			);

			echo json_encode($data);
		}

		/**==================================================
		 * gets the priority of a project or task
		==================================================**/
        public function priority() {
			$helperData = $this->helper();
			$data = $this->task_models->priority(
				$helperData['module']
			);

			echo json_encode($data);
		}

/**====================================================================================================
 * projectTask
====================================================================================================**/
		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function getTaskByProject() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->getTaskByProject(
				$helperData['id']
			);

			echo json_encode($data);
		}
		
		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function getProjectByTask() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->getProjectByTask(
				$helperData['id']
			);

			echo json_encode($data);
		}

		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function verifyProjectTask() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->verifyProjectTask(
				$helperData['moduleID'],
				$helperData['id']
			);

			echo json_encode($data);
		}

/**====================================================================================================
 * userProject
====================================================================================================**/
		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function getProjectByUser() {
			$helperData = $this->helper();
			$data = $this->userProject_models->getProjectByUser(
				$helperData['id']
			);

			echo json_encode($data);
		}
		
		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function getUserByProject() {
			$helperData = $this->helper();
			$data = $this->userProject_models->getUserByProject(
				$helperData['id']
			);

			echo json_encode($data);
		}

		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function verifyUserProject() {
			$helperData = $this->helper();
			$data = $this->userProject_models->verifyUserProject(
				$helperData['moduleID'],
				$helperData['id']
			);

			echo json_encode($data);
		}

/**====================================================================================================
 * user
====================================================================================================**/
		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function verifyUser() {
			$helperData = $this->helper();
			$data = $this->user_models->verifyUser(
				$helperData['id']
			);

			echo json_encode($data);
		}
    }