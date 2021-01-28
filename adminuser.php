<?php
session_start();
require_once'controllers/User_controller/User_controller.php';
require_once'controllers/Article_controller/Article_controller.php';
require_once'views/Admin_view.php';
require_once'views/Articles_view.php';


$controller = new usercontroller();
$controllers = new articlecontroller();
$views = new adminview();
$view = new articleview();

$pageTitle = "Administrer";

$controller->notAdmin($_SESSION['droits']);

$id_user = $controller->verifGetId($_GET);

$error = [
    'formUpdate' => '',
    'formDelete' => '',
    'formUp' => ''
];

//TRAITEMENT DES FORMULAIRE
//php form suppr user
if(isset($_POST['submitsuppr'])){
    $error['formDelete'] = $controller->checkFormDeleteUser($_POST);
}
//php form modif des droits
if(isset($_POST['submitdroit'])){
    $error['formUp'] = $controller->checkFormUp($_POST);
}
//php form update user
if(isset($_POST['submit'])){
    $error['formUpdate'] = $controller->checkFormUpdate($_POST);
}
/////////////////////////////////////
ob_start();
if($_SESSION['droits']==1337){
    $user = $controller->selectUser(); 
}
?>
<section class="text-center">
    <?php
    //affichage tableau de l'utilisateur concerné
    $tableuserid = $views->tableiduser($user);
    echo $tableuserid;
    //////////
    ?>
    <!--FORMULAIRE 1 UPDATE INFO 2 UPDATE DROIT 3 DELETE USER-->
    <div class="container">
        <div class="row">
            <div class="col-6 align-self-center">
                <div class="card">
                    <div class="card-header">Change les informations</div><br>
                    <form action="" method="POST">
                        <label for="">Change le login</label>
                        <input class="form-control" type="text"  name="login">
                        <br>
                        <label for="">Change l'email</label>
                        <input class="form-control" type="email"  name="email">
                        <br>
                        <label for="">Change ton mot de passe</label>
                        <input class="form-control" type="password" name="password">
                        <br>
                        <label for="">Change ton nouveau mot de passe</label>
                        <input class="form-control" type="password" name="password_conf"><br>
                        <?= $error['formUpdate'] ?>
                        <input  class="btn btn-sm btn-primary btn-block p-3" type="submit" name="submit">
                    </form></div></div> 
            <!--2-->
            <!--2-->
            <div class="col-6 align-self-center">
                <div class="card">
                    <div class="card-header">Change le statut</div>
                    <form action="" method="POST"><br>
                        <select name="select">
                            <option value="0">--Please choose an option--</option>
                            <option value="1">utilisateur</option>
                            <option value="42">modérateur</option>
                        </select><br><br>
                        <?=  $error['formUp'] ?>
                        <input  class="btn btn-sm btn-primary btn-block p-3" type="submit" name="submitdroit">                    
                    </form>

                    <!--                   3    -->
                    <!--                   3    -->
                </div>
                <br><br><br><br>
                <div class="card">
                    <div class="card-header">
                        Supprime l'utilisateur
                    </div>
                    <form action="" method="POST"><br>
                        <h5>Are you sur ?</h5>
                        <select name="select">
                            <option value="0">--Please choose an option--</option>
                            <option value="1">yes</option>
                            <option value="2">OMGGG NOO !!!!</option>
                        </select><br><br>
                        <?= $error['formDelete'] ?>
                        <input  class="btn btn-sm btn-primary btn-block p-3" type="submit" name="submitsuppr">                    
                    </form>    
                </div>
            </div>   
        </div>
    </div>
</section>
<?php
    $pageContent = ob_get_clean();
    require_once('views/templates/layout.php');
?>