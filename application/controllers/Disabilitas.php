<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Disabilitas Controller
*| --------------------------------------------------------------------------
*| Disabilitas site
*|
*/
class Disabilitas extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_disabilitas');
	}

	/**
	* show all Disabilitass
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('disabilitas_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['disabilitass'] = $this->model_disabilitas->get($filter, $field, $this->limit_page, $offset);
		$this->data['disabilitas_counts'] = $this->model_disabilitas->count_all($filter, $field);

		$config = [
			'base_url'     => 'disabilitas/index/',
			'total_rows'   => $this->model_disabilitas->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Disabilitas List');
		$this->render('modul/disabilitas/disabilitas_list', $this->data);
	}
	
	
	
	/**
	* delete Disabilitass
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('disabilitas_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'disabilitas'), 'success');
        } else {
            set_message(cclang('error_delete', 'disabilitas'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Disabilitass
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('disabilitas_view');

		$this->data['disabilitas'] = $this->model_disabilitas->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Disabilitas Detail');
		$this->render('modul/disabilitas/disabilitas_view', $this->data);
	}
	
	/**
	* delete Disabilitass
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$disabilitas = $this->model_disabilitas->find($id);

		
		
		return $this->model_disabilitas->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('disabilitas_export');

		$this->model_disabilitas->export('disabilitas', 'disabilitas');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('disabilitas_export');

		$this->model_disabilitas->pdf('disabilitas', 'disabilitas');
	}
}


/* End of file disabilitas.php */
/* Location: ./application/controllers/Disabilitas.php */