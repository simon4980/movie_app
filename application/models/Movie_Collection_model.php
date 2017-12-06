<?php
class Movie_Collection_model extends CI_Model
{
    protected $arrSortValues = array(
        'title' => 'var',
        'format' => 'var',
        'release_year' => 'int',
        'length' => 'int',
    );

    protected $arrColValues = array(
        'id',
        'title',
        'format',
        'release_year',
        'length',
        'url',
    );

    protected $strTable = 'movie';

    protected $arrMovieCollection = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('movie_model');
    }

    public function getMovieCollection()
    {
        return $this->arrMovieCollection;
    }

    public function loadMovies()
    {
        $this->db->select(implode(', ', $this->arrColValues));
        $query = $this->db->get($this->strTable);
        foreach ($query->result() as $row) {
            $objMovie = new Movie_model();
            $objMovie->mapData($row);
            $this->arrMovieCollection[$objMovie->getId()] = $objMovie;
        }
    }

    public function buildSort($strSortBy, $strDirection)
    {
        $strDirection = trim(strtoupper($strDirection));
        $strSortBy = trim(strtolower($strSortBy));

        if ($strDirection != 'ASC' and $strDirection != 'DESC')
        {
            throw new Exception('Sorting direction must be either ASC or DESC');
        }

        if (!array_key_exists($strSortBy, $this->arrSortValues)) {
            throw new Exception(('Sort by key provided not in the approved list'));
        }

        if ($this->arrSortValues[$strSortBy] == 'var') {
            $strSortBy = 'LOWER('.$strSortBy.')';
        }

        $this->db->order_by($strSortBy, $strDirection);


    }
}