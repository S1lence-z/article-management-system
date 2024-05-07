<?php
class CreationController {
    private $databaseManager;

    public function __construct($dbConnection) {
        $this->databaseManager = new DatabaseManager($dbConnection);
    }

    public function insertArticle() {
        $articleName = htmlspecialchars($_POST['newName']) ?? '';
        $newId = $this->databaseManager->createArticle($articleName);
        header('Location: /~11418120/cms/article-edit/' . htmlspecialchars($newId));
        exit();
    }
}