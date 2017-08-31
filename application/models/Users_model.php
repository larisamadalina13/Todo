<?php

class Users_model extends CI_Model {

	public function getUsers() 
    {
    	$query = $this->db->get('users');
       	return $query->result_array();
    }

    public function getUsersById($id)
    {
    	$this->db->where('id',$id);
    	$query = $this->db->get('users');
    	if($query->num_rows() > 0) {
    		return $query->row_array();
    	} else {
    		return false;
    	}
    }

    public function validateUsers($data)
    {
    		$errorsUsers = array();
			$length = strlen($data['name']);
			$len = strlen($data['email']);
			
			if ( $length < 3 || $length > 32  || (!preg_match("/^[a-zA-Z ]*$/",$data['name']))) {
				$errorsUsers['name'] = 'Numele trebuie sa contina minim 3 caractere si maxim 32 de caractere !'; 
			} 
			
			if ( $len < 5 || $len > 64 || (!preg_match("/^[a-zA-Z ]*$/",$data['name']))) {
				$errorsUsers['email'] = 'Emailul trebuie sa contina minim 5 si maxim 64 caractere!';
			}

			return $errorsUsers;
    }

    public function insertUser($data)
    {
    	$name = $data['name'];
    	$email = $data['email'];
   		$birthday = $data['birthday'];

    	$data = array ( 'name' => $name,
    					'email' => $email,
    					'birthday' => $birthday
    	);

    	$this->db->set($data);
    	$this->db->insert('users',$data);
		$userId = $this->db->insert_id(); 

    	return $userId;
    }

	public function updateUser($id, $dataUpdate) 
	{
		$name = $dataUpdate["name"];
    	$email = $dataUpdate["email"];
   		$birthday = $dataUpdate["birthday"];

		$dataUpdate = array ( 'name' => $name,
    						  'email' => $email,
    					      'birthday' => $birthday
    	);

		$this->db->where('id',$id);
		$this->db->update('users',$dataUpdate);

		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}

	}

	/*public function afterEdit()
	{
		$data['users'] = $this->Users_model->getUsers();
		$this->load->view("users",$data);	
	}*/

	public function deleteUser($id) 
	{
		$this->db->where('id',$id);
		$this->db->delete('users');

		if($this->db->affected_rows() > 0) {
			return true;
		} else { 
			return false;
		}
	}


}

?>