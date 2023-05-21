<?php
    class task_models extends CI_Model {
        /**==================================================
		 * getTask
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
        public function get($data) {
			$from = '';
			if($data['module'] == 'project') {
				$from = 'userProject';
			} else if ($data['module'] == 'task') {
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
							".$data['module']."ID
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
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
        public function getOne($data) {
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
            ", [$data['id']]);
            return $result->result_array();
        }

        /**==================================================
		 * insertTask
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
        public function insert($data) {
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
                ", [$data['title'], $data['description'], $data['eta'], $data['time'], $data['updateDate'], $data['priority']]);
				$insertedTaskID = $this->db->insert_id();

                if($data['module'] == 'task') {
                    $this->db->query("
                        INSERT INTO projectTask(
                            projectID,
                            taskID
                        )
                        VALUES(
                            ?,
                            ?
                        )
                    ", [$data['moduleID'], $insertedTaskID]);
                    $this->db->query("
						UPDATE task
						SET
							time = time + ?
						WHERE
							id = (
								SELECT
									projectID
								FROM
									projectTask
								WHERE
									taskID = ?
							)
                    ", [$data['addedHours'], $insertedTaskID]);
                } else if($data['module'] == 'project') {
                    $this->db->query("
                        INSERT INTO userProject(
							userID,
                            projectID
                        )
                        VALUES(
                            ?,
                            ?
                        )
                    ", [$data['moduleID'], $insertedTaskID]);
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
		 * @param {Object} $data
		 * @return {Boolean}
		==================================================**/
        public function update($data) {
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
				", [$data['title'], $data['description'], $data['eta'], $data['time'], $data['updateDate'], $data['priority'], $data['id']]);

				if($data['module'] == 'task') {
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
                    ", [$data['moduleID'], $data['id']]);
                    $this->db->query("
						UPDATE task
						SET
							time = time + ?
						WHERE
							id = (
								SELECT
									projectID
								FROM
									projectTask
								WHERE
									taskID = ?
							)
                    ", [$data['addedHours'], $data['id']]);
                } else if($data['module'] == 'project') {
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
                    ", [$data['moduleID'], $data['id']]);
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
		 * @param {Object} $data
		 * @return {Boolean}
		==================================================**/
        public function delete($data) {
            $this->db->trans_start();
                $this->db->query("
                    DELETE FROM task
                    WHERE
                        id = ?
                ", [$data['id']]);
                if($data['module'] == 'task') {
                    $this->db->query("
                        DELETE FROM projectTask
                        WHERE
                            taskID = ?
                    ", [$data['id']]);
                } else if($data['module'] == 'project') {
                    $this->db->query("
						DELETE FROM projectTask
						WHERE
							projectID = ?
                    ", [$data['id']]);
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
		 * @param {Object} $data
		 * @return {Object}
		==================================================**/
        public function priority($data) {
            $result = $this->db->query("
				SELECT
					priority
				FROM
					task
				WHERE
					id IN (
						SELECT
							".$data['module']."ID
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