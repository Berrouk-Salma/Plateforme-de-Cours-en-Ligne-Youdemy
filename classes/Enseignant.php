<?php
namespace Youdemy;

class Enseignant extends Utilisateur
{
    public function ajouterCours($titre, $description, $contenu, $categorieId)
    {
        
        $cours = new Cours($titre, $description, $contenu, $categorieId, $this->getId());
        return $cours->save();
    }

    public function modifierCours($coursId, $titre, $description, $contenu, $categorieId)
    {
   
        $cours = new Cours($titre, $description, $contenu, $categorieId, $this->getId());
        $cours->setId($coursId);
        return $cours->update();
    }

    public function supprimerCours($coursId)
    {
    
        $cours = new Cours();
        $cours->setId($coursId);
        return $cours->delete();
    }
}