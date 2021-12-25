<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_vaksinasi extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'view_vaksinasi';
	private $field_search 	= ['nik', 'no_kk', 'nama', 'tgl_lahir', 'jenis_kelamin', 'alamat'];

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
		if ($this->input->get('status')) {
			$status = $this->input->get('status');
		} else {
			$status = 'Sudah';
		}
		
		


        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "view_vaksinasi.".$field . " LIKE '%" . $q . "%'  AND view_vaksinasi.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND view_vaksinasi.dosis='$status' ";
	            } else {
	                $where .= "OR " . "view_vaksinasi.".$field . " LIKE '%" . $q . "%' AND view_vaksinasi.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND view_vaksinasi.dosis='$status' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "view_vaksinasi.".$field . " LIKE '%" . $q . "%' AND view_vaksinasi.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND view_vaksinasi.dosis='$status'  )";
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
		if ($this->input->get('status')) {
			$status = $this->input->get('status');
		} else {
			$status = 'Sudah';
		}

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "view_vaksinasi.".$field . " LIKE '%" . $q . "%' AND view_vaksinasi.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND view_vaksinasi.dosis='$status' ";
	            } else {
	                $where .= "OR " . "view_vaksinasi.".$field . " LIKE '%" . $q . "%' AND view_vaksinasi.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND view_vaksinasi.dosis='$status' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "view_vaksinasi.".$field . " LIKE '%" . $q . "%' AND view_vaksinasi.kd_wilayah LIKE '%" . $kd_wilayah . "%' AND view_vaksinasi.dosis='$status')";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('view_vaksinasi.'.$this->primary_key, "DESC");
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

/* End of file Model_view_vaksinasi.php */
/* Location: ./application/models/Model_view_vaksinasi.php */