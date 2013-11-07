<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdminPages extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('page');
		$this->load->library('error');
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/pages/index', ['pages' => $this->page->all()]);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/pages/add');
		$this->load->view('admin/footer');
	}

	public function create()
	{
		$result = $this->page->create($this->input->post());

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
		if (empty($id) || is_null($this->page->findOne($id))) {
			show_404();
		}

		$this->load->view('admin/header');
		$this->load->view('admin/pages/show', ['page' => $this->page->findOne($id)]);
		$this->load->view('admin/footer');
	}

	public function update($id)
	{
		if (is_null($this->page->findOne($id))) {
			$this->output->set_status_header('404');
		}

		$result = $this->page->update($id, $this->input->post());

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
		if (is_null($this->page->findOne($id))) {
			$this->output->set_status_header('404');
		}

		$this->page->delete($id);

		$this->output->set_status_header('200');

		return true;
	}
}
