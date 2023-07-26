<?php

namespace App\Router;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

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
        $route = explode('?', $requestUri)[0];
        $pathFragments = explode('/', $route);
        $id = array_values(array_filter($pathFragments, fn ($i) => intval($i) ? (int) $i : false))[0] ?? null;
        $action = $this->routes[$_SERVER['REQUEST_METHOD']][$route] ?? null;

        if ($action) {
            return $this->doAction($action, $id);
        } else {
            if (!$id) return notFound();

            $wildCardRoute = str_replace($id, "{id}", $route);

            if (!isset($this->routes[$_SERVER['REQUEST_METHOD']][$wildCardRoute])) return notFound();

            $action = $this->routes[$_SERVER['REQUEST_METHOD']][$wildCardRoute];
        }

        return $this->doAction($action, $id);
    }

    private function doAction($action, $id = null)
    {
        [$class, $method] = $action;
        $class = new $class();

        if (method_exists($class, $method)) {
            if (!empty($_REQUEST)) {
                $requestClass = $this->getMethodRequestClass($class, $method);
                if ($requestClass) {
                    if ($id) return $class->$method(new $requestClass($_REQUEST), $id);

                    return $class->$method(new $requestClass($_REQUEST));
                } else {
                    return $class->$method($_REQUEST);
                }
            } else {
                if ($id) return $class->$method($id);

                return $class->$method();
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
}
