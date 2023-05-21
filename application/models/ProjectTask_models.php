<?php
	class projectTask_models extends CI_Model {
		/**==================================================
		 * getTask
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
		public function getTaskByProject($data) {
			$result = $this->db->query("
				SELECT
					id,
					projectID,
					taskID
				FROM
					projectTask
				WHERE
					projectID = ?
			", [$data['id']]);

			return $result->result_array();
		}

		/**==================================================
		 * getOneTask
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
		public function getProjectByTask($data) {
			$result = $this->db->query("
				SELECT
					id,
					projectID,
					taskID
				FROM
					projectTask
				WHERE
					taskID = ?
			", [$data['id']]);
			return $result->result_array();
		}

		/**==================================================
		 * insertTask
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
		public function verifyProjectTask($data) {
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
			", [$data['moduleID'], $data['id']]);
			return ($this->db->affected_rows() > 0) ? true : false;
		}
	}
?>