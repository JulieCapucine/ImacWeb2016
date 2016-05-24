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

		<form method="post" action="api/public/post/2/tags">
			<label for="titre">Rajout tags (avec virgule)</label>
			<input type="text" name="nomTag" id="nomTag"/>
			<input type="submit"/>
		</form>
		<h1> Suppression de tag pour le post 2 </h1>
		<form method="post" action="api/public/post/2/tags">
			<input type="hidden" name="_METHOD" value="DELETE"/>
			<input type="text" name="toDeleteTag" id="toDeleteTag"/>
			<input type="submit"/>
		</form>
	</body>


</html>