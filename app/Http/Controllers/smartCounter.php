<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class smartCounter extends Controller
{
    //
	public function increment($string)
	{
		if(!is_numeric(substr($string, -1)))
			$string=$string."000";
		$last_char=substr($string,-1);
		$rest=substr($string, 0, -1);
		switch ($last_char) {
			case '':
			$next= 'A';
			break;
			case 'Z':
			$next = '0';
			$unique = increment($rest);
			$rest = $unique;
			break;
			case '9':
			$next= 'A';
			break;
			default:
			$next = ++$last_char;
			break;
		}
		$string=$rest.$next;
		return $string;
	}
}
