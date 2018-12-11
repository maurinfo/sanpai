<?php

	class employee extends CI_Controller{
		
		public function index(){

			$data['title'] = 'Employees';
			$data['employee'] = $this->employee_mod->getemployeelist();
		
			$this->load->view('templates/header');
			$this->load->view('employee/index',$data);
			$this->load->view('templates/footer');

		}

/**		public function view ($id = NULL){

			$data['employee'] = $this->employee_model->get_posts($id);

			if(empty($data['employee'])){
				show_404();
			}
			echo "string";

			print_r($data);
			$this->load->view('templates/header');
			$this->load->view('employee/view', $data);
			$this->load->view('templates/footer');
		}
*/
		public function add(){
            $data['title'] = 'New Employee';
		    $this->form_validation->set_rules('name', 'name', 'required');

			if($this->form_validation->run() ===FALSE){
                $this->load->view('templates/header');
			   $this->load->view('employee/add',$data);
				$this->load->view('templates/footer');

			}else{
				$this->mEmployee->addemployee($data);
                 echo($data);
				redirect('employee');
               
			}

		}
		public function edit(){
			$id = $this->uri->segment(3);
			$data["employee"] = $this->employee_mod->getemployeedata($id);
			

		}

    	public function delete($id){
			echo $id;

			$this->employee_mod->delemployee($id);
			redirect('employee');
		
			

		}
	}
