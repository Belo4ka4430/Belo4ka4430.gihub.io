<?php
/**
 * Created by PhpStorm.
 * Users: Reebok
 * Date: 20.04.2020
 * Time: 8:02
 */

namespace System;


class App
{
    public static function run()
    {
        $path = $_SERVER['REQUEST_URI'];
        $pathParts = explode('/', $path);
        if (empty($pathParts[2]))
        {
            App::redirect('home', 'index');
        } else if (empty($pathParts[3]))
        {
            $controller = $pathParts[2];
            App::redirect($controller, 'index');
        } else
        {
            $controller = $pathParts[2];
            $action = explode('?', $pathParts[3])[0];

            $controller = 'Controllers\\' . ucfirst($controller) . 'Controller';
            $action = $action;

            if (!class_exists($controller))
            {
                throw new \ErrorException('Controller does not exist');
            }

            $objController = new $controller;

            if (!method_exists($objController, $action))
            {
                throw new \ErrorException('Action does not exist');
            }

            $objController->$action();
        }
    }

    public static function redirect($controller, $action, $query = '')
    {
        header('Location: ' . BASE_URL . $controller . '/' . $action . '?' . $query);
    }

    public static function out_redirect($to)
    {
        header('Location: ' . $to);
    }
}