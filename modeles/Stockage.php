<?php

class Stockage extends Modele{

    private $idStockage;
    private $idPanier;
    private $idLivre;
    private $quantite;

    private $Livre =[];
    public function __construct($idStockage = null)
    {
       if($idStockage!=null)
       {
        $requete=$this->getBdd()->prepare("SELECT * FROM stockage WHERE idStockage = ?");
        $requete->execute([$idStockage]);
        $stockage = $requete->fetch(PDO::FETCH_ASSOC);

        $this->idStockage       = $stockage['idStockage'];
        $this->idPanier         = $stockage['idPanier'];
        $this->idLivre          = $stockage['idLivre'];
        $this->quantite         = $stockage['quantite'];

        $this->initLivreStockage($this->idLivre);
// instancier objets  pour propriétés
       }
    }
    /**
     * @param   int idLivre
     * @return  void
     */
    public function initLivreStockage($idLivre)
    {
        $requete = $this->getBdd()-> prepare ("SELECT * FROM livres WHERE idLivre = ?");
        $requete -> execute([$idLivre]);
        $livre = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($livre as $L)
        {
            $livres = new Livre();
            $livres->initialize($L['idLivre'],$L['Titre'],$L['date_sortie'],$L['Prix'],$L['Photo'],$L['idGenre'],$L['idtypeGenre'],$L['idEditeur'],$L['date_heure'],$L['droit']);
            $this->Livre=$livres;
        }
    }

    public function initializeStockage( $idStockage=null,$idPanier=null,$idLivre=null,$quantite=null)
    {
        $this->idStockage   =   $idStockage;
        $this->idPanier     =   $idPanier;
        $this->idLivre      =   $idLivre;
        $this->quantite     =   $quantite;

        $this->Livre        =   new Livre($this->idLivre);
    }

    public function getIdStockage()
    {
        return $this->idStockage;
    }
    public function getIdPanier()
    {
        return $this->idPanier;
    }
    public function getIdLivre()
    {
        return $this->idLivre;
    }
    public function getQuantite()
    {
        return $this->quantite;
    }
    public function getLivre()
    {
        return $this->Livre;
    }






    public function insertStockage($idPanier, $idLivre, $quantite){
        $requete=$this->getBdd()->prepare("INSERT INTO stockage (idPanier, idLivre, quantite) VALUES (?, ?, ?)");
        $requete->execute([$idPanier,$idLivre, $quantite]);
    }

    public function recupPanier($idPanier)
    {
        $requete=$this->getBdd()->prepare("SELECT * FROM stockage LEFT JOIN paniers USING(idPanier) WHERE idPanier = ?");
        $requete->execute([$idPanier]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modifQuantite($quantite, $idPanier, $idLivre)
    {
        $requete=$this->getBdd()->prepare("UPDATE stockage SET quantite = ? WHERE idPanier = ? AND idLivre = ?");
        $requete->execute([$quantite, $idPanier, $idLivre]);
    }

    public function verifQuantite($idPanier, $idLivre)
    {
        $requete=$this->getBdd()->prepare("SELECT quantite FROM stockage WHERE idPanier = ? AND idLivre = ?");
        $requete->execute([$idPanier, $idLivre]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function suppressionProduit($idStockage)
    {
        $requete=$this->getBdd()->prepare("DELETE FROM stockage WHERE idStockage = ?");
        $requete->execute([$idStockage]);
    }

    public function comptageLivrePanier($idPanier)
    {
        $requete=$this->getBdd()->prepare('SELECT count(*) as nbLivres FROM stockage WHERE idPanier = ?');
        $requete->execute([$idPanier]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function quantiteMoins($idPanier, $idLivre)
    {
        $requete=$this->getBdd()->prepare('UPDATE stockage SET quantite = quantite-1 WHERE idPanier = ? AND idLivre = ?');
        $requete->execute([$idPanier, $idLivre]);
    }

    public function quantitePlus($idPanier, $idLivre)
    {
        $requete=$this->getBdd()->prepare('UPDATE stockage SET quantite = quantite+1 WHERE idPanier = ? AND idLivre = ?');
        $requete->execute([$idPanier, $idLivre]);
    }
}

