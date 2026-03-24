<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Services\AuthService;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm(Request $request, array $vars = []): Response
    {
        if (AuthService::check()) {
            return $this->redirect('/admin');
        }
        $html = $this->view->render('admin/login', ['error' => null]);
        $response = new Response();
        $response->setBody($html);
        return $response;
    }

    public function login(Request $request, array $vars = []): Response
    {
        if (!$request->isPost()) {
            return $this->redirect('/admin/login');
        }

        $login    = trim($request->post('login', ''));
        $password = $request->post('password', '');

        if (AuthService::attempt($login, $password)) {
            return $this->redirect('/admin');
        }

        $html = $this->view->render('admin/login', ['error' => 'Неверный логин или пароль']);
        $response = new Response();
        $response->setBody($html);
        return $response;
    }

    public function logout(Request $request, array $vars = []): Response
    {
        AuthService::logout();
        return $this->redirect('/admin/login');
    }
}
