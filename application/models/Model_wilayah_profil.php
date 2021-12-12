<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_wilayah_profil extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'wilayah_profil';
	private $field_search 	= ['alamat_kantor', 'luas', 'sejarah', 'tahun_pembentukan', 'kd_pos', 'tipologi', 'lokasi', 'visi_misi'];

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
        $tahun = $this->input->get('tahun');
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "wilayah_profil.".$field . " LIKE '%" . $q . "%' AND wilayah_profil.kd_wilayah='$kd_wilayah' ";
	            } else {
	                $where .= "OR " . "wilayah_profil.".$field . " LIKE '%" . $q . "%' AND  wilayah_profil.kd_wilayah='$kd_wilayah'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "wilayah_profil.".$field . " LIKE '%" . $q . "%' AND  wilayah_profil.kd_wilayah='$kd_wilayah'  )";
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
        $tahun = $this->input->get('tahun');
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "wilayah_profil.".$field . " LIKE '%" . $q . "%' AND  wilayah_profil.kd_wilayah='$kd_wilayah'  ";
	            } else {
	                $where .= "OR " . "wilayah_profil.".$field . " LIKE '%" . $q . "%' AND  wilayah_profil.kd_wilayah='$kd_wilayah'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "wilayah_profil.".$field . " LIKE '%" . $q . "%' AND  wilayah_profil.kd_wilayah='$kd_wilayah'  )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('wilayah_profil.'.$this->primary_key, "DESC");
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

/* End of file Model_wilayah_profil.php */
/* Location: ./application/models/Model_wilayah_profil.php */