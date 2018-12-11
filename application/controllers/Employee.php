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

		        $data['title'] = 'Employee';
		        $data['action']= 'add';
		        $data['employee'] = NULL;

		                    
	            $this->load->view('templates/header');
			 	$this->load->view('employee/editor',$data);
				$this->load->view('templates/footer');
	               
			}else{
				$data['title'] = 'Employee';
		        $data['action']= 'edit';
				$data['employee'] = $this->employee_mod->getemployee($id);
			  	
			  	if (empty($data['employee'])){
			  		show_404();
			  	}

		        $this->load->view('templates/header');
				$this->load->view('employee/editor',$data);
				$this->load->view('templates/footer');			


			}
			

		}

		public function save($id="new"){

			if ($id=="new"){
				
				$this->form_validation->set_rules('name', 'name', 'required');

				if($this->form_validation->run() ===FALSE){

					$this->load->view('templates/header');
					$this->load->view('employee/input',$data);
					$this->load->view('templates/footer');			
				
				}else{

				/*	$data =  array(
					
					'name' => $this->input->post('name'),
	                'furigana' => $this->input->post('furigana'),
	                'birthdate' => date("Y-m-d",strtotime($this->input->post('birthdate'))),
	                'gender' => $this->input->post('gender'),
				 	
				 	);
				*/
					$data =	$this->input->post();
					$data['birthdate'] = date("Y-m-d",strtotime($this->input->post('birthdate'))); /*date needs to be converted*/
					$this->employee_mod->addemployee($data);
	                redirect('employee');
	             //   print_r($data);
            	}



            }else{

					$id = $this->input->post('id');
					$data = $this->input->post();
 				 	$data['birthdate'] = date("Y-m-d",strtotime($this->input->post('birthdate')));/*date needs to be converted*/
					$this->employee_mod->editemployee($id,$data);
	                redirect('employee');

            }
		}

    	public function delete($id){
			echo $id;

			$this->employee_mod->delemployee($id);
			redirect('employee');
		
			

		}
	}
