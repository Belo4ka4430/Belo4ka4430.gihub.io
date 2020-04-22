<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

define('RB', __DIR__ . '/../libs/rb.php');
define('DB', __DIR__ . '/db.php');

use Models\User;

define('BASE_URL', 'http://localhost/ej/');
define('ADMIN_URL', 'http://localhost/phpmyadmin/');

$pathParts = explode('/', $_SERVER['REQUEST_URI']);
define('CONTROLLER', ucfirst($pathParts[2]));

define('WEB', 'http://localhost/ej/webroot/');

define('ELEMENTS', __DIR__ . '/../src/Views/Elements/');

if (isset($_SESSION['logged_user']))
{
    if ($user = \Models\User::getUserById($_SESSION['logged_user']))
    {
        define('USER', $user['id']);
    } else
    {
        define('USER', null);
    }
} else {
    define('USER', null);
}
