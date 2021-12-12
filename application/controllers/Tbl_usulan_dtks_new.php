<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Usulan Dtks New Controller
*| --------------------------------------------------------------------------
*| Tbl Usulan Dtks New site
*|
*/
class Tbl_usulan_dtks_new extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_usulan_dtks_new');
	}

	/**
	* show all Tbl Usulan Dtks News
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_usulan_dtks_new_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_usulan_dtks_news'] = $this->model_tbl_usulan_dtks_new->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_usulan_dtks_new_counts'] = $this->model_tbl_usulan_dtks_new->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_usulan_dtks_new/index/',
			'total_rows'   => $this->model_tbl_usulan_dtks_new->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tbl Usulan Dtks List');
		$this->render('modul/tbl_usulan_dtks_new/tbl_usulan_dtks_new_list', $this->data);
	}
	
	
	
	/**
	* delete Tbl Usulan Dtks News
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_usulan_dtks_new_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_usulan_dtks_new'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_usulan_dtks_new'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Usulan Dtks News
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_usulan_dtks_new_view');

		$this->data['tbl_usulan_dtks_new'] = $this->model_tbl_usulan_dtks_new->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tbl Usulan Dtks Detail');
		$this->render('modul/tbl_usulan_dtks_new/tbl_usulan_dtks_new_view', $this->data);
	}
	
	/**
	* delete Tbl Usulan Dtks News
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_usulan_dtks_new = $this->model_tbl_usulan_dtks_new->find($id);

		
		
		return $this->model_tbl_usulan_dtks_new->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_usulan_dtks_new_export');

		$this->model_tbl_usulan_dtks_new->export('tbl_usulan_dtks_new', 'tbl_usulan_dtks_new');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_usulan_dtks_new_export');

		$this->model_tbl_usulan_dtks_new->pdf('tbl_usulan_dtks_new', 'tbl_usulan_dtks_new');
	}
}


/* End of file tbl_usulan_dtks_new.php */
/* Location: ./application/controllers/Tbl Usulan Dtks New.php */