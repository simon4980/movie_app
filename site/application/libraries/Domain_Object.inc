<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 12/5/17
 * Time: 1:20 PM
 */
class Domain_Object extends CI_Model
{
    private $id;
    protected $table_name;
    protected $arrOrginalValues = array();


    public function __construct()
    {
        parent::__construct();
    }

    public function getDisplayValue($strKey)
    {
        $strMethodName = 'get'.ucfirst($strKey);
        return $this->security->xss_clean($this->$strMethodName());
    }

    /**
     * Id for table
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Load domain object for movies
     * @param $mixValue
     * @param string $strKey
     */
    public function load($mixValue, $strKey = 'id')
    {
        if (is_null($this->table_name)) {
            throw new Exception('Table must not be blank for loading data');
        }

        $objQuery = $this->db->get_where($this->table_name, array($strKey => $mixValue), 1);
        $arrResults = $objQuery->result();

        if (count($arrResults)) {
            # Set the id first
            $this->id = $arrResults[0]->id;
            unset($arrResults[0]->id);

            foreach ($arrResults[0] as $strDbKey => $mixDbValue) {
                $this->arrTableValues[$strDbKey] = $mixDbValue;
                $this->arrOrginalValues[$strDbKey] = $mixDbValue;
            }
        }
    }

    public function delete()
    {
        $this->db->where('id', $this->getId());
        $this->db->delete($this->table_name);
    }

    public function save()
    {
        if ($this->getId() > 0) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    protected function insert()
    {
        $this->db->insert($this->table_name, $this->arrTableValues);
        $this->id = $this->db->insert_id();
    }

    protected function update()
    {
        $arrDirtyValues = array();
        foreach($this->arrOrginalValues as $strKey => $strValue) {
            if ($strValue != $this->arrTableValues[$strKey]) {
                $arrDirtyValues[$strKey] = $strValue;
            }
        }

        if (count($arrDirtyValues)) {
            if (array_key_exists('updated_date', $this->arrOrginalValues)) {
                $this->arrTableValues['updated_date'] = NULL;
            }
            $this->db->where('id', $this->getId());
            $this->db->update($this->table_name, $this->arrTableValues);
        }
    }
}