<?php
namespace Youdemy;

use Youdemy\Connection\Database;
use PDO;

class Etudiant extends Utilisateur
{
    public function inscriptionCours($coursId)
    {
        // Implement logic to enroll a student in a course
        $inscription = new Inscription($this->getId(), $coursId, date('Y-m-d'));
        return $inscription->save();
    }

    public function getMesCours()
    {
        // Implement logic to get the student's enrolled courses
        $inscription = new Inscription();
        return $inscription->getCoursForStudent($this->getId());
    }

    public function getNotesForCours($coursId)
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT notes 
                               FROM Inscription 
                               WHERE etudiant_id = :etudiant_id AND cours_id = :cours_id");
        $stmt->bindParam(':etudiant_id', $this->getId());
        $stmt->bindParam(':cours_id', $coursId);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['notes'] ?? null;
    }

    public function updateNotes($coursId, $notes)
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("UPDATE Inscription 
                               SET notes = :notes
                               WHERE etudiant_id = :etudiant_id AND cours_id = :cours_id");
        $stmt->bindParam(':notes', $notes);
        $stmt->bindParam(':etudiant_id', $this->getId());
        $stmt->bindParam(':cours_id', $coursId);

        return $stmt->execute();
    }
}