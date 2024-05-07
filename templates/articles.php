<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/~11418120/cms/styles/style.css">
    <title>Article List</title>
</head>
<body>
    <div class="center">
        <h1>Article list</h1>
        <ul id="article-list">
            <?php foreach ($allArticles as $article) {
                echo ('<li id="article-' . htmlspecialchars($article->getId()) . '">'
                . htmlspecialchars($article->getName())
                . '<div id="time-stamps-container">'
                . '<p id="creation-time" data-creation="' . htmlspecialchars($article->getCreationTime()) . '">Created: '. htmlspecialchars($article->getCreationTime()) . '</p>'
                . '<p id="change-time" data-change="' . htmlspecialchars($article->getChangeTime()) . '">Changed: ' . htmlspecialchars($article->getChangeTime()) . '</p>'
                . '</div>'
                . '<div class="article-options">'
                . '<a class="link-button-blue" href="/~11418120/cms/article/' . htmlspecialchars($article->getId()) . '">Show</a>'
                . '<a class="link-button-blue" href="/~11418120/cms/article-edit/' . htmlspecialchars($article->getId()) . '">Edit</a>'
                . '<button class="link-button-red" name="delete-article-button" article-id="' . htmlspecialchars($article->getId()) . '">Delete</button>'
                . '</div>'
                . '</li>');
            }?>
        </ul>
        <div class="article-buttons-list">
            <div id="pagination">
                <button type="button" id="previous-button">Previous</button>
                <button type="button" id="next-button">Next</button>
                <label id="pageCount"></label>
            </div>
            <button type="button" id="create-article-button">
                Create Article
            </button>
        </div>
        <div id="create-article-window" class="hidden">
            <div class="create-article-card">
                <form action="/~11418120/cms/article-insert/" method="post">
                    <div>
                        <h2>Create New Article</h2>
                        <input type="text" id="new-name-input" name="newName" value="" placeholder="Name" maxlength="32" required>
                    </div>
                    <div class="create-article-button-list">
                        <button type="submit" id="save-button">Create</button>
                        <button type="button" id="cancel-button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/~11418120/cms/scripts/showElapsedTime.js"></script>
    <script src="/~11418120/cms/scripts/articleCreation.js"></script>
    <script src="/~11418120/cms/scripts/articleDeletion.js"></script>
    <script src="/~11418120/cms/scripts/pageCount.js"></script>
    <script src="/~11418120/cms/scripts/pagingButtons.js"></script>
    <script src="/~11418120/cms/scripts/displayItemsPerPage.js"></script>
</body>
</html>