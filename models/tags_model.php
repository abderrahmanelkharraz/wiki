<?php

class Tags {

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createTags($name)
    {

        $stmt = $this->db->prepare("INSERT INTO tags (name) VALUES (:name)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function updateTags($id, $name)
    {

        $stmt = $this->db->prepare("UPDATE tags SET name = :name WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deleteTags($id)
    {

        $stmt = $this->db->prepare("DELETE FROM tags WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getAllTags()
    {

        $stmt = $this->db->prepare("SELECT * FROM tags");
        $stmt->execute();

        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }

}

?>