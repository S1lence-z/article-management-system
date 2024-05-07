<?php
class DeletionController {
    private $databaseManager;

    public function __construct($dbConnection) {
        $this->databaseManager = new DatabaseManager($dbConnection);
    }

    public function deleteArticle($id) {
        $this->databaseManager->deleteArticle($id);
        exit();
    }
}