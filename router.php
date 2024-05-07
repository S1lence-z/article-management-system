<?php
// This is the main class which takes care of routing and processing requests
require_once("./controllers/showController.php");
require_once("./controllers/editationController.php");
require_once("./controllers/updateController.php");
require_once("./controllers/deletionController.php");
require_once("./controllers/creationController.php");
class Router {
    private $routes = [];
    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function route($urlPath, $controllerAndMethodToCall) {
        $this->routes[$urlPath] = $controllerAndMethodToCall;
    }

    public function dispatch($userRequestedUrl) {
        $desiredRoute = $this->matchRoute($userRequestedUrl);
        if ($desiredRoute) {
            [$controllerName, $methodName, $id] = $desiredRoute;
            // Use the reflection class to pass on the args to the constructor
            $reflector = new ReflectionClass($controllerName);
            $controller = $reflector->newInstanceArgs([$this->dbConnection]);
            // Call the user function depending on whether it takes an arg or not
            switch ($methodName) {
                case 'index':
                case 'listArticles':
                case 'insertArticle':
                    call_user_func([$controller, $methodName]);
                    break;

                case 'deleteArticle':
                case 'editArticle':
                case 'showArticle':
                case 'updateArticle':
                    call_user_func_array([$controller, $methodName], [$id]);
                    break;
            }
        }
    }

    private function matchRoute($url) {
        $splitUrl = explode('/', $url, 2);
        $routeUrl = isset($splitUrl[0]) ? $splitUrl[0] : '';
        $specifiedId = isset($splitUrl[1]) ? $splitUrl[1] : '';
        foreach ($this->routes as $requestedRoute => $action) {
            if ($routeUrl == $requestedRoute) {
                [$className, $methodName] = explode('@', $action);
                return [$className, $methodName, $specifiedId];
            }
        }
        require_once('./helperFunctions.php');
        exitWithResponseCode(404, 'Not Found');
    }
}