<?php

	define('DB_HOST', $_SERVER['SERVER_NAME']);
	define('DB_NAME', 'gsm_api');
	define('DB_USER', 'root');
	define('DB_PWD', '');

	define('API_ADDRESS', $_SERVER['SERVER_NAME'].'/GSM_API/');


/*

        You can set your directory name as "api" or "GSM_API"

	[Fetch New Messages]
		http://localhost/GSM_API/gsm_api.php?action=fetch_new

	[Fetch All Messages]
		http://localhost/GSM_API/gsm_api.php?action=fetch_all

	[Send Message - Insert Data to DB]
		http://localhost/GSM_API/gsm_api.php?action=insert&name=FAWAD&mobile=03001234567&message=Welcome&status=0 

	[Update Message Status - Insert Data to DB]
		http://localhost/GSM_API/gsm_api.php?action=update&id=1&status=0 


	[Delete Message / Del Record from DB]
		http://localhost/GSM_API/gsm_api.php?action=delete&id=2

*/


