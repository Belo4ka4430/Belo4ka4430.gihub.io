<?php
/**
 * Created by PhpStorm.
 * User: Reebok
 * Date: 20.04.2020
 * Time: 13:54
 */

namespace Models;

require_once DB;

class Discipline
{
    public static function getAllDisciplines()
    {
        return array_values(\R::find('disciplines'));
    }

    public static function getDisciplinesByClassId($id)
    {
        return array_values(\R::find('disciplines', 'class_id = ?', array($id)));
    }

    public static function deleteById($id)
    {
        \R::trash(\R::findOne('disciplines', 'id = ?', array($id)));
    }
}