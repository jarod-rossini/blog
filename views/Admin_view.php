<?php
require_once'models/Article_model/Article_model.php';
require_once'models/User_model/User_model.php';
class adminview
{ 
    private $models;
    private $model;
    
 public function __construct(){
$this->model = new usermodel();
$this->models = new articlemodel(); 
 }
    //ok////
public function allCategorieOnOption($categorie){
          $w=0;
    while(isset($categorie[$w])){ 
        echo '<option value="'.$categorie[$w]['id'].'">'.$categorie[$w]['nom'].'</option>';
        $w++;
    }
  }
    
//tablo adminuser //ok
public function tableuser($user){
    $view = "";
    for($i=1;isset($user[$i]);$i++){
                if($user[$i]['id_droits']==1){
                    $infoS = "utilisateur";
                }
                if($user[$i]['id_droits']==42){
                    $infoS = "modérateur";
                }
            $idbtn = 0;
                $x=0;
        foreach($user[$i] as $users){
            if($x==0){
                $idbtn = $users;
                $x=1;
            }
                 $view.='<td>'.$users.'</td>';
                    }
    $view.= '<td><button type="button" class="btn btn-outline-dark">'.$infoS.'</button></td>
    <td><form method="get" action="adminuser.php"><button class="btn btn-outline-danger" name="idbutton" value="'.$idbtn.'">Gerée</button></form></td></tr>';
    }
    return $view;
}
//tablo all categorie //ok
public function tableCategorie($categorie){
    $view = "<tr>";
    for($p=0;isset($categorie[$p]);$p++){
             $c=0;
             $idcat = 0;
             foreach($categorie[$p] as $categori){
                    if($c==0){
                $idcat = $categori;
                $c=1;
            }
        $view.="<td>$categori</td>"; 
             }
             $view.="<td><form method='get' action='admincategorie.php'><button name='idcategorie' class='btn btn-outline-info' value='".$idcat."'>Modifié/effacé</button></form></td></tr>";
        }
    $view.="";
    return $view;
    }
//tablo all article //ok
public function tableArticle($article){
    $view="<tr>";
    
    for($t=0;isset($article[$t]);$t++){
             $q=0;
             $idart = 0;
             foreach($article[$t] as $articles){
                    if($q==0){
                $idart = $articles;
                $q=1;
            }
                    $view.="<td>$articles</td>";    
             }
$view.="<td><form method='get' action='adminarticle.php'><button name='id' class='btn btn-outline-info' value='".$idart."'>Modifié/effacé</button></form></td></tr>";
         }
    return $view;
    }
    
    //tablo solo uno USER ok//
public function tableiduser($user){
        $view="<br><h1 class='display-4'>Administration user ".$user['login']."</h1><br><table class='table container'><thead class='table-dark'><tr><th>id</th><th>login</th><th>email</th><th>password</th><th>droits</th></tr></thead><tbody class='table-light'><tr><td>".$user['id']."</td><td>".$user['login']."</td><td>".$user['email']."</td><td>".$user['password']."</td><td>".$user['id_droits']."</td></tr></tbody></table><br>";
    return $view;
}
///ok//////
public function tableArticleSolo($article){
    $view="<table class='table'><thead class='table-dark'><tr><th>Id</th><th>Articles</th><th>User</th><th>Categorie</th><th>Date</th></tr></thead><tbody><tr><td> ".$article[0]['id']."</td><td> ".$article[0]['article']."</td><td> ".$article[0]['login']."</td><td> ".$article[0]['nom']."</td><td> ".$article[0]['date']."</td></tbody></table><br>";
        return $view;
        }
}
    