<?php
//action.php
include('config.php'); 

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'insert')
	{
		$form_data = array(
			'name'	        =>	$_POST['name'],
			'mobile'		=>	$_POST['mobile'],
			'message'		=>	$_POST['message'],
			'status'		=>	$_POST['status']
		);
		$api_url = API_ADDRESS . "gsm_api.php?action=insert";
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		// echo ($response);
		// exit();
		foreach($result as $keys => $values)
			echo $result[$keys];

		{
			if($result[$keys]['success'] == '1')
			{
				echo 'insert';
			}
			else
			{
				//echo 'error';
				//print_r($result);
			}
		}
	}

	if($_POST["action"] == 'fetch_single')
	{
		$id = $_POST["id"];
		$api_url = API_ADDRESS . "gsm_api.php?action=fetch_single&id=".$id."";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
	
	if($_POST["action"] == 'update')
	{
		$form_data = array(
		    'name'	        =>	$_POST['name'],
			'mobile'		=>	$_POST['mobile'],
			'message'		=>	$_POST['message'],
			'status'		=>	$_POST['status'],
			'id'			=>	$_POST['hidden_id']
		);
		$api_url = API_ADDRESS . "gsm_api.php?action=update";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'updated';
			}
			 
			else
			{
				// print_r($result);
				exit($response);
				// echo 'error keys: ' . $keys;
				echo 'error 222 $values: ' . $values;
			}
		}
	}
	
	if($_POST["action"] == 'delete')
	{
		$id = $_POST['id'];
		$api_url = API_ADDRESS . "gsm_api.php?action=delete&id=".$id."";  
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
}


?>