<?php
require APPPATH.'/libraries/Domain_Object.inc';

class Movie_model extends Domain_Object
{

//    protected $title;
//    protected $format;
//    protected $length;
//    protected $release_year;
//    protected $url;

    protected $arrTableValues = array(
        'title' => NULL,
        'format' => NULL,
        'length' => NULL,
        'release_year' => NULL,
        'url' => NULL,
    );

    protected $arrFormats = array('DVD', 'VHS', 'Streaming');

    protected $table_name = 'movie';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get movie format dvd, vhs, etc
     * @return mixed
     */
    public function getFormat()
    {
        return $this->arrTableValues['format'];
    }

    /**
     * Length of movie in minutes
     * @return mixed
     */
    public function getLength()
    {
        return $this->arrTableValues['length'];
    }

    public function getReleaseYear()
    {
        return $this->arrTableValues['release_year'];
    }

    /**
     * Get Movie title
     * @return mixed
     */
    public function getTitle()
    {
        return $this->arrTableValues['title'];
    }

    /**
     * Get movie url
     * @return mixed
     */
    public function getUrl()
    {
        return $this->arrTableValues['url'];
    }

    /**
     * Set movie format dvd, vhs, etc
     * @param string $strFormat
     */
    public function setFormat($strFormat = '')
    {
        if (in_array($strFormat, $this->arrFormats)) {
            $this->arrTableValues['format'] = $strFormat;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Set movie length in minutes
     * @param int $intLength
     */
    public function setLength($intLength = 0)
    {
        if (preg_match('/^\d{1,3}$/', $intLength)) {
            $this->arrTableValues['length'] = $intLength;
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Set movie year (4 digits)
     * @param $intYear
     */
    public function setReleaseYear($intYear)
    {
        if (preg_match('/^\d{4}$/', $intYear)) {
            $this->arrTableValues['release_year'] = $intYear;
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Set Movie title
     * @param string $strTitle
     */
    public function setTitle($strTitle = '')
    {
        if (strlen($strTitle) >= 1 || strlen($strTitle) <= 50 || strlen(htmlspecialchars($strTitle, ENT_NOQUOTES)) == strlen($strTitle)) {
            print('Setting Title');
            $this->arrTableValues['title'] = $strTitle;
            $this->setUrl($strTitle);
            return TRUE;
        }

        return FALSE;
    }

    /**
     *  Set Url based off of title.
     * @param  string $strTitle
     */
    protected function setUrl($strTitle)
    {
        $strTitle = str_replace(' ', '-', $strTitle);
        $this->arrTableValues['url'] = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $strTitle));
    }

}