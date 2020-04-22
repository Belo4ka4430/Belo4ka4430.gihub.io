<?php
/**
 * Created by PhpStorm.
 * Users: Reebok
 * Date: 20.04.2020
 * Time: 9:29
 */

namespace Controllers;


use Models\User;
use System\App;
use Views\View;

class UsersController
{
    public function signup()
    {
        if ($logged_user = User::getUserById(\USER))
        {
            if ($logged_user['type'] !== 'admin')
            {
                App::redirect('home', 'index');
            }
        }

        $data = $_POST;
        $alert = '';
        $vars = array();

        if (isset($data['do_signup'])) {
            $errors = [];

            if (trim($data['name']) == "") {
                $errors[] = 'Введіть логін!';
            }
            if (trim($data['email']) == "") {
                $errors[] = 'Введіть email!';
            }
            if (trim($data['password']) == "") {
                $errors[] = 'Введіть пароль!';
            }
            if (trim($data['allowPassword']) != trim($data['password'])) {
                $errors[] = 'Повторний пароль введено некоректно!';
            }
            if (User::getUserByName($data['name'])) {
                $errors[] = 'Користувач з таким логіном вже існує!';
            }
            if (User::getUserByName($data['email'])) {
                $errors[] = 'Користувач з таким email вже існує!';
            }

            if (empty($errors)) {
                $user = \R::dispense('users');
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
                if (isset($_SESSION['teacher']))
                {
                    $user->type = 'teacher';
                    unset($_SESSION['teacher']);
                } else
                {
                    $user->type = 'pupil';
                }

                if ($id = \R::store($user))
                {
                    $_SESSION['logged_user'] = $id;
                    $alert = '<div class="alert alert-success alert-signup">
                                <strong>Ви успішно зареєстровані</strong>
                              </div>';
                    unset($data);
                }
            } else {
                $alert = '<div class="alert alert-danger alert-signup">
                    <strong>'.array_shift($errors).'</strong>
                  </div>';
            }
        } else {
            $alert = '';
        }
        $vars['alert'] = $alert;

        View::render('signup', ['title' => 'Реєстрація', 'data' => $vars]);
    }

    public function signin()
    {
        if (isset($_GET['logout'])) {
            unset($_SESSION['logged_user']);
            App::redirect('home', 'index');
        }

        if ($logged_user = User::getUserById(\USER))
        {
            App::redirect('home', 'index');
        }

        $data = $_POST;
        $alert = '';
        $vars = array();

        if (isset($data['do_login'])) {
            $errors = [];
            $user = User::getUserByName($data['name']);

            if ($user) {
                if (password_verify($data['password'], $user['password'])) {
                    $_SESSION['logged_user'] = $user['id'];
                    $alert = '<div class="alert alert-success alert-signup">
                                <strong>Ви успішно авторизовані!</strong>
                              </div>';
                    unset($data);
                } else {
                    $errors[] = 'Неправильний пароль!';
                }
            } else {
                $errors[] = 'Користувача з таким логіном не існує!';
            }

            if (!empty($errors)) {
                $alert = '<div class="alert alert-danger alert-signup">
                    <strong>' . array_shift($errors) . '</strong>
                  </div>';
            } else
            {
                $vars['user'] = $user;
            }
        } else {
            $alert = '';
        }

        $vars['alert'] = $alert;

        View::render('signin', ['title' => 'Вхід', 'data' => $vars]);
    }
}