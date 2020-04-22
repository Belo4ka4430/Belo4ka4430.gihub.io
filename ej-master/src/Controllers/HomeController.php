<?php
/**
 * Created by PhpStorm.
 * Users: Reebok
 * Date: 20.04.2020
 * Time: 8:27
 */

namespace Controllers;


use Models\Classroom;
use Models\Discipline;
use Models\Grade;
use Models\Pupil;
use Models\User;
use System\App;
use Views\View;

class HomeController
{
    public function index()
    {
        if (USER !== null)
        {
            $vars = array();
            $classes = Classroom::getAllClasses();
            $vars['classes'] = $classes;
            View::render('index', ['title' => 'Головна', 'data' => $vars]);
        } else
        {
            App::redirect('users', 'signin');
        }
    }

    public function classroom()
    {
        if (USER !== null)
        {
            $class_id = $_GET['id'];
            $vars = array();
            $disciplines = Discipline::getDisciplinesByClassId($class_id);
            $vars['disciplines'] = $disciplines;
            View::render('classroom', ['title' => 'Клас', 'data' => $vars]);
        } else
        {
            App::redirect('users', 'signin');
        }
    }

    public function discipline()
    {
        if (USER !== null)
        {
            $discipline_id = $_GET['id'];
            $class_id = $_GET['class_id'];
            $vars = array();
            $pupils = Pupil::getPupilsByClassId($class_id);
            if (isset($_POST['date']))
            {
                $grades = Grade::getGrades($class_id, $discipline_id, $_POST['date']);
                $vars['grades'] = $grades;
            }
            $vars['pupils'] = $pupils;
            View::render('discipline', ['title' => 'Дисципліна', 'data' => $vars]);
        } else
        {
            App::redirect('users', 'signin');
        }
    }

    public function edit()
    {
        if (USER !== null)
        {
            if ($user = User::getUserById(\USER))
            {
                $discipline_id = $_GET['disc_id'];
                $class_id = $_GET['class_id'];
                $pupil_id = $_GET['pupil_id'];
                $add_date = $_GET['date'];
                if ($user['type'] == 'teacher' || $user['type'] == 'admin')
                {
                    $vars = array();
                    if (!($grade = Grade::getGrade($class_id, $discipline_id, $pupil_id, $add_date)))
                    {
                        $grade = \R::dispense('grades');
                    }

                    if (isset($_POST['do_edit']))
                    {
                        $grade->class_id = $class_id;
                        $grade->discipline_id = $discipline_id;
                        $grade->pupil_id = $pupil_id;
                        $grade->grade = trim($_POST['grade']);
                        $grade->add_date = $add_date;
                        \R::store($grade);
                        App::redirect('home', 'discipline', 'id=' . $discipline_id . '&class_id=' . $class_id);
                    }

                    View::render('edit', ['title' => 'Редагувати', 'data' => $vars]);
                } else
                {
                    App::redirect('home', 'discipline', 'id=' . $discipline_id . '&class_id=' . $class_id);
                }
            } else
            {
                App::redirect('users', 'signin');
            }
        } else
        {
            App::redirect('users', 'signin');
        }

    }

    public function admin()
    {
        if (USER !== null)
        {
            if ($user = User::getUserById(\USER))
            {
                if ($user['type'] == 'admin')
                {
                    if (isset($_GET['do']))
                    {
                        if (isset($_GET['entity']))
                        {
                            switch ($_GET['entity'])
                            {
                                case 'teacher':
                                    switch ($_GET['do'])
                                    {
                                        case 'add':
                                            $_SESSION['teacher'] = 'yes';
                                            App::redirect('users', 'signup');
                                            break;
                                        case 'delete':
                                            App::redirect('home', 'admin', 'delete=teacher');
                                            break;
                                    }
                                    break;
                                case 'class':
                                    switch ($_GET['do'])
                                    {
                                        case 'add':
                                            App::out_redirect(ADMIN_URL . 'tbl_change.php?db=ej&table=classes');
                                            break;
                                        case 'delete':
                                            App::redirect('home', 'admin', 'delete=class');
                                            break;
                                    }
                                    break;
                                case 'pupil':
                                    switch ($_GET['do'])
                                    {
                                        case 'add':
                                            App::out_redirect(ADMIN_URL . 'tbl_change.php?db=ej&table=pupils');
                                            break;
                                        case 'delete':
                                            App::redirect('home', 'admin', 'delete=pupil');
                                            break;
                                    }
                                    break;
                                case 'discipline':
                                    switch ($_GET['do'])
                                    {
                                        case 'add':
                                            App::out_redirect(ADMIN_URL . 'tbl_change.php?db=ej&table=disciplines');
                                            break;
                                        case 'delete':
                                            App::redirect('home', 'admin', 'delete=discipline');
                                            break;
                                    }
                                    break;
                            }
                        }
                    }
                    View::render('admin', ['title' => 'Панель адміністратора']);
                } else
                {
                    App::redirect('home', 'index');
                }
            } else
            {
                App::redirect('users', 'signin');
            }
        } else
        {
            App::redirect('users', 'signin');
        }
    }
}