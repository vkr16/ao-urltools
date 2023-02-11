<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->userModel = model("UserModel", true, $db);
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }

    public function login()
    {
        if ($this->session->has('email')) {
            return redirect()->to(base_url('/'));
        }
        return view('auth/login');
    }

    public function register()
    {
        if ($this->session->has('email')) {
            return redirect()->to(base_url('/'));
        }
        return view('auth/register');
    }

    public function registerUser()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];


        $this->validation->setRules(
            [
                'firstname' => 'required|min_length[2]|alpha_space',
                'lastname' => 'required|min_length[2]|alpha_space',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]'
            ],
            [
                'firstname' => [
                    'required' => 'The first name field is required.',
                    'min_length' => 'The first name field must be at least 2 characters.',
                    'alpha_space' => 'The first name field may only contain alphabetical characters and spaces'
                ],
                'lastname' => [
                    'required' => 'The last name field is required.',
                    'min_length' => 'The last name field must be at least 2 characters.',
                    'alpha_space' => 'The last name field may only contain alphabetical characters and spaces'
                ],
                'email' => [
                    'required' => 'The email field is required.',
                    'valid_email' => 'The email must be a valid email address.',
                    'is_unique' => 'This email address already used.'
                ],
                'password' => [
                    'required' => 'The password field is required.',
                    'min_length' => 'The password field must be at least 6 characters.'
                ]
            ]
        );

        $signup_params = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password
        ];


        if (!$this->validation->run($signup_params)) {
            return json_encode($this->validation->getErrors());
        }

        $token = openssl_encrypt($email, "AES-256-CBC", $_ENV['ENCRYPTION_KEY'], 0, $_ENV['ENCRYPTION_IV']);

        $user = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'token' => $token

        ];

        if ($this->userModel->insert($user)) {
            $user = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
            ];

            $this->session->set($user);
            return "success";
        } else {
            return "error";
        }
    }

    public function loginUser()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $this->validation->setRules(
            [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ],
            [
                'email' => [
                    'required' => 'The email field is required.',
                    'valid_email' => 'The email must be a valid email address.',
                ],
                'password' => [
                    'required' => 'The password field is required.',
                    'min_length' => 'The password field must be at least 6 characters.'
                ]
            ]
        );

        if (!$this->validation->run(['email' => $email, 'password' => $password])) {
            return json_encode($this->validation->getErrors());
        }

        if ($user = $this->userModel->where('email', $email)->find()) {
            #check if the password is correct
            if (password_verify($password, $user[0]['password'])) {
                $this->session->set(['firstname' => $user[0]['firstname'], 'lastname' => $user[0]['lastname'], 'email' => $user[0]['email']]);
                return "success";
            } else {
                return "password_error";
            }
        } else {
            return "user_not_found";
        }
    }

    public function recovery()
    {
        return view('auth/recovery');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
