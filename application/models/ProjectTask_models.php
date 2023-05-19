<?php
	class projectTask_models extends CI_Model {
		/**==================================================
		 * getTask
		 * @param {String} $module
		 * @return {Object}
		==================================================**/
		public function getTaskByProject($id) {
			$result = $this->db->query("
				SELECT
					id,
					projectID,
					taskID
				FROM
					projectTask
				WHERE
					projectID = ?
			", [$id]);

			return $result->result_array();
		}

		/**==================================================
		 * getOneTask
		 * @param {Number} $id
		 * @return {Object}
		==================================================**/
		public function getProjectByTask($id) {
			$result = $this->db->query("
				SELECT
					id,
					projectID,
					taskID
				FROM
					projectTask
				WHERE
					taskID = ?
			", [$id]);
			return $result->result_array();
		}

		/**==================================================
		 * insertTask
		 * @param {Number} $moduleID
		 * @param {Number} $id
		 * @return {Object}
		==================================================**/
		public function verifyProjectTask($moduleID, $id) {
			$this->db->query("
				SELECT
					id,
					projectID,
					taskID
				FROM
					projectTask
				WHERE
					projectID = ? AND
					taskID = ?
			", [$moduleID, $id]);
			return ($this->db->affected_rows() > 0) ? true : false;
		}
	}
?>