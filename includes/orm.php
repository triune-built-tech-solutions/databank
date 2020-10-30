<?php
/**
 * Created by PhpStorm.
 * User: ihesiulo
 * Date: 07/05/2019
 * Time: 9:16 PM
 */

class ORM
{
	public static function insertData(array $data, $table, $connect, $column = [], $exclude = [], $replace = [])
	{
		$keys = []; // insert keys
		$values = []; // insert values

		$columns = mysqli_query($connect, "SELECT * FROM $table");
		$fields = mysqli_fetch_fields($columns);

		$tableColumns = [];

		foreach ($fields as $i => $col)
		{
			$tableColumns[$col->name] = $col->name;
		}

		foreach ($data as $key => $val)
		{
			if (!in_array($key, $exclude)) {
				if (!is_null($val) && is_string($key)) {

					$key = isset($column[$key]) ? $column[$key] : $key;

					if (isset($tableColumns[$key]) && !isset($keys[$key]))
					{
						$keys[$key] = "`$key`";
						if (is_numeric($val) || is_int($val)) {
							$values[] = isset($replace[$key]) ? intval($data[$replace[$key]]): intval($val);
						} else {
							$values[] = isset($replace[$key]) ? "'{$data[$replace[$key]]}'" : "'{$val}'";
						}
					}
				}
			}
		}

		$keys = implode(',', $keys);
		$values = implode(',', $values);

		$insertSQL = "INSERT INTO {$table} ({$keys}) VALUES ({$values})";

		if (mysqli_query($connect, $insertSQL))
		{
			return true;
		}

		return false;

	}
}