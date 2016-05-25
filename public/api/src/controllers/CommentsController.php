<?php

class CommentsController {
	protected $ci;

	public __construct(ContainerInterface ci) {
		$this->ci = ci;
	}

	public function showCommentsFromPost($request, $response, $args){
		$id_array = explode(",", $args["ids"]);
		$sql = "SELECT * FROM Comments WHERE ";
		for ($i = 0; $i < count($id_array)-1; $i++) {
		$sql .= "id = ".$id_array[$i]." OR ";
		}
		$sql .= "id = ".$id_array[$i].";";
		$query = $this->db->query($sql);
		$result = $query->fetchAll();
		return $response->withJson($result);
	}

	public function showAll($request, $response, $args){
		$sql = "SELECT * FROM Comments";
		$query = $this->db->query($sql);
		$result = $query->fetchAll();
		return $response->withJson($result);
	}



}

?>