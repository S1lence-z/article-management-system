<?php
require_once('./models/databaseManager.php');
require_once('./views/editationView.php');

class EditationController {
    private $databaseManager;
    private $editationView;

    public function __construct($dbConnection) {
        $this->databaseManager = new DatabaseManager($dbConnection);
        $this->editationView = new EditationView();
    }

    public function editArticle($id) {
        $specificArticle = $this->databaseManager->getSpecificArticle($id);
        $this->editationView->displayEditArticle($specificArticle);
    }
}