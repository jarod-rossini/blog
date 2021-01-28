<!DOCTYPE html>
<html lang="fr"> 
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $pageTitle ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="./assets/style/style.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Accueil</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php  if(isset($_SESSION['login'])){?>
  <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
    Categorie
  </a>
  <div class="dropdown-menu">
  <?php 
$categorie = $controllers->selectAllCategorie();
        echo $view->viewFiltre($categorie);
      ?>
  </div>
  </li>
     <li class="nav-item">
        <a class="nav-link" href="articles.php?start=1">Articles<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
      <?php if(isset($_SESSION['droits'])){
    if($_SESSION['droits']==42 || $_SESSION['droits']==1337){
        ?>
         <li class="nav-item">
        <a class="nav-link" href="creer-article.php">Creer-article<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
<?php 
    }
        if($_SESSION['droits']==1337){  
?>
         <li class="nav-item">
        <a class="nav-link" href="admin.php">Administration<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
      <?php
        }
    }
        ?>
      <li class="nav-item">
        <a class="nav-link" href="profil.php">Profil<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="deconnexion.php">Deconnexion<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
    <?php }?>
    <?php if(!isset($_SESSION['login'])){?>
      <li class="nav-item">
        <a class="nav-link" href="inscription.php">Inscription<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="connexion.php">Connexion</a>
      </li>
<?php
}
?>
    </ul>
  </div>
</nav>
	</header>
	
	<main>
	    <?= $pageContent ?>
	</main>
	<footer class="text-center">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Accueil</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <?php  if(isset($_SESSION['login'])){?>
  <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
    Categorie
  </a>
  <div class="dropdown-menu">
  <?php 
  $categorie = $controllers->selectAllCategorie();
        echo $view->viewFiltre($categorie);
      ?>
  </div>
  </li>
     <li class="nav-item">
        <a class="nav-link" href="articles.php">Articles<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
      <?php if(isset($_SESSION['droits'])){
    if($_SESSION['droits']==42 || $_SESSION['droits']==1337){
        ?>
         <li class="nav-item">
        <a class="nav-link" href="creer-article.php">Creer-article<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
<?php 
    }
        if($_SESSION['droits']==1337){  
?>
         <li class="nav-item">
        <a class="nav-link" href="admin.php">Administration<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
      <?php
        }
    }
        ?>
      <li class="nav-item">
        <a class="nav-link" href="profil.php">Profil<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="deconnexion.php">Deconnexion<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
    <?php }?>
    <?php if(!isset($_SESSION['login'])){?>
      <li class="nav-item">
        <a class="nav-link" href="inscription.php">Inscription<span class="sr-only sr-only-focusable">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="connexion.php">Connexion</a>
      </li>
<?php
}
?>
    </ul>
        <span class="navbar-text">footer by tetar</span>
  </div>
</nav>
</footer>

</body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>