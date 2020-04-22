<?php
/**
 * Created by PhpStorm.
 * User: Reebok
 * Date: 20.04.2020
 * Time: 14:12
 */

namespace Models;

require_once DB;

class Grade
{
    public static function getGrades($class_id, $discipline_id, $add_date)
    {
        return array_values(\R::find('grades', 'class_id = ? AND discipline_id = ? AND add_date = ?',
            array($class_id, $discipline_id, $add_date)));
    }

    public static function getGrade($class_id, $discipline_id, $pupil_id, $add_date)
    {
        return \R::findOne('grades', 'class_id = ? AND discipline_id = ? AND pupil_id = ? AND add_date = ?',
            array($class_id, $discipline_id, $pupil_id, $add_date));
    }
}