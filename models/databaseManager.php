<?php
require_once('./article.php');
// A class to get the db connection
class DatabaseManager {
    private $connection = null;
    private $databaseQueries = [
        'selectAllArticles' => 'SELECT * FROM articles',
        'selectArticleById' => 'SELECT * FROM articles WHERE id = ?',
        'updateArticle' => 'UPDATE articles SET name = ?, content = ? WHERE id = ?',
        'deleteArticle' => 'DELETE FROM articles WHERE id = ?',
        'insertArticle' => "INSERT INTO articles (name, content) VALUES (?, '')",
        'updateLastChangeTime' => 'UPDATE articles SET last_change_time = ? WHERE articles.id = ?'
    ];

    public function __construct(mysqli $connection) {
        $this->connection = $connection;
    }

    public function getAllArticles() : array {
        try {
            $allArticles = [];
            if ($result = $this->connection->query($this->databaseQueries['selectAllArticles'])) {
                while ($row = $result->fetch_assoc()) {
                    $allArticles[] = $this->createArticleInstance($row['id'], $row['name'], $row['content'], $row['creation_time'], $row['last_change_time']);
                }
            }
            return $allArticles;
        }
        catch (Exception $e) {
            echo 'Database error: ' . $e->getMessage();
            return [];
        }
    }

    public function getSpecificArticle($id) : Article {
        try {
            $stmt = $this->connection->prepare($this->databaseQueries['selectArticleById']);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $articleData = $result->fetch_assoc();
            $stmt->close();
            if (is_null($articleData)) {
                exitWithResponseCode(404, 'Not Found');
            }
            $finalArticle = $this->createArticleInstance($articleData['id'], $articleData['name'], $articleData['content'], $articleData['creation_time'], $articleData['last_change_time']);
            return $finalArticle;
        }
        catch (Exception $e) {
            echo 'Database error: ' . $e->getMessage();
            return $this->createArticleInstance(0, 'Nonexistent', 'Nonexistent', 'Nonexistent', 'Nonexistent');
        }
    }
    
    public function updateArticle($id, string $name, string $content) {
        try {
            $newName = $name;
            $newContent = $content;
            $stmt = $this->connection->prepare($this->databaseQueries['updateArticle']);
            $stmt->bind_param('ssi', $newName, $newContent, $id);
            $resultStatus = $stmt->execute();
            $stmt->close();
            if (!$resultStatus) {
                echo 'Error when updating the article: ' . $stmt->error;
                exit();
            }
            echo 'Article updated successfully.';
        }
        catch (Exception $e) {
            echo 'Database error: ' . $e->getMessage();
            return null;
        }
    }

    public function updateArticleTimes(int $id) {
        try {
            $currentTimeStamp = $this->getCurrentTimeStamp();
            $stmt = $this->connection->prepare($this->databaseQueries['updateLastChangeTime']);
            $stmt->bind_param('si', $currentTimeStamp, $id);
            $resultStatus = $stmt->execute();
            $stmt->close();
            if (!$resultStatus) {
                echo 'Error when updating the timestamp: ' . $stmt->error;
                exit();
            }
            echo 'Timestamp updated successfully.';
        }
        catch (Exception $e) {
            echo 'Database error: ' . $e->getMessage();
            return null;
        }
    }
    
    public function deleteArticle($id) {
        try {
            $stmt = $this->connection->prepare($this->databaseQueries['deleteArticle']);
            $stmt->bind_param('i', $id);
            $resultStatus = $stmt->execute();
            $stmt->close();
            if (!$resultStatus) {
                echo 'Error when deleting the article.';
                exit();
            }
            echo 'Article deleted successfully.';
        }
        catch (Exception $e) {
            echo 'Database error: ' . $e->getMessage();
            return null;
        }
    }
    
    public function createArticle(string $newName) : ?int {
        try {
            $stmt = $this->connection->prepare($this->databaseQueries['insertArticle']);
            $stmt->bind_param('s', $newName);
            $resultStatus = $stmt->execute();
            $newId = $this->connection->insert_id;
            $stmt->close();
            if (!$resultStatus) {
                echo 'Error when adding the article.';
                exit();
            }
            echo 'Article created successfully.';
            return $newId;
        }
        catch (Exception $e) {
            echo 'Database error: ' . $e->getMessage();
            return null;
        }
    }

    // Static methods
    private static function createArticleInstance(int $id, string $name, string $content, string $created, string $changed) : Article {
        return new Article($id, $name, $content, $created, $changed);
    }

    private static function getCurrentTimeStamp() {
        date_default_timezone_set('Europe/Prague');
        $timestamp = time();
        $formattedDate = date('Y-m-d H:i:s', $timestamp);
        return $formattedDate;
    }
}