<?php
namespace App\Systems\Validation;

class FormValidation
{
	public function trimValidate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}