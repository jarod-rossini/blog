<?php 
session_start();
require_once'controllers/User_controller/User_controller.php';

$pageTitle  = 'Connexion';

$controller = new usercontroller();

$msg = "<p class='alert alert-success'>Vous avez été enregistré</p>";
$msgSucess = $controller->valid($_GET, $msg);

$error = [
    'empty' => '',
    'login' => '',
    'password' => ''
];

if(isset($_SESSION)){
    $controller->alreadyConnect($_SESSION);
}
if(isset($_POST['submit'])){   
    $error['empty'] = $controller->checkFormSign($_POST);
}
ob_start();
?>
<section class="login text-center">
    <form class="form-signin" action="connexion.php" method="POST">
        <?= $msgSucess ?>
        <h1 class="display-4">Connecte toi</h1>
        <p class="text-xl-center font-weight-light">blog</p>
        <div class="checkbox mb-3"></div>
        <br>
        <input class="form-control"  name="logconnect" type="text" placeholder="Login"><br>
        <input class="form-control"  name="passconnect" type="password" placeholder="mot de passe"><br>
        <?=$error['empty'] ?>
        <input class="btn btn-lg btn-primary btn-block" value="Connexion"  type="submit" name="submit"><br>
        <a class="text-center" href="inscription.php">s'inscrire</a>
    </form>
</section>
<?php
$pageContent = ob_get_clean();
require_once('views/templates/layout.php');
?>