<?php
    class post_models extends CI_Model {   
        public function getTask() {
                $result = $this->db->query("
                        SELECT
                                id,
                                title,
                                text,
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
                                text,
                                updateDate,
                                priority
                        FROM
                                task
                        WHERE
                                id = ?
                ", [$id]);
                return $result->result_array();
        }

        public function insertTask($title, $text, $updateDate, $priority) {
                $this->db->query("
                        INSERT INTO task(
                                title,
                                text,
                                updateDate,
                                priority
                        )
                        VALUES(
                                ?,
                                ?,
                                ?,
                                ?
                        )
                ", [$title, $text, $updateDate, $priority]);
                return ($this->db->affected_rows() > 0) ? true : false;
        }
        
        public function updateTask($id, $title, $text, $updateDate, $priority) {
                $this->db->query("
                        UPDATE task
                        SET
                                title = ?,
                                text = ?,
                                updateDate = ?,
                                priority = ?
                        WHERE
                                id = ?
                ", [$title, $text, $updateDate, $priority, $id]);
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
    }
?>