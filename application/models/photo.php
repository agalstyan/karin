<?php

class Photo extends My_Model
{
	protected $table = 'photos';
	protected $attributes = [
		'id' => '',
		'project_id' => '',
		'filename' => '',
		'main' => '',
	];

	function __construct()
	{
		parent::__construct();
	}

	public function create($data)
	{
		$this->init($data);

		if (!$this->isValid()) {
			return ['errors' => $this->errors()];
		}

		$result = ['id' => $this->save()];

		return $result;
	}

	public function findByProjectId($project_id)
	{
		$this->db->order_by('id', 'desc');
		return $this->db->get_where($this->table, ['project_id' => $project_id])->result();
	}

	protected function bindValidators()
	{
		$this->bindValidator('filename', [
			function(){
				return Validation_Presence::notEmpty($this->attributes['filename']);
			},
			function () {
				return $this->findOne(
					['project_id' => $this->attributes['project_id'], 'filename' => $this->attributes['filename']]
				) ? 'ERROR_PHOTO_EXISTS' : true;
			}
		]);

		$this->bindValidator('project_id', function(){
			return Validation_Presence::notEmpty($this->attributes['project_id']);
		});
	}


}