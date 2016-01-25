<?php
	session_start();
	
    require_once ('API/MysqliDb.php');
	
	if(isset($_POST['message']) && !empty($_POST['message'])) {
		$data = Array(
			'uID' => $_SESSION['uID'],
			'message' => $_POST['message'],
			'postedAt' => $db->now(),
			'editedAt' => $db->now()
			// expires = NOW() + interval 1 year
			// Supported intervals [s]econd, [m]inute, [h]hour, [d]day, [M]onth, [Y]ear
		);
		
		$id = $_SESSION['db']->insert('Posts', $data);
		if ($id)
			echo 'user was created. Id=' . $id;
		else
			echo 'insert failed: ' . $db->getLastError();
	}
?>