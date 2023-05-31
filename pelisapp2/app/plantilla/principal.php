<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE PELÍCULAS</title>
<link href="web/css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>
<div id="container">
<div id="header">
<h1>MI PELÍCULAS PREFERIDAS versión 1.0</h1>
<h3> Buscador </h3>
<form action="index.php" method="get">
    <input name="buscar" value="" placeholder="Inserta tu búsqueda">
    <h5> Buscar por: </h5>
    <button name="orden" value="BuscarTitulo" type="submit">Titulo</button>
    <button name="orden" value="BuscarDirector" type="submit">Director</button>
    <button name="orden" value="BuscarGenero" type="submit">Genero</button>
</form>
</div>
<div id="content">
<?= $contenido ?>
</div>
</div>
</body>
</html>
