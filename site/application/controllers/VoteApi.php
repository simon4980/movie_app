<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VoteApi extends CI_Controller {

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

        $this->load->model('vote_model');


//        if (count($_POST) && array_key_exists('movie_id', $_POST) && array_key_exists('rate', $_POST)) {
            $this->vote_model->setMovieId(1);
//            $this->vote_model->setSessionId($strCookieValue);
            $this->vote_model->setRate(1);
            $this->vote_model->save();

            exit;
//        }
        exit;
    }
}


