<?php
session_start();
date_default_timezone_set('Europe/Paris');

$title = 'WordPress Plugins Manager';
$data = '';

if (isset($_SESSION['wp-apmanager-data'])) {
	$data = $_SESSION['wp-apmanager-data'];
}
if (isset($_GET['clear_session'])) {
	$_SESSION['wp-apmanager-data'] = '';
	$data = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title; ?></title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<link href="css/index.min.css" rel="stylesheet"></style>

</head>
<body>

	<div class="container"> 

		<div class="header clearfix">
	              
		    <nav>
	          <ul class="nav nav-pills float-right">            
	          	<li class="nav-item">
	              <a class="btn btn-outline-primary float-right" href="https://github.com/acloup/wordpress-plugins-manager"><i class="fa fa-github" aria-hidden="true"></i> View on GitHub</a>
	            </li>
	          </ul>
	        </nav>
			<h1 class="text-muted"><?php echo $title; ?></h1>
				
		</div>

		<div class="alert alert-secondary" role="alert">
			<p>This page displays differents <strong>ways to disable / enable plugins on WordPress</strong>, whether you have access to your site via FTP or via database (which is usually the case). 
			<br><br>
			It could be useful if, for some reason, your site is "broken" and you can't login to disable a plugin via the admin panel.
		</div>
		<div class="alert alert-primary" role="alert">
				<b>tl;dr</b> : this page should answer <strong>"How to disable one or all plugin(s) in WordPress?"</strong>
		</div>

			<div class="row">


				<div class=" text-center col-md-6">  
					<div class="card-body">
						<h4 class="card-title"><i class="fa fa-folder-open-o fa-fw fa-3x" aria-hidden="true"></i><br>Via FTP</h4>  
						<br>  
						<a href="#ftp-one-plugin" class="btn btn-outline-primary">ONE plugin</a>
						<a href="#ftp-all-plugins" class="btn btn-outline-primary">ALL plugins</a>
					</div>
				</div>

				<div class=" text-center col-md-6">  
					<div class="card-body">
						<h4 class="card-title"><i class="fa fa-database fa-fw fa-3x" aria-hidden="true"></i><br>Via database</h4>    
						<br>
						<a href="#database-one-plugin" class="btn btn-outline-primary">ONE plugin</a>
						<a href="#database-all-plugins" class="btn btn-outline-primary">ALL plugins</a>
					</div>
				</div>


			</div>

			<hr>

			<h5 id="ftp-one-plugin">Disable one plugin via FTP</h5>

			<ul>
				<li>Connect to your site directory and go to <b>/wp-content/plugins</b> directory</li>
				<li>Find the directory used by your plugin and rename it.
					<br>
					For example : <code>/wp-content/plugins/my-plugin</code> -> <code>/wp-content/plugins/my-plugin-disabled</code>
				</li>
				<li>To enable the plugin again, rename the directory with its original name</li>
			</ul>

			<hr>

			<h5 id="ftp-all-plugins">Disable all plugins via FTP</h5>

			<ul>
				<li>Connect to your site directory and go to <b>/wp-content/plugins</b> directory</li>
				<li>Rename <b>every</b> directories...
					<br>
					For example : <code>/wp-content/plugins/my-plugin</code> -> <code>/wp-content/plugins/my-plugin-disabled</code>
				</li>
				<li>To enable the plugins again, rename all the directories (...) with their original name</li>
			</ul>

			<hr>

			<h5 id="database-all-plugins">Disable all plugins via database</h5>

			<ul>
				<li>Connect to your site database via your favorite database manager (ex : PhpMyAdmin)</li>
				<li>In table <b>wp_options</b> :
					<ul>
						<li>Find the <b>active_plugins</b> key</li>
						<li><u>Copy the value and save it somewhere !</u></li>
						<li>Replace that value by : <b>a:0:{}</b></li>
						<li>Alternative / faster way : execute this query <br>
							<code>UPDATE wp_options SET option_value = 'a:0:{}' WHERE option_name = 'active_plugins';</code>
						</li>
					</ul>
					<li>To enable the plugins again, replace the value by the one you saved</li>
				</ul>

				<hr>

				<h5 id="database-one-plugin">Disable one plugin via database</h5>

				<ul>
					<li>Connect to your site database via your favorite database manager (ex : PhpMyAdmin)</li>
					<li>In table <b>wp_options</b> :
						<ul>
							<li>Find the <b>active_plugins</b> key</li>
							<li><u>Copy the value and save it somewhere !</u></li>							
						</ul>						
					</ul>				

					<div id="zone">
						<form action="#" method="POST" id="form_submit_data">
							<b>Paste this value in the field below and then click "Send" :</b>
							<br><br>
							<textarea name="data" id="data" cols="100" rows="10" class="form-control" placeholder='Example : a:10:{s:34:"plugin_directory/plugin-file.php.php";s:60:"another-plugin/another-file.php";...";}'><?php echo $data; ?></textarea>
							<br>
							<input type="submit" name="is_submit_data" id="is_submit_data" value="SEND" class="btn btn-success btn-block">
							<?php if (isset($_SESSION['wp-apmanager-data']) && $_SESSION['wp-apmanager-data']!='') { ?>
							<a href="?clear_session#database-one-plugin" class="btn btn-default btn-block">Clear field</a>
							<?php } ?>
						</form>
					</div>

					<br><br>

					<footer class="footer">
						<p>&copy; <?php echo Date('Y'); ?> - Aurélien Cloup</p>
					</footer>

				</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/index.min.js"></script>

	</body>
</html>