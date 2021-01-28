<?php
require_once'controllers/Controller.php';
require_once'models/Article_model/Article_model.php';
class articlecontroller extends controller
{
    private $models;
    private $controller;
    private $id_article;
    private $id_categorie;
    private $pagecourante;
    private $cat;

         public function __construct(){
        $this->models = new articlemodel();
        $this->controller = new controller();
    }

//////////////PAGE INDEX////////////////
public function vueTroisArticle(){
    $viewarticle = 3;
    $start = 0;
    return $articles = $this->models->selectArticleWithPagination($start, $viewarticle);
  }

///////////////PAGE ARTICLE////////////////
public function verifGetidarticle(){
    if(isset($_GET['id']) && !empty($_GET['id'])){
    $this->id_article = intval($_GET['id']);
    return $this->id_article;
}
else{
    header('location:articles.php?start=1');
    }
}
//select article viséé
public function selectArticle(){
return $article = $this->models->selectArticleId($this->id_article);
}
//select all commentaires 
public function selectAllCom(){
   return $com = $this->models->selectcomforArticle($this->id_article);
}
//traitement formulaire commentaires
public function formInsertCom()    
    {
        if(isset($_POST['submit'])){
            if(empty($_POST['com'])){
        return $error = "<p class='alert alert-danger'>Remplit bien tout les champs</p>"; 
    }
        if(!preg_match('/^[A-Za-z0-9.]{4,100}/',$_POST['com'])){
            return $error = "<p class='alert alert-danger'>Minimum 3 caractères et commence ton commentaires au début de la ligne pas de caractére speciaux</p>"; 
        }
        else{
            $com = htmlspecialchars($_POST['com']);
         $this->models->insertcom($com, $this->id_article, $_SESSION['id']);
        $this->controller->Redirect("article.php?id=".$this->id_article."&valid=1");
        }

    }
}
//////////////PAGE ALL ARTICLE WHITH FILTRE///////////////////////////
public function totalarticlewithFiltre($categories){
    return $this->models->countArticleFiltre($categories);
}
//////CHECK Argument start//////////
public function CheckGetStart(){
    if(isset($_GET['start']) && !empty($_GET['start']) && $_GET['start'] > 0){
        $this->pagecourante = intval($_GET['start']);
        return $this->pagecourante;
}
    else{
        $pagecourante = 1;
        header('location:articles.php?start='.$this->pagecourante.'');
        return $this->pagecourante;
        }
    }
////////CHECK argument Categorie/////////////::
public function CheckGetCategorie(){
 if(isset($_GET['categorie']) && !empty($_GET['categorie']) && $_GET['categorie'] > 0){
        $this->cat = intval($_GET['categorie']);
     return $this->cat;
        }
        else{
            $this->cat =null;
        }
    }
//ok
public function selectAllCategorie(){
        return $categorie = $this->models->selectCategorie();
    }
public function totalArticle(){
    return $nbrarticle = $this->models->countArticle();
}


    ///////////PAGE ADMIN CATEGORIE///////////
    public function formUpdateCategorie(){
        if(isset($_POST['submit'])){
            if(empty($_POST['nom'])){
                return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
            }
            if(!preg_match('/^[A-Za-z0-9.]{2,100}/',$_POST['nom'])){
            return $error = "<p class='alert alert-danger'>Minimum 2 caractères et commence ton commentaires au début de la ligne pas de caractère spécifique</p>"; 
        }
            $nom = htmlspecialchars($_POST['nom']);
            if($this->models->nameExist($nom)==-1){
               $error['nom'] = "<p class='alert alert-danger'>Nom de categorie deja pris</p>";
           }
            else{
                $this->models->updatecategorie($this->id_categorie, $nom);
                $this->controller->Redirect("admin.php?valid=1");
           }
    }
}
//ok
public function checkFormCategorie(){
if(isset($_POST['submit'])){
    if(empty($_POST['nom'])){
        return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
            }
    else{
    $nom = htmlspecialchars($_POST['nom']);
    $this->models->insertCategorie($nom);
    $this->controller->Redirect("admin.php?valid=1");    
        }
    }
}

///////ok//////
public function formDeleteCategorie(){
    if(isset($_POST['submitsuppr'])){
    if(empty($_POST['select'])){       
                return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
            }
            if($_POST['select']==2){
                return $error = "<p class='alert alert-warning'>Oh quelle confiance ca essaie tout sorte de choses merci beaucoup c'est trop d'honneur</p>";
                }
                if($_POST['select']==1){
                     $this->models->deletecategorie($this->id_categorie);
                    $this->controller->Redirect("admin.php?valid=1");
        }
    }
}
    //okkkk//////
public function verifGetIdArt(){
    if(empty($_GET['idarticle'])){
        header('location:admin.php');
    }
    if(isset($_GET['idarticle'])){
        $this->id_article = intval($_GET['idarticle']);
        return $this->id_article;
    }
}
//select all article// ok
public function selectAllArticle(){
    return $article = $this->models->selectArticle();
}
    //ok/
public function checkFormInsertArticle(){
    if(isset($_POST['submit'])){
   if(empty($_POST['art'])){
       return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
   }
   $article = htmlspecialchars($_POST['art']);
        if($_POST['id_categorie']==0){
        return $error = "<p class='alert alert-danger'>Veuillez choisir une categorie</p>";
}
        else{
            $id_categorie = intval($_POST['id_categorie']);
            $id_utilisateur = $_SESSION['id'];
            $this->models->insertarticle($article,$id_utilisateur,$id_categorie);
             $this->controller->Redirect("articles.php?start=1&valid=1");
        }

    }
}

////ok//////
public function selectCategorie(){
    return $categorie = $this->models->selectidcat($this->id_categorie);
}
   
///okkk////
public function checkFormChangeArticle(){
    if(isset($_POST['submit'])){
        if(empty($_POST['article'])){
      return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
                }
        if($_POST['id_categorie']==0){
            return $error = "<p class='alert alert-danger'>Veuillez choisir une categorie</p>";    
            }
        else{
            $id_utilisateur = $_SESSION['id'];
            $article = htmlspecialchars($_POST['article']);
$id_categorie = intval($_POST['id_categorie']);
$this->models->updatearticle($this->id_article, $article,$id_utilisateur,$id_categorie);
$this->controller->Redirect("admin.php?valid=1");
            }
        }
}
/////ok///////
public function checkFormDeleteArticle(){
    if(isset($_POST['submitsuppr'])){
        if(empty($_POST['select'])){       
                return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
                }
                if($_POST['select']==2){
                    return $error = "<p class='alert alert-warning'>Oh quelle confiance ca essaie tout sorte de choses merci beaucoup c'est trop d'honneur</p>";
                }
                if($_POST['select']==1){
                $this->models->deletearticle($this->id_article);
           $this->controller->Redirect("admin.php?valid=1");
            }
    }
}
    ///okk////
public function verifGetIdCat(){
    if(empty($_GET['idcategorie'])){
        header('location:admin.php');
    }
    if(isset($_GET['idcategorie'])){
    $this->id_categorie = intval($_GET['idcategorie']);
        return $this->id_categorie;
    }
}
}