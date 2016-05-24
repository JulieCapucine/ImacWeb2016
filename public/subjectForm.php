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
	</body>


</html>