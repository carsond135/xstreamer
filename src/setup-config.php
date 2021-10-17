<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	<title>xStreamer Lite &rsaquo; Setup Configuration File</title>
	<link rel='stylesheet' id='buttons-css' href='public/assets/css/buttons.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='install-css' href='public/assets/css/install.min.css' type='text/css' media='all' />
	<style type="text/css">
		#loading {
			width: 100%;
			height: 100%;
			background: #fff;
			position: absolute;
			margin-top: -20px;
			margin-left: -20px;
			opacity: 0.5;
			text-align: center;
			vertical-align: middle;
		}
		#loading img {
			width: 60%;
			margin: 0 auto;
			margin-top: 60px;
		}
		@media (max-width: 370px) {
			.logo {
				width: 90%;
			}
		}
	</style>
	<script type="text/javascript">
		function startInstall() {
			document.getElementById("loading").style.display = "inherit";
		}
	</script>
</head>
<body class="wp-core-ui" style="position: relative">
	<div id="loading" style="display: none"><img src="public/assets/img/loading2.gif"></div>
 	<p style="text-align:center"><img src="public/assets/images/logo.png" tabindex="-1" class="logo" /></p>

 	<?php
 	if(empty($_GET['step'])) {
 	?>
		<h1 class="screen-reader-text">Before getting started</h1>
		<p>Welcome to xStreamer Lite. Before getting started, we need some information on the database. You will need to know the following items before proceeding.</p>
		<ol>
			<li>Database name</li>
			<li>Database username</li>
			<li>Database password</li>
			<li>Database host</li>
		</ol>
		<p>We&#8217;re going to use this information to create a <code>config.php</code> file.</p>
		<p>In all likelihood, these items were supplied to you by your Web Host. If you don&#8217;t have this information, then you will need to contact them before you can continue. If you&#8217;re all ready&hellip;</p>
		<p class="step"><a href="setup-config.php?step=1" class="button button-large">Let&#8217;s go!</a></p>

	<?php
	} elseif($_GET['step'] == 1) {
	?>
		<h1 class="screen-reader-text">Set up your database connection</h1>
		<form method="post" action="setup-config.php?step=2" onsubmit="startInstall()">
			<p>Below you should enter your database connection details. If you&#8217;re not sure about these, contact your host.</p>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="dbname">Database Name</label></th>
					<td><input name="dbname" id="dbname" type="text" size="25" value="xstreamer_lite" /></td>
					<td>The name of the database you want to use with xStreamer Lite.</td>
				</tr>
				<tr>
					<th scope="row"><label for="uname">Username</label></th>
					<td><input name="uname" id="uname" type="text" size="25" value="username" /></td>
					<td>Your database username.</td>
				</tr>
				<tr>
					<th scope="row"><label for="pwd">Password</label></th>
					<td><input name="pwd" id="pwd" type="text" size="25" value="password" autocomplete="off" /></td>
					<td>Your database password.</td>
				</tr>
				<tr>
					<th scope="row"><label for="dbhost">Database Host</label></th>
					<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
					<td>You should be able to get this info from your web host, if <code>localhost</code> doesn&#8217;t work.</td>
				</tr>
			</table>
				<input type="hidden" name="language" value="" />
			<p class="step"><input name="submit" type="submit" value="Submit" class="button button-large" /></p>
		</form>
	<?php
	} elseif($_GET['step'] == 2) {
		error_reporting(E_ERROR | E_PARSE);

		$dbhost = isset($_POST['dbhost']) ? $_POST['dbhost'] : '';
		$username = isset($_POST['uname']) ? $_POST['uname'] : '';
		$password = isset($_POST['pwd']) ? $_POST['pwd'] : '';
		$dbname = isset($_POST['dbname']) ? $_POST['dbname'] : '';

		// Create connection
		$conn = mysqli_connect($dbhost, $username, $password);

		// Check connection
		if (!$conn) {
		?>
		    <p><h1>Error establishing a database connection</h1>
			<p>This either means that the username and password information in your <code>config.php</code> file is incorrect or we can&#8217;t contact the database server at <code>localhost</code>. This could mean your host&#8217;s database server is down.</p>
			<ul>
			<li>Are you sure you have the correct username and password?</li>
			<li>Are you sure that you have typed the correct hostname?</li>
			<li>Are you sure that the database server is running?</li>
			</ul>
			<p>If you&#8217;re unsure what these terms mean you should probably contact your host. If you still need help you can always visit the <a href="http://forums.adent.io/" target="_blank">xStreamer Support Forums</a>.</p>
			</p><p class="step"><a href="setup-config.php?step=1" onclick="javascript:history.go(-1);return false;" class="button button-large">Try again</a></p>
		<?php
			// die("Connection failed.");
			die();
		}
		// echo "Connected successfully";
		if (!$conn->select_db($dbname)) {
		?>
			<p><h1>Can&#8217;t select database</h1>
			<p>We were able to connect to the database server (which means your username and password is okay) but not able to select the <code><?php echo $dbname ?></code> database.</p>
			<ul>
			<li>Are you sure it exists?</li>
			<li>Does the user <code><?php echo $username ?></code> have permission to use the <code><?php echo $dbname ?></code> database?</li>
			<li>On some systems the name of your database is prefixed with your username, so it would be like <code><?php echo 'username_'.$dbname ?></code>. Could that be the problem?</li>
			</ul>
			<p>If you don&#8217;t know how to set up a database you should <strong>contact your host</strong>. If all else fails you may find help at the <a href="http://forums.adent.io/" target="_blank">xStreamer Support Forums</a>.</p>
			</p><p class="step"><a href="setup-config.php?step=1" onclick="javascript:history.go(-1);return false;" class="button button-large">Try again</a></p>
		<?php
			// die("Can't select database.");
			die();
		}
		// Configuration file env new
		copy('.env.example', '.env');
		$env = '.env';
		$search = array('[dbhost]', '[dbdatabase]', '[dbusername]', '[dbpassword]');
		$replace = array($dbhost, $dbname, $username, $password);
		$content_env = file_get_contents($env);
		$content_env_new = str_replace($search, $replace, $content_env);
		file_put_contents($env, $content_env_new);

		// Auto import database
		exec('php artisan db:seed');

		// Configuration file htaccess new
		$htaccess = '.htaccess';
		$content_htaccess = file_get_contents($htaccess);
		$content_htaccess_new = str_replace('Redirect /index.php /setup-config.php', '', $content_htaccess);
		file_put_contents($htaccess, $content_htaccess_new);
		// Remove
		unlink('setup-config.php');
		// Redirect to index
		header('Location: /');
	}
	?>
</body>
</html>
