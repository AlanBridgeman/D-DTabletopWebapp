<?php
session_start();

require_once ('/php/API/MysqliDb.php');
require_once ('/php/Objects/User.class.php');

$db = new MysqliDb('localhost', 'root', '', 'dnd');

echo '<!DOCTYPE html>' . "\n";
echo '<html lang="en">' . "\n";
echo '	<head>' . "\n";
echo '		<meta charset="utf-8">' . "\n";
echo '		<title>Log In</title>' . "\n";
echo '		<link rel="stylesheet" type="text/css" href="css/login_form.css">' . "\n";
echo '	</head>' . "\n";
echo '	<body>' . "\n";

if(isset($_POST['submitted'])) {
	$submited = $_POST['submitted'];
	
	$name = explode(" ", $_POST['name']);
	$pass = $_POST['pass'];
	if(isset($pass) && !empty($pass)) {
		if(isset($name) && !empty($name[0])) {
			if(count($name) >= 1 && count($name) <= 2) {
				if(count($name) > 1) {
					$db->where('fName', $name[0]);
					$db->where('lName', $name[1]);
				}
				else {
					$db->where('fName', $name);
					$db->orWhere('lName', $name);
				}
				$user = $db->getOne("Users");
				$hash = $user['password'];
				if (password_verify($pass, $hash)) {
					echo 'Password is valid!';
					$_SESSION['user'] = new User($user['id'], $user['fName'], $user['lName'], $user['admin']);
					
				} else {
					echo 'Invalid password.';
				}
			}
			else {
				echo "invalid Name given";
			}
		}
		else {
			echo "You must enter a name";;
		}
		//header('Location: index.php');
	}
	else {
		echo "You must enter a password.";
	}
	echo '		<form name="login" action="" method="post" autocomplete="on">'."\n";
	echo '			<label for="name"><font color="black">Name:</font></label>' . "\n";
	echo '			<input id="name" name="name" type="text" autofocus required/>' . "\n";
	echo '			<br />' . "\n";
	echo '			<label for="pass"><font color="black">Password:</font></label>' . "\n";
	echo '			<input id="pass" name="pass" type="password" autocomplete="off" required />' . "\n";
	echo '			<br />' . "\n";
	echo '			<label for="remember"><font color="black">Remember Me:</font></label>' . "\n";
	echo '			<input id="remember" name="remember" type="checkbox" value="true" onClick="toggleEnable()" />' . "\n";
	echo '			<br />' . "\n";
	echo '			<label for="expires"><font color="black">Expires(days):</font></label>' . "\n";
	echo '			<input id="expires"  name="expires" type="range" min="0" max="365" disabled />' . "\n";
	echo '			<br />' . "\n";
	echo '			<input id="submitted" name="submitted" type="hidden" value="submitted" />' . "\n";
	echo '			<br />' . "\n";
	echo '			<input type="submit" value="Log In" />' . "\n";
	echo '			<input type="reset" value="Reset" />' . "\n";
	echo '		</form>' . "\n";
}
else {
	echo '		<form name="login" action="" method="post" autocomplete="on">'."\n";
	echo '		<ul>' . "\n";
	echo '			<li>' . "\n";
	echo '				<h2>Log in</h2>' . "\n";
	echo '				<span class="required_notification">* Denotes Required Field</span>' . "\n";
	echo '			</li>' . "\n";
	echo '			<li>' . "\n";
	echo '				<label for="name"><font color="black">Name:</font></label>' . "\n";
	echo '				<input id="name" name="name" type="text" autofocus required pattern="([A-Za-z0-9]+|[A-Za-z0-9]+\s[A-Za-z0-9]+)" />' . "\n";
	echo '				<span class="form_hint">Either <b>First</b> OR <b>Full</b> name.</span>';
	echo '			</li>' . "\n";
	echo '			<li>' . "\n";
	echo '			<label for="pass"><font color="black">Password:</font></label>' . "\n";
	echo '			<input id="pass" name="pass" type="password" autocomplete="off" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />' . "\n";
	echo '				<span class="form_hint">Password must contain 1 lower case letter, 1 upper case letter and 1 digit.</span>';
	echo '			</li>' . "\n";
	echo '			<li>' . "\n";
	echo '			<label for="remember"><font color="black">Remember Me:</font></label>' . "\n";
	echo '			<input id="remember" name="remember" type="checkbox" value="true" onClick="toggleEnable()" />' . "\n";
	echo '			</li>' . "\n";
	echo '			<li>' . "\n";
	echo '			<label for="expires" style="display:none"><font color="black">Expires(days):</font></label>' . "\n";
	echo '			<input id="expires"  name="expires" type="range" min="0" max="12" step="1" list="dys" disabled style="display:none"/>' . "\n";
	echo '				<span class="form_hint">How often you want to relogin. The more often(less days between lower on the bar) the more secure</span>' . "\n";
	echo '			</li>' . "\n";
	echo '			<li>' . "\n";
	echo '			<input id="submitted" name="submitted" type="hidden" value="submitted" />' . "\n";
	echo '			</li>' . "\n";
	echo '			<li>' . "\n";
	echo '			<button class="submit" type="submit">Log In</button>' . "\n";
	echo '			<button class="submit" type="reset">Reset</button>' . "\n";
	echo '			</li>';
	echo '			</ul>' . "\n";
	echo '		</form>' . "\n";
}

echo '		<script type="application/javascript" src="js/API/JQuery.js"></script>' . "\n";
echo '		<script>' . "\n";
echo '			function toggleEnable() {' . "\n";
echo '				if(document.login.expires.disabled == false) { ' . "\n";
echo '					document.login.expires.disabled = true;' . "\n";
echo "					$(\"label[for='expires']\").hide();" . "\n";
echo '					$("#expires").hide();' . "\n";
echo '				}' . "\n";
echo '				else {' . "\n";
echo '					document.login.expires.disabled = false;' . "\n";
echo "					$(\"label[for='expires']\").show();" . "\n";
echo '					$("#expires").show();' . "\n";
echo '				}' . "\n";
echo '			}' . "\n";
echo '		</script>' . "\n";
echo '		<script>' . "\n";
echo "function ticks(element) {
    if (element.hasOwnProperty('list') && element.hasOwnProperty('min') && element.hasOwnProperty('max') && element.hasOwnProperty('step')) {
 var datalist = document.createElement('datalist'),
 minimum = parseInt(element.getAttribute('min')),
 step = parseInt(element.getAttribute('step')),
 maximum = parseInt(element.getAttribute('max'));
 datalist.id = element.getAttribute('list');
  for (var i = minimum; i < maximum+step; i = i + step) {
 	datalist.innerHTML +=\"<option value=\"+i+\"></option>\";
 } 
 element.parentNode.insertBefore(datalist, element.nextSibling);
    }
};
var lists = document.querySelectorAll(\"input[type=range][list]\"),
arr = Array.prototype.slice.call(lists);
arr.forEach(ticks);";
echo '		</script>' . "\n";
echo '	</body>' . "\n";
echo '</html>' . "\n";
?>