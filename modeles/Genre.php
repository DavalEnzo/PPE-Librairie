 <?php    
     function insertGenre($libelle){
            $requete = getBdd()->prepare("INSERT INTO genres (nomGenre) VALUES(?)");
            $requete->execute([$libelle]);
        }

    function selectGenre(){
        $requete = getBdd()->prepare("SELECT * FROM genres");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function filtreGenre($idGenre){
        $requete=getBdd()->prepare('SELECT * FROM genres INNER JOIN bibliotheque USING(idGenre) LEFT JOIN ecrit USING(idLivre) WHERE idGenre = ?');
        $requete->execute([$idGenre]);  
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function insertTypegenre($libelle,$idGenre){
        $requete=getBdd()->prepare('INSERT INTO typegenre (libelle, idGenre) VALUES (?, ?)');
        $requete->execute([$libelle, $idGenre]);
    }

    function selectTypeGenre(){
        $requete = getBdd()->prepare("SELECT * FROM genres LEFT JOIN typegenre USING (idGenre)");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }