<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Dtks Rumah Tangga Controller
*| --------------------------------------------------------------------------
*| Tbl Dtks Rumah Tangga site
*|
*/
class Tbl_dtks_rumah_tangga extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_dtks_rumah_tangga');
	}

	/**
	* show all Tbl Dtks Rumah Tanggas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_dtks_rumah_tangga_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_dtks_rumah_tanggas'] = $this->model_tbl_dtks_rumah_tangga->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_dtks_rumah_tangga_counts'] = $this->model_tbl_dtks_rumah_tangga->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_dtks_rumah_tangga/index/',
			'total_rows'   => $this->model_tbl_dtks_rumah_tangga->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dtks Rumah Tangga List');
		$this->render('modul/tbl_dtks_rumah_tangga/tbl_dtks_rumah_tangga_list', $this->data);
	}
	
	
	
	/**
	* delete Tbl Dtks Rumah Tanggas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_dtks_rumah_tangga_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_dtks_rumah_tangga'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_dtks_rumah_tangga'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Dtks Rumah Tanggas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_dtks_rumah_tangga_view');

		$this->data['tbl_dtks_rumah_tangga'] = $this->model_tbl_dtks_rumah_tangga->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dtks Rumah Tangga Detail');
		$this->render('modul/tbl_dtks_rumah_tangga/tbl_dtks_rumah_tangga_view', $this->data);
	}
	
	/**
	* delete Tbl Dtks Rumah Tanggas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_dtks_rumah_tangga = $this->model_tbl_dtks_rumah_tangga->find($id);

		
		
		return $this->model_tbl_dtks_rumah_tangga->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_dtks_rumah_tangga_export');

		$this->model_tbl_dtks_rumah_tangga->export('tbl_dtks_rumah_tangga', 'tbl_dtks_rumah_tangga');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_dtks_rumah_tangga_export');

		$this->model_tbl_dtks_rumah_tangga->pdf('tbl_dtks_rumah_tangga', 'tbl_dtks_rumah_tangga');
	}
}


/* End of file tbl_dtks_rumah_tangga.php */
/* Location: ./application/controllers/Tbl Dtks Rumah Tangga.php */