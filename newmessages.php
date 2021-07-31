<?php
	//newmessages.php
	include('config.php');

	$api_url = API_ADDRESS . "gsm_api.php?action=fetch_new";

	$client = curl_init($api_url);

	curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($client);

	echo $response;

?>