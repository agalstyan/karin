<?php

class Validation_Presence
{
	const ERROR_VALUE_IS_EMPTY = 'ERROR_VALUE_IS_EMPTY';

	public static function notEmpty($value)
	{
		return empty($value) ? self::ERROR_VALUE_IS_EMPTY : true;
	}
}
