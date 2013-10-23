<?php

require_once __DIR__ . '/Validation/Presence.php';

class MY_Model extends CI_Model
{
	protected $table;
	protected $attributes = [];
	protected $errors;
	protected $validators = [];

	function __construct()
	{
		parent::__construct();
	}

	public function init($data)
	{
		foreach ($this->attributes as $field => $value) {
			$this->attributes[$field] = isset($data[$field]) ? $data[$field] : '';
		}

		return $this;
	}

	public function all()
	{
		return $query = $this->db->get($this->table)->result();
	}

	public function findOne($where)
	{
		if (is_numeric($where)) {
			$where = ['id' => $where];
		}

		$result = $this->db->get_where($this->table, $where, 1)->result();

		return isset($result[0]) ? $result[0] : null;
	}

	public function save()
	{
		if (empty($this->attributes['id'])) {
			$this->db->insert($this->table, $this->attributes);
			$this->attributes['id'] = $this->db->insert_id();
		} else {
			$this->db->update($this->table, $this->attributes, ['id' => $this->attributes['id']]);
		}

		return $this->attributes['id'];
	}

	public function delete($id)
	{
		return $this->db->delete($this->table, ['id' => $id]);
	}

	public function validate()
	{
		$this->bindValidators();
		foreach ($this->validators as $field => $validator)
		{
			if (!array_key_exists($field, $this->attributes)) {
				continue;
			}

			if (is_array($validator)) {
				foreach ($validator as $v) {
					if ($validation_res = $v() !== true) {
						$this->errors[$field][] = $v();
					}
				}
			} else {
				if ($validation_res = $validator() !== true) {
					$this->errors[$field][] = $validator();
				}
			}
		}

		return $this;
	}

	public function isValid()
	{
		return !(bool) $this->errors();
	}

	public function errors()
	{
		if (is_null($this->errors)) {
			$this->validate();
		}

		return $this->errors;
	}

	/**
	 * @param $field
	 * @param $validator
	 * @return self
	 */
	protected function bindValidator($field, $validator)
	{
		$this->validators[$field] = $validator;

		return $this;
	}

	protected function bindValidators()
	{
		return $this;
	}
}