<?php
session_start();

require_once'controllers/User_controller/User_controller.php';
require_once'controllers/Article_controller/Article_controller.php';
require_once'views/Admin_view.php';
require_once'views/Articles_view.php';

$pageTitle = "Administration";

$views = new adminview();
$view = new articleview();
$controller = new usercontroller();
$controllers = new articlecontroller();

$controllers->notAdmin($_SESSION['droits']);

$msg = "<p class='alert alert-success'>Les donnée ont bien était modifié</p>";
$msgSucess = $controller->valid($_GET, $msg);

$error = [
    'empty' => ''
];

if(isset($_POST['submit'])){   
$error['empty'] = $controllers->checkFormCategorie($_POST);
}
ob_start();
?>
 <section class='text-center'><br>
<?php
   echo $msgSucess;
     
     if($_SESSION['droits']==1337){
         $user = $controller->selectAllUser();
         $categorie = $controllers->selectAllCategorie();
         $article = $controllers->selectAllArticle();
     }
?>
     <h1 class="display-4">Gerer les utilisateurs</h1><br><div class="container">
   <table class="table">
       <thead class="table-dark">
           <tr>
               <th>id</th>
               <th>login</th>
               <th>email</th>
               <th>password</th>
               <th>droits</th>
               <th>Statut</th>
               <th>Gerer</th>
           </tr>
       </thead>
   <tbody class="table-light">
   <tr> 
    <?php
$tableuser = $views->tableuser($user);
echo $tableuser;
       ?>
       </tbody>
    </table>
</div>
      <br><h1 class="display-4">Gerer les catégories</h1><br>
      <div class="text-center container">
    <table class="table">
<thead class="table-dark"><tr>
      <th>Id</th>
      <th>Categorie</th>
      <th>Gerer</th>
      </tr>
      </thead>
      <tbody>
       <?php
$tableCategorie = $views->tableCategorie($categorie);
    echo $tableCategorie;
    ?>
    </tbody>
    </table>
     </div>
    <form action="" method="POST">
          <h3>Creer une categorie</h3>
       <label for="nom">Categorie</label><br>
        <input class="control-form" name="nom" type="text"><br><br>
        <input type="submit" name="submit" class="btn btn-outline-primary"><br>
    </form><br>
        <?= $error['empty'] ?>
    <br>
    <h1 class="display-4">Gerer les articles</h1><br>
    <div class="text-center container">
    <table class="table">
    <thead class="table-dark"><tr>
    <th>Id</th>
    <th>articles</th>
    <th>id_user</th>
    <th>id_categorie</th>
    <th>date</th>
    <th>gerer</th>
    </tr></thead>
    <tbody>
    <?php
         $tableArticle = $views->tableArticle($article);
        echo $tableArticle;
          ?>
            </tbody>
        </table>
    </div>
</section>
          <?php
$pageContent = ob_get_clean();
require_once('views/templates/layout.php');
?>
