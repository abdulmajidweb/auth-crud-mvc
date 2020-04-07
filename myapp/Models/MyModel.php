<?php
namespace App\Models;

use App\Config\Database;

class MyModel extends Database
{
	public function __construct()
	{
		parent::__construct();
	}
}