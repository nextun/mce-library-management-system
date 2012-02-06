
<?php
getToken();

 function authenticate($username, $password)
	{
     	$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);  // this line makes it work under https
		curl_setopt($ch, CURLOPT_URL,$authentication_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=web/{$username}&password={$password}");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HEADER,1);

		$data = curl_exec($ch);
		if (!empty($data))
		{
			//echo $data;
			preg_match("~EASW-Token: ([\S]+)~",$data, $match);
			//print_r($match);
			$token = $match[1];
			//file_put_contents("./token.xml",$token);
		}
		return $token;
	}
	
    function getToken()
	{
		$token = authenticate("web/omsiddiqui@yahoo.com","stanford");
	}
	
?>	