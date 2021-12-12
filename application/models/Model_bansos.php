<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bansos extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'art_dtks';
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
	
    public function hitung_kks()
	{
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('art_dtks');
        $this->db->where('Ada_kks','1');
        $this->db->like('KDDESA',$kd_wilayah);
        return $this->db->count_all_results();
	}
	
	public function hitung_pbi()
	{
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('art_dtks');
        $this->db->where('Ada_pbi','1');
        $this->db->like('KDDESA',$kd_wilayah);
        return $this->db->count_all_results();
	}

	public function hitung_kip()
	{
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('art_dtks');
        $this->db->where('Ada_kip','1');
        $this->db->like('KDDESA',$kd_wilayah);
        return $this->db->count_all_results();
	}
	
	public function hitung_pkh()
	{
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('art_dtks');
        $this->db->where('Ada_pkh','1');
        $this->db->like('KDDESA', $kd_wilayah);
        return $this->db->count_all_results();
	}
	
	public function hitung_bpnt()
	{
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('art_dtks');
        $this->db->where('Ada_BPNT','1');
        $this->db->like('KDDESA',$kd_wilayah);
        return $this->db->count_all_results();
	}
	
	public function hitung_dis()
	{
	      //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
          $this->db->from('art_dtks');
           $this->db->like('KDDESA', $kd_wilayah);
          $this->db->where_in('Jenis_cacat', array('1','2','3','4','5','6','7','8','9','10','11','12'));
          return $this->db->count_all_results();
	}
	
	public function hitung_ren()
	{
	   //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('art_dtks');
        $this->db->like('KDDESA', $kd_wilayah);
        return $this->db->count_all_results();
	}
	
    public function hitung_JnsKel_l()
	{
	   //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('art_dtks');
        $this->db->where('JnsKel', '1');
        $this->db->like('KDDESA', $kd_wilayah);
        return $this->db->count_all_results();
	}
	
	public function hitung_JnsKel_p()
	{
	   //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
        $this->db->from('art_dtks');
        $this->db->where('JnsKel', '2');
        $this->db->like('KDDESA', $kd_wilayah);
        return $this->db->count_all_results();
	}
	
	
		public function bs_bayi()
	{
	    //tambahan
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-5 year', strtotime(date('Y-m-d'))));
        $this->db->from('art_dtks');
        $this->db->where('TglLahir >=',$date);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function bs_anak()
	{
	    //tambahan
		//tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-14 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-6 year', strtotime(date('Y-m-d'))));
        $this->db->from('art_dtks');
        $this->db->where('TglLahir >=',$date);
        $this->db->where('TglLahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
		public function bs_remaja()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-24 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-15 year', strtotime(date('Y-m-d'))));
        $this->db->from('art_dtks');
        $this->db->where('TglLahir >=',$date);
        $this->db->where('TglLahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
		public function bs_dewasa()
	{
	    //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-44 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-25 year', strtotime(date('Y-m-d'))));
        $this->db->from('art_dtks');
        $this->db->where('TglLahir >=',$date);
        $this->db->where('TglLahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function bs_tua()
	{
	   //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-59 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-45 year', strtotime(date('Y-m-d'))));
        $this->db->from('art_dtks');
        $this->db->where('TglLahir >=',$date);
        $this->db->where('TglLahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
	public function bs_lansia()
	{
	   //tambahan
        $username = get_user_data('id'); 
        $user_gr = get_user_group($username);
        if($user_gr == '1' || $user_gr == '9' || $user_gr == '7'){
            $kd_wilayah = $this->input->get('kd_wilayah');
        }else{
            $kd_wilayah = get_user_data('kd_wilayah');
        }
		$date = date('Y-m-d', strtotime('-130 year', strtotime(date('Y-m-d'))));
		$date2 = date('Y-m-d', strtotime('-60 year', strtotime(date('Y-m-d'))));
        $this->db->from('art_dtks');
        $this->db->where('TglLahir >=',$date);
        $this->db->where('TglLahir <=',$date2);
        $this->db->like('kd_wilayah',$kd_wilayah);
        return $this->db->count_all_results();
        
	}
	
}