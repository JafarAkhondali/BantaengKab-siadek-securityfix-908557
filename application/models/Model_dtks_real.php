<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dtks_real extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'dtks_real';
	private $field_search 	= ['nik', 'no_kk', 'nama', 'tempat_lahir', 'tgl_lahir', 'periode'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

		$username = get_user_data('username');
		$periode = $this->input->get('periode');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dtks_real.".$field . " LIKE '%" . $q . "%' AND dtks_real.kd_wilayah= '$kd_wilayah' AND dtks_real.periode= '$periode' ";
	            } else {
	                $where .= "OR " . "dtks_real.".$field . " LIKE '%" . $q . "%' AND dtks_real.kd_wilayah= '$kd_wilayah' AND dtks_real.periode= '$periode'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dtks_real.".$field . " LIKE '%" . $q . "% AND dtks_real.kd_wilayah= '$kd_wilayah' AND dtks_real.periode= '$periode' ' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		//tambahan
		$username = get_user_data('username');
		$periode = $this->input->get('periode');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dtks_real.".$field . " LIKE '%" . $q . "%' AND dtks_real.kd_wilayah= '$kd_wilayah' AND dtks_real.periode= '$periode'  ";
	            } else {
	                $where .= "OR " . "dtks_real.".$field . " LIKE '%" . $q . "%' AND dtks_real.kd_wilayah= '$kd_wilayah' AND dtks_real.periode= '$periode'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dtks_real.".$field . " LIKE '%" . $q . "%' AND dtks_real.kd_wilayah= '$kd_wilayah' AND dtks_real.periode= '$periode'  )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('dtks_real.nama', "ASC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_dtks_real.php */
/* Location: ./application/models/Model_dtks_real.php */