<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Dtks Individu Controller
*| --------------------------------------------------------------------------
*| Tbl Dtks Individu site
*|
*/
class Tbl_dtks_individu extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_dtks_individu');
	}

	/**
	* show all Tbl Dtks Individus
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_dtks_individu_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_dtks_individus'] = $this->model_tbl_dtks_individu->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_dtks_individu_counts'] = $this->model_tbl_dtks_individu->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_dtks_individu/index/',
			'total_rows'   => $this->model_tbl_dtks_individu->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('DTKS INDIVIDU List');
		$this->render('modul/tbl_dtks_individu/tbl_dtks_individu_list', $this->data);
	}
	
	
	
	/**
	* delete Tbl Dtks Individus
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_dtks_individu_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_dtks_individu'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_dtks_individu'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Dtks Individus
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_dtks_individu_view');

		$this->data['tbl_dtks_individu'] = $this->model_tbl_dtks_individu->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('DTKS INDIVIDU Detail');
		$this->render('modul/tbl_dtks_individu/tbl_dtks_individu_view', $this->data);
	}
	
	/**
	* delete Tbl Dtks Individus
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_dtks_individu = $this->model_tbl_dtks_individu->find($id);

		
		
		return $this->model_tbl_dtks_individu->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_dtks_individu_export');

		$this->model_tbl_dtks_individu->export('tbl_dtks_individu', 'tbl_dtks_individu');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_dtks_individu_export');

		$this->model_tbl_dtks_individu->pdf('tbl_dtks_individu', 'tbl_dtks_individu');
	}
}


/* End of file tbl_dtks_individu.php */
/* Location: ./application/controllers/Tbl Dtks Individu.php */