<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class MY_projectTask_controllers extends CI_Controller {
		/**==================================================
		 * helper
		==================================================**/
        function helper() {
			$this->load->model('task_models');
			$this->load->model('projectTask_models');
			$this->load->model('userProject_models');
			$this->load->model('user_models');

			return !empty($_POST['formatedData']) ? $_POST['formatedData'] : null;
		}

/**====================================================================================================
 * project or tasks
====================================================================================================**/
		/**==================================================
		 * get all project or tasks
		==================================================**/
        public function get() {
			$helperData = $this->helper();
			$data = $this->task_models->get($helperData);

			echo json_encode($data);
		}

		/**==================================================
		 * gets one project or task
		==================================================**/
        public function getOne() {
			$helperData = $this->helper();
			$data = $this->task_models->getOne($helperData);

			echo json_encode($data);
		}

		/**==================================================
		 * adds one new project or task
		==================================================**/
        public function insert() {
			$helperData = $this->helper();
			$data = $this->task_models->insert($helperData);

			echo json_encode($data);
		}

		/**==================================================
		 * updates a project or task
		==================================================**/
        public function update() {
			$helperData = $this->helper();
			$data = $this->task_models->update($helperData);

			echo json_encode($data);
		}

		/**==================================================
		 * deletes a project or task
		==================================================**/
        public function delete() {
			$helperData = $this->helper();
			$data = $this->task_models->delete($helperData);

			echo json_encode($data);
		}

		/**==================================================
		 * gets the priority of a project or task
		==================================================**/
        public function priority() {
			$helperData = $this->helper();
			$data = $this->task_models->priority($helperData);

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
			$data = $this->projectTask_models->getTaskByProject($helperData);

			echo json_encode($data);
		}
		
		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function getProjectByTask() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->getProjectByTask($helperData);

			echo json_encode($data);
		}

		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function verifyProjectTask() {
			$helperData = $this->helper();
			$data = $this->projectTask_models->verifyProjectTask($helperData);

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
			$data = $this->userProject_models->getProjectByUser($helperData);

			echo json_encode($data);
		}
		
		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function getUserByProject() {
			$helperData = $this->helper();
			$data = $this->userProject_models->getUserByProject($helperData);

			echo json_encode($data);
		}

		/**==================================================
		 * looks if user exist in DB
		==================================================**/
        public function verifyUserProject() {
			$helperData = $this->helper();
			$data = $this->userProject_models->verifyUserProject($helperData);

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
			$data = $this->user_models->verifyUser($helperData);

			echo json_encode($data);
		}
    }