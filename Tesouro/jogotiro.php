<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Target Shooter</title>
    <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="tiro.css">
</head>
<body>

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
     if(isset($_GET['var']) && ($_GET['var'] != 1) ) {
        $codigo = $_GET['var'];
    
        $sqls = "SELECT `IdPessoa`, `nome`, `senha`, `Jogo_Alvo` FROM `pessoa` WHERE senha = '$codigo' ";
        $results = $conn->query($sqls);
        
        if ($results->num_rows > 0 ) {
            $row = $results->fetch_assoc();
            echo "<h1>Conclua o nível do tiro ao alvo ". $row["nome"]."</h1> ";
        } 
            else {
                echo"<h1>Verifque seu Codigo ou faça login!</h1>";}
            } else{
                 echo"<h1>Conclua o nível do tiro ao alvo !!!</h1>";}
            
 
 
 ?>
   
    
    <!-- Título adicionado -->
    <div id="score"></div>
    <div class="container">
        <div class="buttons">
            <button id="refreshButton" onclick="refreshPage()">
                <i class="fas fa-redo"></i> <!-- Ícone de atualização -->
            </button>
            <button id="logoutButton" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i> <!-- Ícone de logout -->
            </button>
        </div>
        <canvas id="gameCanvas" width="600" height="450"></canvas> <!-- Canvas com tamanho reduzido -->
    </div>
    <div id="message"></div>

    <div id="codeInputContainer">
        <form action="InserirAlvo.php" method="post">
        <input type="text" id="codeInput" name="codigo" placeholder="Insira seu código...">
        <button id="submitButton" onclick="submitCode()">Inserir</button>
        </form>
    </div>

    <button id="nextPageButton" onclick="goToNextPage()">Próxima Página</button>
    
    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        const WIDTH = canvas.width;
        const HEIGHT = canvas.height;
        const TARGET_SIZE = 60; // Tamanho do alvo (imagem) reduzido proporcionalmente

        let target = null;
        let score = 0; // Inicializar a variável score
        let secondsLeft = 15; // Contador de segundos

        let boatImage = new Image();
        boatImage.src = 'pngwing.com.png';

        // Função para carregar e desenhar a imagem do barco
        function drawBoat(x, y) {
            ctx.drawImage(boatImage, x, y, TARGET_SIZE, TARGET_SIZE);
        }

        // Função para spawn do alvo (barco)
        function spawnTarget() {
            const x = Math.random() * (WIDTH - TARGET_SIZE);
            const y = Math.random() * (HEIGHT - TARGET_SIZE);
            target = { x: x, y: y };
        }

        // Função para desenhar tudo
        function draw() {
            ctx.clearRect(0, 0, WIDTH, HEIGHT);

            // Desenhar alvo (barco)
            if (target) {
                drawBoat(target.x, target.y);
            }

            // Desenhar pontuação
            ctx.fillStyle = 'white';
            ctx.font = '24px Arial';
            ctx.fillText('Pontuação: ' + score, 10, 30);

            // Atualizar tempo restante
            ctx.fillText('Tempo Restante: ' + secondsLeft, 10, 60);
        }

        // Função para manipular eventos de clique
        function mouseClicked(event) {
            const rect = canvas.getBoundingClientRect();
            const mouseX = event.clientX - rect.left;
            const mouseY = event.clientY - rect.top;

            // Verificar se clicou no alvo (barco)
            if (target && mouseX >= target.x && mouseX <= target.x + TARGET_SIZE &&
                mouseY >= target.y && mouseY <= target.y + TARGET_SIZE) {
                // Aumentar pontuação
                score++;
                // Gerar novo alvo (barco)
                spawnTarget();
                // Desenhar efeito de animação
                drawHitAnimation(mouseX, mouseY);
            }
        }

        // Função para desenhar animação de acerto
        function drawHitAnimation(x, y) {
            let radius = 0;
            const maxRadius = 30;
            const animationInterval = setInterval(() => {
                ctx.beginPath();
                ctx.arc(x, y, radius, 0, Math.PI * 2);
                ctx.strokeStyle = '#ff3021'; // Cor laranja
                ctx.lineWidth = 2;
                ctx.stroke();
                radius += 2;
                if (radius >= maxRadius) {
                    clearInterval(animationInterval);
                    ctx.clearRect(x - maxRadius, y - maxRadius, maxRadius * 2, maxRadius * 2);
                }
            }, 30);
        }

        // Função para verificar o resultado do jogo
        function checkGameResult() {
            if (score >= 10) {
                showMessage("Você Ganhou!"+ (score));
                src="https://code.jquery.com/jquery-3.6.0.min.js";
            
            // Enviando a requisição AJAX
            $.ajax({
                type: "POST",               // Método HTTP
                url: "pontosAlvo.php",         // URL do arquivo PHP que processa a requisição
                data: { myVar: score },     // Dados que estão sendo enviados ao servidor
                success: function(response) {
                // O que fazer com a resposta do servidor
                console.log("Resposta do PHP: " + response);
                }
            });

            
            } else {
                showMessage("Você Perdeu!");
            }
        }

        // Função para mostrar mensagem na tela
        function showMessage(message) {
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = message;
            messageDiv.style.display = 'block';
        }

        // Função para atualizar a página
        function refreshPage() {
            window.location.reload();
        }

        // Função para sair da conta (pode ser substituída por lógica real de logout)
        function logout() {
            var variavel = "<?php echo $codigo; ?>";
            window.location.assign("sair.php?var="+ encodeURIComponent(variavel));

            // Aqui você pode adicionar a lógica de logout, redirecionamento, etc.
        }

        // Função principal para iniciar o jogo
        function startGame() {
            spawnTarget();
            canvas.addEventListener('click', mouseClicked);
            const gameInterval = setInterval(() => {
                draw();
                secondsLeft--;
                if (secondsLeft <= -1) {
                    clearInterval(gameInterval);
                    checkGameResult();
                }
            }, 1000); // Atualiza a cada segundo
        }

        // Função para enviar o código
        function goToNextPage() {
            window.location.href = "pontosAlvo.php"; // Substitua pelo link da próxima página
        }
       
        // Iniciar o jogo
        startGame();
    </script>
</body>
</html>




