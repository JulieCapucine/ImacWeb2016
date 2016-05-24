<?php
// Routes


// EXAMPLE
// $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");

//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });

$app->get('/topic/{id}/posts', function($request, $response, $args) {
  $sql = "SELECT * FROM Post WHERE id_subject =".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->get('/post/{ids}/comments', function($request, $response, $args) {
  $id_array = explode(",", $args["ids"]);
  $sql = "SELECT * FROM Comments WHERE ";
  for ($i = 0; $i < count($id_array)-1; $i++) {
  	$sql .= "id_post = ".$id_array[$i]." OR ";
  }
  $sql .= "id_post = ".$id_array[$i].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

//post/id recuperer post avec id

$app->get('/topics', function($request, $response, $args) {
  $sql = "SELECT * FROM Sujet;";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

//INPROGRESS
$app->post('/topics', function($request, $response, $args) {
  $sql = "INSERT INTO Sujet (`title`) VALUES ('GoT Spoliers');";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

//INPROGRESS
$app->update('/topics', function($request, $response, $args) {
  $sql = "DELETE FROM Sujet WHERE id = ".$args["id"];
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

//TODO
$app->delete('/topics', function($request, $response, $args) {
  $sql = "SELECT * FROM Sujet;";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->get('/tag/{id}/posts', function($request, $response, $args) {
  $sql = "SELECT * FROM Post INNER JOIN TAGGE ON id_tag =".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

//topic/id

$app->get('/post/{id}/tags', function($request, $response, $args) {
  $sql = "SELECT * FROM Tag WHERE id_post = ".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});



// $app->get('/jsonTestRoute', function($request, $response, $args) {
//   $array = [ "key" => "value" ];
//   return $response->withJson($array);
// });


// $app->get('/jsonTestRoute', function($request, $response, $args) {
//   $array = [ "key" => "value" ];
//   return $response->withJson($array);
// });