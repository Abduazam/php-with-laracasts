<?php

namespace app\Http\Forms;

use app\Exceptions\ValidationException;
use app\Validator;

class RegisterForm
{
    protected array $errors = [];

    public function __construct(public array $attributes)
    {
        if (! Validator::required($attributes['name'])) {
            if (! Validator::min($attributes['name'], 3)) {
                $this->errors['name'] = 'Name should be greater than 3 characters.';
            }
        } else {
            $this->errors['name'] = 'Name is required.';
        }

        if (! Validator::required($attributes['email'])) {
            if (! Validator::email($attributes['email'])) {
                $this->errors['email'] = 'Please provide a valid email address.';
            }
        } else {
            $this->errors['email'] = 'Email is required.';
        }

        if (! Validator::required($attributes['password'])) {
            if (! Validator::min($attributes['password'], 3)) {
                $this->errors['password'] = 'Password should be greater than 3 characters.';
            }

            if (! Validator::max($attributes['password'], 16)) {
                $this->errors['password'] = 'Password should be less than 16 characters.';
            }
        } else {
            $this->errors['password'] = 'Password is required.';
        }
    }

    public static function validate($attributes): static
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    /**
     * @throws ValidationException
     */
    public function throw(): void
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed(): int
    {
        return count($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error($field, $message): static
    {
        $this->errors[$field] = $message;

        return $this;
    }
}