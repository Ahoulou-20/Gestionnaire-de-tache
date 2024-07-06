<?php
class User
{
    private $users_table = "users";
    private $taches_table = "taches";

    // Données personnelles propres à l'utilisateur
    public $con;
    public $email_user;
    public $nom_user;
    public $mdp_user;
    public $chemin_source;
    public $chemin_destination;
    public $chemin_destinationTrue;

    // Données personnelles des tâches
    public $nom_tache;
    public $description_tache;
    public $date_tache;
    public $heure_tache;
    public $priorite_tache;
    public $statut_tache;

    public function __construct($user_conn)
    {
        $this->con = $user_conn;
    }


    // déterminer le nombre de tâche
    public function getnbTache()
    {
        $query = "SELECT COUNT(nom_tache) AS nbre_tache FROM " . $this->taches_table . " WHERE email_user=:user_email";
        $stmt = $this->con->prepare($query);
        $mail = $this->email_user;
        $stmt->bindParam(':user_email', $mail);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            $_SESSION['nbre_tache'] = $row['nbre_tache'];
            return true;
        } else {
            return false;
        }
    }

    // Avoir tous les utilisateurs
    public function getUser()
    {
        $query = "SELECT email_user FROM " . $this->taches_table;
        $stmt = $this->con->prepare($query);
        $resulat = $stmt->execute();
        return ($resulat);

    }

    public function modifierTaches($idsupr)
    {
        $query = "UPDATE " . $this->taches_table . " SET nom_tache = :nom_tache, description_tache = :description_tache, date_tache = :date_tache, heure_tache=:heure_tache, statut_tache=:statut_tache, priorite_tache=:priorite_tache  WHERE email_user = :email_user AND nom_tache =:old_tache";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':nom_tache', $this->nom_tache);
        $stmt->bindParam(':email_user', $this->email_user);
        $stmt->bindParam(':description_tache', $this->description_tache);
        $stmt->bindParam(':date_tache', $this->date_tache);
        $stmt->bindParam(':heure_tache', $this->heure_tache);
        $stmt->bindParam(':statut_tache', $this->statut_tache);
        $stmt->bindParam(':old_tache', $idsupr);
        $stmt->bindParam(':priorite_tache', $this->priorite_tache);
        $stmt->execute();
        return true;
    }


    public function removeSatut($idStatut, $etat)
    {
        $query = "UPDATE " . $this->taches_table . " SET statut_tache =:_statut_tache WHERE nom_tache = :_nom_tache ";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':_statut_tache', $idStatut);
        $stmt->bindParam(':_nom_tache', $etat);
        return $stmt->execute();
    }
    public function emailTaches()
    {
        $query = "SELECT nom_tache, description_tache, date_tache, heure_tache, statut_tache, email_user FROM " . $this->taches_table . " ORDER BY priorite_tache DESC";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Afficher les tâches ordonnées en fonction des priorités
    public function afficherTaches()
    {
        $query = "SELECT nom_tache, description_tache, date_tache, heure_tache, statut_tache, email_user FROM " . $this->taches_table . " WHERE email_user = :email_user ORDER BY priorite_tache DESC";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':email_user', $this->email_user);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function contenuTache($idsupr)
    {
        $query = "SELECT nom_tache, description_tache, date_tache, heure_tache, statut_tache, email_user FROM " . $this->taches_table . " WHERE email_user = :email_user AND nom_tache=:old_tache";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':email_user', $this->email_user);
        $stmt->bindParam(':old_tache', $idsupr);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function appercuTaches()
    {
        $query = "SELECT nom_tache, description_tache, date_tache, heure_tache, statut_tache, email_user FROM " . $this->taches_table . " WHERE email_user = :email_user ORDER BY priorite_tache DESC LIMIT 3";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':email_user', $this->email_user);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Créer une nouvelle tâche 
    public function creationTaches()
    {

        $query = "INSERT INTO " . $this->taches_table . " (nom_tache, description_tache, date_tache, heure_tache, priorite_tache,email_user) VALUES (:nom_tache, :description_tache, :date_tache, :heure_tache, :priorite_tache,:user_email)";
        $stmt = $this->con->prepare($query);

        $nom_tache_clean = $this->nom_tache;
        $description_tache_clean = $this->description_tache;
        $date_tache_clean = $this->date_tache;
        $heure_tache_clean = $this->heure_tache;
        $priorite_tache_tache = $this->priorite_tache;
        $email = $this->email_user;

        $stmt->bindParam(':nom_tache', $nom_tache_clean);
        $stmt->bindParam(':description_tache', $description_tache_clean);
        $stmt->bindParam(':date_tache', $date_tache_clean);
        $stmt->bindParam(':heure_tache', $heure_tache_clean);
        $stmt->bindParam(':priorite_tache', $priorite_tache_tache);
        $stmt->bindParam(':user_email', $email);

        return $stmt->execute();
    }

    // Suppression de tâche
    public function suppressionTaches($tache_spr)
    {
        $query = "DELETE FROM " . $this->taches_table . " WHERE email_user = :email_user AND nom_tache = :nom_tache";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':email_user', $this->email_user);
        $stmt->bindParam(':nom_tache', $tache_spr);

        if ($stmt->execute()) {
            return true;
        }
        ;
    }

    // Connexion de l'utilisateur
    public function userConnexion()
    {
        $query = "SELECT * FROM " . $this->users_table . " WHERE email_user=:user_email";
        $stmt = $this->con->prepare($query);
        $mail = $this->email_user;
        $pwd = $this->mdp_user;
        $stmt->bindParam(':user_email', $mail);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $pwd_hash = $row['mdp_user'];
        if ($row && password_verify($pwd, $pwd_hash)) {
            $pwd_hash = $row['mdp_user'];
            session_start();
            $_SESSION['user_email'] = $row['email_user'];
            $_SESSION['nom_user'] = $row['nom_user'];
            $_SESSION['photo_user'] = $row['photo_user'];
            return true;
        }
        return false;
    }

    // Inscription utilisateur
    public function inscriptionUser()
    {
        $query = 'SELECT * FROM ' . $this->users_table . ' WHERE email_user = :email_user';
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':email_user', $this->email_user);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            $query2 = "INSERT INTO " . $this->users_table . ' (email_user, nom_user, mdp_user, photo_user) VALUES (:email_user, :nom_user, :mdp_user, :photo_user)';
            $stmt2 = $this->con->prepare($query2);

            // Déplacement du fichier uploadé vers le dossier de destination
            move_uploaded_file($this->chemin_source, $this->chemin_destination);

            $email_user_clean = $this->email_user;
            $nom_user_clean = $this->nom_user;
            $mdp_user_hashed = password_hash($this->mdp_user, PASSWORD_DEFAULT);
            $photo_user_clean = $this->chemin_destinationTrue;

            $stmt2->bindParam(':email_user', $email_user_clean);
            $stmt2->bindParam(':nom_user', $nom_user_clean);
            $stmt2->bindParam(':mdp_user', $mdp_user_hashed);
            $stmt2->bindParam(':photo_user', $photo_user_clean);
            $stmt2->execute();
            return true;
        }
        return false;
    }

    public function deconnexionUser()
    {
        // Vérifiez si une session est active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['nom_user'])) {
            // Supprime toutes les variables de session
            $_SESSION = array();
            // Détruisez la session
            session_destroy();
            return true;
        }

        return false;
    }

}
