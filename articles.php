<?php
session_start(); 
require_once'controllers/Article_controller/Article_controller.php';
require_once'views/Articles_view.php';

$controllers = new articlecontroller();
$view = new articleview();

$pageTitle = "Articles";

$msg = "<p class='alert alert-success text-center'>Les donnée ont bien était modifié</p>";
$msgSucess = $controllers->valid($_GET, $msg);

$pagecourante = $controllers->CheckGetStart($_GET);

$cat = $controllers->CheckGetCategorie($_GET);
ob_start();
  echo $msgSucess;
?>
<section>
<br><h1 class="text-center display-4">Les articles</h1>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">filtre par categorie</a><div class='dropdown-menu'>
  <?php 
  ///////VOIR ICI POUR DENIS DANS CETTE VIEW MODEL INSTANCIER///////
    $categories = $controllers->selectAllCategorie();
      $Articlefiltre = $view->viewFiltre($categories);
      echo $Articlefiltre;
?> 
              </div>             
   <a class="nav-link" href="articles.php?start=1">article du plus récents</a>   
    <?php    
    //selectuser(viaID)
     
    $viewarticleall = $view->viewArticles($pagecourante, $cat);
      echo $viewarticleall;
?>
</section>
    <?php
$pageContent = ob_get_clean();
require_once('views/templates/layout.php');
?>