<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_art_dtks_pemadanan extends MY_Model {

	private $primary_key 	= 'id_art_dtks_pemadanan';
	private $table_name 	= 'art_dtks_pemadanan';
	private $field_search 	= ['kd_wilayah', 'IDBDT', 'IDARTBDT', 'KDPROP', 'KDKAB', 'KDKEC', 'KDDESA', 'NoPesertaPKH', 'Nama', 'JnsKel', 'TmpLahir', 'TglLahir', 'HubKRT', 'NIK', 'NoKK', 'Hub_KRT', 'NUK', 'Hubkel', 'Umur', 'Sta_kawin', 'Ada_akta_nikah', 'Ada_diKK', 'Ada_kartu_identitas', 'Sta_hamil', 'Jenis_cacat', 'Penyakit_kronis', 'Partisipasi_sekolah', 'Pendidikan_tertinggi', 'Kelas_tertinggi', 'Ijazah_tertinggi', 'Sta_Bekerja', 'Jumlah_jamkerja', 'Lapangan_usaha', 'Status_pekerjaan', 'Sta_keberadaan_art', 'Sta_kepesertaan_pbi', 'Ada_kks', 'Ada_pbi', 'Ada_kip', 'Ada_pkh', 'Ada_BPNT', 'Anak_diluar_rt', 'namagadis_ibukandung', 'Status', 'periode'];

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
		$sortir = $this->input->get('Status');

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "art_dtks_pemadanan.".$field . " LIKE '%" . $q . "%' and art_dtks_pemadanan.KDDESA LIKE '%" . $kd_wilayah . "%' ";
	            } else {
	                $where .= "OR " . "art_dtks_pemadanan.".$field . " LIKE '%" . $q . "%' and art_dtks_pemadanan.KDDESA LIKE '%" . $kd_wilayah . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "art_dtks_pemadanan.".$field . " LIKE '%" . $q . "%' and art_dtks_pemadanan.KDDESA LIKE '%" . $kd_wilayah . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
		if($sortir > 0){
		    $this->db->where('Status',$sortir);
		}
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
		$sortir = $this->input->get('Status');

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "art_dtks_pemadanan.".$field . " LIKE '%" . $q . "%' and art_dtks_pemadanan.KDDESA LIKE '%" . $kd_wilayah . "%' ";
	            } else {
	                $where .= "OR " . "art_dtks_pemadanan.".$field . " LIKE '%" . $q . "%' and art_dtks_pemadanan.KDDESA LIKE '%" . $kd_wilayah . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "art_dtks_pemadanan.".$field . " LIKE '%" . $q . "%' and art_dtks_pemadanan.KDDESA LIKE '%" . $kd_wilayah . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        	if($sortir > 0){
		    $this->db->where('Status',$sortir);
		}
        $this->db->limit($limit, $offset);
        $this->db->order_by('art_dtks_pemadanan.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('wilayah', 'wilayah.kd_wilayah = art_dtks_pemadanan.kd_wilayah', 'LEFT');
        $this->db->join('wilayah wilayah1', 'wilayah1.kd_wilayah = art_dtks_pemadanan.KDPROP', 'LEFT');
        $this->db->join('wilayah wilayah2', 'wilayah2.kd_wilayah = art_dtks_pemadanan.KDKAB', 'LEFT');
        $this->db->join('wilayah wilayah3', 'wilayah3.kd_wilayah = art_dtks_pemadanan.KDKEC', 'LEFT');
        $this->db->join('wilayah wilayah4', 'wilayah4.kd_wilayah = art_dtks_pemadanan.KDDESA', 'LEFT');
        $this->db->join('setup_cacat', 'setup_cacat.value = art_dtks_pemadanan.Jenis_cacat', 'LEFT');
        $this->db->join('setup_penyakit', 'setup_penyakit.value = art_dtks_pemadanan.Penyakit_kronis', 'LEFT');
        $this->db->join('setup_pekerjaan', 'setup_pekerjaan.value = art_dtks_pemadanan.Status_pekerjaan', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_art_dtks_pemadanan.php */
/* Location: ./application/models/Model_art_dtks_pemadanan.php */