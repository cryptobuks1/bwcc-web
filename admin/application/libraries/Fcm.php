<?php

class Fcm
{	
	public function sendMessage($data, $target, $server_key, $url = ""){
		$url = "https://fcm.googleapis.com/fcm/send";
		$fields = array();
		$fields['notification'] = $data;

		if(is_array($target))
		{
			$fields['registration_ids'] = $target;
		}
		else
		{
			$fields['to'] = $target;
		}

		//header with content_type api key
		$headers = array(
			'Content-Type:application/json',
	  		'Authorization:key='.$server_key
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) 
		{
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}
	
	public function sendChat($data, $target, $server_key)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = $data;
		// $fields['notification'] = $data;
		if(is_array($target))
		{
			$fields['registration_ids'] = $target;
		}
		else
		{
			$fields['to'] = $target;
		}

		//header with content_type api key
		$headers = array(
			'Content-Type:application/json',
	  		'Authorization:key='.$server_key
		);
				
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) 
		{
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
		
	}
}
	