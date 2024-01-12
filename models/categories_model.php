<?php

class Categories {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createCategory($name)
    {

        $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function updateCategory($id, $name)
    {

        $stmt = $this->db->prepare("UPDATE categories SET name = :name WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteCategory($id)
    {

        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getAllCategories()
    {

        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }

}

?>