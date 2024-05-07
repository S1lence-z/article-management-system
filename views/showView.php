<?php
class ShowView {
    public function displayArticlesList($allArticles) {
        include('./templates/articles.php');
    }

    public function displayArticle($articleToDisplay) {
        include('./templates/article-show.php');
    }
}