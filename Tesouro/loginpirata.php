<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="logar.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Peralta&family=Slackey&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Peralta&family=Slackey&display=swap" rel="stylesheet">
    <title>Página de Login</title>

</head>
<body>

    <div class="navbar">
        <img src="https://static.vecteezy.com/system/resources/previews/012/227/432/non_2x/pirate-skull-color-png.png" alt="Logo">
        <div class="navbar-text">Caça ao Tesouro</div>
    </div>

    <div class="login-container">
        <h2>Bem-Vindo</h2>
        
        <form method="post" action="cadastrar.php">
            <div class="todos">
            <div class="inicioNome">
            <div class="todoNome">
                <label for="name">Nome:</label>
                <input type="text" class="Nome" id="name" name="name" required>
            </div>
            <div class="todaIdade">
               <label for="age">Idade:</label>
            <input type="number" class="IdadeInput" id="age" name="age" required>
            </div>
            </div>
           
            <label for='parente'>É um aluno?</label>
                <div class="SimNao">
                <input type='radio' class='radio-input' id='radio1' required name='radio-group'>Sim
                <input type='radio' class='radio-inputs' id='radio2' name='radio-group'>Não
                <br> <br>
                <div class="aluno" id="containerAluno">     
                    <div class="Ano">
                        <label for="year">Ano:</label>
                        <input list='series' name='ano' class="AnoInput" >
                     <datalist id='series'  name>
                         <option value='1° - E.F. I'>
                         <option value='2° - E.F. I'>
                         <option value='3° - E.F. I'>
                         <option value='4° - E.F. I'>
                         <option value='5° - E.F. I'>
                         <option value='6° - E.F. II'>
                         <option value='7° - E.F. II'>
                         <option value='8° - E.F. II'>
                         <option value='9° - E.F. II'>
                         <option value='1° - E.M.'>
                         <option value='2° - E.M.'>
                         <option value='3° - E.M.'>         
                     </datalist>
                    </div>
                    <div class="Turma">
                        <label for="class">Turma:</label>
                        <input list='salas' name='turma' class="TurmaInput">
                         <datalist id='salas'>
                             <option value='A'>
                             <option value='B'>
                         </datalist>
                    </div>
                    
                </div>
                
                </div>
         

         
            <div class="botaoDiv">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</div>
    <script>
        function toggleStudentFields() {
            var checkBox = document.getElementById("student");
            var studentFields = document.getElementById("student-fields");
            if (checkBox.checked == true) {
                studentFields.style.display = "block";
            } else {
                studentFields.style.display = "none";
            }
        }
    </script>

</body>
</html>