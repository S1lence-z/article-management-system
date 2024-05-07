<?php
class Article {
    private $id;
    private $name;
    private $content;
    private $creationTime;
    private $lastChangeTime;

    public function __construct(int $id, string $name, string $content, string $created, string $changed) {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
        $this->creationTime = $created;
        $this->lastChangeTime = $changed;
    }

    public function getId() : string {
        return $this->id;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getContent() : string {
        return $this->content;
    }

    public function getCreationTime() : string {
        $stringValue = strval($this->creationTime);
        return $stringValue;
    }

    public function getChangeTime() : string {
        $stringValue = strval($this->lastChangeTime);
        return $stringValue;
    }
}