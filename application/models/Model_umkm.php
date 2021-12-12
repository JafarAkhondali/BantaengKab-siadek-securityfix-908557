<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_umkm extends MY_Model {

	private $primary_key 	= 'id_umkm';
	private $table_name 	= 'umkm';
	private $field_search 	= ['nama_pelaku_usaha', 'nik', 'jenis_kelamin', 'pr', 'js', 'pd', 'wr', 'bd', 'jenis_usaha', 'manusia', 'alam', 'lahan_bagunan', 'mesin_alat', 'finansial', 'ket_finansial', 'pasar', 'mitra', 'lokasi', 'bentuk_org', 'kegiatan', 'mulai_usaha', 'moral', 'aturan'];

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

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "umkm.".$field . " LIKE '%" . $q . "%'   AND umkm.kd_wilayah LIKE '%" . $kd_wilayah . "%' ";
	            } else {
	                $where .= "OR " . "umkm.".$field . " LIKE '%" . $q . "%' AND umkm.kd_wilayah LIKE '%" . $kd_wilayah . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "umkm.".$field . " LIKE '%" . $q . "%' )";
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

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "umkm.".$field . " LIKE '%" . $q . "%' AND umkm.kd_wilayah LIKE '%" . $kd_wilayah . "%' ";
	            } else {
	                $where .= "OR " . "umkm.".$field . " LIKE '%" . $q . "%' AND umkm.kd_wilayah LIKE '%" . $kd_wilayah . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "umkm.".$field . " LIKE '%" . $q . "%'  AND umkm.kd_wilayah LIKE '%" . $kd_wilayah . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('umkm.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('wilayah', 'wilayah.kd_wilayah = umkm.kd_wilayah', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_umkm.php */
/* Location: ./application/models/Model_umkm.php */