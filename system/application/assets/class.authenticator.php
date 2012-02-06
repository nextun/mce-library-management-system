<?
class Authenticator implements IAuthenticator
{

	public function authenticate($username, $password)
	{
		$authentication_url = "https://service.easw.easports.com/authentication";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // this line makes it work under https
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
	public function getToken()
	{
		/*$filename = "./token.xml";

		$filetime = filectime($filename);
		$currenttime = time();
		if (($currenttime-$filetime>3*60*60)) { //if older than 3 hours then authenticate
			$this->authenticate("web/countdraculla@gmail.com","commonpassword");
		}*/

		$token = $this->authenticate("web/countdraculla@gmail.com","commonpassword");
		return $token;
		//return $this->authenticate()
	}
	public function extendSession($token)
	{
		//place a call to nucleus to extend it
		return false;
	}
}

?>