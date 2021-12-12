<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dtks extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'dtks';
	private $field_search 	= ['no_kk', 'nik', 'nama', 'status_hubungan', 'jenis_cacat', 'penyakit_kronis', 'status'];

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
		$username = get_user_data('username');
		$status = $this->input->get('status');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= '$status' ";
	            } else {
	                $where .= "OR " . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= '$status'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dtks.".$field . " LIKE '%" . $q . "% AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= '$status' ' )";
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
		$status = $this->input->get('status');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= '$status'  ";
	            } else {
	                $where .= "OR " . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= '$status'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= '$status'  )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('dtks.nama', "ASC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
      
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }











//disabilitas



   public function count_all_list($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		//tambahan
		$username = get_user_data('username');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND ( dtks.jenis_cacat> '0' OR dtks.penyakit_kronis> '0')  ";
	            } else {
	                $where .= "OR " . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND ( dtks.jenis_cacat> '0' OR dtks.penyakit_kronis> '0')  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND ( dtks.jenis_cacat> '0' OR dtks.penyakit_kronis> '0')  )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get_list($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		//tambahan
		$username = get_user_data('username');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND ( dtks.jenis_cacat> '0' OR dtks.penyakit_kronis> '0')   ";
	            } else {
	                $where .= "OR " . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND ( dtks.jenis_cacat> '0' OR dtks.penyakit_kronis> '0')     ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND ( dtks.jenis_cacat> '0' OR dtks.penyakit_kronis> '0')     )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('dtks.nama', "ASC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}


	//disabilitas


	//bantuan
   public function count_all_bantuan($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		//tambahan
		$username = get_user_data('username');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND dtks.status_hubungan= '1'   ";
	            } else {
	                $where .= "OR " . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND dtks.status_hubungan= '1'    ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND dtks.status_hubungan= '1'    )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get_bantuan($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		//tambahan
		$username = get_user_data('username');
		if($username=='admin'){
			$kd_wilayah = $this->input->get('kd_wilayah');
		}else{
			$kd_wilayah = get_user_data('kd_wilayah');
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND dtks.status_hubungan= '1'    ";
	            } else {
	                $where .= "OR " . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND dtks.status_hubungan= '1'    ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dtks.".$field . " LIKE '%" . $q . "%' AND dtks.kd_wilayah= '$kd_wilayah' AND dtks.status= 'Terverifikasi' AND dtks.status_hubungan= '1'    )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('dtks.nama', "ASC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

}

/* End of file Model_dtks.php */
/* Location: ./application/models/Model_dtks.php */