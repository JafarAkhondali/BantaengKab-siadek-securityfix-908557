<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tbl_disabilitas extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'tbl_disabilitas';
	private $field_search 	= ['nik', 'disabilitas', 'rentan', 'keterangan'];

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
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "tbl_disabilitas.".$field . " LIKE '%" . $q . "%' AND tbl_disabilitas.kd_wilayah= '$kd_wilayah' ";
	            } else {
	                $where .= "OR " . "tbl_disabilitas.".$field . " LIKE '%" . $q . "%' AND tbl_disabilitas.kd_wilayah= '$kd_wilayah'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "tbl_disabilitas.".$field . " LIKE '%" . $q . "%' AND tbl_disabilitas.kd_wilayah= '$kd_wilayah'  )";
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

		$username = get_user_data('username');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "tbl_disabilitas.".$field . " LIKE '%" . $q . "%' AND tbl_disabilitas.kd_wilayah= '$kd_wilayah'  ";
	            } else {
	                $where .= "OR " . "tbl_disabilitas.".$field . " LIKE '%" . $q . "%' AND tbl_disabilitas.kd_wilayah= '$kd_wilayah'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "tbl_disabilitas.".$field . " LIKE '%" . $q . "%' AND tbl_disabilitas.kd_wilayah= '$kd_wilayah'  )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('tbl_disabilitas.'.$this->primary_key, "DESC");
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

/* End of file Model_tbl_disabilitas.php */
/* Location: ./application/models/Model_tbl_disabilitas.php */