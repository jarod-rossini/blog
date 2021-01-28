<?php
session_start();
require_once'controllers/Article_controller/Article_controller.php';
require_once'views/Articles_view.php';
$view = new articleview();
$controllers = new articlecontroller();

$pageTitle = "Acceuil";
//RECUPERE LES 3 DERNIER ARTICLES
$articles = $controllers->vueTroisArticle();
ob_start();
?>
<section class="text-center">
	<h1 class="display-4">Bienvenue sur mon projet blog</h1>
	<image src="assets/images/photo%20blog.jpg"></image>
	<br><br>
	<h4>les trois derniers articles en dates</h4>
	<?php 
	echo $views = $view->viewIndexArticle($articles);   
	?>
</section>
<?php
$pageContent = ob_get_clean();
require_once('views/templates/layout.php');
?>