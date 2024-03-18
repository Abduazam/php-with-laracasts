<?php

class Validator
{
	public static function required($value)
	{
		return strlen(trim($value)) === 0;
	}

	public static function min($value, $min = 1)
	{
		return strlen(trim($value)) >= $min;
	}

	public static function max($value, $max = INF)
	{
		return strlen(trim($value)) <= $max;
	}
}