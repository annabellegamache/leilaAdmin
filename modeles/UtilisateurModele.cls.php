<?php
class UtilisateurModele extends AccesBd
{
    public function un($courriel)
    {
        return $this->lireUn("SELECT * FROM utilisateur 
                                WHERE uti_courriel=:courriel"
                        , ['courriel'=>$courriel]);
    }
}