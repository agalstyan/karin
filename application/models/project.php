<?php

class Project extends My_Model
{
	protected $table = 'projects';
	protected $attributes = [
		'id' => '',
		'title' => '',
		'url' => '',
		'description' => '',
		'creation_date' => '',
		'published' => ''
	];

	function __construct()
	{
		parent::__construct();
	}

	public function create($data)
	{
		$data['creation_date'] = !empty($data['creation_date'])
			? $data['creation_date']
			: date('Y-m-d', strtotime("now"));
		$this->init($data);

		if (!$this->isValid()) {
			return ['errors' => $this->errors()];
		}

		if ($this->findOne(['url' => $this->attributes['url']])) {
			return ['errors' => ['url' => ['ERROR_URL_RECORD_EXISTS']]];
		}

		$result = ['id' => $this->save()];

		return $result;
	}

	public function update($id, $data)
	{
		$data['creation_date'] = !empty($data['creation_date'])
			? $data['creation_date']
			: date('Y-m-d', strtotime("now"));
		$this->init(array_merge($data, ['id' => $id]));

		if (!$this->isValid()) {
			return ['errors' => $this->errors()];
		}

		if ($this->findOne(['url' => $this->attributes['url'], 'id !=' => $this->attributes['id']])) {
			return ['errors' => ['url' => ['ERROR_URL_RECORD_EXISTS']]];
		}

		return ['id' => $this->save()];
	}

	public function addImage($filename)
	{

	}

	protected function bindValidators()
	{
		$this->bindValidator('title', function(){
			return Validation_Presence::notEmpty($this->attributes['title']);
		});

		$this->bindValidator('url', function(){
			return Validation_Presence::notEmpty($this->attributes['url']);
		});
	}
}