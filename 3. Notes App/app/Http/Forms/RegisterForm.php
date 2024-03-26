<?php

namespace app\Http\Forms;

use app\Validator;

class RegisterForm
{
    protected array $errors = [];

    public function validate($name, $email, $password): bool
    {
        if (! Validator::required($name)) {
            if (! Validator::min($name, 3)) {
                $this->errors['name'] = 'Name should be greater than 3 characters.';
            }
        } else {
            $this->errors['name'] = 'Name is required.';
        }

        if (! Validator::required($email)) {
            if (! Validator::email($email)) {
                $this->errors['email'] = 'Please provide a valid email address.';
            }
        } else {
            $this->errors['email'] = 'Email is required.';
        }

        if (! Validator::required($password)) {
            if (! Validator::min($password, 3)) {
                $this->errors['password'] = 'Password should be greater than 3 characters.';
            }

            if (! Validator::max($password, 16)) {
                $this->errors['password'] = 'Password should be less than 16 characters.';
            }
        } else {
            $this->errors['password'] = 'Password is required.';
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}