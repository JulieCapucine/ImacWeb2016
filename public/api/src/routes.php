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
  $sql = "SELECT * FROM POSTS WHERE id_subject =".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->get('/post/{ids}/comments', function($request, $response, $args) {
  $id_array = explode(",", $args["ids"]);
  $sql = "SELECT * FROM COMMENTS WHERE ";
  for ($i = 0; $i < count($id_array)-1; $i++) {
  	$sql .= "id_post = ".$id_array[$i]." OR ";
  }
  $sql .= "id_post = ".$id_array[$i].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->get('/topics', function($request, $response, $args) {
  $sql = "SELECT * FROM SUBJECT;";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->get('/tag/{id}/posts', function($request, $response, $args) {
  $sql = "SELECT * FROM POSTS INNER JOIN TAGGE ON id_tag =".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->get('/post/{id}/tags', function($request, $response, $args) {
  $sql = "SELECT * FROM TAGS WHERE id_post = ".$args["id"].";";
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