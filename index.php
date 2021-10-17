<?php
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$env = file_get_contents('.env');

$envlines = preg_split('/\s+/', $env);

$db_host = '';
$db_database = '';
$db_username = '';
$db_password = '';

foreach ($envlines as $line) {
	if (strpos($line, 'DB_HOST') === 0) {
		$vars = explode('=', $line);
		$db_host = $vars[1];
		continue;
	}
	if (strpos($line, 'DB_DATABASE') === 0) {
		$vars = explode('=', $line);
		$db_database = $vars[1];
		continue;
	}
	if (strpos($line, 'DB_USERNAME') === 0) {
		$vars = explode('=', $line);
		$db_username = $vars[1];
		continue;
	}
	if (strpos($line, 'DB_PASSWORD') === 0) {
		$vars = explode('=', $line);
		$db_password = isset($vars[1]) ? $vars[1] : '';
		continue;
	}
}

$conn = @mysqli_connect($db_host, $db_username, $db_password);

if (!$conn) {
	header('Location: setup-config.php');
	exit;
}

if (!$conn->select_db($db_database)) {
	header('Location: setup-config.php');
	exit;
}

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
