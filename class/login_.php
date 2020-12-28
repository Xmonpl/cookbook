<?php
	$email = @$_POST['email'];
	$password = @$_POST['password'];
	$captcha = @$_POST['recaptcha_response'];	
	if(!empty($email) && !empty($password) && !empty($captcha)) {
		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		$recaptcha_secret = '6LcrT68UAAAAABOJSZSN3ZtfPNJAgeOmEPihFx6s';
		$recaptcha_response = $_POST['recaptcha_response'];
		$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		$recaptcha = json_decode($recaptcha);
		if ($recaptcha->score >= 0.5) {
			include_once("user.php");
			$user = new User();
			echo($user->login($email, $password));
		}else{
			echo('{"error": "bot"}');
		}
	}else{
		echo("ełoł 1");
    }
?>