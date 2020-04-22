<?php
/**
 * Created by PhpStorm.
 * Users: Reebok
 * Date: 20.04.2020
 * Time: 8:56
 */

namespace Views;


class View
{
    public static function render($template, $data = [])
    {
        $fullPath = __DIR__ . '/Templates/' . CONTROLLER . '/' . $template . '.php';

        if (!file_exists($fullPath))
        {
            throw new \ErrorException('View cannot be found');
        }

        if (!empty($data))
        {
            foreach ($data as $key => $value)
            {
                $$key = $value;
            }
        }

        include($fullPath);
    }
}