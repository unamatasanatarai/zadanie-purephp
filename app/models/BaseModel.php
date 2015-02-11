<?php
namespace models;

use Util\Arr;

/**
 * Common methods for Models
 */
class BaseModel
{
	public $db;

	public function __construct(){
		$this->db = \DB\DB::getInstance();
	}

	public function getCount(){
		return (int)$this->db->PGetOne('SELECT COUNT(*) FROM ' . $this->table);
	}

	public function getCountWhere($col, $val){
		return (int)$this->db->PGetOne('SELECT COUNT(*) FROM ' . $this->table . ' WHERE ' . $col . ' =?', $val);
	}

	public function paginate($offset, $limit){
		return $this->db->PGetAll(
			'SELECT * FROM ' . $this->table . ' LIMIT ?, ?',
			array(
				$offset,
				$limit
			)
		);
	}

	public function getAll($order_by = 'id', $ascdesc = 'ASC'){
		return $this->db->PGetAll('SELECT * FROM ' . $this->table . ' ORDER BY ' . $order_by . ' ' . $ascdesc);
	}

	public function getById($id, $column = 'id'){
		if (is_array($id)){
			return $this->db->PGetAll(
				'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' IN(' . substr(str_repeat('?,', count($id)), 0, -1) . ')',
				$id
			);
		}
		return $this->db->PGetRow('SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = ?', $id);
	}

	public function delete($id, $col = 'id'){
		$r = $this->db->PExecute('DELETE FROM ' . $this->table . ' WHERE ' . $col . '= ?', $id);
		return $r;
	}

	public function create($data, $allowed_fields = '*'){
		$data = $this->__validateAllowedFields($data, $allowed_fields);

		$keys = array_keys($data);
		$vals = array_values($data);
		$sql = 'INSERT INTO ' . $this->table . ' (' . implode(',', $keys) . ') VALUES (' . substr(str_repeat('?,', count($keys)), 0, -1) . ')';
		$this->db->PExecute($sql, $vals);
		$data['id'] = $this->db->Insert_Id();
		return $data['id'];
	}

	private function __validateAllowedFields($data, $fields){
		if ($fields == '*'){
			return $data;
		}
		return Arr::get($data, $fields);
	}

	public function update($data, $where, $where_col = 'id', $allowed_fields = '*'){
		$data = $this->__validateAllowedFields($data, $allowed_fields);
		$keys = array_keys($data);
		$vals = array_values($data);
		$vals[] = $where;
		$sql = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $keys) . '=? WHERE ' . $where_col . '=?';
		$r = $this->db->PExecute($sql, $vals);
		return $r;
	}
}

