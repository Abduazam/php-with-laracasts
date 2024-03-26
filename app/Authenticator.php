<?php

namespace app;

class Authenticator
{
    protected $db;

    public function __construct()
    {
        $this->db = (App::resolve(Database::class));
    }

    public function attempt($email, $password): bool
    {
        $user = $this->findUser($email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login($user);

                return true;
            }
        }

        return false;
    }

    public function register(mixed $name, mixed $email, mixed $password): bool
    {
        $user = $this->findUser($email);

        if (! $user) {
            $this->db->query('insert into users(name, email, password) values (:name, :email, :password)', [
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);

            $this->login([
                'name' => $name,
                'email' => $email,
            ]);

            return true;
        }

        return false;
    }

    public function login($user): void
    {
        $_SESSION['user'] = [
            'name' => $user['name'],
            'email' => $user['email'],
        ];

        session_regenerate_id(true);
    }

    public function logout(): void
    {
        Session::destroy();
    }

    private function findUser($email)
    {
        return $this->db->query('select * from users where email = :email', [
            'email' => $email
        ])->find();
    }
}