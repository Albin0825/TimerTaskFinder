<?php
    class user_models extends CI_Model {        
        /**==================================================
		 * getOneTask
		 * @param {Number} $id
		 * @return {Object}
		==================================================**/
        public function verifyUser($moduleID) {
            $result = $this->db->query("
                SELECT
                    id,
                    username
                FROM
                    user
                WHERE
					id = ?
            ", [$moduleID]);
            return $result->num_rows() != 0 ? true : false;
        }
    }
?>