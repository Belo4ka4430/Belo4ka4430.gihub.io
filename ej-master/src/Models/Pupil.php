<?php
/**
 * Created by PhpStorm.
 * User: Reebok
 * Date: 20.04.2020
 * Time: 14:12
 */

namespace Models;

require_once DB;

class Pupil
{
    public static function getPupilsByClassId($id)
    {
        return array_values(\R::find('pupils', 'class_id = ? ORDER BY pupil ASC', array($id)));
    }

    public static function getAllPupils()
    {
        return array_values(\R::findAll('pupils', 'ORDER BY pupil ASC'));
    }

    public static function deleteById($id)
    {
        \R::trash(\R::findOne('pupils', 'id = ?', array($id)));
        \R::trashAll(\R::find('grades', 'pupil_id = ?', array($id)));
    }
}