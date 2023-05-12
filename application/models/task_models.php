<?php
    class task_models extends CI_Model {   
        public function getTask() {
                $result = $this->db->query("
                        SELECT
                                id,
                                title,
                                description,
                                updateDate
                        FROM
                                task
                        ORDER BY
                                priority DESC
                        LIMIT
                                500
                ");
                return $result->result_array();
        }
        
        public function getOneTask($id) {
                $result = $this->db->query("
                        SELECT
                                title,
                                description,
                                updateDate,
                                priority
                        FROM
                                task
                        WHERE
                                id = ?
                ", [$id]);
                return $result->result_array();
        }

        public function insertTask($title, $description, $updateDate, $priority) {
                $this->db->query("
                        INSERT INTO task(
                                title,
                                description,
                                updateDate,
                                priority
                        )
                        VALUES(
                                ?,
                                ?,
                                ?,
                                ?
                        )
                ", [$title, $description, $updateDate, $priority]);
                return ($this->db->affected_rows() > 0) ? true : false;
        }
        
        public function updateTask($id, $title, $description, $updateDate, $priority) {
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
        
        public function deleteTask($id) {
                $this->db->query("
                        DELETE FROM task
                        WHERE
                                id = ?
                ", [$id]);
                return ($this->db->affected_rows() > 0) ? true : false;
        }

        public function priority() {
                $result = $this->db->query("
                        SELECT
                                priority
                        FROM
                                task
                        ORDER BY
                                priority DESC
                        LIMIT
                                1
                ");
                return $result->result_array();
        }
    }
?>