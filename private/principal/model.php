<?php

/**
 * main model
 */
class Model extends Database
{
	public $errors = array();

	public function __construct()
	{
		// code...
		if (!property_exists($this, 'table')) {
			$this->table = "TI_".strtoupper(get_class($this));
			error_log("MODEL::NOMBRETABLA-> " . $this->table);
		}
	}


	public function where($column, $value)
	{

		$column = addslashes($column);
		$query = "select * from $this->table where $column = :value";
		$data = $this->query($query,'id', [
			'value' => $value
		]);

		//run functions after select
		if (is_array($data)) {
			if (property_exists($this, 'afterSelect')) {
				foreach ($this->afterSelect as $func) {
					$data = $this->$func($data);
				}
			}
		}

		return $data;
	}

	public function first($column, $value)
	{

		$column = addslashes($column);
		$query = "select * from $this->table where $column = :value";
		error_log("firts USUARIO -> ". $query);
		error_log("firts USUARIO -> ". $value);
		$data = $this->query($query,"", [
			'value' => $value
		]);
		
		//run functions after select
		if (is_array($data)) {
			if (property_exists($this, 'afterSelect')) {
				foreach ($this->afterSelect as $func) {
					$data = $this->$func($data);
				}
			}
		}

		if (is_array($data)) {
			$data = $data[0];
		}
		return $data;
	}

	public function findAll()
	{

		$query = "select * from $this->table ";
		error_log("MODEL::findAll-> ". $query);
		$data = $this->query($query,"Id");
		error_log("MODEL::findAll Data-> ". json_encode($data));
		//run functions after select
		/*if (is_array($data)) {
			if (property_exists($this, 'afterSelect')) {
				foreach ($this->afterSelect as $func) {
					$data = $this->$func($data);
				}
			}
		}*/

		return $data;
	}

	public function findById($id)
	{

		$query = "select * from $this->table where id = :value";
		$data = $this->query($query, [
			'value' => $id
		]);


		//run functions after select
		if (is_array($data)) {
			if (property_exists($this, 'afterSelect')) {
				foreach ($this->afterSelect as $func) {
					$data = $this->$func($data);
				}
			}
		}

		if (is_array($data)) {
			$data = $data[0];
		}
		return $data;

	}

	public function insert($data,$nameId)
	{

		//quita columnas no permitidas
		if (property_exists($this, 'allowedColumns')) {
			foreach ($data as $key => $column) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		//ejecuta funciones antes de insertar
		if (property_exists($this, 'beforeInsert')) {
			foreach ($this->beforeInsert as $func) {
				$data = $this->$func($data);
			}
		}


		$keys = array_keys($data);
		$columns = implode(',', $keys);
		$values = implode(',:', $keys);

		$query = "insert into $this->table ($columns) values (:$values)";

		return $this->query($query,$nameId, $data);
	}

	public function update($id, $data,$nameId)
	{


		//remove unwanted columns
		if (property_exists($this, 'allowedColumns')) {
			foreach ($data as $key => $column) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		//run functions before insert
		if (property_exists($this, 'beforeUpdate')) {
			foreach ($this->beforeUpdate as $func) {
				$data = $this->$func($data);
			}
		}

		$str = "";
		foreach ($data as $key => $value) {
			// code...
			if($key != "Clave"){
				$str .= $key . "=:" . $key . ",";
			}
		}

		$str = trim($str, ",");
		$nameId = addslashes($nameId);
		$data['id'] = intval($id);
		unset($data['Clave']);
		$query = "update $this->table set $str where $nameId = :id";
		error_log("USUARIO::UPDATE -> ".$query);
		return $this->query($query,"", $data);
	}

	public function delete($name,$id)
	{
		$idTable = addslashes($name);
		$query = "update $this->table SET Activo = 0 WHERE $idTable = :id";
		$data['id'] = $id;
		error_log("eliminar USUARIO -> ". $query . " ".json_encode($data));
		return $this->query($query,"", $data);
	}

	public function consultaSP($query,$data){
		
		return $this->ejecutarSP($query,$data);
		
	}

	
}
