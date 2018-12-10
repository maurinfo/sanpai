<?php

	class Contractor extends CI_Controller{
	{
		
		function __construct()
		{
			parent:: __construct();

		}
	}

	public function insert($data){
		if($this->db->insert("firm",$data)){
			return true;
		}
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
	}
	?>