<?php
    class userProject_models extends CI_Model {
		/**==================================================
		 * getTask
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
		public function getProjectByUser($data) {
			$result = $this->db->query("
				SELECT
					id,
					userID,
					projectID
				FROM
					userProject
				WHERE
					userID = ?
			", [$data['id']]);

			return $result->result_array();
		}

		/**==================================================
		 * getOneTask
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
		public function getUserByProject($data) {
			$result = $this->db->query("
				SELECT
					id,
					userID,
					projectID
				FROM
					userProject
				WHERE
					projectID = ?
			", [$data['id']]);
			return $result->result_array();
		}

		/**==================================================
		 * insertTask
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
		public function verifyUserProject($data) {
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
			", [$data['moduleID'], $data['id']]);
			return ($this->db->affected_rows() > 0) ? true : false;
		}
	}
?>