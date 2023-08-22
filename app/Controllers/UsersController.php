<?php

namespace App\Controllers;

use Config\Database;
use App\Models\UsersModel;
use App\Models\GuestPostLeadsModel;

class UsersController extends BaseController
{
    public function register(): string
    {
        return view('register');
    }
    public function login(): string
    {
        return view('login');
    }
    // public function dashboard()
    // {
    //     return view('index');
    // }
    // public function agent_dashboard()
    // {
    //     return view('agent-dashboard');
    // }
    // public function users_registration()
    // {
    //     $session = session();
    //     $UsersModel = new UsersModel();
    //     $email = $this->request->getVar('email');
    //     $existingUser = $UsersModel->where('email', $email)->first();
    //     if (!$existingUser) {
    //         $data = [
    //             'name' => $this->request->getVar('name'),
    //             'email' => $this->request->getVar('email'),
    //             'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
    //         ];
    //     } else {
    //         $session->setFlashdata('error_registration', 'user already exists');
    //         return redirect()->to(base_url() . 'register');
    //     }
    //     $UsersModel->insert($data);
    // }
    public function loginAuth()
    {
        $session = session();
        $UsersModel = new UsersModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $UsersModel->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            $userprofile = $UsersModel->select('users.id as user_id, users.name as username , users.email, role.id as role_id, role.name as role')
                ->join('role', 'role.id = users.role_id', 'left')
                ->where('users.id', $data['id'])
                ->first();
            // print_r($userprofile);
            // die('hi');
            $data['userdetails'] = $userprofile;
            $userinfo = $userprofile;
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $userinfo['user_id'],
                    'name' => $userinfo['username'],
                    'email' => $userinfo['email'],
                    'role' => $userinfo['role'],
                    'role_id' => $userinfo['role_id'],
                    'isLoggedIn' => TRUE
                ];
                // print_r($ses_data);
                // die('hi');
                $session->set($ses_data);
                if ($session->get('role') == "admin") {
                    return redirect()->to(base_url() . 'admin');
                }
                if ($session->get('role') == "agent") {
                    return redirect()->to(base_url() . 'agent');
                }
                // return view('index', $data);
            } else {
                $session->setFlashdata('error_registration', 'Password is incorrect.');
                return redirect()->to(base_url());
            }
        } else {
            $session->setFlashdata('error_registration', 'Email does not exist.');
            return redirect()->to(base_url());
        }
    }

    public function logout()
    {
        session();
        session_destroy();
        return redirect()->to(base_url());
    }
}
