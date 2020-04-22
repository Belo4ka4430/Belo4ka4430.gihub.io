<?php
/**
 * Created by PhpStorm.
 * Users: Reebok
 * Date: 20.04.2020
 * Time: 9:28
 */

namespace Models;

require_once DB;

class User
{
    public static function getUserByName($name)
    {
        return \R::findOne('users', 'name = ?', array($name));
    }

    public static function getUserById($id)
    {
        return \R::findOne('users', 'id = ?', array($id));
    }

    public static function getUsersByType($type)
    {
        return array_values(\R::find('users', 'type = ?', array($type)));
    }

    public static function deleteById($id)
    {
        \R::trash(\R::findOne('users', 'id = ?', array($id)));
    }
}