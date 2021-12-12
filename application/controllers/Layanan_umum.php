<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Posyandu Controller
*| --------------------------------------------------------------------------
*| Posyandu site
*|
*/
class Layanan_umum extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* show all Layanan Umum
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('Layananan_Umum_list');
		$status = $this->input->get('Status');
		$data = array(
		"token" => "9876543210",
		"user" => "infokom",
		"proses" => $status,
		
	);
	 $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://10.73.3.200:8182/silacak/public/api/v1/layanan/umum');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/json')); 
	$result = curl_exec($ch);
	$respon = json_decode($result,true);

		$this->data['layanan_umums'] = $respon['0']['response']['data'];
		// return $respon['0']['response']['data'];
		$this->data['layanan_umum_counts'] = '10';
		// $this->data['pagination'] = $this->pagination($config);

		$this->template->title('Layanan Umum');
		$this->render('modul/layanan/layanan_umum',$this->data);
	}
	


	public function view($id)
	{
		$this->is_allowed('posyandu_view');

		$this->data['posyandu'] = $this->model_posyandu->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Posyandu Detail');
		$this->render('modul/posyandu/posyandu_view', $this->data);
	}
	
}
