<?php
class Vote_Collection_model extends CI_Model
{
    protected $strTable = 'movie_rating';
    protected $intNumVotes;
    protected $intTotalVotes;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get Number of votes
     * @return mixed
     */
    public function getNumVotes()
    {
        return $this->intNumVotes;
    }

    /**
     * Return total votes
     * @return mixed
     */
    public function getTotalVotes()
    {
        return $this->intTotalVotes;
    }

    /**
     * Calc rating
     * @return mixed
     */
    public function getRating()
    {
        if ($this->intNumVotes > 0 && $this->intTotalVotes > 0) {
            return round($this->intTotalVotes/$this->intNumVotes);
        }
    }


    public function loadVotes($intMovieId)
    {
        if ($intMovieId > 0) {
            $this->db->select('SUM(rate) as sum_rate, count(id) as num_votes');
            $this->db->from($this->strTable);
            $this->db->where('movie_id', $intMovieId);
            $query = $this->db->get();
            $arrResult = $query->result();
            if (count($arrResult)) {
                $this->intNumVotes = $arrResult[0]->num_votes;
                $this->intTotalVotes = $arrResult[0]->sum_rate;
            }
        } else {
            throw new Exception('Movie id must be an int');
        }
    }
}