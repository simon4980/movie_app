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


        if (count($_POST) && array_key_exists('movie_id', $_POST) && array_key_exists('rate', $_POST)) {
            $this->vote_model->setMovieId($_POST['movie_id']);
            $this->vote_model->setRate($_POST['rate']);
            $this->vote_model->save();

            $this->load->model('vote_collection_model');
            $this->vote_collection_model->loadVotes($_POST['movie_id']);
            header('Content-Type: application/json');
            echo json_encode(
                array(
                    'success' => TRUE,
                    'vote_count' => $this->vote_collection_model->getNumVotes(),
                    'vote_avg' => $this->vote_collection_model->getRating(),
                )
            );
            exit;
        }
        redirect('/');
        exit;
    }
}


