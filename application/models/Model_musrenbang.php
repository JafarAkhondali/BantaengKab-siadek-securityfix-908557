<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_musrenbang extends MY_Model {

	private $primary_key 	= 'id_musrenbang';
	private $table_name 	= 'musrenbang';
	private $field_search 	= ['kegitan', 'Lokasi', 'Biaya', 'total', 'berita_acara', 'daftar_hadir', 'notulensi_rapat', 'ket_usulan', 'satatus_program', 'Tahun'];

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

	//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
	$tahun = $this->input->get('tahun');
	
        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "musrenbang.".$field . " LIKE '%" . $q . "%' AND musrenbang.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND musrenbang.Tahun= '$tahun' ";
	            } else {
	                $where .= "OR " . "musrenbang.".$field . " LIKE '%" . $q . "%' AND musrenbang.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND musrenbang.Tahun= '$tahun' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "musrenbang.".$field . " LIKE '%" . $q . "%' AND musrenbang.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND musrenbang.Tahun= '$tahun' )";
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
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
	$tahun = $this->input->get('tahun');
	
        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "musrenbang.".$field . " LIKE '%" . $q . "%' AND musrenbang.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND musrenbang.Tahun= '$tahun'";
	            } else {
	                $where .= "OR " . "musrenbang.".$field . " LIKE '%" . $q . "%' AND musrenbang.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND musrenbang.Tahun= '$tahun'";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "musrenbang.".$field . " LIKE '%" . $q . "%'  AND musrenbang.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND musrenbang.Tahun= '$tahun' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('musrenbang.'.$this->primary_key, "DESC");
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

/* End of file Model_musrenbang.php */
/* Location: ./application/models/Model_musrenbang.php */