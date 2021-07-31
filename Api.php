<?php

//Api.php
include('config.php');


	// print_r ('mysql:host='.DB_HOST . '; dbname= . 'DB_NAME .',' DB_USER . ',' .DB_PWD );
	// exit();

class Api
{
	private $connect = '';

	
	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		// $this->connect = new PDO("mysql:host=localhost;dbname=fiqbal_gsm_api", "fiqbal_new", "fchina@2020");
		$this->connect = new PDO("mysql:host=localhost;dbname=gsm_api", "root", "");
		// $this->connect = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME .',' . DB_USER . ',' . DB_PWD );
	}

    
    function fetch_all()
	{
		$query = "SELECT * FROM users_mobile ORDER BY id";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_OBJ))
			{
				$data['users'][] = $row;
			}
			return $data;
		}
	}
	
	
	function fetch_new()
	{
		$query = "SELECT * FROM users_mobile where status = 0 ORDER BY id";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_OBJ))
			{
				$data['users'][] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_GET["name"]))
		{
			$form_data = array(
				':name'	    	=>	$_GET["name"],
				':mobile'		=>	$_GET["mobile"],
				':message'		=>	$_GET["message"],
				':status'		=>	$_GET["status"]
			);
			$query = "
			INSERT INTO users_mobile 
						(name, mobile, message, status) VALUES 
						(:name, :mobile, :message, :status)
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM users_mobile WHERE id='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['name'] = $row['name'];
				$data['mobile'] = $row['mobile'];
				$data['message'] = $row['message'];
				$data['status'] = $row['status'];
			}
			return $data;
		}
	}

    // https://website.com/api/gsm_api.php?action=update&id=1&status=1
	function update()
	{
		if(isset($_GET["status"]))
		{
			$form_data = array(
				':id'			=>	$_GET['id'],
				//':name'			=>	$_GET['name'],
				//'mobile'		=>	$_POST['mobile'],
				//'message'		=>	$_POST['message'],
				':status'		=>	$_GET['status']
			);
			
			
		$query = "SELECT * FROM users_mobile WHERE id='".$_GET['id']."'";
		$statement = $this->connect->prepare($query);
		
		if($statement->execute())
		{
			// SET name = :name, 
			// 			mobile = :mobile, 
			// 			message = :message, 
			// 			status = :status
			// WHERE id = :id

		    if($statement->rowCount() > 0){
		        	$query = "
					UPDATE users_mobile 
					SET status = :status
					WHERE id = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		    }else{
		        	$data[] = array(
					'success'	=>	'0'
				);
		    }
		}
		
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM users_mobile WHERE id = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>