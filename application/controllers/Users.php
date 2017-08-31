<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Users_model');
	}

	public function index()
	{
		//$this->load->database();
		
		$data = $this->input->post();
		
		//$result = $this->Users_model->insertUser($data);
		if (count($data)) {
			if($data['actiontype']=='insert') {
				$errorsUsers = $this->Users_model->validateUsers($data);
				$data['errors'] = $errorsUsers; 
//var_dump($data);

				if( count($errorsUsers) == 0 /*&& $data['actiontype'] == 'insert'*/) {
					$userId = $this->Users_model->insertUser($data);
					$data['success'] = true;
					//echo '<span style="color:green;font-size: 20"> Inregistrarea a fost trimisa cu succes !</span>'.'<br>';
				}
				else {
					$data['success'] = false;
				}

			}
			
			
			//var_dump($userId);

			if( $data['actiontype'] == 'delete') {
				$userId = $this->input->post("userId");
				$userId = $this->Users_model->deleteUser($userId);//$this->Users_model->deleteUser($id);

				if($userId) {
					//echo 's-a sters cu succes';
				}

				//$data['user'] = $this->Users_model->getUsersById($id);
				//$this->load->view("users",$data);
			}
			
			if($data['actiontype'] == 'addUser') {
				$errorsAddUser = $this->Users_model->validateUsers($data);
				$data['errors'] = $errorsAddUser;
				if( count($errorsUsers) == 0) {
					$userId = $this->Users_model->insertUser($data);
					$data['success'] = true;
				}
				else {
					$data['success'] = false;
				}
				$this->load->view('menu');
    			$this->load->view('UserForm');
			}

		}
		
		$data['users'] = $this->Users_model->getUsers();
		$this->load->view("users",$data);
		
	}

	public function edit($id)
	{
		$this->load->model('Users_model');
		$dataUpdate = $this->input->post();

		if (count($dataUpdate)) {
/*azi 23 august apelare validare*/
	 		$this->Users_model->updateUser($id,$dataUpdate);

		}

	 	$data['user'] = $this->Users_model->getUsersById($id); 
	 	$data['users'] = $this->Users_model->getUsers();
		$this->load->view('UsersForm2',$data); 
		if( $this->input->post('submit')) {
			header('Location: '.'/framework/index.php/users'); 
		}

	}

	public function insert() //pt modal
	{

		$data = $this->input->post();

		$errorsUsers = $this->Users_model->validateUsers($data);
		$response['errors'] = $errorsUsers; 
		
		if( count($errorsUsers) == 0 ) {
			$userId = $this->Users_model->insertUser($data);
			$response['success'] = true;
			//echo '<span style="color:green;font-size: 20"> Inregistrarea a fost trimisa cu succes !</span>'.'<br>';
		}
		else {
			$response['success'] = false;
		}
		echo json_encode($response);
	}
}

?>