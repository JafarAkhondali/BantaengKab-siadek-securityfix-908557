<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_art_dtks extends MY_Model {

	private $primary_key 	= 'id_art_dtks';
	private $table_name 	= 'art_dtks';
	private $field_search 	= ['kd_wilayah', 'IDBDT', 'IDARTBDT', 'KDPROP', 'KDKAB', 'KDKEC', 'KDDESA', 'NoPesertaPKH', 'Nama', 'JnsKel', 'TmpLahir', 'TglLahir', 'HubKRT', 'NIK', 'NoKK', 'Hub_KRT', 'NUK', 'Hubkel', 'Umur', 'Sta_kawin', 'Ada_akta_nikah', 'Ada_diKK', 'Ada_kartu_identitas', 'Sta_hamil', 'Jenis_cacat', 'Penyakit_kronis', 'Partisipasi_sekolah', 'Pendidikan_tertinggi', 'Kelas_tertinggi', 'Ijazah_tertinggi', 'Sta_Bekerja', 'Jumlah_jamkerja', 'Lapangan_usaha', 'Status_pekerjaan', 'Sta_keberadaan_art', 'Sta_kepesertaan_pbi', 'Ada_kks', 'Ada_pbi', 'Ada_kip', 'Ada_pkh', 'Ada_BPNT', 'Anak_diluar_rt', 'namagadis_ibukandung'];

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
		$sortir = $this->input->get('sortir');
		

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "art_dtks.".$field . " LIKE '%" . $q . "%' and art_dtks.KDDESA  LIKE '%" . $kd_wilayah . "%' ";
	            } else {
	                $where .= "OR " . "art_dtks.".$field . " LIKE '%" . $q . "%' and art_dtks.KDDESA  LIKE '%" . $kd_wilayah . "%'  ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "art_dtks.".$field . " LIKE '%" . $q . "%' and art_dtks.KDDESA  LIKE '%" . $kd_wilayah . "%'  )";
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
	                $where .= "art_dtks.".$field . " LIKE '%" . $q . "%' and art_dtks.KDDESA  LIKE '%" . $kd_wilayah . "%' ";
	            } else {
	                $where .= "OR " . "art_dtks.".$field . " LIKE '%" . $q . "%' and art_dtks.KDDESA  LIKE '%" . $kd_wilayah . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "art_dtks.".$field . " LIKE '%" . $q . "%' and art_dtks.KDDESA  LIKE '%" . $kd_wilayah . "%'  )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
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

/* End of file Model_art_dtks.php */
/* Location: ./application/models/Model_art_dtks.php */