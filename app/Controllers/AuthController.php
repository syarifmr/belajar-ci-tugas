<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper('form');
        $this->user = new UserModel();
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $rules = [
                'username' => 'required|min_length[6]',
                'password' => 'required|min_length[7]|numeric',
            ];

            if ($this->validate($rules)) {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                $dataUser = $this->user->where(['username' => $username])->first(); //pasw 1234567

                if ($dataUser) {
                    if (password_verify($password, $dataUser['password'])) {
                        session()->set([
                            'username' => $dataUser['username'],
                            'role' => $dataUser['role'],
                            'isLoggedIn' => TRUE
                        ]);

                        return redirect()->to(base_url('/'));
                    } else {
                        session()->setFlashdata('failed', 'Kombinasi Username & Password Salah');
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back();
            }
        }

        return view('v_login');
    }

    public function register()
    {
        $userModel = new \App\Models\UserModel();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|min_length[6]|is_unique[user.username]',
                'email'    => 'required|valid_email|is_unique[user.email]',
                'password' => 'required|min_length[7]',
            ];

            if (! $this->validate($rules)) {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

            $data = [
                'username'   => $this->request->getPost('username'),
                'email'      => $this->request->getPost('email'),
                'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'       => 'guest',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            if (! $userModel->insert($data)) {
                session()->setFlashdata('failed', implode(', ', $userModel->errors()));
                return redirect()->back()->withInput();
            }

            return redirect()->to('login')->with('success', 'Akun berhasil dibuat.');
        }

        return view('v_register');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
