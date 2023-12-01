<?php
require_once('../functions.php');

/* -------------------------------------------------------------------------- */
/*                            RETURNS JSON WHEN OK                            */
/* -------------------------------------------------------------------------- */

function responseAsJson($body)
{
  header('Access-Control-Allow-Origin: *'); // permite o acesso publico, se quisesse especificar um dominio ou uma cadeia de dominios, teria que substituir o *;
  header('Content-type: application/json'); // retorna a api em json

  http_response_code(200); //devolve o codigo 200 se ok
  echo json_encode($body); //devolve o parametro
}


/* -------------------------------------------------------------------------- */
/*                            RETURNS JSON WHEN ERR                           */
/* -------------------------------------------------------------------------- */

function responseErrorAsJson($status, $errorDescription)
{
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  http_response_code($status);
  echo json_encode(array(
    'error' => $status,
    'errorDescription' => $errorDescription,
  ));
}

/* -------------------------------------------------------------------------- */
/*                          FETCHING EXPENSE DETAILS                          */
/* -------------------------------------------------------------------------- */

function getNews($item)
{
  //---Binds the values from the DB to KEY's 
  $return = array(
    'id' => $item['id'],
    'title' => $item['title'],
    'summary' => $item['summary'],
    'body' => $item['body'],
    'author' => $item['author'],
    'image' => $item['image'],
    'date' => $item['date'],
    'token_news' => $item['token_news']
  );
  return $return;
}

/* -------------------------------------------------------------------------- */
/*                            FETCHING ALL NEWS                              */
/* -------------------------------------------------------------------------- */

$news = function () {
  //---Query to fetch all the NEWS
  $sql = "SELECT * FROM news WHERE validation = ?";
  $hf = 2;
  $stmt = conn()->prepare($sql);
  if ($stmt->execute([$hf])) {
    $n = $stmt->rowCount();
    if ($n >= 1) {
      $items = $stmt->fetchAll();
      $stmt = null;
    }
  };

  //---Total array for the request
  $return = array(
    'total news' => $n,
    'news' => []
  );

  //---Adds each expense values to each array index
  foreach ($items as $item) {
    $return['news'][] = getNews($item);
  }

  //---Call function to display the request result in JSON
  return responseAsJson($return);
};


/* -------------------------------------------------------------------------- */
/*                           FETCHING SINGLE EXPENSE                          */
/* -------------------------------------------------------------------------- */

$new = function () {
  //---Gets the ID and USERID from the URL
  $id = !empty($_GET['id']) ? $_GET['id'] : null;
  $userId = !empty($_GET['token']) ? $_GET['token'] : null;

  //---If values are empty then show error
  if (!$id || !$userId) {
    return responseErrorAsJson(400, 'Missing id or user');
  }

  //---Gets the values of the requested expense
  $sql = "SELECT * FROM news WHERE id = ? and tattooers_token = ?";
  $stmt = conn()->prepare($sql);
  if ($stmt->execute([$id, $userId])) {
    $n = $stmt->rowCount();
    if ($n === 1) {
      $item = $stmt->fetch();
      $stmt = null;
    }
  };

  //---If the fecth doesn't contain the match of ID or USERID returns error
  if (!$item['id'] || !$item['tattooers_token']) {
    return responseErrorAsJson(404, 'Record not found');
  }

  //---Adds the values to the array and show them in JSON format 
  return responseAsJson(getNews($item));
};


/* -------------------------------------------------------------------------- */
/*                             REQUEST VIEW & TYPE                            */
/* -------------------------------------------------------------------------- */

//---See in the url if exists ? and based on that assings the value to search in endpoints array
$requestView = strpos($_SERVER['REQUEST_URI'], '?') !== false ? 'new' : 'news';

//---Gets the request type (GET, POST, PUT, etc)
$requestType = strtolower($_SERVER['REQUEST_METHOD']);

/* -------------------------------------------------------------------------- */
/*                             AVAILABLE ENDPOINTS                            */
/* -------------------------------------------------------------------------- */

//---Depending on the type of request and view, calls the appropriate function
$endpoints = array(
  'get' => array(
    'news' => $news,
    'new' => $new
  )
);

/* -------------------------------------------------------------------------- */
/*                              IF REQUEST IS OK                              */
/* -------------------------------------------------------------------------- */

//---If the type and view request exists then call the endpoints function with those arguments, else returns error
if (array_key_exists($requestType, $endpoints) && array_key_exists($requestView, $endpoints[$requestType])) {
  $endpoints[$requestType][$requestView]();
} else {
  responseErrorAsJson(404, 'Endpoint not available');
}
