<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kesehatan extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'puskesmas';
	private $field_search 	= ['nik', 'no_kk', 'nama', 'TglLahir'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );
		parent::__construct($config);
	}
	
    public function hitung_puskesmas()
	{
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('puskesmas');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
	}
	
	public function hitung_posyandu()
	{
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('posyandu');
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
	}
	
}