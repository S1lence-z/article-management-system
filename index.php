<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Establish the database connection
require_once('./db_config.php');
require_once('./helperFunctions.php');
$host_name = $db_login_credentials['server'];
$login_name = $db_login_credentials['login'];
$password = $db_login_credentials['password'];
$db_name = $db_login_credentials['database_name'];
$mysqli = new mysqli($host_name, $login_name, $password, $db_name);

// Initialize router and pass in the db connection along with the path
require_once('./router.php');
$router = new Router($mysqli);

// Add all possible routes with their mapping to controllers and methods
$router->route('', 'ShowController@index');
$router->route('articles', 'ShowController@listArticles');
$router->route('article', 'ShowController@showArticle');
$router->route('article-edit', 'EditationController@editArticle');
$router->route('article-update', 'UpdateController@updateArticle');
$router->route('article-delete', 'DeletionController@deleteArticle');
$router->route('article-insert', 'CreationController@insertArticle');

// Get the path with which the router can work
$url = $_SERVER['REQUEST_URI'];
$desiredPath = getValidRoute($url);

// It is used to find out what url is associated with the url
$router->dispatch($desiredPath);

// At the end close the database connection since it is no longer needed
$mysqli->close();