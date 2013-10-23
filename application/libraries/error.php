<?php

class Error
{
	public function translate($errors)
	{
		$CI =& get_instance();

		$translated_errors = [];
		foreach ($errors as $field => $field_errors) {
			foreach ($field_errors as $field_error) {
				$translated_errors[$field][] = $CI->lang->line($field_error);
			}
		}

		return $translated_errors;
	}
}
