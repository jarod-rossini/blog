<?php
require_once('models/Model.php');

class articlemodel extends model
{
    protected $pdo;
    
    //fonction sur categorie
public function insertCategorie($nom){
    $query = $this->pdo->prepare('INSERT INTO categories SET nom = :nom');
	   $query->execute(compact('nom'));
}

public function selectCategorie(){
    $sql = "SELECT id, nom FROM categories";    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
     while($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        return $user;
    } 
}
    

    
public function updatecategorie($id, $nom){
    $sql = "UPDATE categories SET nom =:nom WHERE id=:id";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'id' => $id
            ]);  
}
    
    public function nameExist($nom){
    $sql = ('SELECT nom FROM categories WHERE nom = :nom');
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'nom' => $nom
    ]);
    if($stmt->rowCount() > 0){
        return -1;
    } else 
        return 1;
}
    
public function deletecategorie($id){
    $sql = "DELETE FROM categories WHERE id = :id";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
            ]);
}
    //fonction sur les articles
    

public function updatearticle($id, $article, $id_utilisateur, $id_categorie){
    $sql = "UPDATE articles SET article = :article, id_utilisateur = :id_utilisateur, id_categorie = :id_categorie WHERE id=:id";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'article' => $article,
            'id_utilisateur' => $id_utilisateur,
            'id_categorie' => $id_categorie
            ]);  
}
   
public function deletearticle($id){
    $sql = "DELETE FROM articles WHERE id = :id";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
            ]);
}
    
public function insertarticle($article, $id_utilisateur, $id_categorie){
    $query = $this->pdo->prepare('INSERT INTO articles SET article = :article, id_utilisateur = :id_utilisateur, id_categorie = :id_categorie');
	   $query->execute([
           'article' => $article,
           'id_utilisateur' => $id_utilisateur,
           'id_categorie' => $id_categorie
           ]);
        }
    
public function selectArticle(){
    $sql = "SELECT * FROM articles ORDER BY date DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
while($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        return $user;
    }
}

public function countArticle(){
    $sql = "SELECT id FROM articles";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
     $nbrarticle = $stmt->rowCount();
    return $nbrarticle;
}

/////////PAGE ARTICLES//////
public function selectArticleWithPagination($start, $nbrarticle){
    $sql = "SELECT articles.id, articles.article, articles.date, utilisateurs.login, categories.nom FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.id_categorie = categories.id ORDER BY date DESC LIMIT ".$start.",".$nbrarticle."";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
while($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        return $user;
    }
}
public function selectArticleFiltre($start, $nbrarticle, $id_categorie){
    $sql = "SELECT * FROM categories INNER JOIN articles ON categories.id = articles.id_categorie WHERE id_categorie = :id_categorie ORDER BY date DESC LIMIT ".$start.",".$nbrarticle."";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'id_categorie' => $id_categorie
    ]);
while($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        return $user;
    }
}

public function selectidcat($id){
    $sql = ('SELECT id, nom FROM categories WHERE id = :id');    
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
             return $row;
    }

public function countArticleFiltre($id_categorie){
        $sql = "SELECT * FROM articles INNER JOIN categories ON articles.id_categorie = categories.id WHERE id_categorie = :id_categorie";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'id_categorie' => $id_categorie
    ]);
        $nbrarticle = $stmt->rowCount();
    return $nbrarticle;
    }
//page article
public function selectArticleId($id){
    $sql = "SELECT articles.id, articles.article, articles.date, utilisateurs.login, categories.nom FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.id_categorie = categories.id WHERE articles.id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'id' => $id
    ]);
while($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        return $user;
    }
}

public function insertcom($com, $id_art, $id_user){
     $query = $this->pdo->prepare("INSERT INTO commentaires SET commentaire = :commentaire, id_article = :id_article, id_utilisateur = :id_utilisateur");
    $query->execute([
        'commentaire' => $com,
        'id_article' => $id_art,
        'id_utilisateur' => $id_user
    ]);
}

public function selectcomforArticle($id_article){
    $sql = "SELECT * FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id WHERE id_article = :id_article ORDER BY date DESC";
     $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'id_article' => $id_article
    ]);
while($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        return $user;
    }
}
    
    
    }
?>