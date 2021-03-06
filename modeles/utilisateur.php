<?php

class Utilisateur extends Modele{
  
    private $idUtilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $photoProfile;
    private $idPermission;
    private $token;
    private $dateMentionAccepte;
    private $active;

    private $adresse = [];

    private $commentaires = [];

    private $panier;

    private $commandes = [];
    
    public function __construct($idUtilisateur = null,$option=true)
    {
        if($idUtilisateur != null)
        {
            
            $requete=$this->getBdd()->prepare('SELECT * FROM utilisateurs WHERE idUtilisateur = ?');
            $requete->execute([$idUtilisateur]);    
            $User= $requete->fetch(PDO::FETCH_ASSOC);

            $this->idUtilisateur = $User['idUtilisateur'];

            $this->nom = $User['nom'];

            $this->prenom = $User['prenom'];
        
            $this->email = $User['email'];
        
            $this->mdp = $User['mdp'];

            $this->photoProfile = $User['photoProfile'];

            $this->idPermission = $User['idPermission'];
            
            $this->token = $User['token'];

            $this->dateMentionAccepte = $User['dateMentionAcceptée'];

            $this->active = $User['active'];
            
            if($option)
            {
                $this->initComUtilisateur($this->idUtilisateur);
                $this->initCommandesUtilisateur($this->idUtilisateur);
                $this->initCommandeAdresse($this->idUtilisateur);
                $this->initPanierUtilisateur($this->idUtilisateur);
            }
        }
    }

    /**
     * Initialise l'objet utilisateur sans passer par la requête (setters de masse)
     * @param   int     $idUtilisateur
     * @param   string  $nom
     * @param   string  $prenom
     * @param   email   $email
     * @param   string  $mdp
     * @param   string  $photoProfile
     * @param   int     $idPermission
     * @param   string  $token
     * @param   date    $dateMentionAccepte
     * @param   int     $adresse
     *
     * @return  void
     */
    public function initialize($idUtilisateur=null,$nom=null,$prenom=null,$email=null,$mdp=null,$photoProfile=null,$idPermission=null,$token=null,$dateMentionAccepte=null,$active = null, $adresse = null)
    {
        $this->idUtilisateur = $idUtilisateur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp   =   $mdp;
        $this->photoProfile = $photoProfile;
        $this->idPermission = $idPermission;
        $this->token = $token;
        $this->dateMentionAccepte = $dateMentionAccepte;
        $this->active = $active;

        $this->initComUtilisateur($this->idUtilisateur);
        $this->initCommandesUtilisateur($this->idUtilisateur);
        $this->initPanierUtilisateur($this->idUtilisateur);
        $this->initCommandeAdresse($this->idUtilisateur);

    }

     /**
      * Initialise l'objet commentaire par l'idUtilisateur
     * @param   int idUtlisateur
     * 
     * @return void
     */
    public function initComUtilisateur($idUtilisateur)
    {
        $requete = $this->getBdd()-> prepare ("SELECT * FROM commentaires WHERE idUtilisateur = ? ORDER BY date_heure ASC ");
        $requete -> execute([$idUtilisateur]);
        $com = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($com as $c)
        {
            $commentaire = new Commentaire();
            $commentaire->initializeCom( $c['idCommentaire'],$c['contenu'],$c['idUtilisateur'],$c['idLivre'],$c['grade'],$c['entete'],$c['date_heure'], $c['verif'],false);
            $this->commentaires[]=$commentaire;
        }
    }

    /**
     * initialise l'objet panier par l'idUtilisateur
     * @param   int idUtlisateur
     * 
     * @return void
     */
    public function initPanierUtilisateur($idUtilisateur)
    {
        $requete = $this->getBdd()-> prepare ("SELECT * FROM paniers LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idUtilisateur = ? AND utilisateurs.active = 1");
        $requete -> execute([$idUtilisateur]);
        $p = $requete->fetch(PDO::FETCH_ASSOC);

        $panier = new Panier();
        $panier->initializePanier($p['idPanier'],$p['idUtilisateur']);
        $this->panier=$panier;
    }

