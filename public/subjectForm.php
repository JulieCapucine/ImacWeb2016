<!HTML>
<html>
	<head>
		<title>Test ajout subject </title>
	</head>

	<body>
		<form method="post" action="api/public/topics">
			<label for="title">Titre</label>
			<input type="text" name="title" id="title"/>
			<input type="submit"/>
		</form>

		<form method="put" action="api/public/topic/2">
			<label for="title">Titre</label>
			<input type="text" name="title" id="title"/>
			<input type="submit"/>
		</form>
	</body>


</html>