<?php
class CategorieControleur extends Controleur
{

    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        if(!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/index');
        }
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée
     */
    public function index($params)
    {
        // Par défaut on affiche les catégories
        $this->gabarit->affecterActionParDefaut('tout');
        $this->tout($params);
    }

    /* Exercice #3 - Question 3 */
    /**
     * Affiche les catégories
     */
    public function tout($params)
    {
        $this->gabarit->affecter('categories', $this->modele->tout());
    }

    /* Exercice #3 - Question 4 */
    /**
     * Ajoute une catégorie et réaffiche les catégories
     */
    public function ajouter()
    {
        $this->modele->ajouter($_POST);
        Utilitaire::nouvelleRoute('categorie/tout');
    }

    /**
     * Supprime une catégorie et réaffiche les catégories
     */
    public function retirer()
    {
        Utilitaire::nouvelleRoute('categorie/tout');
    }

    /**
     * Modifie une catégorie et réaffiche les catégories
     */
    public function changer()
    {
        Utilitaire::nouvelleRoute('categorie/tout');
    }
    
}
