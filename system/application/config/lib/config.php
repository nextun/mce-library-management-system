<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if($GLOBALS['application_state'] == "localhost")
{
    $config['signup_url'] = "https://profile.integration.ea.com/acctcreate.do?registrationSource=friend01.sig.max.ad.ea.com&surl={success_url}&ref=sims";
    $config['login_url'] = "https://profile.integration.ea.com/login.do?surl={success_url}";
}

elseif ($GLOBALS['application_state'] == "alpha")
{
	$config['nucleus_url'] = "http://integration.nucleus.ea.com";
	$config['nucleus_requestorid'] = "Maxis-SimsFriend";
	$config['signup_url'] = "https://profile.integration.ea.com/acctcreate.do?registrationSource=friend01.sig.max.ad.ea.com&surl={success_url}&ref=sims";
    $config['forgor_password_link'] = "https://profile.integration.ea.com/forgotpassword.do?surl={success_url}&ref=sims";
    $config['login_url'] = "https://profile.integration.ea.com/login.do?surl={success_url}";
}

elseif ($GLOBALS['application_state'] == "production")
{
	$config['nucleus_url'] = "http://nucleus.ea.com";
	$config['nucleus_requestorid'] = "Maxis-SimFriend";
	$config['signup_url'] = "https://profile.ea.com/acctcreate.do?registrationSource=simfriend.thesims3.com&surl={success_url}&ref=sims";
    $config['forgor_password_link'] = "https://profile.ea.com/forgotpassword.do?surl={success_url}&ref=sims";
    $config['login_url'] = "https://profile.ea.com/login.do?surl={success_url}";
}
?>