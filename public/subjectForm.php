<!HTML>
<html>
	<head>
		<title>Test ajout subject </title>
	</head>

	<body>
		<form method="post" action="api/public/topics">
			<label for="titre">Titre</label>
			<input type="text" name="titre" id="titre"/>
			<input type="submit"/>
		</form>

		<form method="post" action="api/public/topic/2">
			<label for="titre">Titre</label>
			<input type="hidden" name="_METHOD" value="PUT"/>
			<input type="text" name="titre" id="titre"/>
			<input type="submit"/>
		</form>

		<form method="post" action="api/public/topic/12">
			<input type="hidden" name="_METHOD" value="DELETE"/>
			<input type="submit" value ="effacer"/>
		</form>

		<h1> Ajout de post dans le topic 1 ♥ </h1>
		<form method="POST" action="api/public/topic/1/posts">
			<label for="postTitre">Titre</label>
			<input type="text" name="titre" id="postTitre"/>
			<br/>
			<label for="postAuteur">Auteur</label>
			<input type="text" name="auteur" id="postAuteur"/>
			<br/>
			<label for="postImage">URL de l'image</label>
			<input type="text" name="image" id="postImage"/>
			<br/>
			<label for="postTitre">Text</label>
			<textarea name="contenu" id="postContenu"></textarea>
			<input type="submit"/>
		</form>

		<form method="post" action="api/public/post/10">
			<input type="hidden" name="_METHOD" value="DELETE"/>
			<input type="submit" value ="effacer"/>
		</form>
	
	</body>


</html>