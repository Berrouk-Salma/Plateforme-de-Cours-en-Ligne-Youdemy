<?php
namespace Youdemy;

use Youdemy\Connection\Database;
use PDO;

class Cours
{
    private $id;
    private $title;
    private $description;
    private $contenu;
    private $categorieId;
    private $enseignantId;

    public function __construct($title, $description, $contenu, $categorieId, $enseignantId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->contenu = $contenu;
        $this->categorieId = $categorieId;
        $this->enseignantId = $enseignantId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getCategorieId()
    {
        return $this->categorieId;
    }

    public function setCategorieId($categorieId)
    {
        $this->categorieId = $categorieId;
    }

    public function getEnseignantId()
    {
        return $this->enseignantId;
    }

    public function setEnseignantId($enseignantId)
    {
        $this->enseignantId = $enseignantId;
    }

    public function save()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO Cours (title, description, contenu, categorie_id, enseignant_id) VALUES (:title, :description, :contenu, :categorie_id, :enseignant_id)");
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':contenu', $this->contenu);
        $stmt->bindParam(':categorie_id', $this->categorieId);
        $stmt->bindParam(':enseignant_id', $this->enseignantId);

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

        $stmt = $conn->prepare("UPDATE Cours SET title = :title, description = :description, contenu = :contenu, categorie_id = :categorie_id WHERE id_cours = :id");
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':contenu', $this->contenu);
        $stmt->bindParam(':categorie_id', $this->categorieId);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("DELETE FROM Cours WHERE id_cours = :id");
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}