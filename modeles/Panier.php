<?

class Panier extends Modele{

    private $idpanier;
    
    private $idutilisateur;

    private $idLivres;

    function __construct($idpanier = null, $idutilisateur = null)
    {
        if($idpanier != null && $idutilisateur != null){
            $requete = $this->getBdd()->prepare('SELECT idLivre,idPanier FROM panier INNER JOIN stockage USING (idPanier) INNER JOIN utilisateurs USING (idUtilisateur) WHERE idPanier = ? AND IdUtilisateur = ?');
            $requete->execute([$idpanier,$idutilisateur]);

            $idLivres = $requete->fetch(PDO::FETCH_ASSOC);

            $this-> idpanier = $idpanier;

            $this-> idLivres = $idLivres;
        }
    }

    public function ajouterPanier(){
        $requete = $this->getBdd()->prepare('INSERT INTO Panier (idUtilisateur) VALUES (?)');
        $requete->execute();
    }

    public function getPanier(){
        return $this->idpanier;
    }

    public function getIdlivres(){
        return $this->idLivres;
    }
}