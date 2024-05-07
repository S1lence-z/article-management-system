<?php
require_once('./models/databaseManager.php');
require_once('./views/showView.php');
class ShowController {
    private $databaseManager;
    private $showView;

    public function __construct($dbConnection) {
        $this->databaseManager = new DatabaseManager($dbConnection);
        $this->showView = new ShowView();
    }

    public function index() {
        header("Location: https://webik.ms.mff.cuni.cz/~11418120/cms/articles", true);
        exit();
    }

    public function listArticles() {
        $allArticles = $this->databaseManager->getAllArticles();
        $this->showView->displayArticlesList($allArticles);
    }

    public function showArticle($id) {
        $specificArticle = $this->databaseManager->getSpecificArticle($id);
        $this->showView->displayArticle($specificArticle);
    }
}