<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tbl_bantuan extends MY_Model {

	private $primary_key 	= 'id_art_dtks';
	private $table_name 	= 'art_dtks';
	private $field_search 	= ['no_kk', 'nama_kepala', 'pkh', 'bpnt', 'blt_dd', 'bst'];

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

		// //tambahan
		// $username = get_user_data('username');
		// if($username=='admin'){
		// 	$kd_wilayah = $this->input->get('kd_wilayah');
		// }else{
		// 	$kd_wilayah = get_user_data('kd_wilayah');
		// }

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "art_dtks.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "art_dtks.".$field . " LIKE '%" . $q . "%' ";
	            }
	            if($this->input->get('kip')){
	                $where .= "AND art_dtks.Ada_kip = 1 ";
	            }
	            if($this->input->get('kks')){
	                $where .= "AND art_dtks.Ada_kks = 1 ";
	            }
	            if($this->input->get('pbi')){
	                $where .= "AND art_dtks.Ada_pbi = 1 ";
	            }
	            if($this->input->get('pkh')){
	                $where .= "AND art_dtks.Ada_pkh = 1 ";
	            }
	            if($this->input->get('bpnt')){
	                $where .= "AND art_dtks.Ada_BPNT = 1 ";
	            }
	            
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
            
            if($this->input->get('pkh') || $this->input->get('kip') || $this->input->get('kks') || $this->input->get('pbi') || $this->input->get('bpnt')){
                $where .= "art_dtks.".$field . " LIKE '%" . $q . "%' ";
                 if($this->input->get('kip')){
	                $where .= "AND art_dtks.Ada_kip = 1 ";
	            }
	            if($this->input->get('kks')){
	                $where .= "AND art_dtks.Ada_kks = 1 ";
	            }
	            if($this->input->get('pbi')){
	                $where .= "AND art_dtks.Ada_pbi = 1 ";
	            }
	            if($this->input->get('pkh')){
	                $where .= "AND art_dtks.Ada_pkh = 1 ";
	            }
	            if($this->input->get('bpnt')){
	                $where .= "AND art_dtks.Ada_BPNT = 1 ";
	            }
	           
	            $where = '('.$where.')';
                
            }else {
                	$where .= "(" . "art_dtks.".$field . " LIKE '%" . $q . "%'  )";
            }
        
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        if($this->input->get('disabilitas')){
	                $this->db->where('Jenis_cacat >','0');
	            }
	    if($this->input->get('rentanca')){
	                $this->db->where('Jenis_cacat >','0');
	            }
	   if($this->input->get('rentanlan')){
	                $this->db->where('Umur >','59');
	            }
	   if($this->input->get('rentankro')){
	                $this->db->where('Penyakit_kronis >','0');
	            }
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

		// //tambahan
		// $username = get_user_data('username');
		// if($username=='admin'){
		// 	$kd_wilayah = $this->input->get('kd_wilayah');
		// }else{
		// 	$kd_wilayah = get_user_data('kd_wilayah');
		// }

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "art_dtks.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "art_dtks.".$field . " LIKE '%" . $q . "%'  ";
	            }
	             if($this->input->get('kip')){
	                $where .= "AND art_dtks.Ada_kip = 1 ";
	            }
	            if($this->input->get('kks')){
	                $where .= "AND art_dtks.Ada_kks = 1 ";
	            }
	            if($this->input->get('pbi')){
	                $where .= "AND art_dtks.Ada_pbi = 1 ";
	            }
	            if($this->input->get('pkh')){
	                $where .= "AND art_dtks.Ada_pkh = 1 ";
	            }
	            if($this->input->get('bpnt')){
	                $where .= "AND art_dtks.Ada_BPNT = 1 ";
	            }
	             
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        if($this->input->get('pkh') || $this->input->get('kip') || $this->input->get('kks') || $this->input->get('pbi') || $this->input->get('bpnt')){
                $where .= "art_dtks.".$field . " LIKE '%" . $q . "%' ";
                 if($this->input->get('kip')){
	                $where .= "AND art_dtks.Ada_kip = 1 ";
	            }
	            if($this->input->get('kks')){
	                $where .= "AND art_dtks.Ada_kks = 1 ";
	            }
	            if($this->input->get('pbi')){
	                $where .= "AND art_dtks.Ada_pbi = 1 ";
	            }
	            if($this->input->get('pkh')){
	                $where .= "AND art_dtks.Ada_pkh = 1 ";
	            }
	            if($this->input->get('bpnt')){
	                $where .= "AND art_dtks.Ada_BPNT = 1 ";
	            }
	            
	            $where = '('.$where.')';
                
            }else {
                	$where .= "(" . "art_dtks.".$field . " LIKE '%" . $q . "%'  )";
            }
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        if($this->input->get('disabilitas')){
	                $this->db->where('Jenis_cacat >','0');
	            }
	   if($this->input->get('rentanca')){
	                $this->db->where('Jenis_cacat >','0');
	            }
	   if($this->input->get('rentanlan')){
	                $this->db->where('Umur >','59');
	            }
	   if($this->input->get('rentankro')){
	                $this->db->where('Penyakit_kronis >','0');
	            }
        $this->db->limit($limit, $offset);
        $this->db->order_by('art_dtks.'.$this->primary_key, "DESC");
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

/* End of file Model_tbl_bantuan.php */
/* Location: ./application/models/Model_tbl_bantuan.php */