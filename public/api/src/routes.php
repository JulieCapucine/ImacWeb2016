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

//post/id recuperer post avec id

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

$app->delete('/topics', function($request, $response, $args) {
  $body = $request->getParsedBody();
  $sql = "SELECT * FROM Sujet;";
  $sql = "DELETE FROM Sujet WHERE id = ".$args["id"];
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
}); 

/*
$app->get('/tag/{id}/posts', function($request, $response, $args) {
  $sql = "SELECT * FROM Post INNER JOIN TAGGE ON id_tag =".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});*/

//topic/id

// récupère tous les tags d'un post
$app->get('/post/{id}/tags', function($request, $response, $args) {
  $sql = "SELECT * FROM Tag INNER JOIN Tagge ON Tagge.idTag = Tag.id WHERE Tagge.idPost = ".$args["id"].";";
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
  return $response->withJson($result);
});

// ajoute des tags sur un post
$app->post('/post/{id}/tags', function($request, $response, $args) {
  $body  = $request->getParsedBody();
  $tags = filter_var($body['nomTag'], FILTER_SANITIZE_STRING);

  $sql = "SELECT * FROM Post WHERE id = ".$args["id"];
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
 
  if (count($result) == 0) { return "Le post n'existe pas";  }

  $tabTags = explode(",", $tags);
  
  foreach($tabTags as $tagCourant){
    $sql = "SELECT id FROM Tag WHERE nom = '".$tagCourant."';";
    $query = $this->db->query($sql);
    $result = $query->fetchAll();
    if (count($result) == 0) {
       $sql = "INSERT INTO Tag (`nom`) VALUES ('".$tagCourant."');";
       $query = $this->db->query($sql);
       $reponse = $this->db->lastInsertId();
    } else {
      $reponse = $result[0]['id'];
    }

    $sql = "SELECT * FROM Tagge WHERE idPost = ".$args["id"]." && idTag = ".$reponse;
    $query = $this->db->query($sql);
    $result = $query->fetchAll();
   
    if (count($result) == 0) {
       $sql = "INSERT INTO Tagge VALUES ('".$args["id"]."','".$reponse."');";
       $query = $this->db->query($sql);
    }
      
  }
  return 'mega cool';

});

// Supprime les tags d'un post
/*$app->delete('/post/{id}/tags', function($request, $response, $args) {
  $body = $request->getParsedBody();

  $sql = "SELECT * FROM Post WHERE id = ".$args["id"];
  $query = $this->db->query($sql);
  $result = $query->fetchAll();
 
  if (count($result) == 0) { return "Le post n'existe pas";  }

  $tags = filter_var($body['toDeleteTag'], FILTER_SANITIZE_STRING);
  $tabTags = explode(",", $tags);

  foreach($tabTags as $tagCourant){
    $sql = "SELECT * FROM Tagge WHERE idTag = '".$tagCourant."';";
    $query = $this->db->query($sql);
    $result = $query->fetchAll();
    if (count($result) != 0) {
       $reponse = $result[0]['id'];
    }

    $sql = "DELETE FROM Tagge WHERE idPost = ".$args["id"]." && idTag = ".$reponse;
    $query = $this->db->query($sql);
    $result = $query->fetchAll();

  }



  return 'yeah';*/
}); 

