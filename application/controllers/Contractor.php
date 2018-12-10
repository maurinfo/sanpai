<?php

	class Contractor extends CI_Controller{
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->fbsql_database();
		}
	}

	public function list(){
		$query = $this->db->get("contractor");
		$data['record'] = $query->result();
		$this->load->view()

	}

	public function delete($id){
		if($this->db->delete("firm","id=".$id)){
			return true;
		}
	}

	public function update($id,$data){
		$this->db->set($data);
		$this->db->where("id",$id)
		$this->db->update("firm",$data);


		dsfsdfdsfafd
		asdfdasfdfadf
		sadfadsfadf
	}
	?>