<?php
class UtilisateurControleur extends Controleur
{

    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        // S'il y a un utilisateur connecté, diriger vers categorie/tout (ou categorie)
        if(isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('categorie');
        }
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée
     */
    public function index($params)
    {
        // Il n'y a rien à faire ici pour le moment.
    }

    /**
     * Tente l'ouvertir d'une connexion : si réussi, redirige vers categorie/tout 
     * et sinon, réaffiche le formulaire de connexion avec un message d'erreur.
     */
    public function connexion()
    {
        $erreur = false;
        $courriel = $_POST['uti_courriel'];
        $mdp = $_POST['uti_mdp'];
        $utilisateur = $this->modele->un($courriel);
        if(!$utilisateur || !password_verify($mdp, $utilisateur->uti_mdp)) {
            $erreur = "Mauvaise combinaison courriel/mot de passe";
        }
        else if($utilisateur->uti_confirmation !== '') {
            $erreur = "Ce compte n'est pas encore confirmé : vérifiez le message de confirmation dans vos courriels";
        }
        else if($utilisateur->uti_actif == 0) {
            $erreur = "Ce compte n'a pas encore été activé : demandez à votre administrateur";
        }

        if(!$erreur) {
            $_SESSION['utilisateur'] = $utilisateur;
            Utilitaire::nouvelleRoute("categorie/tout");
        }
        else {
            $this->gabarit->affecter('erreur', $erreur);
            $this->gabarit->affecterActionParDefaut('index');
            $this->index([]);
        }
    }

    /**
     * Déconnecte l'utilisateur connecté et redirige vers la page d'accueil 
     * (formulaire de connexion)
     */
    public function deconnexion()
    {
        unset($_SESSION['utilisateur']);
        Utilitaire::nouvelleRoute("utilisateur/index");
    }
}
