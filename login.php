<?php
if(!empty($_POST)){
   if(isset($_POST["email"], $_POST["password"])
        && !empty($_POST["email"] && !empty($_POST["password"]))
   ){
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            die("Ce n'est pas un email");
        }

        require_once "includes/connect.php";
        $sql = "SELECT * FROM `users` WHERE `email` = :email";

        $query = $db->prepare($sql);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch();
        if(!$user){
            die("L'utilisateur ou le mot de passe est incorrect");
        }
        if(!password_verify($_POST["password"], $user["password"])){
            die("L'utilisateur ou le mot de passe est incorrect");
        }

        session_start();
        $_SESSION["user"] = [
            "id" => $user["id"],
            "pseudo" => $user[""]
        ];
   }
}
?>

<h1>Log In</h1>
<form action="post">
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