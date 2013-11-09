<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('project');
		$this->load->model('page');
	}

	public function show($url)
	{
		if (empty($url) || is_null($project = $this->project->findOneByUrl($url))) {
			show_404();
		}

		$this->config->load('image_lib');
		$images = $this->project->getImages($project->id);
		$projects_root_dir = sprintf($this->config->item('projects_root_dir'), $project->id);
		$big_dir = $projects_root_dir . $this->config->item('big_dir');
		$thumb_dir = $projects_root_dir . $this->config->item('thumb_dir');
		$result_images = [];
		$limit = count($images);
		for ($i = 0; $i < $limit; ++$i) {
			$result_images[] = [
				'big' => base_url(str_replace($_SERVER['DOCUMENT_ROOT'], '', $big_dir . $images[$i]->filename)),
				'thumb' => base_url(str_replace($_SERVER['DOCUMENT_ROOT'], '', $thumb_dir . $images[$i]->filename)),
			];
		}
		$project->images = $result_images;

		$this->load->view('header', ['pages' => $this->page->all(), 'projects' => $this->project->all()]);
		$this->load->view(
			'project',
			['project' => $project]
		);
		$this->load->view('footer');
	}
}
