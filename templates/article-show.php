<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/~11418120/cms/styles/style.css">
    <title>Show Article</title>
</head>
<body>
    <div id="center">
        <div class="article-card">
            <div id="time-stamps-container">
                <p id="creation-time" data-creation="<?=htmlspecialchars($articleToDisplay->getCreationTime())?>">Created: <?=htmlspecialchars($articleToDisplay->getCreationTime()) ?></p>
                <p id="change-time" data-change="<?=htmlspecialchars($articleToDisplay->getChangeTime())?>">Changed: <?= htmlspecialchars($articleToDisplay->getChangeTime()) ?></p>
            </div>
            <div class="article-text">
                <h1><?= htmlspecialchars($articleToDisplay->getName()) ?></h1>
                <p><?= htmlspecialchars($articleToDisplay->getContent()) ?></p>
            </div>
        </div>
        <div class="show-button-list">
            <a class="link-button-blue" href="/~11418120/cms/article-edit/<?= htmlspecialchars($articleToDisplay->getId()) ?>">Edit</a>
            <a class="link-button-blue" href="/~11418120/cms/articles">Back to articles</a>
        </div>
    </div>
    <script src="/~11418120/cms/scripts/showElapsedTime.js"></script>
</body>
</html>