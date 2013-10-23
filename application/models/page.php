<?php

class Page extends My_Model
{
	protected $table = 'static_pages';
	protected $attributes = [
		'id' => '',
		'title' => '',
		'url' => '',
		'text' => ''
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

		if ($this->findOne(['url' => $this->attributes['url']])) {
			return ['errors' => ['url' => ['ERROR_URL_RECORD_EXISTS']]];
		}

		$result = ['id' => $this->save()];

		return $result;
	}

	public function update($id, $data)
	{
		$this->init(array_merge($data, ['id' => $id]));

		if (!$this->isValid()) {
			return ['errors' => $this->errors()];
		}

		if ($this->findOne(['url' => $this->attributes['url'], 'id !=' => $this->attributes['id']])) {
			return ['errors' => ['url' => ['ERROR_URL_RECORD_EXISTS']]];
		}

		$result = ['id' => $this->save()];

		return $result;
	}

	protected function bindValidators()
	{
		$this->bindValidator('title', function(){
			return Validation_Presence::notEmpty($this->attributes['title']);
		});

		$this->bindValidator('url', function(){
			return Validation_Presence::notEmpty($this->attributes['url']);
		});

		$this->bindValidator('text', function(){
			return Validation_Presence::notEmpty(strip_tags($this->attributes['text']));
		});
	}
}