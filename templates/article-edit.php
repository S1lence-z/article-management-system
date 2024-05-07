<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/~11418120/cms/styles/style.css">
    <title>Edit Article</title>
</head>
<body>
    <div id="center">
        <div class="article-card">
            <h1>Edit article</h1>
            <form action=<?= "/~11418120/cms/article-update/" . htmlspecialchars($articleToEdit->getId()) ?> method="post">
                <div id="edit-article-name">
                    <h2>Article name</h2>
                    <input type="text" name="newName" placeholder="Name" value="<?= htmlspecialchars($articleToEdit->getName()) ?>" maxlength="32" required></input>
                </div>
                <div id="edit-article-content">
                    <h2>Article content</h2>
                    <textarea name="newContent" placeholder="Content" maxlength="1024"><?= htmlspecialchars($articleToEdit->getContent()) ?></textarea>
                </div>
                <div class="show-button-list">
                    <button type="submit" id="save-button">Save</button>
                    <a class="link-button-blue" href="/~11418120/cms/articles">Back to articles</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>