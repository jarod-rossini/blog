<?php
session_start();

require_once'controllers/Article_controller/Article_controller.php';
require_once'views/Articles_view.php';

$controllers = new articlecontroller();
$view = new articleview();

$pageTitle = "Article";

$error = [
'empty' => ''
];


$msg = "<p class='alert alert-success'>Le commentaire à bien était posté</p>";
$msgSucess = $controllers->valid($_GET, $msg);

$controllers->verifGetidarticle($_GET);

$article = $controllers->selectArticle();

if(isset($_POST['submit'])){
    $error['empty'] = $controllers->formInsertCom($_POST);
}
$com = $controllers->selectAllCom();

ob_start();
?>
<section class="text-center">
   <?= $msgSucess ?>
    <h1 class="display-4">Bienvenue sur l'article n°<?= $article[0]['id'] ?></h1><br>
    <div class="card text-center">
        <div class="card-header">
            par <?= $article[0]['login'] ?>
        </div>
        <div class="card-body">
            <h5 class="card-title">
                
            </h5>
            <p class="card-text">
                <?= $article[0]['article'] ?>
            </p>
            <br>
            <span class="alert alert-light">
                <?= $article[0]['nom'] ?>
            </span>
        </div>
        <div class="card-footer">
            <?= $article[0]['date'] ?>
        </div>
    </div>
    <br>
    <h5 class="">commentaires :</h5>
      <?php
      $view->viewCommentaire($com);
        ?>
    <br>
    <form action="" method="post">
       <label for=""> Posté un commentaires</label><br>
        <textarea name="com" id="" cols="30" rows="3">
        </textarea><br>
        <input type="submit" name="submit">
        <?= $error['empty'] ?>
        <br>
    </form><br><br>
</section>
<?php
$pageContent = ob_get_clean();
require_once('views/templates/layout.php');
?> 