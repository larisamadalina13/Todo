<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todos extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Todos_model');
	}

	public function index()
	{

		$this->load->model('Todos_model');
		$data['users'] = $this->Todos_model->getUsers();
		$data['todos'] = $this->Todos_model->getTodos(); 
    
		if (count($_POST)) {

			if($_POST['actiontype'] == 'insert') {
				$errors = $this->Todos_model->validateTodos($_POST); 
				$imageErrors = $this->Todos_model->validateImage();

				$data['errors'] = $errors;
				$data['imageErrors'] = $imageErrors;

				if( count($errors) == 0 && count($imageErrors) == 0) {
					$todoId = $this->Todos_model->insertTodo($data);
					if (is_int($todoId) ) {

					$resultUpload = $this->Todos_model->insertImage($todoId);
					$data['success'] = true;

				} else { //var_dump($todoId);
					//echo '<span style="color:red;font-size: 20"> A aparut o eroare neasteptata !</span>'.'<br>'; 
					$data['success'] = false;
				}}
			}
			
			if($_POST['actiontype'] == 'delete') {

				$todoId = $this->input->post("todoId");
				$this->Todos_model->deleteTodo($todoId);
				$path = "$todoId.jpg";
				$result = unlink("uploads\\$path");
var_dump($result); die;
				if($todoId) {
					//var_dump($todoId);
					//echo 's-a sters';
				}
			}

		}

		
		$this->load->view("todos", $data);

	}

	public function edit($todoId)
	{
			$this->load->model('Todos_model');
			$dataUpdate = $this->input->post();

			if (count($dataUpdate)) {

		 		$this->Todos_model->updateTodo($todoId,$dataUpdate);

			}

			$data['todo'] = $this->Todos_model->getTodosById($todoId);
		 	$data['todos'] = $this->Todos_model->getTodos();
			$this->load->view('TodosForm2',$data); 

			if( $this->input->post('submit')) {
				header('Location: '.'/framework/index.php/todos'); 
			}
	}

	public function insert() //pt modal
	{

		$data = $this->input->post();

		$errorsTodos = $this->Todos_model->validateTodos($data);
		//$imageErrors = $this->Todos_model->validateImage();
		$response['errors'] = $errorsTodos; 

		if( count($errorsTodos) == 0 /*&& count($imageErrors) == 0*/) {
			$todoId = $this->Todos_model->insertTodo($data);
			$response['success'] = true;
			//echo '<span style="color:green;font-size: 20"> Inregistrarea a fost trimisa cu succes !</span>'.'<br>';
		}
		else {
			$response['success'] = false;
		}
		echo json_encode($response);
	}
}

		


