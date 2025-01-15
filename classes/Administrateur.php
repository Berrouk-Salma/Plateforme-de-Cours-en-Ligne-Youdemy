<?php
namespace Youdemy;

class Administrateur extends Utilisateur
{
    public function validateTeacherAccount($enseignant)
    {
        // Implement logic to validate a teacher's account
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("UPDATE Utilisateur SET role = 'Enseignant' WHERE id_utilisateur = :id");
        $stmt->bindParam(':id', $enseignant->getId());
        return $stmt->execute();
    }

    public function suspendUser($utilisateur)
    {
        // Implement logic to suspend a user's account
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("UPDATE Utilisateur SET role = 'Suspendu' WHERE id_utilisateur = :id");
        $stmt->bindParam(':id', $utilisateur->getId());
        return $stmt->execute();
    }
}

class Enseignant extends Utilisateur
{
    public function ajouterCours($titre, $description, $contenu, $categorieId)
    {
        // Implement logic to add a new course
        $cours = new Cours($titre, $description, $contenu, $categorieId, $this->getId());
        return $cours->save();
    }

    public function modifierCours($coursId, $titre, $description, $contenu, $categorieId)
    {
        // Implement logic to modify an existing course
        $cours = new Cours($titre, $description, $contenu, $categorieId, $this->getId());
        $cours->setId($coursId);
        return $cours->update();
    }

    public function supprimerCours($coursId)
    {
        // Implement logic to delete a course
        $cours = new Cours();
        $cours->setId($coursId);
        return $cours->delete();
    }
}

class Etudiant extends Utilisateur
{
    public function inscriptionCours($coursId)
    {
        // Implement logic to enroll in a course
        $inscription = new Inscription($this->getId(), $coursId, date('Y-m-d'));
        return $inscription->save();
    }

    public function getMesCours()
    {
        // Implement logic to get the student's enrolled courses
        $inscription = new Inscription();
        return $inscription->getCoursForStudent($this->getId());
    }
}