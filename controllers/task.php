<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/database/config.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/database/todo.php";

// this response variable are the one we're gonna use on our client side for getting the data
// on our controller
$response = [];

function get($db_connection)
{
  // get all todo or task from the database
  $tasks = getTasks($db_connection);
  return [
    "success" => true,
    "message" => "",
    "data" => $tasks
  ];
}

function post($db_connection)
{

  // we're gonna defined first our expected result so that we can easily
  // modify the result throught this function
  $result = [
    "success" => true,
    "message" => "",
    "data" => []
  ];

  // for creating a todo, we need a title and description on POST request
  if (!isset($_POST["title"]) || !isset($_POST["description"])) {
    $result["success"] = false;
    $result['message'] = 'We need title and description on POST request';
    return $result;
  }

  $title = $_POST['title'];
  $description = $_POST['description'];

  $createdTodo = createTask($db_connection, $title, $description);

  if (!$createdTodo) {
    $result['success'] = false;
    $result['message'] = 'There\'s a problem creating ToDo';
    return $result;
  }

  // success
  $result["message"] = "Successfully Created ToDo";
  $result["data"] = getTasks($db_connection); // now let's get again the data without creating another code to query it ;)
  return $result;
}

function put()
{
  // implement update
  return [];
}

function delete()
{
  return [];
}

// this controller will handle different HTTP Requests
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    $response = get($db_connection); // we need to pass the database configuration/connection on our config.php file
    break;
  case "POST":
    $response = post($db_connection);
    break;
  case "DELETE":
    $response = delete();
    break;
  case "PUT":
    $response = put();
    break;
  default:
    get($db_connection); // set the default to get method
    break;
}