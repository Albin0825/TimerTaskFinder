<?php
    class post_models extends CI_Model {   
        public function getPost() {
                $result = $this->db->query("
                        SELECT
                                id,
                                title,
                                text,
                                updateDate
                        FROM
                                post
                        ORDER BY
                                priority DESC
                        LIMIT
                                500
                ");
                return $result->result_array();
        }
        
        public function getOnePost($id) {
                $result = $this->db->query("
                        SELECT
                                title,
                                text,
                                updateDate,
                                priority
                        FROM
                                post
                        WHERE
                                id = ?
                ", [$id]);
                return $result->result_array();
        }

        public function insertPost($title, $text, $updateDate, $priority) {
                $this->db->query("
                        INSERT INTO post(
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
        
        public function updatePost($id, $title, $text, $updateDate, $priority) {
                $this->db->query("
                        UPDATE post
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
        
        public function deletePost($id) {
                $this->db->query("
                        DELETE FROM post
                        WHERE
                                id = ?
                ", [$id]);
                return ($this->db->affected_rows() > 0) ? true : false;
        }
    }
?>