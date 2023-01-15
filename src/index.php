<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Not Secure Login</title>
    </head>
    
    <body>
      <form method="post" action="index.php">
        <p>Connectez vous ci-dessous :</p>  
        <label for="email">Email:</label>
        <input type="text" name="email" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
      </form>

    </body>
  </html>
<?php

    require('../vendor/autoload.php');

    
    $connection = new MongoDB\Driver\Manager("mongodb+srv://root:root@cluster0.asrgqf8.mongodb.net/test
    ");
        $email = $_POST["email"];
        $password = $_POST["password"];
        $query = new MongoDB\Driver\Query([
            "email" => $email,
            "password" => ['$ne' => $password]
        ]);
        $response = $connection->executeQuery("user.user", $query)->toArray();
    
    if($response){
        echo "Vous etes desormais connecté";
    }else{
        echo "La connexion a échoué...";
    }
?>