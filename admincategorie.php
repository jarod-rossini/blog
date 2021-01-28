<?php 
session_start();
require_once'controllers/Article_controller/Article_controller.php';
require_once'views/Articles_view.php';


$view = new articleview();
$controllers = new articlecontroller();
$pageTitle = "Administrer";

$controllers->notAdmin($_SESSION['droits']);
    
$error = [
    'update' => '',
    'delete' => ''
];

$controllers->verifGetIdCat($_GET);

//traitement form changeCategorie
if(isset($_POST['submit'])){
    $error['update'] = $controllers->formUpdateCategorie($_POST);
        }

//traitement form suppression categorie
if(isset($_POST['submitsuppr'])){
    $error['delete'] = $controllers->formDeleteCategorie($_POST);
    }

    ob_start();
$row = $controllers->selectCategorie();
    ?>
    <section class="text-center"><br>
    <h1 class="display-4">Gerer les categorie</h1><br>
    <table class="table container">
        <thead class="table-dark">
           <tr>
            <th>id</th>
            <th>nom</th>
           </tr>
        </thead>
        <tbody class="table-light">
            <tr>
                <td>
                <?php echo $row['id']; ?>
                </td>
                <td>
                <?php echo $row['nom']; ?>
                </td>
            </tr>
        </tbody>    
    </table>
     <br>
     <div class="container">
         <div class="row">
             <div class="col-6 align-self-center">
                <div class="card">
                 <div class="card-header">
                     Change le nom de cette categorie
                 </div>
                 <br>
                 <form action="" method="POST">
 <label for="">Change le nom</label>
 <input class="form-control" type="text"  name="nom">

 <br>
  <?= $error['update'] ?>
 <input  class="btn btn-sm btn-primary btn-block p-3" type="submit" name="submit">
</form>                    
            </div>
        </div>
        <div class="col-6 align-self-center">
            <div class="card">
        <div class="card-header">
                     Supprime cette categorie 
                 </div>
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
</div><br>
     <?php
        $pageContent = ob_get_clean();
    require_once('views/templates/layout.php');
