<?php
	// just to store the content of the textarea in a session

	session_start();

	if(isset($_POST['data'])) {
		$_SESSION['wp-apmanager-data'] = $_POST['data'];
	}
?>