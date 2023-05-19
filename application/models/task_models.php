<?php
    class task_models extends CI_Model {
        /**==================================================
		 * getTask
		 * @param {String} $module
		 * @return {Object}
		==================================================**/
        public function get($module) {
			$from = '';
			if($module == 'project') {
				$from = 'userProject';
			} else if ($module == 'task') {
				$from = 'projectTask';
			}

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
							".$from."
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
		 * @return {Object}
		==================================================**/
        public function insert($module, $title, $description, $eta, $time, $updateDate, $priority, $moduleID) {
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
                ", [$title, $description, $eta, $time, $updateDate, $priority]);
				$insertedTaskID = $this->db->insert_id();

                if($module == 'task') {
                    $this->db->query("
                        INSERT INTO projectTask(
                            projectID,
                            taskID
                        )
                        VALUES(
                            ?,
                            ?
                        )
                    ", [$moduleID, $insertedTaskID]);
                } else if($module == 'project') {
                    $this->db->query("
                        INSERT INTO userProject(
							userID,
                            projectID
                        )
                        VALUES(
                            ?,
                            ?
                        )
                    ", [$moduleID, $insertedTaskID]);
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
        public function update($module, $id, $title, $description, $eta, $time, $updateDate, $priority, $moduleID) {
			$this->db->trans_start();
				$this->db->query("
					UPDATE task
					SET
						title       = ?,
						description = ?,
						eta         = ?,
						time        = ?,
						updateDate  = ?,
						priority    = ?
					WHERE
						id = ?
				", [$title, $description, $eta, $time, $updateDate, $priority, $id]);

				if($module == 'task') {
                    $this->db->query("
						UPDATE projectTask
						SET
                            projectID = ?
						WHERE
							id = (
								SELECT
									id
								FROM
									projectTask
								WHERE
									taskID = ?
							)
                    ", [$moduleID, $id]);
                } else if($module == 'project') {
                    $this->db->query("
						UPDATE userProject
						SET
							userID = ?
						WHERE
							id = (
								SELECT
									id
								FROM
									userProject
								WHERE
									projectID = ?
							)
                    ", [$moduleID, $id]);
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