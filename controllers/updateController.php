<?php
class UpdateController {
    private $databaseManager;

    public function __construct($dbConnection) {
        $this->databaseManager = new DatabaseManager($dbConnection);
    }

    public function updateArticle($id) {
        $newName = htmlspecialchars($_POST['newName']) ?? '';
        $newContent = htmlspecialchars($_POST['newContent']) ?? '';
        
        if (strlen($newName) > 32 || strlen($newContent) > 1024) {
            $errorMessage = "Article name or content exceeds the character limit.";
            echo ($errorMessage);
        }
        else {
            $this->databaseManager->updateArticle($id, $newName, $newContent);
            $this->databaseManager->updateArticleTimes($id);
            header("Location: /~11418120/cms/articles");
            exit();
        }
    }
}