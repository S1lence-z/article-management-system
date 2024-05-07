<?php
// This function will return the desired response code and echo a custom message
function exitWithResponseCode(int $responseCode, string $message):void {
    http_response_code($responseCode);
    echo($responseCode . '<br>');
    echo($message . '<br>');
    exit();
}

// This function retrieves the URI and extracts the desired part
function getValidRoute($url) : string {
    $validPartOfUrl = explode('/cms/', $url, 2)[1];
    $desiredPath = isset($validPartOfUrl) ? $validPartOfUrl : '';
    $desiredPath = explode('?', $desiredPath, 2)[0]; // Delete query params
    return $desiredPath;
}