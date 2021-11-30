<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_surat_keluar extends MY_Model {

	private $primary_key 	= 'id_surat_keluar';
	private $table_name 	= 'surat_keluar';
	private $field_search 	= ['Nik', 'surat_keluar_nomor', 'surat_keluar_jenis', 'file', 'tanggal_surat'];

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

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "surat_keluar.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "surat_keluar.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "surat_keluar.".$field . " LIKE '%" . $q . "%' )";
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
			if($username=='admin'){
				$kd_wilayah = $this->input->get('kd_wilayah');
			}else{
				$kd_wilayah = get_user_data('kd_wilayah');
			}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "surat_keluar.".$field . " LIKE '%" . $q . "%' and surat_keluar.kd_wilayah= '$kd_wilayah' ";
	            } else {
	                $where .= "OR " . "surat_keluar.".$field . " LIKE '%" . $q . "%' and surat_keluar.kd_wilayah= '$kd_wilayah'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "surat_keluar.".$field . " LIKE '%" . $q . "%'  and surat_keluar.kd_wilayah= '$kd_wilayah'  )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('surat_keluar.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
	}
	
	public function wilayah($kdwilayah)
    {
        $this->db->where('kd_wilayah',$kdwilayah);
        $query = $this->db->get("wilayah");
        return $query->result_array();
	}
	public function cetak($id,$jenis)
    {
		if ($jenis == "timam") {
			$table_name = 'suket_timam';
		} elseif ($jenis == "nikah") {
			$table_name = 'suket_nikah';
		} elseif ($jenis == "bnikah") {
			$table_name = 'suket_bnikah';
		} elseif ($jenis == "kematian") {
			$table_name = 'suket_kematian';
		} elseif ($jenis == "domisili") {
			$table_name = 'suket_domisili';
		}
		
        $this->db->where('id',$id);
        $query = $this->db->get($table_name);
        return $query->result_array();
	}

}

/* End of file Model_surat_keluar.php */
/* Location: ./application/models/Model_surat_keluar.php */