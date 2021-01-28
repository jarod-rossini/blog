<?php
session_start();
require_once'controllers/User_controller/User_controller.php';
require_once'controllers/Article_controller/Article_controller.php';
require_once'views/Articles_view.php';
$pageTitle  = 'Profil';
$controllers = new articlecontroller();
$view = new articleview();
$controller = new usercontroller();

$msg = "<p class='alert alert-success'>Vos donnée ont bien était modifié</p>";
$msgSucess = $controller->valid($_GET, $msg);

$error = [                                             
	'empty' => '',
];

if(isset($_POST['submit'])){
	$error['empty'] = $controller->checkPostProfil($_POST);
}
$controller->notConnect($_SESSION);
ob_start();
?>
<section class="text-center">
	<?= $msgSucess ?>
	<h3 class="display-4 text-center">Change tes informations</h3>
	<form class="text-center container" method="POST" action="profil.php">
		<label for="">Change ton login</label>
		<input class="form-control" type="text" value="<?php echo $_SESSION['login'];?>" name="login"><br>
		<label for="">Change ton email</label>
		<input class="form-control" type="text" value="<?php echo $_SESSION['email'];?>" name="email"><br>
		<label for="">Change ton mot de passe</label>
		<input class="form-control" type="password" name="password" value="<?php echo $_SESSION['pass'] ?>"><br>
		<label for="">Change ton nouveau mot de passe</label>
		<input class="form-control" type="password" name="password_conf" value="<?php echo $_SESSION['pass'] ?>"><br>
		<?=$error['empty'] ?>
		<input  class="btn btn-lg btn-primary btn-block p-3" type="submit" name="submit"><br>             
	</form>
</section>
<?php
$pageContent = ob_get_clean();
require_once('views/templates/layout.php');      
