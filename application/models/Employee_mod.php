<?php

	class employee_mod extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getemployeelist($id = FALSE){

			if ($id === FALSE){
                $this->db->order_by("furigana", "asc");
                $query = $this->db->get('employee');
			/**	$query = $this->db->get('employee');*/
				return $query->result_array();

			}

			$query = $this->db->get_where('employee', array('id' =>$id));
			return $query->result_array();

		}
        
		public function addemployee($data){
            //if ($this->input->post('gender') == "male"){ 
              //  $gender= 1; 
            //}else{ 
              //  $gender= 0; 
            //};
			$data =  array(
				'name' => $this->input->post('name'),
                'furigana' => $this->input->post('furigana'),
                'birthdate' => date("Y-m-d",strtotime($this->input->post('birthdate'))),
                'gender' => $this->input->post('gender'),
			 );

			return $this->db->insert('employee',$data);
            echo ($data);
		}

		public function delemployee($id){
			$this->db->where('id',$id);
			$this->db->delete('posts');
			return true;

		}
	}