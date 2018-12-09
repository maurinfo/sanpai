<?php

	class Pages extends CI_Controller{
		public function view($page='dashboard'){
			if (!file_exists(APPPATH.'views/'.$page.'/index.php')){
				print_r(APPPATH.'views/'.$page.'/index.php');
				show_404();
			}

			$data['title'] = ucfirst($page);
			

			
	
	 		$this->load->view('templates/header');
			$this->load->view($page.'/index.php',$data);
			$this->load->view('templates/footer');



		}
	}
?>