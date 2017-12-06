<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends CI_Controller {

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
	public function index($strMovieKey = NULL)
	{
        $this->_loadMovieByKey($strMovieKey);
        $data['objMovie'] = $this->movie_model;

        $data['main_content'] = $this->load->view('main-content/movie-detail', $data, TRUE);
        $this->load->view('structure', $data);
	}

	public function addmovie() {
        $this->load->helper('form');
        $this->load->model('movie_model');

        if (count($_POST) && $this->_validateForm()) {
            $this->_save();
        }

        $data['objMovie'] = $this->movie_model;
        $data['main_content'] = $this->load->view('main-content/add-edit-movie', $data, TRUE);
        $this->load->view('structure', $data);
    }

    public function delete($strMovieKey = NULL)
    {
        $this->load->model('movie_model');
        $this->_loadMovieByKey($strMovieKey);
        $this->movie_model->delete();
        redirect('/movies');
        exit;
}

	public function edit($strMovieKey = NULL)
    {
        $this->load->helper('form');
        $this->load->model('movie_model');
        $this->_loadMovieByKey($strMovieKey);
        $data['objMovie'] = $this->movie_model;

        if (count($_POST) && $this->_validateForm()) {
            $this->_save();
        }

        $data['main_content'] = $this->load->view('main-content/add-edit-movie', $data, TRUE);
        $this->load->view('structure', $data);
    }

    private function _loadMovieByKey($strMovieKey = NULL)
    {
        // No key redirect to homepage
        if (is_null($strMovieKey) or trim($strMovieKey) == '') {
            header('Location: /');
            exit;
        }
        $this->load->model('movie_model');
        $this->movie_model->load($strMovieKey, 'url');
        // No ID return to home page
        if ($this->movie_model->getId() == 0 or is_null($this->movie_model->getId())) {
            header('Location: /');
            exit;
        }

        $data['objMovie'] = $this->movie_model;
    }

    private function _save() {
	    $this->movie_model->setTitle($_POST['title']);
	    $this->movie_model->setFormat($_POST['format']);
	    $this->movie_model->setLength($_POST['length']);
	    $this->movie_model->setReleaseYear($_POST['release_year']);
	    $this->movie_model->save();

	    # Redirect after save.
	    if ($this->movie_model->getId() > 0) {
	        redirect('/movie/'.$this->movie_model->getUrl());
        }
    }

    private function _validateForm()
    {
        if (!count($_POST)) {
            return FALSE;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Movie Title', 'required|max_length[50]');
        $this->form_validation->set_rules('format', 'Movie Format', 'required|in_list[DVD,VHS,Streaming]');
        $this->form_validation->set_rules('length', 'Movie Length', 'required|numeric|greater_than[0]|less_than[500]');
        $this->form_validation->set_rules('release_year', 'Movie Release Date', 'required|numeric|exact_length[4]|greater_than[1800]|less_than[2100]');
        return $this->form_validation->run();
    }
}
