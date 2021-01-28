<?php 
session_start();
require_once'controllers/User_controller/User_controller.php';
require_once'controllers/Article_controller/Article_controller.php';
require_once'views/Admin_view.php';
require_once'views/Articles_view.php';

$view = new articleview();
$views = new adminview();
$controller = new usercontroller();
$controllers = new articlecontroller();

$pageTitle = "Administrer";

$controller->notAdmin($_SESSION['droits']);

$controllers->verifGetidarticle($_GET);

$error = [
    'change' => '',
    'delete' => ''
];
//traitement changement de l'article
if(isset($_POST['submit'])){
    $error['change'] = $controllers->checkFormChangeArticle($_POST);  
        }
////traitement suppression article
if(isset($_POST['submitsuppr'])){ 
    $error['delete'] = $controllers->checkFormDeleteArticle($_POST);
}
ob_start();
?>
<div class="text-center container"><br>
    <h1 class="display-4">Gerer les articles</h1><br>
    <?php
    $article = $controllers->selectArticle();
    $tableauArticle = $views->tableArticleSolo($article);
    echo $tableauArticle;
    ?>
    <div class="container">
         <div class="row">
             <div class="col-6 align-self-center">
                <div class="card">
<div class="card-header">modifier cette articles</div><br>
                 <form action="" method="POST">   
         <textarea name="article"
          rows="6" cols="53">
</textarea><br><br>
     <select name="id_categorie" id="">
           <option value="0">Select your categorie:</option>          
           <?php 
    $categorie = $controllers->selectAllCategorie();
         $viewCategorie = $views->allCategorieOnOption($categorie);
         echo $viewCategorie;          
        ?>
       </select><br><br>
  <?= $error['change'] ?>
 <input  class="btn btn-sm btn-primary btn-block p-3" type="submit" name="submit">
</form>                    
            </div>
        </div>
    <div class="col-6 align-self-center">
            <div class="card">
<div class="card-header">Supprime l'article</div>
<form action="" method="POST"><br>
<h5>Are you sur ?</h5>
<select name="select">
<option value="0">--Please choose an option--</option>
<option value="1">yes</option>
<option value="2">OMGGG NOO !!!!</option>
</select><br><br>
<?= $error['delete'] ?>
 <input  class="btn btn-sm btn-primary btn-block p-3" type="submit" name="submitsuppr">                    
</form>
                </div>
            </div>  
        </div>
    </div>
</div>

<?php
    $pageContent = ob_get_clean();
require_once('views/templates/layout.php');