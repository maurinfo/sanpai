<?php

	class employee_mod extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function get_employee($id = FALSE) {

			if ($id === FALSE){
                $this->db->order_by("furigana", "asc");
                $query = $this->db->get('employee');
				return $query->result_array();

			}

			$query = $this->db->get_where('employee', array('id' =>$id));
			return $query->row_array();
		}

		public function save($data) {
            $this->db->trans_start();

            if(isset($data['id'])) {
                $this->delete($data['id']);
            }
			$this->db->insert('employee',$data);

            $this->db->trans_complete();

            return $this->db->trans_status();
		}

		public function delete($id){
			$this->db->where('id',$id);
			$this->db->delete('employee');
			return true;

		}
	}
