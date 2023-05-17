<?php
    class ProjectTask_models extends CI_Model {
        /**==================================================
		 * getTask
		 * @param {String} $module
		 * @return {Object}
		==================================================**/
        public function get($module) {
            $result = $this->db->query("
                SELECT
                    id,
                    title,
                    description,
					eta,
					time,
                    updateDate
                FROM
                    task
                WHERE
                    id IN (
                        SELECT
                            ".$module."ID
                        FROM
                            projecttask
                    )
                ORDER BY
                    priority DESC
                LIMIT
					500
            ");
            return $result->result_array();
        }
        
        /**==================================================
		 * getOneTask
		 * @param {Number} $id
		 * @return {Object}
		==================================================**/
        public function getOne($id) {
            $result = $this->db->query("
                SELECT
                    title,
                    description,
					eta,
					time,
                    updateDate,
                    priority
                FROM
                    task
                WHERE
                    id = ?
            ", [$id]);
            return $result->result_array();
        }

        /**==================================================
		 * insertTask
		 * @param {String} $module
		 * @param {String} $title
		 * @param {String} $description
		 * @param {Number} $eta
		 * @param {Number} $time
		 * @param {Date} $updateDate
		 * @param {Number} $priority
		 * @param {Number} $moduleID - taskID or projectID
		 * @param {Number} $secModuleID - projectID or userID
		 * @return {Object}
		==================================================**/
        public function insert($module, $title, $description, $eta, $time, $updateDate, $priority, $moduleID, $secModuleID) {
            $this->db->trans_start();
                $this->db->query("
                    INSERT INTO task(
                        title,
                        description,
                        eta,
                        time,
                        updateDate,
                        priority
                    )
                    VALUES(
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )
                ", [$title, $description, $updateDate, $priority]);
                if($module == 'task') {
                    $this->db->query("
                        INSERT INTO projectTask(
                            taskID,
                            projectID,
                        )
                        VALUES(
                            ?,
                            ?
                        )
                    ", [$taskID, $projectID]);
                } else if($module == 'project') {
                    $this->db->query("
                        INSERT INTO userProject(
                            projectID,
                            userID,
                        )
                        VALUES(
                            ?,
                            ?
                        )
                    ", [$projectID, 1]);
                } else {
                    $this->db->trans_rollback();
                }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return false;
            }
            return true;
        }
        
        /**==================================================
		 * updateTask
		 * @param {Number} $id
		 * @param {String} $title
		 * @param {String} $description
		 * @param {Number} $eta
		 * @param {Number} $time
		 * @param {Date} $updateDate
		 * @param {Number} $priority
		 * @return {Boolean}
		==================================================**/
        public function update($id, $title, $description, $eta, $time, $updateDate, $priority) {
            $this->db->query("
                UPDATE task
                SET
                    title = ?,
                    description = ?,
                    updateDate = ?,
                    priority = ?
                WHERE
                    id = ?
            ", [$title, $description, $updateDate, $priority, $id]);
            return ($this->db->affected_rows() > 0) ? true : false;
        }
        
        /**==================================================
		 * deleteTask
		 * @param {String} $module
		 * @param {Number} $moduleID - taskID or projectID
		 * @param {Number} $id
		 * @return {Boolean}
		==================================================**/
        public function delete($module, $moduleID, $id) {
            $this->db->trans_start();
                $this->db->query("
                    DELETE FROM task
                    WHERE
                        id = ?
                ", [$id]);
                if($module == 'task') {
                    $this->db->query("
                        DELETE FROM projectTask
                        WHERE
                            taskID = ?
                    ", [$moduleID]);
                } else if($module == 'project') {
                    $this->db->query("
						DELETE FROM projectTask
						WHERE
							projectID = ?
                    ", [$moduleID]);
                } else {
                    $this->db->trans_rollback();
                }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return false;
            }
            return true;
        }

        /**==================================================
		 * priority
		 * @param {String} $module
		 * @return {Object}
		==================================================**/
        public function priority($module) {
            $result = $this->db->query("
				SELECT
					priority
				FROM
					task
				WHERE
					id IN (
						SELECT
							".$module."ID
						FROM
							projecttask
					)
				ORDER BY
					priority DESC
				LIMIT
					1
            ");
            return $result->result_array();
        }
    }
?>