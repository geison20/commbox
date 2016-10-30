<?php

namespace App\Core\Routes;

use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| Sistema de rotas.
|--------------------------------------------------------------------------
*/

class RouteSystem
{

    /*
    |--------------------------------------------------------------------------
    | Array com rotas.
    |--------------------------------------------------------------------------
    */
    private $route = array();

    /*
    |--------------------------------------------------------------------------
    | recebe o request do user.
    |--------------------------------------------------------------------------
    */
    private $request;

    /*
    |--------------------------------------------------------------------------
    | armazena o controller da aplicacao.
    |--------------------------------------------------------------------------
    */
    private $controller;

    /*
    |--------------------------------------------------------------------------
    | aponta para a action do controller.
    |--------------------------------------------------------------------------
    */
    private $action;

    /*
    |--------------------------------------------------------------------------
    | aponta para o namespace do controller.
    |--------------------------------------------------------------------------
    */
    private $namespace;


    /*
    |--------------------------------------------------------------------------
    | resgata a request .
    |--------------------------------------------------------------------------
    */

    private function request() : String
    {
      $this->request  = Request::createFromGlobals();
      return $this->request->getPathInfo();
    }

    /*
    |--------------------------------------------------------------------------
    | Adiciona Rotas e adiciona ao array.
    |--------------------------------------------------------------------------
    */

    public function addRoute(String $path, $callback)
    {
      $this->route[$path] = $callback->bindTo($this, __CLASS__);
    }

    /*
    |--------------------------------------------------------------------------
    | redireciona para o controller correto.
    |--------------------------------------------------------------------------
    */

    public function redirect()
    {
      $class = $this->namespace.ucfirst($this->controller);
      $action = $this->action;
      $controller = new $class();
      $controller->$action();
    }


    /*
    |--------------------------------------------------------------------------
    | onde a magica ocorre, verifico se o path do metodo addRoute() é igual a request do usuário.
    |--------------------------------------------------------------------------
    */
    public function run()
    {
        array_walk($this->route, function ($callback, $path)
        {
            if ($path == $this->request())
            {
              $callback();

              $this->redirect();
            }
        });
    }

}
