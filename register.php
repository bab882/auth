<?php
if(!empty($_POST)){
    if(isset($_POST["email"], $_POST["name"], $_POST["password"]) 
        && !empty($_POST["email"]) && !empty($_POST["name"]) && !empty($_POST["password"])
    ){
        $pseudo = strip_tags($_POST["name"]);

        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            die("L'adresse email est incorrecte");
        }

        // Hash password
        $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);

        require_once "includes/connect.php";
        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `roles`) 
                VALUES (:pseudo, :email, '$pass', '[\"ROLE_USER\"]')";


        $query = $db->prepare($sql);
        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        $query->execute();
        // print_r($query->errorInfo());
    } else {
        die("Le formulaire est incomplet");
    }
}   
?>

<h1>Register</h1>
<form action="post">
    <div>
        <label for="pseudo">Pseudo</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit">Submit</button>
</form>