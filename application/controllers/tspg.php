<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tspg extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tlapharpeng';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		$this->load->library('Grocery_CRUD');	
	}

	public function _example_output($output = null)
	{
		$this->load->view('layouts/main', $output );		
	}

	public function index()
	{
		$crud = new grocery_CRUD();
        $crud->set_theme('bootstrap2');
		$crud->set_table('t_spg');
		$crud->set_subject('TSPG');
		$crud->columns("id_petani","nama_petani","kategori","kode_blok","r_spg","persen_10");
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		$crud->callback_column('nama_petani',array($this,'_callback_nama_petani'));
		$crud->callback_column('kategori',array($this,'_callback_kategori'));
		$crud->callback_field('nama_petani',array($this,'field_nama_petani'));
		$crud->callback_field('kategori',array($this,'field_kategori'));
		$crud->field_type('persen_10','dropdown', array('1' => 'YA', '2'=>'TIDAK'));
		$crud->field_type('r_spg','integer');
		$crud->field_type('id_petani','readonly');
		$crud->field_type('kode_blok','readonly');
		$crud->unset_fields('created_at');
	    $state = $crud->getState();
	    if($state == 'list' || $state == 'success')
	    {
			$out['button'] = '<div  style="    text-align: right;">
                				    <a class="btn btn-primary"  id="import">IMPORT</a>  
                			  </div>'; 
	    }
		$out['output'] =  $crud->render();
		$out['title'] = "TSPG";
		$out['style'] = "<style>
							.search-button{
								display:none;
							}
							
						</style>
						<script>
						$('input[name=nama_petani]').hide();
						$('input[name=kategori]').hide();
						//$('input[name=r_spg]').hide();
						$('input[name=persen_10]').hide();
						$('#import').click(function(){
							$(this).attr('disabled','disabled');
						  $.get('tspg/import', function(data, status){
						    alert('Import sukses');
						    location.reload();
						  });
						});
						</script>";
		$out['script'] = '<p id="demo"></p>';
		$this->data['content'] = $this->load->view('tspg/index',$out, true);				
		$this->_example_output($this->data);	
	}

	public function import()
	{
		// $data = $this->db->query("select id_petani_sap as id_petani, kode_blok from sap_field where kepemilikan = 'TS-SP'")->result();
		// foreach ($data as $key => $value) {
		// 	$this->db->insert("t_spg",array("id_petani"=>$value->id_petani, "kode_blok"=>$value->kode_blok));
		// }
		$data = $this->db->query("INSERT ignore t_spg (id_petani, kode_blok) select id_petani_sap as id_petani, kode_blok from sap_field where kepemilikan = 'TS-SP';");
		$count = $this->db->count_all_results();
		if($count == 0){
			redirect('tspg','refresh');		
		}else{
			redirect('tspg','refresh');
		}
	}


	public function _callback_nama_petani($value, $row)
	{
			$data = $this->db->query("select nama_petani from sap_petani where id_petani_sap = '".$row->id_petani."'")->row();
			if (!empty($data->nama_petani)) {
				return $data->nama_petani;
			}else{
				return "-";
			}		
	}

	public function _callback_kategori($value, $row)
	{
			$data = $this->db->query("select kepemilikan from sap_field where kode_blok = '".$row->kode_blok."'")->row();
			if (!empty($data->kepemilikan)) {
				return $data->kepemilikan;
			}else{
				return "-";
			}
		
	}
	
 
}
