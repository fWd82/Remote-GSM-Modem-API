# Remote GSM Modem API

This repo is assosiated with [Remote GSM Modem](https://github.com/fWd82/Remote-GSM-Modem/)

# Setting Up API 

## Database

You can create yourself new Database name it whatever you want. 
Got to your online hosting provider server or go to your `cpanel`. Then head over to **MySQL® Databases** and create yourself database whatever you want.
Now go back and go to **phpMyAdmin** in your cpanel.
At this point you can set this API via two methods:

### Method 1: Automatic 
Now download sql script `gsm_api.sql` from [here](https://github.com/fWd82/Remote-GSM-Modem-API/blob/main/gsm_api.sql), while you are inside your dabase in `phpMyAdmin`, go to `import` and browse the sql file that you have downloaded. Just click `Go` and you are done. Now skip Method 2.

### Method 2: Manual 
You can create even new `table` name it: `users_mobile`
And inside create these columns: 

    DB Name: YOUR_DB_NAME
    Table Name: users_mobile  
    
    Columns:
    id int(11)
    name	varchar(255) 
    mobile	varchar(255) 
    message	varchar(255) 
    status	tinyint(10) 
    timestamp datetime
    
Now you are done. 

## API
Now Download API from [HERE](https://github.com/fWd82/Remote-GSM-Modem-API/) which is written in PHP. Change credentials in file: `config.php` [here](https://github.com/fWd82/Remote-GSM-Modem-API/blob/main/config.php) on line number `4`, `5`, `6` according to your cpanel settings. 
Now go to your **File Manager** in cpanel, go to **public_html**  create new directory/folder name it **api**  (or just **GSM_API**) and paste content of API that you have downloaded.
At this moment your API is ready to test.

You can check your API home page: 

    exampleurl.com/api/

## HTTP API Calls
### Inserting Record
Just call:
    
    https://exampleurl.com/api/gsm_api.php?action=insert&name=NAME&mobile=+9XXXXXXXXXX&message=ANY_MESSAGE&status=0

Pass these parameters:

    name STRING
    mobile STRING
    message STRING
    status BOOLEAN

Sometime we don't want to send message to some record that's why you can just pass `status=1`  

### Updating value of Status
Change value of status from `1` to `0` or `0` to `1` 

    https://exampleurl.com/api/gsm_api.php?action=update&id=1&status=1


### General API Calls for App

    

    Fetch All Records: [ALL]
    https://exampleurl.com/api/gsm_api.php?action=fetch_all
    
    Fetch New Data (those status values are 0)
    https://exampleurl.com/api/gsm_api.php?action=fetch_new

    Update: [Change value from 0 to 1]
    https://exampleurl.com/api/gsm_api.php?action=update&id=1&status=1
    
    INSERT:
    https://exampleurl.com/api/gsm_api.php?action=insert&name=NAME&mobile=+9XXXXXXXXXX&message=ANY_MESSAGE&status=0
    
    [Delete Message / Del Record from DB]
	http://localhost/api/gsm_api.php?action=delete&id=2


