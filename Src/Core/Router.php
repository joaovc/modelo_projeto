<?php
namespace Src\Core;
    
class Router
{
    private $projectUrl;
    private $namespace;
    public $routes = [
        'get'=>[],
        'post'=>[]
    ];
    private $group = null;

    public function __construct($projectUrl)
    {
        $this->projectUrl = $projectUrl;
    }
    
    public function namespase($namespace)
    {
        $this->namespace = $namespace;
    }

    public function group($group)
    {
        $this->group = $group;
    }

    private function typeRoute($type, $route, $handler)
    {
        $handler = explode(":",$handler);
        array_push($this->routes[$type],['route' => $this->group?$this->group."/".$route:$route, 'controller' => $handler[0], 'action' => $handler[1]]);
        $this->group = null;
    }

    public function get($route, $handler)
    {
        $this->typeRoute('get', $route, $handler);
    }

    public function post($route, $handler)
    {
        $this->typeRoute('post', $route, $handler);
    }

    public function error()
    {

    }
}
    
