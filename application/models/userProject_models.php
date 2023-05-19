<?php
    class userProject_models extends CI_Model {
		/**==================================================
		 * getTask
		 * @param {String} $module
		 * @return {Object}
		==================================================**/
		public function getProjectByUser($id) {
			$result = $this->db->query("
				SELECT
					id,
					userID,
					projectID
				FROM
					userProject
				WHERE
					userID = ?
			", [$id]);

			return $result->result_array();
		}

		/**==================================================
		 * getOneTask
		 * @param {Number} $id
		 * @return {Object}
		==================================================**/
		public function getUserByProject($id) {
			$result = $this->db->query("
				SELECT
					id,
					userID,
					projectID
				FROM
					userProject
				WHERE
					projectID = ?
			", [$id]);
			return $result->result_array();
		}

		/**==================================================
		 * insertTask
		 * @param {Number} $moduleID
		 * @param {Number} $id
		 * @return {Object}
		==================================================**/
		public function verifyUserProject($moduleID, $id) {
			$this->db->query("
				SELECT
					id,
					userID,
					projectID
				FROM
					userProject
				WHERE
					userID = ? AND
					projectID = ?
			", [$moduleID, $id]);
			return ($this->db->affected_rows() > 0) ? true : false;
		}
	}
?>