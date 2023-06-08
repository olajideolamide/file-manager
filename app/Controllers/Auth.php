<?php

namespace App\Controllers;

class Auth extends AuthController
{


    public function login()
    {

        $this->data["page_schema"]["title"] = "Login";
        $this->data["page_schema"]["canonical"] = "/auth/login";
        $view = "auth/login";


        if (!$this->request->is('post')) {
            return $this->render($view);
        }
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[10]'

        ];

        if (!$this->validate($rules)) {
            return $this->render($view);
        }

        $user_model = new \App\Models\UserModel($this->db);

        $user = $user_model->getUserByEmail($this->request->getPost("email"));



        if (empty($user["email"])) {
            $this->validator->setError("user-not-exists", "The user does not exist");
            return $this->render($view);
        }

        $password = $this->request->getPost("password");

        $pwd_verify = password_verify((string)$password, $user['password']);

        if (!$pwd_verify) {
            $this->validator->setError("wrong-password", "Invalid email or password.");
            return $this->render($view);
        }

        $user_data = [
            'id'  => $user["id"],
            'email'     => $user["email"],
            'is_logged_in' => true,
        ];

        $this->session->set($user_data);

        return redirect()->to(url_to('Drive::index'));
    }


    public function logout()
    {

        $array_items = ['id', 'email', 'is_logged_in'];
        $this->session->remove($array_items);

        return redirect()->to(url_to('Auth::login'));
    }
}