    /**
     * initialise l'objet commande par l'idUtilisateur
     * @param   int idUtlisateur
     * 
     * @return void
     */
    public function initCommandesUtilisateur($idUtilisateur)
    {
        $requete = $this->getBdd()-> prepare ("SELECT * FROM commandes WHERE idUtilisateur = ?");
        $requete -> execute([$idUtilisateur]);
        $commandes = $requete->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($commandes))
        {
            foreach($commandes as $c)
            {
                $commande = new Commande();
                $commande->initializeCommande($c['idCommande'],$c['idPanier'],$c['idUtilisateur'],$c['prixTotal'],$c['idAdresse'],$c['dateCommande'],$c['statut'], $c['dateLivraison']);
                $this->commandes[]=$commande;
            }
        }
    }

    /**
     * initialise l'objet adresse par l'idUtilisateur
     * @param   int idUtlisateur
     *
     * @return void
     */
    public function initCommandeAdresse($idUtilisateur)
    {
        $requete = $this->getBdd()-> prepare ("SELECT * FROM adresses WHERE idUtilisateur = ?");
        $requete -> execute([$idUtilisateur]);
        $adresses = $requete->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($adresses))
        {
            foreach ($adresses as $a) {
                $adresse = new Adresse();
                $adresse->initializeAdresse($a['idUtilisateur'], $a['idAdresse'], $a['libelle'], $a['ville'], $a['codePostal'], $a['complementAdresse']);
                $this->adresse[] = $adresse;
            }
        }
    }


    public function verifUtilisateur()
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $requete->execute([$_POST["email"]]);
        $u = $requete->fetch(PDO::FETCH_ASSOC);
        $this->initialize($u['idUtilisateur'],$u['nom'],$u['prenom'],$u['email'],$u['mdp'],$u['photoProfile'],$u['idPermission'],$u['token'],$u['dateMentionAcceptée'],$u['active']);
    }

    public function verifUtilisateurMdp($email)
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $requete->execute([$email]);
        $u = $requete->fetch(PDO::FETCH_ASSOC);
        $this->initialize($u['idUtilisateur'],$u['nom'],$u['prenom'],$u['email'],$u['mdp'],$u['photoProfile'],$u['idPermission'],$u['token'],$u['dateMentionAcceptée'],$u['active']);
    }

    public function inscriptionUtilisateur(){
        $requete = $this->getBdd()->prepare("INSERT INTO utilisateurs(nom,prenom,email,mdp,dateMentionAcceptée) VALUES(?,?,?,?, NOW())");
        $requete->execute([$this->nom,$this->prenom,$this->email,$this->mdp]);
    }

    public function modifProfile()
    {
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, email = ? WHERE idUtilisateur = ?");
        $requete->execute([$this->nom, $this->prenom, $this->email, $this->idUtilisateur]);
    }

    public function modifPhotoProfile($idUser, $fichier)
    {
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET photoProfile = ? WHERE idUtilisateur = ?");
        $requete->execute([$fichier, $idUser]);
    }

    public function modifMdp($mdp, $idUser)
    {
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET mdp = ? WHERE idUtilisateur = ?");
        $requete->execute([$mdp, $idUser]);
    }

    public function supprimerProfile($idUser)
    {
        $requete = $this->getBdd()->prepare("DELETE FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$idUser]);
    }

    public function addToken($token, $idUser)
    {
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET token = ? WHERE idUtilisateur = ?");
        $requete->execute([$token, $idUser]);
    }

    public function addUserLogs($idUtilisateur, $ip)
    {
        $requete = $this->getBdd()->prepare("INSERT INTO access_logs(idUtilisateur, ip, date) VALUES (?, ?, NOW())");
        $requete->execute([$idUtilisateur, $ip]);
    }

    public function checkAdminAllowedIP($ip, $idUtilisateur)
    {
        $requete = $this->getBdd()->prepare('SELECT * FROM allowed_ips WHERE ip = ? AND idUtilisateur = ?');
        $requete->execute([$ip, $idUtilisateur]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function verifTentativeConnexion($ip)
    {
        $requete = $this->getBdd()->prepare("SELECT ip FROM tentatives_connexion WHERE ip = ? AND date BETWEEN (NOW() - INTERVAL 1 DAY) AND NOW()");
        $requete->execute([$ip]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tentativeConnexionEchouee($ip)
    {
        $requete = $this->getBdd()->prepare("INSERT INTO tentatives_connexion(ip, date) VALUES (?, NOW())");
        $requete->execute([$ip]);
    }
    
//////SETTERS
    public function setName($var = null)
    {
       $this->nom = $var;
    }
    public function setPrenom($var = null)
    {
        $this->prenom = $var;
    }
    public function setEmail($var = null)
    {
        $this->email = $var;
    }
    public function setMdp($var = null)
    {
        $this->mdp = $var;
    }
    public function setPhotoProfile($var = null)
    {
        $this->photoProfile = $var;
    }
    public function setIdPermission($var = null)
    {
        $this->idPermission = $var;
    }
    public function setDateMentionAccepte($var = null)
    {
        $this->dateMentionAccepte = $var;
    }
    public function setToken($var = null)
    {
        $this->token = $var;
    }
    public function setActive($var = null)
    {
        $this->active = $var;
    }

    public function setAdresse($var = null)
    {
        $this->adresse = $var;
    }
//// GETTERS
    public function getIdUtilisateur()
    {
        return  $this->idUtilisateur;
    }
    public function getNom()
    {
        return  $this->nom;
    }
    public function getPrenom()
    {
        return  $this->prenom;
    }
    public function getEmail()
    {
        return  $this->email;
    }
    public function getMdp()
    {
        return  $this->mdp;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getToken()
    {
        return  $this->token;
    }
    public function getIdPermission()
    {
        return  $this->idPermission;
    }
    public function getPhotoProfile()
    {
        return  $this->photoProfile;
    }
    public function getdateMentionAccepte()
    {
        return  $this->dateMentionAccepte;
    }
    public function getPanier()
    {
        return  $this->panier;
    }
    public function getCommandes()
    {
        return  $this->commandes;
    }
    public function getCommentaire()
    {
        return  $this->commentaires;
    }
    public function getActive()
    {
        return  $this->active;
    }

}
