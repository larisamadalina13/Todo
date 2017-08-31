<?php use Gregwar\Image\Image;
class Todos_model extends CI_Model {

    public function getUsers() 
    {
    	$query = $this->db->get('users');
        return $query->result_array();
    }

    public function getTodos() 
    {
    	$query = $this->db->get('todos');
        return $query->result_array();
    }

    public function getTodosById($todoId)
    {
    	$this->db->where('id',$todoId);
    	$query = $this->db->get('todos');
    	if($query->num_rows() > 0) {
    		return $query->row_array();
    	} else {
    		return false;
    	}
    }

    public function validateTodos($data)
    {
    	$errors = array();
		$length = strlen($data['title']);
		$len = strlen($data['description']);
		$u = $data['user_id'];
	
		if ( $length < 3 || $length > 255 ) {
			$errors['title'] = 'Titlul trebuie sa contina minim 3 caractere si maxim 255 de caractere !'; 
		}

		if ( $len > 255 ) {
			$errors['description'] = 'Descrierea depaseste numarul de caractere' ;
		}
	
		return $errors;
    }

    public function validateImage()
	{
		//var_dump($_FILES);
		$imageErrors = array();
		$image_len = $_FILES['image']['size'];
		$imageFileType = $_FILES['image']['type'];

		//  file size ... 
		if ( $image_len > 1048576) {
    		$imageErrors['image'] = 'Fisierul are dimensiunea mai mare decat 1 MB';
		}

		// tip imagine 
		if( $imageFileType != "image/jpeg") {
			$imageErrors['image'] = 'Sunt permise doar fisiere jpeg';
		}

		return $imageErrors;
	}

	public function insertTodo($data)
	{
		$user_id = $this->input->post('user_id');            
		$title = $this->input->post('title');      
		$description = $this->input->post('description');    
		$notification_date = $this->input->post('notification_date');  

		$data = array ( 'user_id' => $user_id, 
						'title' => $title,
						'description' => $description,
						'notification_date' => $notification_date 
		);

		$this->db->set($data);
		//$this->db->insert($this->db->dbprefix . 'todos');
		$this->db->insert('todos', $data);
		$todoId = $this->db->insert_id();

		return $todoId;
		
	}

	public function insertImage($todoId) 
	{
		$filetmp = $_FILES['image']['tmp_name'];

		$path = "$todoId.jpg"; 
		$finalPath = "uploads\\$path";
    	move_uploaded_file($filetmp, $finalPath);

    	$data = array('image' =>$path);

    	//$this->resizeImage($finalPath, 100, 100); //pt varianta 1 de resize
    	$this->resizeImage($finalPath);

    	$this->db->set('image', $path);
		//$this->db->set('', $this->resizeImage($finalPath)); pt imaginea redimensionata 
    	$this->db->where('id', $todoId);
    	$this->db->update('todos', $data);

	}
 
	 //o varianta pt resize image
	/*public function resizeImage($path, $w, $h)
	{
		// de facut cu gregwar image in loc de calculele de mai jos si apoi trebe sa apara in tabel thumbnail-ul ci nu imaginea mare 
		// si apoi cand dam click pe ea sa apara ca un modal imaginea cea mare (ca la facebook)
		list($width, $height) = getimagesize($path);
    	$r = $width / $height;

        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }

    $src = imagecreatefromjpeg($path);
    $dst = imagecreatetruecolor($newwidth, $newheight);

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    $newPath='thumbnails\\'.basename($path,'.jpg').'-thumbnail.jpg';
    //$newPath='thumbnails/'.basename($path,'.jpg').'-thumbnail.jpg';

    $output = imagejpeg($dst, $newPath, 100);

	//var_dump($newPath, $output); die;
    return $newPath;

	}*/

	public function resizeImage($path)
	{
		$newPath = 'thumbnails\\'.basename($path,'.jpg').'.jpg';

        Image::open($path)
	     ->resize(100, 100)
	     ->save($newPath);

		return $newPath;
	}

	public function deleteTodo($todoId)
	{
		$this->db->where('id',$todoId);
		$this->db->delete('todos');

		if($this->db->affected_rows() > 0) {
			return true;
		} else { 
			return false;
		}

	}

	public function UpdateTodo($id, $dataUpdate)
	{
		$todoId = $this->db->insert_id(); 

		$title = $dataUpdate["title"];
    	$description = $dataUpdate["description"];
   		$notification_date = $dataUpdate["notification_date"];
   		$image = $dataUpdate["image"];

		$dataUpdate = array ( 'title' => $title,
    						  'description' => $description,
    					      'notification_date' => $notification_date
    					      
    	);

    	$this->db->where('id',$todoId);
		$this->db->update('todos',$dataUpdate);

		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}




	// delete buton pt todos si de facut modal ....   
}