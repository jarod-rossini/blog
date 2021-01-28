<?php 
session_start();
require_once'controllers/User_controller/User_controller.php';
$pageTitle  = 'Inscription';
$controller = new usercontroller();

$controller->alreadyConnect($_SESSION);

$error = [                                           
    'empty' => '',
];
if(isset($_POST['submit'])){
    $error['empty'] = $controller->formSignin($_POST);
}
ob_start();
?>
<section class="text-center container">
    <br>
    <form class="text-center border border-light p-4" method="post" action="inscription.php">
        <p class="h4 mb-4">Inscritpion</p>
        <div class="form-row p-3">
            <div class="col">
                <input class="form-control p-2" name="login" type="text" placeholder="Login">
            </div>
        </div>

        <div class="form-row p-3">
            <div class="col">
                <input class="form-control p-2" name="email" type="email" placeholder="Email">
            </div>
        </div>

        <div class="form-row p-3">
            <div class="col">
                <input class="form-control p-2" name="password" type="password" placeholder="mot de passe">
            </div>
        </div>
        <div class="form-row p-3">
            <div class="col">
                <input class="form-control p-2" name="password_conf" type="password" placeholder="Confirme ton mot de passe">
            </div><br><br>
        </div>
        <?= $error['empty']?>
        <div class="form-row p-3">
            <div class="col">
                <input class="form-control btn btn-primary" type="submit" name="submit">
                <br>
                <br>
                <a class="btn btn-primary-outliner" href="login.php">Connexion</a>
            </div>	
        </div>
    </form>
</section>
<?php
$pageContent = ob_get_clean();
require_once('views/templates/layout.php');