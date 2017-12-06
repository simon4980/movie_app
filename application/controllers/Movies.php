<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movies extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->model('movie_collection_model');

        $data['sortby'] = '';
        $data['sortdir'] = '';
        if (array_key_exists('sortby', $_GET) && array_key_exists('sortdir', $_GET)) {
            $this->movie_collection_model->buildSort($_GET['sortby'], $_GET['sortdir']);
            $data['sortby'] = $_GET['sortby'];
            $data['sortdir'] = $_GET['sortdir'];
        }

        $this->movie_collection_model->loadMovies();
        $data['movie_collection'] = $this->movie_collection_model;
        $data['main_content'] = $this->load->view('main-content/movie-list', $data, TRUE);
        $this->load->view('structure', $data);	}
}
