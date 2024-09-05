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

$nome = $_POST['name']; 
$idade = $_POST['age'];
$IsAluno = $_POST['radio-group']; 
$ano = $_POST["ano"];
$turma = $_POST["turma"]; 

if ($IsAluno == true){
    $IsAluno = "Sim";
}else{
    $IsAluno = "Não";
}

// Função para gerar um código aleatório
function gerarSenha($tamanho = 4) {
    $caracteres = '0123456789';
    $senha = '';
    for ($i = 0; $i < $tamanho; $i++) {
        $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $senha;
}

// Função para verificar se o código já existe no banco de dados
function codigoUnico($senha, $conn) {
    $sql = "SELECT `codigoFinal` FROM `pessoa` WHERE codigoFinal ='$senha' ";
    $result = $conn->query($sql);
    return $result->num_rows === 0;
}

// Função para gerar e salvar um código único no banco de dados
function gerarESalvarCodigo($conn) {
    do {
        $codigo = gerarSenha();
    } while (!codigoUnico($codigo, $conn));

    return $codigo;
}

$senha = gerarESalvarCodigo($conn);

$sql ="INSERT INTO `pessoa`( `nome`, `Idade`, `IsAluno`, `turma`, `ano`, `senha`) VALUES ('$nome','$idade','$IsAluno','$turma','$ano', '$senha')";
$result = $conn->query($sql);

if($result == true){
   
    echo "
    <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='https://fonts.googleapis.com/css2?family=Peralta&display=swap' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <div class ='conteiner'>
        <div class ='conteudo'>
        <h3>Bem vinda a bordo $nome</h3>
        <p>Seu código de marujo é <big><b>$senha</b></big></p> 
        <p>Prossiga para sua aventura!!!</p>
        </div>
    </div>

<style>

body{
    display: flex;
    align-items: center;
    justify-content: center;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 750px;
    background-image: url('imagns/teste.jpg');
}

.conteiner{
    width: 500px;
    height: 350px;
    background-color: inherit;
    background-image: url('imagns/papelzinho.png'); /* Substitua pelo caminho correto da imagem */
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: flex-start; /* Alinha o conteúdo para o início do contêiner */
    justify-content: center;
    padding-top: 30px; /* Ajuste para subir o conteúdo */
    font-family: 'Peralta', serif;
  font-weight: 400;
  font-style: normal;
}

.conteudo{
    text-align: center;
    padding: 10px;
}

</style>

</body>
</html>
    
    ";
}else { 
    echo "Algo deu errado";
}

?>
