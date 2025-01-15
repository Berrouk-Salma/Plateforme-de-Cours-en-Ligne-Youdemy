<?php
namespace Youdemy;

use Youdemy\Connection\Database;
use PDO;

class Categorie
{
    private $id;
    private $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function save()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO Categorie (nom) VALUES (:nom)");
        $stmt->bindParam(':nom', $this->nom);

        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return true;
        }

        return false;
    }

    public function update()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("UPDATE Categorie SET nom = :nom WHERE id_categorie = :id");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("DELETE FROM Categorie WHERE id_categorie = :id");
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}

class Tag
{
    private $id;
    private $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function save()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO Tags (nom) VALUES (:nom)");
        $stmt->bindParam(':nom', $this->nom);

        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return true;
        }

        return false;
    }

    public function update()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("UPDATE Tags SET nom = :nom WHERE id_tag = :id");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("DELETE FROM Tags WHERE id_tag = :id");
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}