<?php

	class employee extends CI_Controller{
		
		public function index(){

			$data['title'] = 'Employees';
			$data['employee'] = $this->employee_mod->getemployee();
		
			$this->load->view('templates/header');
			$this->load->view('employee/index',$data);
			$this->load->view('templates/footer');

		}

		public function input($id="new"){

			if ($id=="new"){

		        $data['title'] = 'New Employee';
	            
	            $this->load->view('templates/header');
			 	$this->load->view('employee/input',$data);
				$this->load->view('templates/footer');
	               
			}else{

				$data['employee'] = $this->employee_mod->getemployee($id);
			  	
			  	if (empty($data['employee'])){
			  		show_404();
			  	}

		        $this->load->view('templates/header');
				$this->load->view('employee/edit',$data);
				$this->load->view('templates/footer');			


			}
			

		}

		public function save($id="new"){

			if ($id=="new"){
				
/*				$this->form_validation->set_rules('name', 'name', 'required');

				if($this->form_validation->run() ===FALSE){

					$data =  array(
					
					'name' => $this->input->post('name'),
	                'furigana' => $this->input->post('furigana'),
	                'birthdate' => date("Y-m-d",strtotime($this->input->post('birthdate'))),
	                'gender' => $this->input->post('gender'),
				 	
				 	);
*/					
					$this->employee_mod->addemployee($data);
	                redirect('employee');
            	

            }else{

					
					$this->employee_mod->editemployee($data);
	                redirect('employee');

            }
		}

    	public function delete($id){
			echo $id;

			$this->employee_mod->delemployee($id);
			redirect('employee');
		
			

		}
	}
