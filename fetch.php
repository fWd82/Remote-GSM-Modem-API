<?php
//fetch.php 
include('config.php');

$api_url = API_ADDRESS . "gsm_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

//decode:
$result = json_decode($response);

// print_r(count($result2->users));
// exit(count($result2));

$output = '';

if(count($result->users) > 0)
 
{
	foreach($result->users as $row)
	{
		$output .= '
		<tr>
		    <td>'.$row->id.'</td>
			<td>'.$row->name.'</td>
			<td>'.$row->mobile.'</td>
			<td>'.$row->message.'</td>
			<td>'.$row->status.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Delete</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
				<tr>
					<td colspan="7" align="center">No Data Found</td>
				</tr>
	';
}
echo $output;

?>