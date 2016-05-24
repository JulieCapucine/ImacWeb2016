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
  $sql = "SELECT * FROM Post WHERE sujet =".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->post('/topic/{id}/posts', function($request, $response, $args) {
   try{
    $body  = $request->getParsedBody();
    $titre = filter_var($body['titre'], FILTER_SANITIZE_STRING);
    $auteur = filter_var($body['auteur'], FILTER_SANITIZE_STRING);
    $image = filter_var($body['image'], FILTER_SANITIZE_STRING);
    $texte = filter_var($body['contenu'], FILTER_SANITIZE_STRING);

    if (empty($image)){
      $sql = "INSERT INTO Post (`titre`, `auteur`, `image`, `texte`, `sujet`) VALUES ('".$titre."', '".$auteur."', 'NULL', '".$texte."', '".$args["id"]."');";
    } else {
      $sql = "INSERT INTO Post (`titre`, `auteur`, `image`, `texte`, `sujet`) VALUES ('".$titre."', '".$auteur."', '".$image."', '".$texte."', '".$args["id"]."');";
    }    
    $query = $this->db->query($sql);

    $response->status = 200;
  } catch (Exception $e){
    $response->status = 400;
  }
  return $response->withJson(http_response_code());
});



$app->get('/post/{ids}/comments', function($request, $response, $args) {
  $id_array = explode(",", $args["ids"]);
  $sql = "SELECT * FROM Comments WHERE ";
  for ($i = 0; $i < count($id_array)-1; $i++) {
  	$sql .= "id = ".$id_array[$i]." OR ";
  }
  $sql .= "id = ".$id_array[$i].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});


$app->get('/post/{id}', function($request, $response, $args) {
  $sql = "SELECT * FROM Post WHERE id = ".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->get('/posts', function($request, $response, $args) {
  $sql = "SELECT * FROM Post";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->get('/comments', function($request, $response, $args) {
  $sql = "SELECT * FROM Comments";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

$app->delete('/post/{id}', function($request, $response, $args) {
  $sql = "SELECT * FROM Post WHERE id = ".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  if (count($result) == 1) {
    $sql = "DELETE FROM Post WHERE id = ".$args["id"];
    $query = $this->db->query($sql);
    $response->status = 200;
  }
  $response->status = 400;
  return $response->withJson(http_response_code());
});



$app->get('/topics', function($request, $response, $args) {
  $sql = "SELECT * FROM Sujet;";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});



$app->post('/topics', function($request, $response, $args) {
  try{
    $body  = $request->getParsedBody();
    $titre = filter_var($body['titre'], FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM Sujet WHERE titre = '".$titre."';";
    $query = $this->db->query($sql);
    $result = $query->fetchAll();
    if (count($result) == 0) {
       $sql = "INSERT INTO Sujet (`titre`) VALUES ('".$titre."');";
       $query = $this->db->query($sql);
    } else {
      return "existe déjà";
    }
    $response->status = 200;
  } catch (Exception $e){
    $response->status = 400;
  }
  return $response->withJson(http_response_code());
});

$app->put('/topic/{id}', function($request, $response, $args) {
  $body = $request->getParsedBody();
  $sql = "SELECT * FROM Sujet WHERE id = '".$args["id"]."';";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  if (count($result) == 1) {
      $sql = "UPDATE Sujet SET titre ='".$body["title"]."' WHERE id=".$args['id'].";";
      $query = $this->db->query($sql);
      return "updated :poop:";
  }
  return "echec";
});

$app->delete('/topic/{id}', function($request, $response, $args) {
  $sql = "SELECT * FROM Sujet WHERE id = ".$args["id"];
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  if (count($result) == 1) {
    $sql = "DELETE FROM Sujet WHERE id = ".$args["id"];
    $query = $this->db->query($sql);
    return "deleted";
  }
  return "beurk";
}); 


$app->get('/tag/{id}/posts', function($request, $response, $args) {
  $sql = "SELECT * FROM Post INNER JOIN Tagge ON Tagge.idTag = ".$args["id"]." WHERE Tagge.idPost = Post.id;";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

//topic/id

$app->get('/post/{id}/tags', function($request, $response, $args) {
  $sql = "SELECT * FROM Tag INNER JOIN Tagge ON Tagge.idTag = Tag.id WHERE Tagge.idPost = ".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

