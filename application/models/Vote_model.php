<?php
require_once APPPATH.'/libraries/Domain_Object.inc';

class Vote_model extends Domain_Object
{


    protected $arrTableValues = array(
        'movie_id' => NULL,
        'session_id' => NULL,
        'rate' => NULL,
    );


    protected $table_name = 'movie_rating';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
    }

    /**
     * Get vote associated movie id
     * @return mixed
     */
    public function getMovieId()
    {
        return $this->arrTableValues['movie_id'];
    }

    /**
     * Get rated value
     * @return mixed
     */
    public function getRate()
    {
        return $this->arrTableValues['rate'];
    }

    /**
     * Get Session id
     * @return mixed
     */
    public function getSessionId()
    {
        if (is_null($this->arrTableValues['session_id'])) {
            $this->setSessionId();
        }

        return $this->arrTableValues['session_id'];
    }

    /**
     * Only insert, can't change votes
     */
    public function save()
    {
        if (
            $this->getSessionId() &&
            $this->getMovieId() &&
            is_null($this->getId()) &&
            $this->hasVoted() == FALSE
        ) {
            $this->insert();
        }
    }

    /**
     * Set movie id
     * @param $intMovieId
     * @return bool
     */
    public function setMovieId($intMovieId)
    {
        if ($intMovieId > 0) {
            $this->arrTableValues['movie_id'] = $intMovieId;
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Set Rating
     * @param $intRating
     * @return bool
     */
    public function setRate($intRating)
    {
        if ($intRating > 0 && $intRating <= 5) {
            $this->arrTableValues['rate'] = $intRating;
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Store user session
     */
    protected function setSessionId() {
        $strCookieValue = get_cookie('vt');

        if (is_null($strCookieValue)) {
            $this->arrTableValues['session_id'] = md5(uniqid().microtime());
            set_cookie('vt', $this->arrTableValues['session_id'], 2592000);
        } else {
            $this->arrTableValues['session_id'] = $strCookieValue;
        }
    }
    /**
     * Do not allow updated votes.
     */
    protected function update()
    {
        return;
    }

    /**
     * Check to see if the user has voted.
     * @return bool
     */
    public function hasVoted()
    {
        $this->db->select('id');
        $this->db->from($this->table_name);
        $this->db->where('session_id', $this->getSessionId());
        $this->db->where('movie_id', $this->getMovieId());
        $query = $this->db->get();

        if (count($query->result())) {
            return TRUE;
        }

        return FALSE;
    }

}