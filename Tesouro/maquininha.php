<?php
// Verifica se o request é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Configurações do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "senai";
    $dbname = "pessoa";

    // Cria conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Recebe o código enviado pelo usuário
    $codigo = $_POST['codigo'];

    // Evitar SQL Injection (caso seja necessário)
    $codigo = $conn->real_escape_string($codigo);

    // Consulta para verificar se o código existe na tabela
    $sql = "SELECT * FROM sua_tabela WHERE codigoFinal = '$codigo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // O código existe, então é válido
        echo "Código validado com sucesso.";
    } else {
        // O código não existe, então é inválido
        echo "Código inválido.";
    }

    // Fecha a conexão
    $conn->close();
}
?>
