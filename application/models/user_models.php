<?php
    class user_models extends CI_Model {        
        /**==================================================
		 * getOneTask
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
        public function verifyUser($data) {
            $result = $this->db->query("
                SELECT
                    id,
                    username
                FROM
                    user
                WHERE
					id = ?
            ", [$data['id']]);
            return $result->num_rows() != 0 ? true : false;
        }
    }
?>