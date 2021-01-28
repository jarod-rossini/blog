<?php
session_start();
require_once'controllers/Article_controller/Article_controller.php';
require_once'views/Articles_view.php';
$controllers = new articlecontroller();
$view = new articleview();

$pageTitle = "Creer articles";

$controllers->notAdmin($_SESSION['droits']);

$empty = $categorie = '';
       $error = [
           'empty' => ''
       ];

$categorie = $controllers->selectAllCategorie();
//traitement form create article
if(isset($_POST['submit'])){
    $error['empty'] = $controllers->checkFormInsertArticle($_POST);
    }
ob_start();
?>
<section class="text-center">
    <h1 class="display-4">Creer ton articles</h1>
    <form action="" method="post">
        <label>Ecrit ton article</label><br>
        <textarea name="art"
          rows="16" cols="133">
</textarea><br><br>
       <label for=""></label>
       <select name="id_categorie" id="">
           <option value="0">Select your categorie:</option>          
           <?php 
            $viewcategorie = $view->allCategoriesOnOption($categorie);  
            echo $viewcategorie;                
        ?>
       </select>
       <br>
        <?= $error['empty'] ?>
       <br>
        <input class="btn btn-outline-info" name="submit" type="submit"><br>
    </form>
</section>
<?php
$pageContent = ob_get_clean();
require_once('views/templates/layout.php');
?>