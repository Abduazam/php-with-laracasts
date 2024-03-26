<?php

namespace app;

class Validator
{
	public static function required(string $value): bool
    {
		return strlen(trim($value)) === 0;
	}

	public static function min(string $value, int $min = 1): bool
    {
		return strlen(trim($value)) >= $min;
	}

	public static function max(string $value, int $max = INF): bool
    {
		return strlen(trim($value)) <= $max;
	}

    public static function email(string $value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}