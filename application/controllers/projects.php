<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('project');
		$this->load->library('error');
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/projects/index', ['projects' => $this->project->all()]);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/projects/add');
		$this->load->view('admin/footer');
	}

	public function create()
	{
		$result = $this->project->create($this->input->post());

		if (!empty($result['errors'])) {
			$this->output->set_status_header('400')
				->set_content_type('application/json')
				->set_output(json_encode(['errors' => $this->error->translate($result['errors'])]));

			return false;
		}

		$this->output->set_status_header('200');

		return true;
	}

	public function show($id)
	{
		if (empty($id) || is_null($this->project->findOne($id))) {
			show_404();
		}

		$this->load->view('admin/header');
		$this->load->view('admin/projects/show', ['project' => $this->project->findOne($id)]);
		$this->load->view('admin/footer');
	}

	public function update($id)
	{
		if (is_null($this->project->findOne($id))) {
			$this->output->set_status_header('404');

			return false;
		}

		$result = $this->project->update($id, $this->input->post());

		if (!empty($result['errors'])) {
			$this->output->set_status_header('400')
				->set_content_type('application/json')
				->set_output(json_encode(['errors' => $this->error->translate($result['errors'])]));

			return false;
		}

		$this->output->set_status_header('200');

		return true;
	}

	public function delete($id)
	{
		if (is_null($this->project->findOne($id))) {
			$this->output->set_status_header('404');

			return false;
		}

		$this->project->delete($id);

		$this->output->set_status_header('200');

		return true;
	}

	public function images($project_id)
	{
		if (is_null($this->project->findOne($project_id))) {
			show_404();
		}

		$result_images = [];
		$images = $this->project->getImages($project_id);

		if (!empty($images)) {
			$this->config->load('image_lib');
			$projects_root_dir = sprintf($this->config->item('projects_root_dir'), $project_id);
			$big_dir = $projects_root_dir . $this->config->item('big_dir');
			$thumb_dir = $projects_root_dir . $this->config->item('thumb_dir');
			foreach ($images as $image) {
			 	$result_images[] = [
				 	'big' => base_url(str_replace($_SERVER['DOCUMENT_ROOT'] . '/karin/', '', $big_dir . $image->filename)),
				 	'thumb' => base_url(str_replace($_SERVER['DOCUMENT_ROOT'] . '/karin/', '', $thumb_dir . $image->filename)),
				 ];
			}
		}

		$this->load->view('admin/header');
		$this->load->view(
			'admin/projects/images',
			['project' => $this->project->findOne($project_id), 'images' => $result_images]
		);
		$this->load->view('admin/footer');
	}

	public function images_upload($project_id)
	{
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);
		if (empty($_FILES) || $_POST['token'] != $verifyToken) {
			$this->output->set_status_header('400');
			echo 'No image';

			return false;
		}

		$project = $this->project->findOne($project_id);
		if (is_null($project)) {
			$this->output->set_status_header('404');

			return false;
		}

		$this->project->init($project);
		$filepath = $this->project->addImage($_FILES['Filedata']);

		echo json_encode(['file' => base_url(str_replace($_SERVER['DOCUMENT_ROOT'] . '/karin/', '', $filepath))]);

		return true;
	}

}
