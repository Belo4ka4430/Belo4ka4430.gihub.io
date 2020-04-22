<?php
/**
 * Created by PhpStorm.
 * User: Reebok
 * Date: 20.04.2020
 * Time: 13:39
 */

namespace Models;

require_once DB;

class Classroom
{
    public static function getAllClasses()
    {
        return array_values(\R::find('classes'));
    }

    public static function deleteById($id)
    {
        \R::trash(\R::findOne('classes', 'id = ?', array($id)));
    }
}