<?php
class CategorieModele extends AccesBd
{
    /* Exercice #3 - Question 3 */
    /**
     * Récupère tous les enregistrements 'categorie' de la BD
     */
    public function tout()
    {
        return $this->lireTout("SELECT * FROM categorie ORDER BY cat_id ASC");
    }

    /* Exercice #3 - Question 4 */
    /**
     * Ajoute une catégorie dans la table 'categorie'
     */
    public function ajouter($categorie)
    {
        extract($categorie);
        $this->creer("INSERT INTO categorie VALUES (0, ?, ?)", [$cat_nom, $cat_type]);
    }

}