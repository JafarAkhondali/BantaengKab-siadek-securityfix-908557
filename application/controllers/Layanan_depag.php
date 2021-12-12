<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Posyandu Controller
*| --------------------------------------------------------------------------
*| Posyandu site
*|
*/
class Layanan_depag extends Admin	
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

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Layanan Depag');
		$this->render('modul/layanan/layanan_depag');
	}
	


	public function view($id)
	{
		$this->is_allowed('posyandu_view');

		$this->data['posyandu'] = $this->model_posyandu->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Posyandu Detail');
		$this->render('modul/posyandu/posyandu_view', $this->data);
	}
	
}
