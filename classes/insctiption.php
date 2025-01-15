<?php
namespace Youdemy;

use Youdemy\Connection\Database;
use PDO;

class Inscription
{
    private $etudiantId;
    private $coursId;
    private $dateInscription;

    public function __construct($etudiantId, $coursId, $dateInscription)
    {
        $this->etudiantId = $etudiantId;
        $this->coursId = $coursId;
        $this->dateInscription = $dateInscription;
    }

    public function getEtudiantId()
    {
        return $this->etudiantId;
    }

    public function getCoursId()
    {
        return $this->coursId;
    }

    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    public function save()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO Inscription (etudiant_id, cours_id, DateInscription) VALUES (:etudiant_id, :cours_id, :date_inscription)");
        $stmt->bindParam(':etudiant_id', $this->etudiantId);
        $stmt->bindParam(':cours_id', $this->coursId);
        $stmt->bindParam(':date_inscription', $this->dateInscription);

        return $stmt->execute();
    }

    public function getCoursForStudent($etudiantId)
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT Cours.* 
                               FROM Inscription 
                               INNER JOIN Cours ON Inscription.cours_id = Cours.id_cours
                               WHERE Inscription.etudiant_id = :etudiant_id");
        $stmt->bindParam(':etudiant_id', $etudiantId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}