<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function index()
	{
		$this->load->model('project');
		$this->load->model('page');

	    $projects = [];
		$this->config->load('image_lib');
		foreach($this->project->all() as $project) {
			$images = $this->project->getImages($project->id);
			if (empty($images)) {
				$projects[] = $project;
				continue;
			}

			$projects_root_dir = sprintf($this->config->item('projects_root_dir'), $project->id);
			$big_dir = $projects_root_dir . $this->config->item('big_dir');
			$thumb_dir = $projects_root_dir . $this->config->item('thumb_dir');
			$result_images = [];
			$limit = count($images) <= 3 ? count($images) : 3;
			for ($i = 0; $i < $limit; ++$i) {
				$result_images[] = [
					'big' => base_url(str_replace($_SERVER['DOCUMENT_ROOT'] . '/karin/', '', $big_dir . $images[$i]->filename)),
					'thumb' => base_url(str_replace($_SERVER['DOCUMENT_ROOT'] . '/karin/', '', $thumb_dir . $images[$i]->filename)),
				];
			}
			$project->images = $result_images;
			$projects[] = $project;
		}

		$this->load->view('header', ['projects' => $projects, 'pages' => $this->page->all()]);
		$this->load->view('index');
		$this->load->view('footer');
	}
}
