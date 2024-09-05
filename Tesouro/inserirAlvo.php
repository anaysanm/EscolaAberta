<?php
$servername = "localhost";
$database = "cacaaotesouro";
$username = "root";
$password = "senai";

$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Falha na Conexão: " . mysqli_connect_error());
}

$codigo = $_POST['codigo']; 

header("Location: jogotiro.php?var=".urlencode($codigo));

echo"$codigo";


?>