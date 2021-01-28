<?php
require_once'models/Article_model/Article_model.php';
require_once'models/User_model/User_model.php';
class articleview
{

  private $models;
  private $model;

  public function __construct(){
    $this->model = new usermodel();
    $this->models = new articlemodel();
    $this->controllers = new articlecontroller();   
  }
  ////////////////PAGE INDEX///////////////////
  public function viewIndexArticle($articles){
    for($t=0;isset($articles[$t]);$t++){
        echo"<br><div class='card text-center'>
  <div class='card-header'>par ".$articles[$t]['login']." </div>
  <div class='card-body'>
    <h5 class='card-title'><a href='#' class='btn btn-outline-light'>article n°".$articles[$t]['id']."</a></h5>
    <p class='card-text'>".$articles[$t]['article']."</p>
    <span class='alert alert-light'>".$articles[$t]['nom']."</span>
  </div>";
        if(isset($_SESSION['login'])){
            echo"<a href='article.php?id=".$articles[$t]['id']."' class='btn btn-outline-info'>Accéder à l'article</a>";
        }
        echo"<a><div class='card-footer text-muted'>
    ".$articles[$t]['date']."
  </div>
</div> 
</section><br>";
    } 
  }
  ////////////////PAGE ARTICLE///////////////////
 public function viewCommentaire($com){
    $c=0;
    while(isset($com[$c])){
        echo"<div class='container'><div class='card text-center bg-dark text-white'>
        <div class='card-header'>Par ".$com[$c]['login']."</div><div class='card-body'>".$com[$c]['commentaire']."</div><div class='card-footer'>à ".$com[$c]['date']."</div></div></div></div><br>";
        $c++;
    }
 }



  public function viewFiltre($categories){
    $w=0;
    $view = null;
    while(isset($categories[$w])){
     $view.= '<a class="dropdown-item" href="articles.php?categorie='.$categories[$w]['id'].'&start=1">'.$categories[$w]['nom'].'</a>';
     $w++;
   }
   return $view;
 }
 //ok//
 public function allCategoriesOnOption($categorie){
          $w=0;
    while(isset($categorie[$w])){ 
        echo '<option value="'.$categorie[$w]['id'].'">'.$categorie[$w]['nom'].'</option>';
        $w++;
    }
  }



/////////////PAGE ARTICLE/////////////////
 public function viewArticles($pagecourante, $cat){
  $view = "";
  $viewarticle = 5;
  $start = ($pagecourante-1)*$viewarticle;
  if(isset($_GET['start']) && empty($_GET['categorie'])){
    $nbrarticle = $this->controllers->totalArticle();
  $totalarticle = ceil($nbrarticle/$viewarticle);
    $article = $this->models->selectArticleWithPagination($start, $viewarticle);
    for($t=0;isset($article[$t]);$t++){
      echo "<br><div class='card text-center'><div class='card-header'>par ".$article[$t]['login']."</div><div class='card-body'><h5 class='card-title'><a href='article.php?id=".$article[$t]['id']."' class='btn btn-outline-info'>article n°".$article[$t]['id']."</a></h5><p class='card-text'>".$article[$t]['article']."</p><span class='alert alert-light'>".$article[$t]['nom']."</span></div><div class='card-footer text-muted'>".$article[$t]['date']."</div></div><br>";
          }
    $view.="</section><nav aria-label='Page navigation example'><ul class='pagination justify-content-center'>";
    for($a=1;$a<=$totalarticle;$a++){
      if($a==$pagecourante){
        $view.="<li class='page-item'><a class='page-link bg-light' href='#'>$a</a></li>";
      }
      else{   
        $view.="<li class='page-item'><a class='page-link' href='articles.php?start=".$a."'>$a</a></li>";
      }
    }
    $view.="</ul></nav>";
    return $view;
  }
///////si filtre choisit categorie/////////
  else{
    $nbrarticle = $this->controllers->totalarticlewithFiltre($cat);
    $totalarticle = ceil($nbrarticle/$viewarticle);
    $articles = $this->models->selectArticleFiltre($start, $viewarticle, $cat);
    for($b=0;isset($articles[$b]);$b++){
      $user = $this->model->selectid($articles[$b]['id_utilisateur']);
      $categoriess = $this->models->selectidcat($articles[$b]['id_categorie']);       
      echo"<br><div class='card text-center'><div class='card-header'>par ".$user['login']."</div><div class='card-body'><h5 class='card-title'><a href='article.php?id=".$articles[$b]['id']."' class='btn btn-outline-info'>article n°".$articles[$b]['id']."</a></h5><p class='card-text'>".$articles[$b]['article']."</p><span class='alert alert-light'>".$categoriess['nom']."</span></div><div class='card-footer text-muted'>".$articles[$b]['date']."</div></div><br>";
    }
    $view.="</section><nav aria-label='Page navigation example'><ul class='pagination justify-content-center'>";
    for($a=1;$a<=$totalarticle;$a++){
      if($a==$pagecourante){
        $view.="<li class='page-item'><a class='page-link bg-light' href='#'>$a</a></li>";
      }
      else{   
        $view.="<li class='page-item'><a class='page-link' href='articles.php?categorie=".$cat."&start=".$a."'>$a</a></li>";
      }
    }
    $view.="</ul></nav>";
    return $view;        
  }
}    

}