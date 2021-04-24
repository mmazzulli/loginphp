
<?php
 
 include('inc/config.php');
 session_start();
  
 if (isset($_POST['login'])) {
  
     $username = $_POST['username'];
     $password = $_POST['password'];
  
     $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
     $query->bindParam("username", $username, PDO::PARAM_STR);
     $query->execute();
  
     $result = $query->fetch(PDO::FETCH_ASSOC);
  
     if (!$result) {
         echo '<div class="failed"><h4>Usuário ou senha inválida.</h4></div>';
     } else {
         if (password_verify($password, $result['password'])) {
             $_SESSION['user_id'] = $result['id'];
             echo '<div class="logado"><h4>Seja bem-vindo ao seu painel.</h4></div>';
         } else {
             echo '<div class="failed"><h4>Usuário ou senha inválida.</h4></div>';
         }
     }
 }
  
 ?>
 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<form method="post" action="#" name="signin-form">
    <div class="form-element">
        <label>Usuário</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Senha</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="login" value="login">Entrar</button>
</form>

</body>
</html>