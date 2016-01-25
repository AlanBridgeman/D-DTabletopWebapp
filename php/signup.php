<?php
	session_start();
	
	require_once ('/php/API/MysqliDb.php');
	$db = new MysqliDb('localhost', 'root', '', 'dnd');
	
	echo '<!DOCTYPE html>' . "\n";
	echo '<html lang="en">' . "\n";
	echo '	<head>' . "\n";
	echo '		<meta charset="utf-8">' . "\n";
	echo '		<title>Sign Up</title>' . "\n";
	echo '		<link rel="stylesheet" type="text/css" href="css/login_form.css">' . "\n";
	echo '	</head>' . "\n";
	echo '	<body>' . "\n";
	
	if(isset($_POST['submitted']) && $_POST['pass'] === $_POST['repass']) {
		$submited = $_POST['submitted'];
		
		$name = explode(" ", $_POST['name']);
		$fName = $name[0];
		$lName = $name[1];
		
		$email = $_POST['email'];
		
		$phone = $_POST['phone'];
		
		$intro = $_POST['intro'];
		
		$pass = $_POST['pass'];
		$options = [
			'cost' => 17,
		];
		$pass = password_hash($pass, PASSWORD_BCRYPT, $options)."\n";
		
		$data = Array(
			'password' => $pass,
			'active' => true,
			'fName' => $fName,
			'lName' => $lName,
			'email' => $email,
			'phone' => $phone,
			'intro' => $intro,
			'createdAt' => $db->now(),
			'expires' => $db->now('+1Y')
			// expires = NOW() + interval 1 year
			// Supported intervals [s]econd, [m]inute, [h]hour, [d]day, [M]onth, [Y]ear
		);
		
		$id = $db->insert('Users', $data);
		if ($id)
			echo 'user was created. Id=' . $id;
		else
			echo 'insert failed: ' . $db->getLastError();
	}
	else {
		echo '		<form name="signup" action="" method="post" autocomplete="on">'."\n";
		echo '		<ul>' . "\n";
		echo '			<li>' . "\n";
		echo '				<h2>Contact Us</h2>' . "\n";
		echo '				<span class="required_notification">* Denotes Required Field</span>' . "\n";
		echo '			</li>' . "\n";
		echo '			<li>' . "\n";
		echo '				<label for="name"><font color="black">Name:</font></label>' . "\n";
		echo '				<input id="name" name="name" type="text" autofocus required pattern="[A-Za-z0-9]+\s[A-Za-z0-9]+" />' . "\n";
		echo '				<span class="form_hint">Either <b>First</b> OR <b>Full</b> name.</span>';
		echo '			</li>' . "\n";
		echo '			<li>' . "\n";
		echo '				<label><font color="black">Email:</font></label>' . "\n";
		echo '				<input id="email" name="email" type="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />' . "\n";
		echo '			</li>' . "\n";
		echo '			<li>' . "\n";
		echo '				<label><font color="black">Phone:</font></label>' . "\n";
		echo '				<input id="phone" name="phone" type="tel" pattern="[\(]\d{3}[\)]\s\d{3}[\-]\d{4}"/>' . "\n";
		echo '				<span class="form_hint">Blank or (###) ###-####</span>' . "\n";
		echo '			</li>' . "\n";
		echo '			<li>' . "\n";
		echo '				<label><font color="black">Introduction:</font></label>'. "\n";
		echo '				<textarea id="intro" name="intro" rows="10" cols="102" placeHolder="A short(< 1024 Characters) introduction about yourself for other people."></textarea>' . "\n";
		echo '			</li>' . "\n";
		echo '			<li>' . "\n";
		echo '				<label for="pass"><font color="black">Password:</font></label>' . "\n";
		echo '				<input id="pass" name="pass" type="password" autocomplete="off" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />' . "\n";
		echo '				<span class="form_hint">Password must contain 1 lower case letter, 1 upper case letter, 1 digit and be 8 characters long.</span>';
		echo '			</li>' . "\n";
		echo '			<li>' . "\n";
		echo '				<label for="repass"><font color="black">Password:</font></label>' . "\n";
		echo '				<input id="repass" name="repass" type="password" autocomplete="off" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />' . "\n";
		echo '				<span class="form_hint">Password must contain 1 lower case letter, 1 upper case letter, 1 digit and 8 characters long.</span>';
		echo '			</li>' . "\n";
		echo '			<li>' . "\n";
		echo '				<input id="submitted" name="submitted" type="hidden" value="submitted" />' . "\n";
		echo '			</li>' . "\n";
		echo '			<li>' . "\n";
		echo '				<button class="submit" type="submit">Log In</button>' . "\n";
		echo '				<button class="submit" type="reset">Reset</button>' . "\n";
		echo '			</li>';
		echo '			</ul>' . "\n";
		echo '		</form>' . "\n";
	}
	echo '	</bdoy>' . "\n";
	echo '</html>' . "\n";
?>