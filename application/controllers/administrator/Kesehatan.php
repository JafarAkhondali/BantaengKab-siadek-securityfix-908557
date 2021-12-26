<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kesehatan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('model_kesehatan');
		
	}
    public function index(){
     //data puskesmas
     $data['hit_puskesmas'] = $this->model_kesehatan->hitung_puskesmas();
     $data['hit_posyandu'] = $this->model_kesehatan->hitung_posyandu();
    

     $now = date('Y-m-d');
     $date = date_create($now);
     date_add($date, date_interval_create_from_date_string('-12 year'));
     $range = date_format($date, 'Y-m-d'); 
     $kd_wilayah = get_user_data('kd_wilayah');
     $this->db->select('*');
     $this->db->where('dosis','sudah');
     $this->db->where('tgl_lahir <=',$range);
     $this->db->like('kd_wilayah',$kd_wilayah);
     $query = $this->db->get('view_vaksinasi');


     $this->db->select('*');
     $this->db->where('dosis','belum');
     $this->db->where('tgl_lahir <=',$range);
     $this->db->like('kd_wilayah',$kd_wilayah);
     $query2 = $this->db->get('view_vaksinasi');

     $data['vak_sudah'] = $query->num_rows();;
     $data['vak_belum'] = $query2->num_rows();;



    $this->render('backend/standart/kesehatan', $data);
    }
}
