<?php

namespace App\Router;

use App\Exceptions\RouteNotFoundException;

class Router
{
    const ACCEPTED_REQUEST_METHOD = ["GET", "POST", "PUT", "PATCH", "DELETE"];
    private array $routes = [];
    private $requestMethod = "";

    public function get(string $route, callable | array $action): self
    {
        $this->register('GET', $route, $action);

        return $this;
    }

    public function post(string $route, callable | array $action): self
    {
        $this->register('POST', $route, $action);

        return $this;
    }

    public function put(string $route, callable | array $action): self
    {
        $this->register("PUT", $route, $action);

        return $this;
    }

    public function patch(string $route, array $action): self
    {
        $this->register("PATCH", $route, $action);

        return $this;
    }

    public function delete(string $route, callable | array $action): self
    {
        $this->register("DELETE", $route, $action);

        return $this;
    }

    public function resolve(string $requestUri)
    {
        $requestMethod = $this->setRequestMethod();
        $route = explode('?', $requestUri)[0];
        $pathFragments = explode('/', $route);
        $id = array_values(array_filter($pathFragments, fn ($i) => intval($i) ? (int) $i : false))[0] ?? null;
        $action = $this->routes[$requestMethod][$route] ?? null;

        if ($action) return $this->doAction($action);

        $wildCardRoute = str_replace($id, "{id}", $route);

        if (!$id || !isset($this->routes[$requestMethod][$wildCardRoute])) return notFound();

        $action = $this->routes[$requestMethod][$wildCardRoute];

        return $this->doAction($action,  $id);
    }

    private function doAction($action, $id = null)
    {
        [$targetClass, $method] = $action;
        $targetClass = new $targetClass();

        if (method_exists($targetClass, $method)) {
            if (!empty($_REQUEST)) {
                $requestClass = $this->getMethodRequestClass($targetClass, $method);
                if ($requestClass) {
                    if ($id) return $targetClass->$method(new $requestClass($_REQUEST), $id);

                    return $targetClass->$method(new $requestClass($_REQUEST));
                } else {
                    return $targetClass->$method($_REQUEST);
                }
            } else {
                if ($id) return $targetClass->$method($id);

                return $targetClass->$method();
            }
        }

        throw new RouteNotFoundException();
        exit;
    }

    private function getMethodRequestClass($class, $method)
    {
        $rm = new \ReflectionMethod($class, $method);

        return $rm->getParameters()[0]->getType() ? $rm->getParameters()[0]->getType()->getName() : null;
    }

    private function register(string $requestMethod, string $route, callable | array $action): void
    {
        $this->routes[$requestMethod][$route] = $action;
    }

    private function setRequestMethod(): string
    {
        if (!isset($_REQUEST['_method'])) {
            $this->requestMethod = $_SERVER["REQUEST_METHOD"];

            return $this->requestMethod;
        }

        if (is_string($_REQUEST['_method']) && in_array(strtoupper($_REQUEST['_method']), self::ACCEPTED_REQUEST_METHOD)) {
            $this->requestMethod = strtoupper($_REQUEST['_method']);
            unset($_REQUEST['_method']);

            return $this->requestMethod;
        }

        throw new \Exception("Request method must be one of these types " . implode(", ", self::ACCEPTED_REQUEST_METHOD));
        exit;
    }
}
