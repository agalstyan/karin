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

	public function findOneByUrl($url)
	{
		if (empty($url)) {
			return null;
		}

		$where = ['url' => $url];
		$result = $this->db->get_where($this->table, $where, 1)->result();

		return isset($result[0]) ? $result[0] : null;
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

	public function delete($id)
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

	public function addImage($file)
	{
		$this->load->library('image_lib');

		$this->config->load('image_lib', true);
		$img_config = $this->config->item('image_lib');

		$temp_file = $file['tmp_name'];
		$file_name = $file['name'];

		if (!in_array(strtolower(pathinfo($file['name'])['extension']), $img_config['valid_types'])) {
			return false;
		}

		$projects_root_dir = sprintf($img_config['projects_root_dir'], $this->attributes['id']);
		$original_dir = $projects_root_dir . 'original/';
		if (!file_exists($projects_root_dir)) {
			mkdir($projects_root_dir);
			mkdir($original_dir);
		}

		if (!move_uploaded_file($temp_file, $original_dir . $file_name)) {
			echo "Oh oh!";
			die;
		}

		$this->load->model('photo');
		$this->photo->create(['filename' => $file_name, 'project_id' => $this->attributes['id']]);

		$img_config['source_image'] = $original_dir . $file_name;
		foreach ($img_config['sizes'] as $dir_name => $size) {
			$resized_dir = $projects_root_dir . $dir_name . '/';
			if (!file_exists($resized_dir)) {
				mkdir($resized_dir);
			}

			$img_config['new_image'] = $resized_dir . $file_name;
			$img_config['width'] = $size['width'];
			$img_config['height'] = $size['height'];
			$this->image_lib->initialize($img_config);
			$this->image_lib->resize();
		}

		return $projects_root_dir . 'thumb/' . $file_name;
	}

	public function getImages($project_id = 0)
	{
		$this->load->model('photo');
		return $this->photo->findByProjectId($project_id ?: $this->attributes['project_id']);
	}

	public function deleteImage()
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