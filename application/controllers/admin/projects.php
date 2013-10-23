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

		$this->load->view('admin/header');
		$this->load->view('admin/projects/images', ['project' => $this->project->findOne($project_id)]);
		$this->load->view('admin/footer');
	}

	public function images_upload($project_id)
	{
		if (is_null($this->project->findOne($project_id))) {
			$this->output->set_status_header('404');

			return false;
		}

		$this->load->library('image_lib');

		$root = $_SERVER['DOCUMENT_ROOT'] . '/karin/';
		$targetFolder = 'public/assets/img/projects/' . $project_id . '/';

		if (!file_exists($root . $targetFolder)) {
			mkdir($root . $targetFolder);
		}

		$this->libraries->load('gd');
//		$this->gd->
		$thumb = new PHPThumb\GD(__DIR__ .'/../tests/resources/test.jpg');
		$thumb->adaptiveResize(175, 175);
		$thumb->show();

		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetFile = rtrim($targetFolder, '/') . '/' . $_FILES['Filedata']['name'];

			// Validate the file type
			$fileTypes = ['jpg', 'jpeg', 'gif', 'png']; // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
				move_uploaded_file($tempFile, $root . $targetFile);
				echo json_encode(['file' => base_url($targetFile)]);
			} else {
				$this->output->set_status_header('400');
				echo 'Invalid file type.';
			}
		}
	}

}
