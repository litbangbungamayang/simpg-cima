<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Telgil extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'telgil';
	public $per_page	= '10';
	public $idx			= '';
	private $namapg     = CNF_PLANCODE;

	function __construct() {
		parent::__construct();
		
		$this->load->model('telgilmodel');
		$this->load->model('crud_model');
		$this->load->library('Grocery_CRUD');
		$this->load->model('telgilmodel');
		$this->model = $this->telgilmodel;
		$idx = $this->model->primaryKey;
				error_reporting(0);	
		// $this->info = $this->model->makeInfo( $this->module);
		// $this->access = $this->model->validAccess($this->info['id']);	
		// $this->data = array_merge( $this->data, array(
		// 	'pageTitle'	=> 	$this->info['title'],
		// 	'pageNote'	=>  $this->info['note'],
		// 	'pageModule'	=> 'telgil',
		// ));
		// $this->col = array();
		// $this->con = array();
		// $inf = $this->info['config']['grid'];
		// $inf = SiteHelpers::array_sort($inf, 'sortlist', SORT_ASC);
		// $in=0;
		// foreach ($inf as $key => $t) {
		// 	if($t['view'] =='1'){
				
		// 		$in++;
		// 		$this->col[$in] = $t['field'];
		// 		$this->con[$in] = $t['conn'];
				
		// 	}
			
		// }
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
	}


	// function index() 
	// {
	// 	if($this->access['is_view'] ==0)
	// 	{ 
	// 		$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
	// 		redirect('dashboard',301);
	// 	}	
		
	// 	$this->data['tableGrid'] 	= $this->info['config']['grid'];

	// 	// Group users permission
	// 	$this->data['access']		= $this->access;
	// 	// Render into template
		
	// 	$this->data['content'] = $this->load->view('telgil/index',$this->data, true );
		
 //    	$this->load->view('layouts/main', $this->data );
    
	  
	// }
	

	public function _example_output($output = null)
	{
		$this->load->view('layouts/main', $output );		
	}

	public function index()
	{
		$crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
        $crud->set_primary_key('id','vw_telgil_status');
		$crud->set_table('vw_telgil_status');
		$crud->set_subject('Telgil');
		$crud->columns('AKSI','KATEGORI','PERIODE','UNIT','STATUS');
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_read();
		$crud->unset_export();
		$crud->unset_delete();
		$crud->unset_print();
		$crud->where('UNIT',$this->namapg);
		$crud->order_by('PERIODE','DESC');
		$crud->callback_column('STATUS',array($this,'callback_status'));
		$crud->callback_column('AKSI',array($this,'callback_aksi'));
		$out['output'] =  $crud->render();
		$out['title'] = "Download Template";
		$out['style'] = "<style>
						</style>
						<script>
				function myFunction(kat,id) {
				    if (confirm('Hapus Data!')) {
					    delete_telgil(kat,id);
				    } else {
				    }
				}
				function delete_telgil(kat,id)
				{
					$.ajax({
                        url : '".site_url('telgil/remove_telgil')."/'+kat+'/'+id,
                        type: 'GET',
                        dataType: 'html',
                        success: function(data)
                        {
							alert(data);
							location.reload();	
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert(textStatus);
                        }
                        });
				}
				</script>";
		$out['script'] = '<p id="demo"></p>';
		$this->data['content'] = $this->load->view('telgil/index',$out, true);				
		$this->_example_output($this->data);	
	}

	


	public function template(){
		$crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
      	$crud->set_primary_key('id', 'vw_template');
		$crud->set_table('vw_template');
		$crud->set_subject('Template Excel');
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->unset_read();
		$crud->unset_export();
		$crud->unset_print();
		$crud->callback_column('download',array($this,'callback_download'));

		$data['output'] =  $crud->render();
		$data['title'] = "Download Template";
		$data['style'] = "<style>
						</style>
						</script>";
		$data['script'] = '<p id="demo"></p>';				
		$this->data['content'] = $this->load->view('telgil/index',$data, true);				
		$this->_example_output($this->data);
	}

	public function callback_status($value, $row)
	{
		return "<span style='color:green;font-weight: bold;'>UPLOADED</span>";
	}

	public function callback_aksi($value, $row)
	{
		if ($row->KATEGORI == "Evaluasi") {
			$kat = 1;
		}else{
			$kat = 2;
		}
		return "<a href='#' onclick='myFunction(".$kat.",".$row->ID.")' class='btn btn-danger'><i class='fa fa-trash'></i></a>";
	}

	public function remove_telgil($kat, $id)
	{
		if ($kat == 1) {
			$this->crud_model->delete("telgil_evaluasi",array("ID"=>$id));
		}else{
			$this->crud_model->delete("telgil_produksi",array("ID"=>$id));
			$this->crud_model->delete("telgil_fabrikasi",array("ID"=>$id));
			$this->crud_model->delete("telgil_rincian_gula",array("ID"=>$id));
		}
		echo "Hapus Sukses!";
	}

	public function callback_download($value, $row)
	{
		if ($row->id == 1) {
			$file = "telgil.xlsx";
		}else{
			$file = "evaluasi.xlsx";
		}
    	$this->load->library("excel");
		$inputFileName = './assets/uploads/files/'.$file;
		$select = $this->db->query('select awal_giling from tb_setting')->result(); 
		//  Read your Excel workbook
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);

	   		$sheet = $objPHPExcel->getSheet(0);
	   		if ($row->id == 1) {
	   			$sheet->getCell('B2')->setValue('LAPORAN TELEGRAM GILING TAHUN '.date('Y'));
				$sheet->getCell('C4')->setValue($this->namapg);	
				$sheet->getCell('D6')->setValue($select[0]->awal_giling);	
	   		}else{
	   			$sheet->getCell('C4')->setValue('LAPORAN EVALUASI GILING TAHUN '.date('Y'));
				$sheet->getCell('D6')->setValue($this->namapg);	
	   		}
				
	 		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,  'Excel2007');
			$objWriter->save($inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		return "<a href='".base_url('assets/uploads/files/'.$file)."'>Download</a>";
	}

	public function report_telgil()
	{
		$crud = new grocery_CRUD();
		$state = $crud->getState();	
        $crud->set_theme('flexigrid');
		$crud->set_table('export_template');
		$crud->field_type('KATEGORI','dropdown', array('1'=>'Produksi','2'=>'Evaluasi'));
		$data['output'] =  $crud->render();
		$data['title'] = "Laporan Produksi";
		$data['style'] = "<style>
							// #save-and-go-back-button{
						 //        display: none;
						 //      }
								#cancel-button{
							        display: block;
							      }
						</style>
						<script>
							$('#form-button-save').prop('type', 'button');
							$('#form-button-save').attr('id','show');
							$('#form-button-save').val('Show');

							$('#cancel-button').prop('type', 'button');
							$('#cancel-button').attr('id','print');
							$('#print').val('Cetak');

							$('#save-and-go-back-button').prop('type', 'button');
							$('#save-and-go-back-button').val('Excel');
							$('#save-and-go-back-button').attr('id','excel');

							$('#show').attr('class','btn btn-primary');
							$('#excel').attr('class','btn btn-success');
							$('#print').attr('class','btn btn-default');
							$('#show').val('Show');
							$('#show').click(myFunction2);
							$('#excel').click(myFunctionexcel);
							$('#print').click(printContent);
							function myFunction2() {
								var kategori = $('#field-KATEGORI').val();
								var periode = $('#field-PERIODE').val();
								var kat = '';
								if (kategori == 1) {
									kat = 'get_report_produksi';
								}else{
									kat = 'get_report_evaluasi';
								}
								$('#show').attr('disabled',true);
									$.ajax({
		                                url : '".site_url("telgil/")."/'+kat+'?periode='+periode+'&excel=0&kat='+kategori,
		                                type: 'GET',
		                                dataType: 'html',
		                                success: function(data)
		                                {
		                                	$('#show').attr('disabled',false);
		                                	$('#konten').html(data);	
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#show').attr('disabled',false);
		                                    alert(textStatus);
		                                }
		                                });
							}

							function myFunctionexcel() {
								var kategori = $('#field-KATEGORI').val();
								var periode = $('#field-PERIODE').val();
								var kat = '';
								if (kategori == 1) {
									kat = 'get_report_produksi';
								}else{
									kat = 'get_report_evaluasi';
								}
								$('#show').attr('disabled',true);
		                                var url = '".site_url("telgil/")."/'+kat+'?periode='+periode+'&excel=1&kat='+kategori;
		                                window.open(url);
							}
							 function printContent() {
 									var kategori = $('#field-KATEGORI').val();
									var periode = $('#field-PERIODE').val();
									var kat = '';
									if (kategori == 1) {
										kat = 'get_report_produksi';
									}else{
										kat = 'get_report_evaluasi';
									}
									$.ajax({
									url : '".site_url("telgil/")."/'+kat+'?periode='+periode+'&excel=0&kat='+kategori,
									type: 'GET',
									dataType: 'html',
									success: function(data)
									{
										$('#show').attr('disabled',false);
										$('#konten').html(data);
									   var printContents = document.getElementById('report').innerHTML;
							           var originalContents = document.body.innerHTML;

							           document.body.innerHTML = printContents;

							           window.print();
							           location.reload();	
									},
									error: function (jqXHR, textStatus, errorThrown)
									{
										$('#show').attr('disabled',false);
									    alert(textStatus);
									}
									});
					      }
						</script>";
		$data['script'] = '<p id="demo"></p>';				
		$this->data['content'] = $this->load->view('telgil/index',$data, true);				
		$this->_example_output($this->data);
	}

	public function get_report_produksi()
	{
		$tgl1 = DateTime::createFromFormat('d/m/Y', $this->input->get('periode'));
		$periode = $tgl1->format('Y-m-d');
		if($this->input->get('excel') == 1){
			$file = "Laporan Telgil Produksi - Periode ".date_format(date_create($periode, "d-m-Y")).".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		}
		$data['unit'] = $this->db->query('select namapg from masterpg where kode = "'.$this->namapg.'"')->result();
		$data['produksi'] = $this->db->query('select * from telgil_produksi where UNIT = "'.$this->namapg.'" AND PERIODE="'.$periode.'"')->result();
		$data['fabrikasi'] = $this->db->query('select * from telgil_fabrikasi where UNIT = "'.$this->namapg.'" AND PERIODE="'.$periode.'"')->result();
		$data['rincian_gula'] = $this->db->query('select * from telgil_rincian_gula where UNIT = "'.$this->namapg.'" AND PERIODE="'.$periode.'"')->result();
		$this->load->view('telgil/laporan_produksi', $data);	
	}

	public function get_report_evaluasi()
	{
		$tgl1 = DateTime::createFromFormat('d/m/Y', $this->input->get('periode'));
		$periode = $tgl1->format('Y-m-d');
		if($this->input->get('excel') == 1){
			$file = "Laporan Telgil Evaluasi - Periode ".date_format(date_create($periode, "d-m-Y")).".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		}
		$data['unit'] = $this->db->query('select namapg from masterpg where kode = "'.$this->namapg.'"')->result();
		$data['evaluasi'] = $this->db->query('select * from telgil_evaluasi where UNIT = "'.$this->namapg.'" AND PERIODE="'.$periode.'"')->result();
		$this->load->view('telgil/laporan_evaluasi', $data);	
	}

	public function import_produksi()
	{
		$this->config->grocery_crud_file_upload_allow_file_types         = 'xls|xlsx';
        $this->config->grocery_crud_file_upload_max_file_size             = '20MB';
		$crud = new grocery_CRUD();
		$state = $crud->getState();	
        $crud->set_theme('flexigrid');
		$crud->set_table('import_template');
		$crud->set_field_upload('file','assets/uploads/files');
		$crud->set_lang_string('insert_success_message',
						         'Your data has been successfully stored into the database.<br/>Please wait...
						         <script type="text/javascript">
						                window.setTimeout(function(){
								        window.location = "'.site_url('v1/'.strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'/add";
								    }, 2000);
						         </script>
						         <div style="display:none">'
						   		);
		$crud->callback_field('unit',array($this,'field_callback_unit'));
		$data['output'] =  $crud->render();
		// $data['output'] =  "<p id='demo'></p><input name='file' type='file' id='fileinput'><button type='button'  onclick='myFunction()' id='proses'>Proses</button>";
		$data['title'] = "Import Excel";
		$data['style'] = "<style>
							#save-and-go-back-button{
						        display: block;
						      }
						    #cancel-button{
						      display:none;
						    }  
						</style>
						<script>
							$('#save-and-go-back-button').prop('type', 'button');
							$('#save-and-go-back-button').val('Show');
							$('#save-and-go-back-button').attr('id','cek');
							$('#form-button-save').prop('type', 'button');
							$('#form-button-save').attr('id','simpan');
							$('#form-button-save').val('Simpan');
							$('#simpan').attr('class','btn btn-primary');
							$('#cek').attr('class','btn btn-warning');
							$('#cek').click(myFunction2);
							function myFunction2() {
								$('#cek').attr('disabled',true);
									var x =$('input[name=file]').val();
								    // document.getElementById('demo').innerHTML = x;
								    // window.open('".site_url("telgil/")."/readexcel?file='+x+'&method=read', '_blank');
									$.ajax({
		                                url : '".site_url("telgil/")."/readexcel?file='+x+'&method=read',
		                                type: 'GET',
		                                dataType: 'html',
		                                success: function(data)
		                                {
		                                	$('#cek').attr('disabled',false);
		                                	$('#konten').html(data);	
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#cek').attr('disabled',false);
		                                    alert(textStatus);
		                                }
		                                });
							}
							$('#simpan').click(myFunction3);
							function myFunction3() {
								$('#simpan').attr('disabled',true);
									var x =$('input[name=file]').val();
								    // document.getElementById('demo').innerHTML = x;
								    // window.open('".site_url("telgil/")."/saveexcel?file='+x+'&method=read', '_blank');
					

									$.ajax({
		                                url : '".site_url("telgil/")."/saveexcel?file='+x+'&method=read',
		                                type: 'GET',
		                                dataType: 'text',
		                                success: function(data)
		                                {
		                                	$('#simpan').attr('disabled',false);
		                                	alert('SIMPAN SUKSES');	
		                                	location.reload();
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#simpan').attr('disabled',false);
		                                    alert('Error Simpan: Data yang akan disimpan terdapat periode yang sama');
		                                }
		                                });
							}
						</script>";
		$data['script'] = '<p id="demo"></p>';				
		$this->data['content'] = $this->load->view('telgil/index',$data, true);				
		$this->_example_output($this->data);				
	}

	public function import_evaluasi()
	{
		$this->config->grocery_crud_file_upload_allow_file_types         = 'xls|xlsx';
        $this->config->grocery_crud_file_upload_max_file_size             = '20MB';
		$crud = new grocery_CRUD();
		$state = $crud->getState();	
        $crud->set_theme('flexigrid');
		$crud->set_table('import_template');
		$crud->set_field_upload('file','assets/uploads/files');
		$crud->set_lang_string('insert_success_message',
						         'Your data has been successfully stored into the database.<br/>Please wait...
						         <script type="text/javascript">
						                window.setTimeout(function(){
								        window.location = "'.site_url('v1/'.strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'/add";
								    }, 2000);
						         </script>
						         <div style="display:none">'
						   		);
		$crud->callback_field('unit',array($this,'field_callback_unit'));
		$data['output'] =  $crud->render();
		// $data['output'] =  "<p id='demo'></p><input name='file' type='file' id='fileinput'><button type='button'  onclick='myFunction()' id='proses'>Proses</button>";
		$data['title'] = "Import Excel";
		$data['style'] = "<style>
							#save-and-go-back-button{
						        display: block;
						      }
				      	  #cancel-button{
					        display: none;
					      }
						</style>
						<script>
							$('#save-and-go-back-button').prop('type', 'button');
							$('#save-and-go-back-button').val('Show');
							$('#save-and-go-back-button').attr('id','cek');
							$('#form-button-save').prop('type', 'button');
							$('#form-button-save').attr('id','simpan');
							$('#form-button-save').val('Simpan');
							$('#simpan').attr('class','btn btn-primary');
							$('#cek').attr('class','btn btn-warning');
							$('#cek').click(myFunction2);
							function myFunction2() {
								$('#cek').attr('disabled',true);
									var x =$('input[name=file]').val();
								    // document.getElementById('demo').innerHTML = x;
								    // window.open('".site_url("telgil/")."/readexcelevaluasi?file='+x+'&method=read', '_blank');
									$.ajax({
		                                url : '".site_url("telgil/")."/readexcel?file='+x+'&method=read',
		                                type: 'GET',
		                                dataType: 'html',
		                                success: function(data)
		                                {
		                                	$('#cek').attr('disabled',false);
		                                	$('#konten').html(data);	
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#cek').attr('disabled',false);
		                                    alert(textStatus);
		                                }
		                                });
							}
							$('#simpan').click(myFunction3);
							function myFunction3() {
								$('#simpan').attr('disabled',true);
									var x =$('input[name=file]').val();
								    // document.getElementById('demo').innerHTML = x;
								    // window.open('".site_url("telgil/")."/saveexcelevaluasi?file='+x+'&method=read', '_blank');
									$.ajax({
		                                url : '".site_url("telgil/")."/saveexcelevaluasi?file='+x+'&method=read',
		                                type: 'GET',
		                                dataType: 'text',
		                                success: function(data)
		                                {
		                                	$('#simpan').attr('disabled',false);
		                                	alert('SIMPAN SUKSES');	
		                                	location.reload();
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#simpan').attr('disabled',false);
		                                    alert(textStatus);
		                                }
		                                });
							}
						</script>";
		$data['script'] = '<p id="demo"></p>';
		$this->data['content'] = $this->load->view('telgil/index',$data, true);				
		$this->_example_output($this->data);	
	}

	function field_callback_unit($value = '', $primary_key = null)
	{
		return '<input type="text"  value="'.$this->namapg.'" name="unit" readonly="true" style="width:200px">';
	}
	public function downloadExcel()
    {  
        //load librarynya terlebih dahulu
        //jika digunakan terus menerus lebih baik load ini ditaruh di auto load
        $this->load->library("excel");
		        // Create new PHPExcel object
        $dok = $this->input->get('dok');
        $pab = $this->input->get('pab');
        $per = $this->input->get('per');

        $orderdate = explode('/', $per);
		$month = $orderdate[1];
		$day   = $orderdate[0];


		$year  = $orderdate[2];
		
		$date_per = $year.'-'.$month.'-'.$day;
		$v = "";
		if ($dok == 'ha_digiling' || $dok == 'ha_belum_digiling' || $dok == 'tebu_digiling' || $dok == 'hablur_digiling') {
        	$dataDok = 'ha_digiling';
        	if ($dok == 'ha_digiling') {
        		$v = "v1";
        	}else if ($dok == 'ha_belum_digiling') {
        		$v = "v2";
        	}else if ($dok == 'tebu_digiling') {
        		$v = "v3";
        	}else if ($dok == 'hablur_digiling') {
        		$v = "v4";
        	}
        	$u = "_v1";
        }else if ($dok == 'data_produksi') {
        	$dataDok = 'data_produksi_rev';
        	$u = "";
        	$sub = "_rev";
        }else if ($dok == 'rincian_gula') {
        	$dataDok = 'rincian_gula_rev';
        	$u = "";
        	$sub = "_rev";
        }
        $result = $this->crud_model->select('vw_'.$dataDok, 'COLUMN_NAME')->result();
        $data = $this->crud_model->select($dataDok, '*',array('TGL_LAP'.$u=>$date_per))->result();

		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Hendrik")
									 ->setLastModifiedBy("Hendrik")
									 ->setTitle("Telgil Document")
									 ->setSubject("Telgil Document")
									 ->setDescription("Telgil document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Telgil result file");
		// Add some data
			$i=0;
			$a=1;
			foreach ($result as $value) {
	            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$a, $result[$i]->COLUMN_NAME);
	            $i++;
	            $a++;
			}

			$str = 'B';
			for ($j=0; $j <count($data) ; $j++) { 
				$c=0;
				$d=1;
				foreach ($result as $value) {
					if ($result[$c]->COLUMN_NAME == 'NAMAPG ' || $result[$c]->COLUMN_NAME == 'TGL LAP ' || $result[$c]->COLUMN_NAME == 'TGL MULAI GILING ' || $result[$c]->COLUMN_NAME == 'TGL AKHIR GILING ') {
						if ($c == 0 || $c == 1 || $c == 2 || $c == 3) {
							$h = 'v1';
						}
					}else{
						$h = $v;
					}
					
					$col = str_replace(' ', '_', $result[$c]->COLUMN_NAME).$h;
		            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($str.$d, $data[$j]->$col);
					$c++;
		            $d++;
				}
				++$str;
			}
			foreach(range('A','ZZ') as $columnID) {
			    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			        ->setAutoSize(true);
			}

			$objPHPExcel->getDefaultStyle()
			    ->getBorders()
			    ->getTop()
			        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getDefaultStyle()
			    ->getBorders()
			    ->getBottom()
			        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getDefaultStyle()
			    ->getBorders()
			    ->getLeft()
			        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getDefaultStyle()
			    ->getBorders()
			    ->getRight()
			        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
											

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Simple');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$dok.'-'.$per.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

    }

    public function readExcel()
    {
   

    	$file = $this->input->get('file');
    	$method = $this->input->get('method');
    	// include 'PHPExcel/IOFactory.php';
    	$this->load->library("excel");

		$inputFileName = './assets/uploads/files/'.$file;

		//  Read your Excel workbook
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		$arr_rowData = array();
		//  Loop through each row of the worksheet in turn
		for ($row = 1; $row <= $highestRow; $row++){ 
		    //  Read a row of data into an array
		    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
		                                    NULL,
		                                    TRUE,
		                                    FALSE);
		    array_push($arr_rowData, $rowData);
		    //  Insert row data array into your database of choice here
		}
		$data['read'] = $arr_rowData;

		if ($method == "read") {
			$this->load->view('telgil/readexcel', $data);	
		}else{
			$this->load->view('evaluasi', $data);		
		}
	
    }

    public function saveExcel()
    {
    	$file = $this->input->get('file');
    	$method = $this->input->get('method');
    	// include 'PHPExcel/IOFactory.php';
    	$this->load->library("excel");

		$inputFileName = './assets/uploads/files/'.$file;

		//  Read your Excel workbook
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$objPHPExcelGET = new PHPExcel();
		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		$arr_rowData = array();
		//  Loop through each row of the worksheet in turn
		for ($row = 10; $row <= 85; $row++){ 
			if ($row !=43) {
			    $rowData = $sheet->rangeToArray('E' . $row . ':E' . $row,  NULL, TRUE, FALSE);
			    array_push($arr_rowData, $rowData);
			}
		}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('F' . $row . ':F' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('G' . $row . ':G' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('H' . $row . ':H' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('I' . $row . ':I' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('J' . $row . ':J' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('K' . $row . ':K' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}

		$data['read'] = $arr_rowData;
		$arr_push_data = array();
		
		$lenghtRow = count($arr_rowData);
	      $lenghtHeader = count($arr_rowData[0][0]);
	      $row = ""; 
	      $table = $this->db->query("SELECT column_NAME FROM information_schema.COLUMNS WHERE table_name='telgil_produksi';")->result();
	          
	      $conversiAWALGILING  = PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('D6')->getCalculatedValue(),  'YYYY-MM-DD');    
	      $conversiAKHIRGILING  = PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('G6')->getCalculatedValue(),  'YYYY-MM-DD');    
	      $PERIODE  = PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('C3')->getCalculatedValue(),  'YYYY-MM-DD');
	      $AWAL_GILING  = $conversiAWALGILING;
	      $AKHIR_GILING  = $conversiAKHIRGILING;
	      $TETES  = $sheet->getCell('K6')->getCalculatedValue();

	      // $ddata[$table[1]->column_NAME] = $PERIODE;
	      // $ddata[$table[2]->column_NAME] = $this->namapg;
	      // $ddata[$table[3]->column_NAME] = $AWAL_GILING;
	      // $ddata[$table[4]->column_NAME] = $AKHIR_GILING;
	      // $ddata[$table[5]->column_NAME] = $TETES;

	      // for ($j=1; $j < $lenghtRow; $j++) {
	      //           		$ddata[$table[$j+5]->column_NAME] = $arr_rowData[$j-1][0][0];
	      //           		array_push($arr_push_data, $ddata);
	      // }
	      $arr_produksi = array(
	      						"PERIODE" => $PERIODE, 
	      						"UNIT" => $this->namapg, 
	      						"MULAI_GILING" => $AWAL_GILING, 
	      						"AKHIR_GILING" => $AKHIR_GILING, 
	      						"TETES_PETANI" => $TETES, 
	      						
	      						"TSS_I_HG_HA_DIGIL" => $sheet->getCell('E10')->getCalculatedValue(),
								"TSS_II_HG_HA_DIGIL" => $sheet->getCell('E11')->getCalculatedValue(),
								"TSS_III_HG_HA_DIGIL" => $sheet->getCell('E12')->getCalculatedValue(),
								"SUB_JUMLAHRATA_TSS_HG_HA_DIGIL" => $sheet->getCell('E13')->getCalculatedValue(),
								"TST_I_HG_HA_DIGIL" => $sheet->getCell('E14')->getCalculatedValue(),
								"TST_II_HG_HA_DIGIL" => $sheet->getCell('E15')->getCalculatedValue(),
								"TST_III_HG_HA_DIGIL" => $sheet->getCell('E16')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_HG_HA_DIGIL" => $sheet->getCell('E17')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_HG_HA_DIGIL" => $sheet->getCell('E18')->getCalculatedValue(),
								"TSS_I_IP_HA_DIGIL" => $sheet->getCell('E19')->getCalculatedValue(),
								"TSS_II_IP_HA_DIGIL" => $sheet->getCell('E20')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_IP_HA_DIGIL" => $sheet->getCell('E21')->getCalculatedValue(),
								"TST_I_IP_HA_DIGIL" => $sheet->getCell('E22')->getCalculatedValue(),
								"TST_II_IP_HA_DIGIL" => $sheet->getCell('E23')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_IP_HA_DIGIL" => $sheet->getCell('E24')->getCalculatedValue(),
								"TSS_I_KN_HA_DIGIL" => $sheet->getCell('E25')->getCalculatedValue(),
								"TSS_II_KN_HA_DIGIL" => $sheet->getCell('E26')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KN_HA_DIGIL" => $sheet->getCell('E27')->getCalculatedValue(),
								"TST_I_KN_HA_DIGIL" => $sheet->getCell('E28')->getCalculatedValue(),
								"TST_II_KN__HA_DIGIL" => $sheet->getCell('E29')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KN_HA_DIGIL" => $sheet->getCell('E30')->getCalculatedValue(),
								"TSS_I_KS_HA_DIGIL" => $sheet->getCell('E31')->getCalculatedValue(),
								"TSS_II_KS_HA_DIGIL" => $sheet->getCell('E32')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KS_HA_DIGIL" => $sheet->getCell('E33')->getCalculatedValue(),
								"TST_I_KS_HA_DIGIL" => $sheet->getCell('E34')->getCalculatedValue(),
								"TST_II_KS_HA_DIGIL" => $sheet->getCell('E35')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KS_HA_DIGIL" => $sheet->getCell('E36')->getCalculatedValue(),
								"TS_SP_HA_DIGIL" => $sheet->getCell('E37')->getCalculatedValue(),
								"TS_ST_HA_DIGIL" => $sheet->getCell('E38')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_SPT_HA_DIGIL" => $sheet->getCell('E39')->getCalculatedValue(),
								"TS_TR_HA_DIGIL" => $sheet->getCell('E40')->getCalculatedValue(),
								"TS_BB_HA_DIGIL" => $sheet->getCell('E41')->getCalculatedValue(),
								"JUMLAHRATA_TS_HA_DIGIL" => $sheet->getCell('E42')->getCalculatedValue(),
								"TRS_I_KD_HA_DIGIL" => $sheet->getCell('E44')->getCalculatedValue(),
								"TRS_II_KD_HA_DIGIL" => $sheet->getCell('E45')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KD_HA_DIGIL" => $sheet->getCell('E46')->getCalculatedValue(),
								"TRT_I_KD_HA_DIGIL" => $sheet->getCell('E47')->getCalculatedValue(),
								"TRT_II_KD_HA_DIGIL" => $sheet->getCell('E48')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KD_HA_DIGIL" => $sheet->getCell('E49')->getCalculatedValue(),
								"TRS_I_KL_HA_DIGIL" => $sheet->getCell('E50')->getCalculatedValue(),
								"TRS_II_KL_HA_DIGIL" => $sheet->getCell('E51')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KL_HA_DIGIL" => $sheet->getCell('E52')->getCalculatedValue(),
								"TRT_I_KL_HA_DIGIL" => $sheet->getCell('E53')->getCalculatedValue(),
								"TRT_II_KL_HA_DIGIL" => $sheet->getCell('E54')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KL_HA_DIGIL" => $sheet->getCell('E55')->getCalculatedValue(),
								"TRS_I_MD_HA_DIGIL" => $sheet->getCell('E56')->getCalculatedValue(),
								"TRS_II_MD_HA_DIGIL" => $sheet->getCell('E57')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MD_HA_DIGIL" => $sheet->getCell('E58')->getCalculatedValue(),
								"TRT_I_MD_HA_DIGIL" => $sheet->getCell('E59')->getCalculatedValue(),
								"TRT_II_MD_HA_DIGIL" => $sheet->getCell('E60')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MD_HA_DIGIL" => $sheet->getCell('E61')->getCalculatedValue(),
								"TRS_I_ML_HA_DIGIL" => $sheet->getCell('E62')->getCalculatedValue(),
								"TRS_II_ML_HA_DIGIL" => $sheet->getCell('E63')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_ML_HA_DIGIL" => $sheet->getCell('E64')->getCalculatedValue(),
								"TRT_I_ML_HA_DIGIL" => $sheet->getCell('E65')->getCalculatedValue(),
								"TRT_II_ML_HA_DIGIL" => $sheet->getCell('E66')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_ML_HA_DIGIL" => $sheet->getCell('E67')->getCalculatedValue(),
								"TRS_I_KS_HA_DIGIL" => $sheet->getCell('E68')->getCalculatedValue(),
								"TRS_II_KS_HA_DIGIL" => $sheet->getCell('E69')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KS_HA_DIGIL" => $sheet->getCell('E70')->getCalculatedValue(),
								"TRT_I_KS_HA_DIGIL" => $sheet->getCell('E71')->getCalculatedValue(),
								"TRT_II_KS_HA_DIGIL" => $sheet->getCell('E72')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KS_HA_DIGIL" => $sheet->getCell('E73')->getCalculatedValue(),
								"TRS_I_MR_HA_DIGIL" => $sheet->getCell('E74')->getCalculatedValue(),
								"TRS_II_MR_HA_DIGIL" => $sheet->getCell('E75')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MR_HA_DIGIL" => $sheet->getCell('E76')->getCalculatedValue(),
								"TRT_I_MR_HA_DIGIL" => $sheet->getCell('E77')->getCalculatedValue(),
								"TRT_II_MR_HA_DIGIL" => $sheet->getCell('E78')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MR_HA_DIGIL" => $sheet->getCell('E79')->getCalculatedValue(),
								"TR_TK_HA_DIGIL" => $sheet->getCell('E80')->getCalculatedValue(),
								"TR_TM_HA_DIGIL" => $sheet->getCell('E81')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_HA_DIGIL" => $sheet->getCell('E82')->getCalculatedValue(),
								"JUMLAHRATA_TR_HA_DIGIL" => $sheet->getCell('E83')->getCalculatedValue(),
								"JUMLAH_RATA_RATA_TS_TR_HA_DIGIL" => $sheet->getCell('E84')->getCalculatedValue(),
								
								"TSS_I_HG_HA_BELUM" => $sheet->getCell('F10')->getCalculatedValue(),
								"TSS_II_HG_HA_BELUM" => $sheet->getCell('F11')->getCalculatedValue(),
								"TSS_III_HG_HA_BELUM" => $sheet->getCell('F12')->getCalculatedValue(),
								"SUB_JUMLAHRATA_TSS_HG_HA_BELUM" => $sheet->getCell('F13')->getCalculatedValue(),
								"TST_I_HG_HA_BELUM" => $sheet->getCell('F14')->getCalculatedValue(),
								"TST_II_HG_HA_BELUM" => $sheet->getCell('F15')->getCalculatedValue(),
								"TST_III_HG_HA_BELUM" => $sheet->getCell('F16')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_HG_HA_BELUM" => $sheet->getCell('F17')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_HG_HA_BELUM" => $sheet->getCell('F18')->getCalculatedValue(),
								"TSS_I_IP_HA_BELUM" => $sheet->getCell('F19')->getCalculatedValue(),
								"TSS_II_IP_HA_BELUM" => $sheet->getCell('F20')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_IP_HA_BELUM" => $sheet->getCell('F21')->getCalculatedValue(),
								"TST_I_IP_HA_BELUM" => $sheet->getCell('F22')->getCalculatedValue(),
								"TST_II_IP_HA_BELUM" => $sheet->getCell('F23')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_IP_HA_BELUM" => $sheet->getCell('F24')->getCalculatedValue(),
								"TSS_I_KN_HA_BELUM" => $sheet->getCell('F25')->getCalculatedValue(),
								"TSS_II_KN_HA_BELUM" => $sheet->getCell('F26')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KN_HA_BELUM" => $sheet->getCell('F27')->getCalculatedValue(),
								"TST_I_KN_HA_BELUM" => $sheet->getCell('F28')->getCalculatedValue(),
								"TST_II_KN__HA_BELUM" => $sheet->getCell('F29')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KN_HA_BELUM" => $sheet->getCell('F30')->getCalculatedValue(),
								"TSS_I_KS_HA_BELUM" => $sheet->getCell('F31')->getCalculatedValue(),
								"TSS_II_KS_HA_BELUM" => $sheet->getCell('F32')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KS_HA_BELUM" => $sheet->getCell('F33')->getCalculatedValue(),
								"TST_I_KS_HA_BELUM" => $sheet->getCell('F34')->getCalculatedValue(),
								"TST_II_KS_HA_BELUM" => $sheet->getCell('F35')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KS_HA_BELUM" => $sheet->getCell('F36')->getCalculatedValue(),
								"TS_SP_HA_BELUM" => $sheet->getCell('F37')->getCalculatedValue(),
								"TS_ST_HA_BELUM" => $sheet->getCell('F38')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_SPT_HA_BELUM" => $sheet->getCell('F39')->getCalculatedValue(),
								"TS_TR_HA_BELUM" => $sheet->getCell('F40')->getCalculatedValue(),
								"TS_BB_HA_BELUM" => $sheet->getCell('F41')->getCalculatedValue(),
								"JUMLAHRATA_TS_HA_BELUM" => $sheet->getCell('F42')->getCalculatedValue(),
								"TRS_I_KD_HA_BELUM" => $sheet->getCell('F44')->getCalculatedValue(),
								"TRS_II_KD_HA_BELUM" => $sheet->getCell('F45')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KD_HA_BELUM" => $sheet->getCell('F46')->getCalculatedValue(),
								"TRT_I_KD_HA_BELUM" => $sheet->getCell('F47')->getCalculatedValue(),
								"TRT_II_KD_HA_BELUM" => $sheet->getCell('F48')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KD_HA_BELUM" => $sheet->getCell('F49')->getCalculatedValue(),
								"TRS_I_KL_HA_BELUM" => $sheet->getCell('F50')->getCalculatedValue(),
								"TRS_II_KL_HA_BELUM" => $sheet->getCell('F51')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KL_HA_BELUM" => $sheet->getCell('F52')->getCalculatedValue(),
								"TRT_I_KL_HA_BELUM" => $sheet->getCell('F53')->getCalculatedValue(),
								"TRT_II_KL_HA_BELUM" => $sheet->getCell('F54')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KL_HA_BELUM" => $sheet->getCell('F55')->getCalculatedValue(),
								"TRS_I_MD_HA_BELUM" => $sheet->getCell('F56')->getCalculatedValue(),
								"TRS_II_MD_HA_BELUM" => $sheet->getCell('F57')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MD_HA_BELUM" => $sheet->getCell('F58')->getCalculatedValue(),
								"TRT_I_MD_HA_BELUM" => $sheet->getCell('F59')->getCalculatedValue(),
								"TRT_II_MD_HA_BELUM" => $sheet->getCell('F60')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MD_HA_BELUM" => $sheet->getCell('F61')->getCalculatedValue(),
								"TRS_I_ML_HA_BELUM" => $sheet->getCell('F62')->getCalculatedValue(),
								"TRS_II_ML_HA_BELUM" => $sheet->getCell('F63')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_ML_HA_BELUM" => $sheet->getCell('F64')->getCalculatedValue(),
								"TRT_I_ML_HA_BELUM" => $sheet->getCell('F65')->getCalculatedValue(),
								"TRT_II_ML_HA_BELUM" => $sheet->getCell('F66')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_ML_HA_BELUM" => $sheet->getCell('F67')->getCalculatedValue(),
								"TRS_I_KS_HA_BELUM" => $sheet->getCell('F68')->getCalculatedValue(),
								"TRS_II_KS_HA_BELUM" => $sheet->getCell('F69')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KS_HA_BELUM" => $sheet->getCell('F70')->getCalculatedValue(),
								"TRT_I_KS_HA_BELUM" => $sheet->getCell('F71')->getCalculatedValue(),
								"TRT_II_KS_HA_BELUM" => $sheet->getCell('F72')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KS_HA_BELUM" => $sheet->getCell('F73')->getCalculatedValue(),
								"TRS_I_MR_HA_BELUM" => $sheet->getCell('F74')->getCalculatedValue(),
								"TRS_II_MR_HA_BELUM" => $sheet->getCell('F75')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MR_HA_BELUM" => $sheet->getCell('F76')->getCalculatedValue(),
								"TRT_I_MR_HA_BELUM" => $sheet->getCell('F77')->getCalculatedValue(),
								"TRT_II_MR_HA_BELUM" => $sheet->getCell('F78')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MR_HA_BELUM" => $sheet->getCell('F79')->getCalculatedValue(),
								"TR_TK_HA_BELUM" => $sheet->getCell('F80')->getCalculatedValue(),
								"TR_TM_HA_BELUM" => $sheet->getCell('F81')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_HA_BELUM" => $sheet->getCell('F82')->getCalculatedValue(),
								"JUMLAHRATA_TR_HA_BELUM" => $sheet->getCell('F83')->getCalculatedValue(),
								"JUMLAH_RATA_RATA_TS_TR_HA_BELUM" => $sheet->getCell('F84')->getCalculatedValue(),
								
								"TSS_I_HG_TON_TEBU" => $sheet->getCell('G10')->getCalculatedValue(),
								"TSS_II_HG_TON_TEBU" => $sheet->getCell('G11')->getCalculatedValue(),
								"TSS_III_HG_TON_TEBU" => $sheet->getCell('G12')->getCalculatedValue(),
								"SUB_JUMLAHRATA_TSS_HG_TON_TEBU" => $sheet->getCell('G13')->getCalculatedValue(),
								"TST_I_HG_TON_TEBU" => $sheet->getCell('G14')->getCalculatedValue(),
								"TST_II_HG_TON_TEBU" => $sheet->getCell('G15')->getCalculatedValue(),
								"TST_III_HG_TON_TEBU" => $sheet->getCell('G16')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_HG_TON_TEBU" => $sheet->getCell('G17')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_HG_TON_TEBU" => $sheet->getCell('G18')->getCalculatedValue(),
								"TSS_I_IP_TON_TEBU" => $sheet->getCell('G19')->getCalculatedValue(),
								"TSS_II_IP_TON_TEBU" => $sheet->getCell('G20')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_IP_TON_TEBU" => $sheet->getCell('G21')->getCalculatedValue(),
								"TST_I_IP_TON_TEBU" => $sheet->getCell('G22')->getCalculatedValue(),
								"TST_II_IP_TON_TEBU" => $sheet->getCell('G23')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_IP_TON_TEBU" => $sheet->getCell('G24')->getCalculatedValue(),
								"TSS_I_KN_TON_TEBU" => $sheet->getCell('G25')->getCalculatedValue(),
								"TSS_II_KN_TON_TEBU" => $sheet->getCell('G26')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KN_TON_TEBU" => $sheet->getCell('G27')->getCalculatedValue(),
								"TST_I_KN_TON_TEBU" => $sheet->getCell('G28')->getCalculatedValue(),
								"TST_II_KN__TON_TEBU" => $sheet->getCell('G29')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KN_TON_TEBU" => $sheet->getCell('G30')->getCalculatedValue(),
								"TSS_I_KS_TON_TEBU" => $sheet->getCell('G31')->getCalculatedValue(),
								"TSS_II_KS_TON_TEBU" => $sheet->getCell('G32')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KS_TON_TEBU" => $sheet->getCell('G33')->getCalculatedValue(),
								"TST_I_KS_TON_TEBU" => $sheet->getCell('G34')->getCalculatedValue(),
								"TST_II_KS_TON_TEBU" => $sheet->getCell('G35')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KS_TON_TEBU" => $sheet->getCell('G36')->getCalculatedValue(),
								"TS_SP_TON_TEBU" => $sheet->getCell('G37')->getCalculatedValue(),
								"TS_ST_TON_TEBU" => $sheet->getCell('G38')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_SPT_TON_TEBU" => $sheet->getCell('G39')->getCalculatedValue(),
								"TS_TR_TON_TEBU" => $sheet->getCell('G40')->getCalculatedValue(),
								"TS_BB_TON_TEBU" => $sheet->getCell('G41')->getCalculatedValue(),
								"JUMLAHRATA_TS_TON_TEBU" => $sheet->getCell('G42')->getCalculatedValue(),
								"TRS_I_KD_TON_TEBU" => $sheet->getCell('G44')->getCalculatedValue(),
								"TRS_II_KD_TON_TEBU" => $sheet->getCell('G45')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KD_TON_TEBU" => $sheet->getCell('G46')->getCalculatedValue(),
								"TRT_I_KD_TON_TEBU" => $sheet->getCell('G47')->getCalculatedValue(),
								"TRT_II_KD_TON_TEBU" => $sheet->getCell('G48')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KD_TON_TEBU" => $sheet->getCell('G49')->getCalculatedValue(),
								"TRS_I_KL_TON_TEBU" => $sheet->getCell('G50')->getCalculatedValue(),
								"TRS_II_KL_TON_TEBU" => $sheet->getCell('G51')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KL_TON_TEBU" => $sheet->getCell('G52')->getCalculatedValue(),
								"TRT_I_KL_TON_TEBU" => $sheet->getCell('G53')->getCalculatedValue(),
								"TRT_II_KL_TON_TEBU" => $sheet->getCell('G54')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KL_TON_TEBU" => $sheet->getCell('G55')->getCalculatedValue(),
								"TRS_I_MD_TON_TEBU" => $sheet->getCell('G56')->getCalculatedValue(),
								"TRS_II_MD_TON_TEBU" => $sheet->getCell('G57')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MD_TON_TEBU" => $sheet->getCell('G58')->getCalculatedValue(),
								"TRT_I_MD_TON_TEBU" => $sheet->getCell('G59')->getCalculatedValue(),
								"TRT_II_MD_TON_TEBU" => $sheet->getCell('G60')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MD_TON_TEBU" => $sheet->getCell('G61')->getCalculatedValue(),
								"TRS_I_ML_TON_TEBU" => $sheet->getCell('G62')->getCalculatedValue(),
								"TRS_II_ML_TON_TEBU" => $sheet->getCell('G63')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_ML_TON_TEBU" => $sheet->getCell('G64')->getCalculatedValue(),
								"TRT_I_ML_TON_TEBU" => $sheet->getCell('G65')->getCalculatedValue(),
								"TRT_II_ML_TON_TEBU" => $sheet->getCell('G66')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_ML_TON_TEBU" => $sheet->getCell('G67')->getCalculatedValue(),
								"TRS_I_KS_TON_TEBU" => $sheet->getCell('G68')->getCalculatedValue(),
								"TRS_II_KS_TON_TEBU" => $sheet->getCell('G69')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KS_TON_TEBU" => $sheet->getCell('G70')->getCalculatedValue(),
								"TRT_I_KS_TON_TEBU" => $sheet->getCell('G71')->getCalculatedValue(),
								"TRT_II_KS_TON_TEBU" => $sheet->getCell('G72')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KS_TON_TEBU" => $sheet->getCell('G73')->getCalculatedValue(),
								"TRS_I_MR_TON_TEBU" => $sheet->getCell('G74')->getCalculatedValue(),
								"TRS_II_MR_TON_TEBU" => $sheet->getCell('G75')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MR_TON_TEBU" => $sheet->getCell('G76')->getCalculatedValue(),
								"TRT_I_MR_TON_TEBU" => $sheet->getCell('G77')->getCalculatedValue(),
								"TRT_II_MR_TON_TEBU" => $sheet->getCell('G78')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MR_TON_TEBU" => $sheet->getCell('G79')->getCalculatedValue(),
								"TR_TK_TON_TEBU" => $sheet->getCell('G80')->getCalculatedValue(),
								"TR_TM_TON_TEBU" => $sheet->getCell('G81')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_TON_TEBU" => $sheet->getCell('G82')->getCalculatedValue(),
								"JUMLAHRATA_TR_TON_TEBU" => $sheet->getCell('G83')->getCalculatedValue(),
								"JUMLAH_RATA_RATA_TS_TR_TON_TEBU" => $sheet->getCell('G84')->getCalculatedValue(),
								
								"TSS_I_HG_TON_HABL" => $sheet->getCell('H10')->getCalculatedValue(),
								"TSS_II_HG_TON_HABL" => $sheet->getCell('H11')->getCalculatedValue(),
								"TSS_III_HG_TON_HABL" => $sheet->getCell('H12')->getCalculatedValue(),
								"SUB_JUMLAHRATA_TSS_HG_TON_HABL" => $sheet->getCell('H13')->getCalculatedValue(),
								"TST_I_HG_TON_HABL" => $sheet->getCell('H14')->getCalculatedValue(),
								"TST_II_HG_TON_HABL" => $sheet->getCell('H15')->getCalculatedValue(),
								"TST_III_HG_TON_HABL" => $sheet->getCell('H16')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_HG_TON_HABL" => $sheet->getCell('H17')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_HG_TON_HABL" => $sheet->getCell('H18')->getCalculatedValue(),
								"TSS_I_IP_TON_HABL" => $sheet->getCell('H19')->getCalculatedValue(),
								"TSS_II_IP_TON_HABL" => $sheet->getCell('H20')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_IP_TON_HABL" => $sheet->getCell('H21')->getCalculatedValue(),
								"TST_I_IP_TON_HABL" => $sheet->getCell('H22')->getCalculatedValue(),
								"TST_II_IP_TON_HABL" => $sheet->getCell('H23')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_IP_TON_HABL" => $sheet->getCell('H24')->getCalculatedValue(),
								"TSS_I_KN_TON_HABL" => $sheet->getCell('H25')->getCalculatedValue(),
								"TSS_II_KN_TON_HABL" => $sheet->getCell('H26')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KN_TON_HABL" => $sheet->getCell('H27')->getCalculatedValue(),
								"TST_I_KN_TON_HABL" => $sheet->getCell('H28')->getCalculatedValue(),
								"TST_II_KN__TON_HABL" => $sheet->getCell('H29')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KN_TON_HABL" => $sheet->getCell('H30')->getCalculatedValue(),
								"TSS_I_KS_TON_HABL" => $sheet->getCell('H31')->getCalculatedValue(),
								"TSS_II_KS_TON_HABL" => $sheet->getCell('H32')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KS_TON_HABL" => $sheet->getCell('H33')->getCalculatedValue(),
								"TST_I_KS_TON_HABL" => $sheet->getCell('H34')->getCalculatedValue(),
								"TST_II_KS_TON_HABL" => $sheet->getCell('H35')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KS_TON_HABL" => $sheet->getCell('H36')->getCalculatedValue(),
								"TS_SP_TON_HABL" => $sheet->getCell('H37')->getCalculatedValue(),
								"TS_ST_TON_HABL" => $sheet->getCell('H38')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_SPT_TON_HABL" => $sheet->getCell('H39')->getCalculatedValue(),
								"TS_TR_TON_HABL" => $sheet->getCell('H40')->getCalculatedValue(),
								"TS_BB_TON_HABL" => $sheet->getCell('H41')->getCalculatedValue(),
								"JUMLAHRATA_TS_TON_HABL" => $sheet->getCell('H42')->getCalculatedValue(),
								"TRS_I_KD_TON_HABL" => $sheet->getCell('H44')->getCalculatedValue(),
								"TRS_II_KD_TON_HABL" => $sheet->getCell('H45')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KD_TON_HABL" => $sheet->getCell('H46')->getCalculatedValue(),
								"TRT_I_KD_TON_HABL" => $sheet->getCell('H47')->getCalculatedValue(),
								"TRT_II_KD_TON_HABL" => $sheet->getCell('H48')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KD_TON_HABL" => $sheet->getCell('H49')->getCalculatedValue(),
								"TRS_I_KL_TON_HABL" => $sheet->getCell('H50')->getCalculatedValue(),
								"TRS_II_KL_TON_HABL" => $sheet->getCell('H51')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KL_TON_HABL" => $sheet->getCell('H52')->getCalculatedValue(),
								"TRT_I_KL_TON_HABL" => $sheet->getCell('H53')->getCalculatedValue(),
								"TRT_II_KL_TON_HABL" => $sheet->getCell('H54')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KL_TON_HABL" => $sheet->getCell('H55')->getCalculatedValue(),
								"TRS_I_MD_TON_HABL" => $sheet->getCell('H56')->getCalculatedValue(),
								"TRS_II_MD_TON_HABL" => $sheet->getCell('H57')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MD_TON_HABL" => $sheet->getCell('H58')->getCalculatedValue(),
								"TRT_I_MD_TON_HABL" => $sheet->getCell('H59')->getCalculatedValue(),
								"TRT_II_MD_TON_HABL" => $sheet->getCell('H60')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MD_TON_HABL" => $sheet->getCell('H61')->getCalculatedValue(),
								"TRS_I_ML_TON_HABL" => $sheet->getCell('H62')->getCalculatedValue(),
								"TRS_II_ML_TON_HABL" => $sheet->getCell('H63')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_ML_TON_HABL" => $sheet->getCell('H64')->getCalculatedValue(),
								"TRT_I_ML_TON_HABL" => $sheet->getCell('H65')->getCalculatedValue(),
								"TRT_II_ML_TON_HABL" => $sheet->getCell('H66')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_ML_TON_HABL" => $sheet->getCell('H67')->getCalculatedValue(),
								"TRS_I_KS_TON_HABL" => $sheet->getCell('H68')->getCalculatedValue(),
								"TRS_II_KS_TON_HABL" => $sheet->getCell('H69')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KS_TON_HABL" => $sheet->getCell('H70')->getCalculatedValue(),
								"TRT_I_KS_TON_HABL" => $sheet->getCell('H71')->getCalculatedValue(),
								"TRT_II_KS_TON_HABL" => $sheet->getCell('H72')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KS_TON_HABL" => $sheet->getCell('H73')->getCalculatedValue(),
								"TRS_I_MR_TON_HABL" => $sheet->getCell('H74')->getCalculatedValue(),
								"TRS_II_MR_TON_HABL" => $sheet->getCell('H75')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MR_TON_HABL" => $sheet->getCell('H76')->getCalculatedValue(),
								"TRT_I_MR_TON_HABL" => $sheet->getCell('H77')->getCalculatedValue(),
								"TRT_II_MR_TON_HABL" => $sheet->getCell('H78')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MR_TON_HABL" => $sheet->getCell('H79')->getCalculatedValue(),
								"TR_TK_TON_HABL" => $sheet->getCell('H80')->getCalculatedValue(),
								"TR_TM_TON_HABL" => $sheet->getCell('H81')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_TON_HABL" => $sheet->getCell('H82')->getCalculatedValue(),
								"JUMLAHRATA_TR_TON_HABL" => $sheet->getCell('H83')->getCalculatedValue(),
								"JUMLAH_RATA_RATA_TS_TR_TON_HABL" => $sheet->getCell('H84')->getCalculatedValue(),
								
								"TSS_I_HG_TEBU_HA" => $sheet->getCell('I10')->getCalculatedValue(),
								"TSS_II_HG_TEBU_HA" => $sheet->getCell('I11')->getCalculatedValue(),
								"TSS_III_HG_TEBU_HA" => $sheet->getCell('I12')->getCalculatedValue(),
								"SUB_JUMLAHRATA_TSS_HG_TEBU_HA" => $sheet->getCell('I13')->getCalculatedValue(),
								"TST_I_HG_TEBU_HA" => $sheet->getCell('I14')->getCalculatedValue(),
								"TST_II_HG_TEBU_HA" => $sheet->getCell('I15')->getCalculatedValue(),
								"TST_III_HG_TEBU_HA" => $sheet->getCell('I16')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_HG_TEBU_HA" => $sheet->getCell('I17')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_HG_TEBU_HA" => $sheet->getCell('I18')->getCalculatedValue(),
								"TSS_I_IP_TEBU_HA" => $sheet->getCell('I19')->getCalculatedValue(),
								"TSS_II_IP_TEBU_HA" => $sheet->getCell('I20')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_IP_TEBU_HA" => $sheet->getCell('I21')->getCalculatedValue(),
								"TST_I_IP_TEBU_HA" => $sheet->getCell('I22')->getCalculatedValue(),
								"TST_II_IP_TEBU_HA" => $sheet->getCell('I23')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_IP_TEBU_HA" => $sheet->getCell('I24')->getCalculatedValue(),
								"TSS_I_KN_TEBU_HA" => $sheet->getCell('I25')->getCalculatedValue(),
								"TSS_II_KN_TEBU_HA" => $sheet->getCell('I26')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KN_TEBU_HA" => $sheet->getCell('I27')->getCalculatedValue(),
								"TST_I_KN_TEBU_HA" => $sheet->getCell('I28')->getCalculatedValue(),
								"TST_II_KN__TEBU_HA" => $sheet->getCell('I29')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KN_TEBU_HA" => $sheet->getCell('I30')->getCalculatedValue(),
								"TSS_I_KS_TEBU_HA" => $sheet->getCell('I31')->getCalculatedValue(),
								"TSS_II_KS_TEBU_HA" => $sheet->getCell('I32')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KS_TEBU_HA" => $sheet->getCell('I33')->getCalculatedValue(),
								"TST_I_KS_TEBU_HA" => $sheet->getCell('I34')->getCalculatedValue(),
								"TST_II_KS_TEBU_HA" => $sheet->getCell('I35')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KS_TEBU_HA" => $sheet->getCell('I36')->getCalculatedValue(),
								"TS_SP_TEBU_HA" => $sheet->getCell('I37')->getCalculatedValue(),
								"TS_ST_TEBU_HA" => $sheet->getCell('I38')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_SPT_TEBU_HA" => $sheet->getCell('I39')->getCalculatedValue(),
								"TS_TR_TEBU_HA" => $sheet->getCell('I40')->getCalculatedValue(),
								"TS_BB_TEBU_HA" => $sheet->getCell('I41')->getCalculatedValue(),
								"JUMLAHRATA_TS_TEBU_HA" => $sheet->getCell('I42')->getCalculatedValue(),
								"TRS_I_KD_TEBU_HA" => $sheet->getCell('I44')->getCalculatedValue(),
								"TRS_II_KD_TEBU_HA" => $sheet->getCell('I45')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KD_TEBU_HA" => $sheet->getCell('I46')->getCalculatedValue(),
								"TRT_I_KD_TEBU_HA" => $sheet->getCell('I47')->getCalculatedValue(),
								"TRT_II_KD_TEBU_HA" => $sheet->getCell('I48')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KD_TEBU_HA" => $sheet->getCell('I49')->getCalculatedValue(),
								"TRS_I_KL_TEBU_HA" => $sheet->getCell('I50')->getCalculatedValue(),
								"TRS_II_KL_TEBU_HA" => $sheet->getCell('I51')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KL_TEBU_HA" => $sheet->getCell('I52')->getCalculatedValue(),
								"TRT_I_KL_TEBU_HA" => $sheet->getCell('I53')->getCalculatedValue(),
								"TRT_II_KL_TEBU_HA" => $sheet->getCell('I54')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KL_TEBU_HA" => $sheet->getCell('I55')->getCalculatedValue(),
								"TRS_I_MD_TEBU_HA" => $sheet->getCell('I56')->getCalculatedValue(),
								"TRS_II_MD_TEBU_HA" => $sheet->getCell('I57')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MD_TEBU_HA" => $sheet->getCell('I58')->getCalculatedValue(),
								"TRT_I_MD_TEBU_HA" => $sheet->getCell('I59')->getCalculatedValue(),
								"TRT_II_MD_TEBU_HA" => $sheet->getCell('I60')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MD_TEBU_HA" => $sheet->getCell('I61')->getCalculatedValue(),
								"TRS_I_ML_TEBU_HA" => $sheet->getCell('I62')->getCalculatedValue(),
								"TRS_II_ML_TEBU_HA" => $sheet->getCell('I63')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_ML_TEBU_HA" => $sheet->getCell('I64')->getCalculatedValue(),
								"TRT_I_ML_TEBU_HA" => $sheet->getCell('I65')->getCalculatedValue(),
								"TRT_II_ML_TEBU_HA" => $sheet->getCell('I66')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_ML_TEBU_HA" => $sheet->getCell('I67')->getCalculatedValue(),
								"TRS_I_KS_TEBU_HA" => $sheet->getCell('I68')->getCalculatedValue(),
								"TRS_II_KS_TEBU_HA" => $sheet->getCell('I69')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KS_TEBU_HA" => $sheet->getCell('I70')->getCalculatedValue(),
								"TRT_I_KS_TEBU_HA" => $sheet->getCell('I71')->getCalculatedValue(),
								"TRT_II_KS_TEBU_HA" => $sheet->getCell('I72')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KS_TEBU_HA" => $sheet->getCell('I73')->getCalculatedValue(),
								"TRS_I_MR_TEBU_HA" => $sheet->getCell('I74')->getCalculatedValue(),
								"TRS_II_MR_TEBU_HA" => $sheet->getCell('I75')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MR_TEBU_HA" => $sheet->getCell('I76')->getCalculatedValue(),
								"TRT_I_MR_TEBU_HA" => $sheet->getCell('I77')->getCalculatedValue(),
								"TRT_II_MR_TEBU_HA" => $sheet->getCell('I78')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MR_TEBU_HA" => $sheet->getCell('I79')->getCalculatedValue(),
								"TR_TK_TEBU_HA" => $sheet->getCell('I80')->getCalculatedValue(),
								"TR_TM_TEBU_HA" => $sheet->getCell('I81')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_TEBU_HA" => $sheet->getCell('I82')->getCalculatedValue(),
								"JUMLAHRATA_TR_TEBU_HA" => $sheet->getCell('I83')->getCalculatedValue(),
								"JUMLAH_RATA_RATA_TS_TR_TEBU_HA" => $sheet->getCell('I84')->getCalculatedValue(),
								
								"TSS_I_HG_HABL_HA" => $sheet->getCell('J10')->getCalculatedValue(),
								"TSS_II_HG_HABL_HA" => $sheet->getCell('J11')->getCalculatedValue(),
								"TSS_III_HG_HABL_HA" => $sheet->getCell('J12')->getCalculatedValue(),
								"SUB_JUMLAHRATA_TSS_HG_HABL_HA" => $sheet->getCell('J13')->getCalculatedValue(),
								"TST_I_HG_HABL_HA" => $sheet->getCell('J14')->getCalculatedValue(),
								"TST_II_HG_HABL_HA" => $sheet->getCell('J15')->getCalculatedValue(),
								"TST_III_HG_HABL_HA" => $sheet->getCell('J16')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_HG_HABL_HA" => $sheet->getCell('J17')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_HG_HABL_HA" => $sheet->getCell('J18')->getCalculatedValue(),
								"TSS_I_IP_HABL_HA" => $sheet->getCell('J19')->getCalculatedValue(),
								"TSS_II_IP_HABL_HA" => $sheet->getCell('J20')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_IP_HABL_HA" => $sheet->getCell('J21')->getCalculatedValue(),
								"TST_I_IP_HABL_HA" => $sheet->getCell('J22')->getCalculatedValue(),
								"TST_II_IP_HABL_HA" => $sheet->getCell('J23')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_IP_HABL_HA" => $sheet->getCell('J24')->getCalculatedValue(),
								"TSS_I_KN_HABL_HA" => $sheet->getCell('J25')->getCalculatedValue(),
								"TSS_II_KN_HABL_HA" => $sheet->getCell('J26')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KN_HABL_HA" => $sheet->getCell('J27')->getCalculatedValue(),
								"TST_I_KN_HABL_HA" => $sheet->getCell('J28')->getCalculatedValue(),
								"TST_II_KN__HABL_HA" => $sheet->getCell('J29')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KN_HABL_HA" => $sheet->getCell('J30')->getCalculatedValue(),
								"TSS_I_KS_HABL_HA" => $sheet->getCell('J31')->getCalculatedValue(),
								"TSS_II_KS_HABL_HA" => $sheet->getCell('J32')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KS_HABL_HA" => $sheet->getCell('J33')->getCalculatedValue(),
								"TST_I_KS_HABL_HA" => $sheet->getCell('J34')->getCalculatedValue(),
								"TST_II_KS_HABL_HA" => $sheet->getCell('J35')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KS_HABL_HA" => $sheet->getCell('J36')->getCalculatedValue(),
								"TS_SP_HABL_HA" => $sheet->getCell('J37')->getCalculatedValue(),
								"TS_ST_HABL_HA" => $sheet->getCell('J38')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_SPT_HABL_HA" => $sheet->getCell('J39')->getCalculatedValue(),
								"TS_TR_HABL_HA" => $sheet->getCell('J40')->getCalculatedValue(),
								"TS_BB_HABL_HA" => $sheet->getCell('J41')->getCalculatedValue(),
								"JUMLAHRATA_TS_HABL_HA" => $sheet->getCell('J42')->getCalculatedValue(),
								"TRS_I_KD_HABL_HA" => $sheet->getCell('J44')->getCalculatedValue(),
								"TRS_II_KD_HABL_HA" => $sheet->getCell('J45')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KD_HABL_HA" => $sheet->getCell('J46')->getCalculatedValue(),
								"TRT_I_KD_HABL_HA" => $sheet->getCell('J47')->getCalculatedValue(),
								"TRT_II_KD_HABL_HA" => $sheet->getCell('J48')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KD_HABL_HA" => $sheet->getCell('J49')->getCalculatedValue(),
								"TRS_I_KL_HABL_HA" => $sheet->getCell('J50')->getCalculatedValue(),
								"TRS_II_KL_HABL_HA" => $sheet->getCell('J51')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KL_HABL_HA" => $sheet->getCell('J52')->getCalculatedValue(),
								"TRT_I_KL_HABL_HA" => $sheet->getCell('J53')->getCalculatedValue(),
								"TRT_II_KL_HABL_HA" => $sheet->getCell('J54')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KL_HABL_HA" => $sheet->getCell('J55')->getCalculatedValue(),
								"TRS_I_MD_HABL_HA" => $sheet->getCell('J56')->getCalculatedValue(),
								"TRS_II_MD_HABL_HA" => $sheet->getCell('J57')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MD_HABL_HA" => $sheet->getCell('J58')->getCalculatedValue(),
								"TRT_I_MD_HABL_HA" => $sheet->getCell('J59')->getCalculatedValue(),
								"TRT_II_MD_HABL_HA" => $sheet->getCell('J60')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MD_HABL_HA" => $sheet->getCell('J61')->getCalculatedValue(),
								"TRS_I_ML_HABL_HA" => $sheet->getCell('J62')->getCalculatedValue(),
								"TRS_II_ML_HABL_HA" => $sheet->getCell('J63')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_ML_HABL_HA" => $sheet->getCell('J64')->getCalculatedValue(),
								"TRT_I_ML_HABL_HA" => $sheet->getCell('J65')->getCalculatedValue(),
								"TRT_II_ML_HABL_HA" => $sheet->getCell('J66')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_ML_HABL_HA" => $sheet->getCell('J67')->getCalculatedValue(),
								"TRS_I_KS_HABL_HA" => $sheet->getCell('J68')->getCalculatedValue(),
								"TRS_II_KS_HABL_HA" => $sheet->getCell('J69')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KS_HABL_HA" => $sheet->getCell('J70')->getCalculatedValue(),
								"TRT_I_KS_HABL_HA" => $sheet->getCell('J71')->getCalculatedValue(),
								"TRT_II_KS_HABL_HA" => $sheet->getCell('J72')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KS_HABL_HA" => $sheet->getCell('J73')->getCalculatedValue(),
								"TRS_I_MR_HABL_HA" => $sheet->getCell('J74')->getCalculatedValue(),
								"TRS_II_MR_HABL_HA" => $sheet->getCell('J75')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MR_HABL_HA" => $sheet->getCell('J76')->getCalculatedValue(),
								"TRT_I_MR_HABL_HA" => $sheet->getCell('J77')->getCalculatedValue(),
								"TRT_II_MR_HABL_HA" => $sheet->getCell('J78')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MR_HABL_HA" => $sheet->getCell('J79')->getCalculatedValue(),
								"TR_TK_HABL_HA" => $sheet->getCell('J80')->getCalculatedValue(),
								"TR_TM_HABL_HA" => $sheet->getCell('J81')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_HABL_HA" => $sheet->getCell('J82')->getCalculatedValue(),
								"JUMLAHRATA_TR_HABL_HA" => $sheet->getCell('J83')->getCalculatedValue(),
								"JUMLAH_RATA_RATA_TS_TR_HABL_HA" => $sheet->getCell('J84')->getCalculatedValue(),
								
								"TSS_I_HG_REND" => $sheet->getCell('K10')->getCalculatedValue(),
								"TSS_II_HG_REND" => $sheet->getCell('K11')->getCalculatedValue(),
								"TSS_III_HG_REND" => $sheet->getCell('K12')->getCalculatedValue(),
								"SUB_JUMLAHRATA_TSS_HG_REND" => $sheet->getCell('K13')->getCalculatedValue(),
								"TST_I_HG_REND" => $sheet->getCell('K14')->getCalculatedValue(),
								"TST_II_HG_REND" => $sheet->getCell('K15')->getCalculatedValue(),
								"TST_III_HG_REND" => $sheet->getCell('K16')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_HG_REND" => $sheet->getCell('K17')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_HG_REND" => $sheet->getCell('K18')->getCalculatedValue(),
								"TSS_I_IP_REND" => $sheet->getCell('K19')->getCalculatedValue(),
								"TSS_II_IP_REND" => $sheet->getCell('K20')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_IP_REND" => $sheet->getCell('K21')->getCalculatedValue(),
								"TST_I_IP_REND" => $sheet->getCell('K22')->getCalculatedValue(),
								"TST_II_IP_REND" => $sheet->getCell('K23')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_IP_REND" => $sheet->getCell('K24')->getCalculatedValue(),
								"TSS_I_KN_REND" => $sheet->getCell('K25')->getCalculatedValue(),
								"TSS_II_KN_REND" => $sheet->getCell('K26')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KN_REND" => $sheet->getCell('K27')->getCalculatedValue(),
								"TST_I_KN_REND" => $sheet->getCell('K28')->getCalculatedValue(),
								"TST_II_KN__REND" => $sheet->getCell('K29')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KN_REND" => $sheet->getCell('K30')->getCalculatedValue(),
								"TSS_I_KS_REND" => $sheet->getCell('K31')->getCalculatedValue(),
								"TSS_II_KS_REND" => $sheet->getCell('K32')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TSS_KS_REND" => $sheet->getCell('K33')->getCalculatedValue(),
								"TST_I_KS_REND" => $sheet->getCell('K34')->getCalculatedValue(),
								"TST_II_KS_REND" => $sheet->getCell('K35')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TST_KS_REND" => $sheet->getCell('K36')->getCalculatedValue(),
								"TS_SP_REND" => $sheet->getCell('K37')->getCalculatedValue(),
								"TS_ST_REND" => $sheet->getCell('K38')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_SPT_REND" => $sheet->getCell('K39')->getCalculatedValue(),
								"TS_TR_REND" => $sheet->getCell('K40')->getCalculatedValue(),
								"TS_BB_REND" => $sheet->getCell('K41')->getCalculatedValue(),
								"JUMLAHRATA_TS_REND" => $sheet->getCell('K42')->getCalculatedValue(),
								"TRS_I_KD_REND" => $sheet->getCell('K44')->getCalculatedValue(),
								"TRS_II_KD_REND" => $sheet->getCell('K45')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KD_REND" => $sheet->getCell('K46')->getCalculatedValue(),
								"TRT_I_KD_REND" => $sheet->getCell('K47')->getCalculatedValue(),
								"TRT_II_KD_REND" => $sheet->getCell('K48')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KD_REND" => $sheet->getCell('K49')->getCalculatedValue(),
								"TRS_I_KL_REND" => $sheet->getCell('K50')->getCalculatedValue(),
								"TRS_II_KL_REND" => $sheet->getCell('K51')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KL_REND" => $sheet->getCell('K52')->getCalculatedValue(),
								"TRT_I_KL_REND" => $sheet->getCell('K53')->getCalculatedValue(),
								"TRT_II_KL_REND" => $sheet->getCell('K54')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KL_REND" => $sheet->getCell('K55')->getCalculatedValue(),
								"TRS_I_MD_REND" => $sheet->getCell('K56')->getCalculatedValue(),
								"TRS_II_MD_REND" => $sheet->getCell('K57')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MD_REND" => $sheet->getCell('K58')->getCalculatedValue(),
								"TRT_I_MD_REND" => $sheet->getCell('K59')->getCalculatedValue(),
								"TRT_II_MD_REND" => $sheet->getCell('K60')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MD_REND" => $sheet->getCell('K61')->getCalculatedValue(),
								"TRS_I_ML_REND" => $sheet->getCell('K62')->getCalculatedValue(),
								"TRS_II_ML_REND" => $sheet->getCell('K63')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_ML_REND" => $sheet->getCell('K64')->getCalculatedValue(),
								"TRT_I_ML_REND" => $sheet->getCell('K65')->getCalculatedValue(),
								"TRT_II_ML_REND" => $sheet->getCell('K66')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_ML_REND" => $sheet->getCell('K67')->getCalculatedValue(),
								"TRS_I_KS_REND" => $sheet->getCell('K68')->getCalculatedValue(),
								"TRS_II_KS_REND" => $sheet->getCell('K69')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_KS_REND" => $sheet->getCell('K70')->getCalculatedValue(),
								"TRT_I_KS_REND" => $sheet->getCell('K71')->getCalculatedValue(),
								"TRT_II_KS_REND" => $sheet->getCell('K72')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_KS_REND" => $sheet->getCell('K73')->getCalculatedValue(),
								"TRS_I_MR_REND" => $sheet->getCell('K74')->getCalculatedValue(),
								"TRS_II_MR_REND" => $sheet->getCell('K75')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRS_MR_REND" => $sheet->getCell('K76')->getCalculatedValue(),
								"TRT_I_MR_REND" => $sheet->getCell('K77')->getCalculatedValue(),
								"TRT_II_MR_REND" => $sheet->getCell('K78')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TRT_MR_REND" => $sheet->getCell('K79')->getCalculatedValue(),
								"TR_TK_REND" => $sheet->getCell('K80')->getCalculatedValue(),
								"TR_TM_REND" => $sheet->getCell('K81')->getCalculatedValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_REND" => $sheet->getCell('K82')->getCalculatedValue(),
								"JUMLAHRATA_TR_REND" => $sheet->getCell('K83')->getCalculatedValue(),
								"JUMLAH_RATA_RATA_TS_TR_REND" => $sheet->getCell('K84')->getCalculatedValue(),
								);
	      $arr_pabrikasi = array(
	      						"PERIODE" => $PERIODE, 
	      						"UNIT" => $this->namapg, 
	      						"AWAL_GILING" => $AWAL_GILING, 
	      						"AKHIR_GILING" => $AKHIR_GILING, 
	      						"GKP_I" => $sheet->getCell('E92')->getCalculatedValue(), 
								"GKP_II" => $sheet->getCell('E93')->getCalculatedValue(),
								"TETES" => $sheet->getCell('E94')->getCalculatedValue(),
								"KAP_GILING_EXCL_KES" => $sheet->getCell('E7')->getCalculatedValue(),
								"KAP_GILING_INCL_KIS_TNP_HR" => $sheet->getCell('E8')->getCalculatedValue(),
								"KAP_GILING_INCL_KIS_DG_HR" => $sheet->getCell('E9')->getCalculatedValue(),
								"PERSEN_JAM_STOP_LUAR_PG_TANPA_HR" => $sheet->getCell('E101')->getCalculatedValue(),
								"PERSEN_JAM_STOP_LUAR_PG_DG_HR" => $sheet->getCell('E102')->getCalculatedValue(),
								"PERSEN_JAM_STOP_DALAM_PG" => $sheet->getCell('E103')->getCalculatedValue(),
								"HARI_GIL_EXCL_JAM_STOP" => $sheet->getCell('E104')->getCalculatedValue(),
								"HARI_GIL_INCL_JAM_STOP_TANPA_HR" => $sheet->getCell('E105')->getCalculatedValue(),
								"HARI_GIL_INCL_JAM_STOP_DG_HR" => $sheet->getCell('E106')->getCalculatedValue(),
								"SABUT_PERSEN_TEBU" => $sheet->getCell('E108')->getCalculatedValue(),
								"IMBIBISI_PERSEN_SABUT" => $sheet->getCell('E109')->getCalculatedValue(),
								"KADAR_NIRA_TEBU" => $sheet->getCell('E110')->getCalculatedValue(),
								"HPG_125" => $sheet->getCell('E111')->getCalculatedValue(),
								"HPB_TOTAL" => $sheet->getCell('E112')->getCalculatedValue(),
								"PSHK" => $sheet->getCell('E113')->getCalculatedValue(),
								"NILAI_NIRA_NPP" => $sheet->getCell('E114')->getCalculatedValue(),
								"ME" => $sheet->getCell('E115')->getCalculatedValue(),
								"BHR" => $sheet->getCell('E116')->getCalculatedValue(),
								"OR_PABRIKASI" => $sheet->getCell('E117')->getCalculatedValue(),
								"HK_NIRA_MENTAH" => $sheet->getCell('E119')->getCalculatedValue(),
								"HK_TETES" => $sheet->getCell('E120')->getCalculatedValue(),
								"RENDEMEN_WINTER" => $sheet->getCell('E121')->getCalculatedValue(),
								"FAKTOR_RENDEMEN" => $sheet->getCell('E122')->getCalculatedValue(),
								"RENDEMEN_KETEL" => $sheet->getCell('E124')->getCalculatedValue(),
								"KCALBRIX_NMENTAH" => $sheet->getCell('E125')->getCalculatedValue(),
								"KG_UAPKG_TEBU" => $sheet->getCell('E126')->getCalculatedValue(),
								"TON_GKP_I_LALU" => $sheet->getCell('E129')->getCalculatedValue(),
								"TON_GKP_II_LALU" => $sheet->getCell('E130')->getCalculatedValue(),
								"TON_GKP_I_INI" => $sheet->getCell('E132')->getCalculatedValue(),
								"TON_GKP_II_INI" => $sheet->getCell('E133')->getCalculatedValue(),
								"TON_TETES_INI" => $sheet->getCell('E134')->getCalculatedValue(),
								"LEMBAR_KARUNG" => $sheet->getCell('E135')->getCalculatedValue(),
								"KRISTAL_PG" => $sheet->getCell('E137')->getCalculatedValue(),
								"KRISTAL_PETANI" => $sheet->getCell('E138')->getCalculatedValue(),
								"KRISTAL_EX_TS" => $sheet->getCell('E139')->getCalculatedValue()
	      					);
			$arr_rincian_gula = array(
							"PERIODE" => $PERIODE, 
							"UNIT" => $this->namapg, 
      						"AWAL_GILING" => $AWAL_GILING, 
      						"AKHIR_GILING" => $AKHIR_GILING,
							"GKP_I_EX_TEBU_SENDIRI" => $sheet->getCell('K93')->getCalculatedValue(),
							"GKP_II_EX_TEBU_SENDIRI" => $sheet->getCell('K94')->getCalculatedValue(),
							"JUMLAH_EX_TEBU_SENDIRI" => $sheet->getCell('K95')->getCalculatedValue(),
							"GKP_I_BAGIAN_PG" => $sheet->getCell('K99')->getCalculatedValue(),
							"GKP_II_BAGIAN_PG" => $sheet->getCell('K100')->getCalculatedValue(),
							"JUMLAH_BAGIAN_PG" => $sheet->getCell('K101')->getCalculatedValue(),
							"GKP_I_BAGIAN_PTR" => $sheet->getCell('K104')->getCalculatedValue(),
							"GKP_II_BAGIAN_PTR" => $sheet->getCell('K105')->getCalculatedValue(),
							"JUMLAH_BAGIAN_PTR" => $sheet->getCell('K106')->getCalculatedValue(),
							"GKP_I_JUMLAH_EX_TR" => $sheet->getCell('K109')->getCalculatedValue(),
							"GKP_II_JUMLAH_EX_TR" => $sheet->getCell('K110')->getCalculatedValue(),
							"JUMLAH_JUMLAH_EX_TR" => $sheet->getCell('K111')->getCalculatedValue(),
							"GKP_I_EX_GULA_SISAN" => $sheet->getCell('K114')->getCalculatedValue(),
							"GKP_II_EX_GULA_SISAN" => $sheet->getCell('K115')->getCalculatedValue(),
							"JUMLAH_EX_GULA_SISAN" => $sheet->getCell('K116')->getCalculatedValue(),
							"GKP_I_EX_ROW_SUGAR" => $sheet->getCell('K119')->getCalculatedValue(),
							"GKP_II_EX_ROW_SUGAR" => $sheet->getCell('K120')->getCalculatedValue(),
							"JUMLAH_EX_ROW_SUGAR" => $sheet->getCell('K121')->getCalculatedValue(),
							"JUMLAH" => $sheet->getCell('K122')->getCalculatedValue(),
							"TETES_HAK_PETANI" => $sheet->getCell('K124')->getCalculatedValue()

				);
	      $this->crud_model->insert('telgil_produksi', $arr_produksi);
	      $this->crud_model->insert('telgil_fabrikasi', $arr_pabrikasi);
	      $this->crud_model->insert('telgil_rincian_gula', $arr_rincian_gula);
	
    }

    public function saveExcelEvaluasi()
    {
    	$file = $this->input->get('file');
    	$method = $this->input->get('method');
    	// include 'PHPExcel/IOFactory.php';
    	$this->load->library("excel");

		$inputFileName = './assets/uploads/files/'.$file;

		//  Read your Excel workbook
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$objPHPExcelGET = new PHPExcel();
		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();


			$arr_evaluasi = array(
					"PERIODE" => PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('D5')->getCalculatedValue(),  'YYYY-MM-DD'),
					"UNIT" => $this->namapg,
					"TEBU_SENDIRI_LUAS_HA_INI" => $sheet->getCell('E11')->getCalculatedValue(),
					"TEBU_PETANI_LUAS_HA_INI" => $sheet->getCell('E12')->getCalculatedValue(),
					"JUMLAH_LUAS_HA_INI" => $sheet->getCell('E13')->getCalculatedValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_INI" => $sheet->getCell('E15')->getCalculatedValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_INI" => $sheet->getCell('E16')->getCalculatedValue(),
					"JUMLAH_TEBU_DIGILING_TON_INI" => $sheet->getCell('E17')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_INI" => $sheet->getCell('E19')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR_HASILTON_INI" => $sheet->getCell('E20')->getCalculatedValue(),
					"JUMLAH_HABLUR_HASILTON_INI" => $sheet->getCell('E21')->getCalculatedValue(),
					"TEBU_SENDIRI_RENDEMEN_INI" => $sheet->getCell('E23')->getCalculatedValue(),
					"TEBU_PETANI_RENDEMEN_INI" => $sheet->getCell('E24')->getCalculatedValue(),
					"JUMLAH_RENDEMEN_INI" => $sheet->getCell('E25')->getCalculatedValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_INI" => $sheet->getCell('E27')->getCalculatedValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_INI" => $sheet->getCell('E28')->getCalculatedValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_INI" => $sheet->getCell('E29')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_INI" => $sheet->getCell('E31')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_INI" => $sheet->getCell('E32')->getCalculatedValue(),
					"JUMLAH_HABLUR__HA_TONHA_INI" => $sheet->getCell('E33')->getCalculatedValue(),
					"MILIK_PG_HABLUR_MILIK_TON_INI" => $sheet->getCell('E35')->getCalculatedValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_INI" => $sheet->getCell('E36')->getCalculatedValue(),
					"JUMLAH_HABLUR_MILIK_TON_INI" => $sheet->getCell('E37')->getCalculatedValue(),
					"MILIK_PG_GULA_MILIK_INI" => $sheet->getCell('E39')->getCalculatedValue(),
					"MILIK_PETANI_GULA_MILIK_INI" => $sheet->getCell('E40')->getCalculatedValue(),
					"JUMLAH_GULA_MILIK_INI" => $sheet->getCell('E41')->getCalculatedValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_INI" => $sheet->getCell('E43')->getCalculatedValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_INI" => $sheet->getCell('E44')->getCalculatedValue(),
					"JUMLAH_PRODUKSI_TETES_TON_INI" => $sheet->getCell('E45')->getCalculatedValue(),
					"PERSEN_POL_TEBU_INI" => $sheet->getCell('E46')->getCalculatedValue(),
					"PERSEN_BRIX_TEBU_INI" => $sheet->getCell('E47')->getCalculatedValue(),
					"NILAI_NIRA_INI" => $sheet->getCell('E48')->getCalculatedValue(),
					"KADAR_NIRA_TEBU_INI" => $sheet->getCell('E49')->getCalculatedValue(),
					"KECGILING_EXCL_TON_INI" => $sheet->getCell('E51')->getCalculatedValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_INI" => $sheet->getCell('E52')->getCalculatedValue(),
					"KECGILING_INCL_HARI_RAYA_TON_INI" => $sheet->getCell('E53')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_INI" => $sheet->getCell('E54')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_INI" => $sheet->getCell('E55')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_INI" => $sheet->getCell('E56')->getCalculatedValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_INI" => $sheet->getCell('E57')->getCalculatedValue(),
					"NIRA_MENTAH_PERSEN_TEBU_INI" => $sheet->getCell('E58')->getCalculatedValue(),
					"IMBIBISI_PERSEN_SABUT_INI" => $sheet->getCell('E59')->getCalculatedValue(),
					"HPB_I_INI" => $sheet->getCell('E60')->getCalculatedValue(),
					"HPB_TOTAL_INI" => $sheet->getCell('E61')->getCalculatedValue(),
					"HPG_INI" => $sheet->getCell('E62')->getCalculatedValue(),
					"HPG_125_INI" => $sheet->getCell('E63')->getCalculatedValue(),
					"POL_AMPAS_INI" => $sheet->getCell('E64')->getCalculatedValue(),
					"PERSEN_BAHAN_KERING_AMPAS_INI" => $sheet->getCell('E65')->getCalculatedValue(),
					"SABUT_PERSEN_TEBU_INI" => $sheet->getCell('E66')->getCalculatedValue(),
					"PSHK_INI" => $sheet->getCell('E67')->getCalculatedValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_INI" => $sheet->getCell('E68')->getCalculatedValue(),
					"EFISIENSI_GILINGAN_INI" => $sheet->getCell('E69')->getCalculatedValue(),
					"POL_BLOTONG_INI" => $sheet->getCell('E71')->getCalculatedValue(),
					"PENGASINGAN_BUKAN_GULA_INI" => $sheet->getCell('E72')->getCalculatedValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_INI" => $sheet->getCell('E73')->getCalculatedValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_INI" => $sheet->getCell('E74')->getCalculatedValue(),
					"WINTER_RENDEMEN_INI" => $sheet->getCell('E75')->getCalculatedValue(),
					"BHR__INI" => $sheet->getCell('E76')->getCalculatedValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_INI" => $sheet->getCell('E77')->getCalculatedValue(),
					"POL_HILANG_DALAM_AMPAS_INI" => $sheet->getCell('E78')->getCalculatedValue(),
					"POL_HILANG_DALAM_BLOTONG_INI" => $sheet->getCell('E79')->getCalculatedValue(),
					"POL_HILANG_DALAM_TETES_INI" => $sheet->getCell('E80')->getCalculatedValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_INI" => $sheet->getCell('E81')->getCalculatedValue(),
					"TOTAL_KEHILANGAN_INI" => $sheet->getCell('E82')->getCalculatedValue(),
					"EFFISIENSI_PABRIK_INI" => $sheet->getCell('E84')->getCalculatedValue(),
					"OVERALL_RECOVERY_INI" => $sheet->getCell('E85')->getCalculatedValue(),
					"FAKTOR_RENDEMEN_INI" => $sheet->getCell('E86')->getCalculatedValue(),
					"RENDEMEN_EFEKTIF_INI" => $sheet->getCell('E87')->getCalculatedValue(),
					"HK_NIRA_MENTAH_INI" => $sheet->getCell('E88')->getCalculatedValue(),
					"KEHIL_POL_PERSEN_POL_NM_INI" => $sheet->getCell('E89')->getCalculatedValue(),
					"KAPUR_KG_INI" => $sheet->getCell('E91')->getCalculatedValue(),
					"KAPUR__100_TON_TEBU_INI" => $sheet->getCell('E92')->getCalculatedValue(),
					"BELERANG_KG_INI" => $sheet->getCell('E93')->getCalculatedValue(),
					"BELERANG__100_TON_TEBU_INI" => $sheet->getCell('E94')->getCalculatedValue(),
					"ASAM_PHOSPHAT_KG_INI" => $sheet->getCell('E95')->getCalculatedValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_INI" => $sheet->getCell('E96')->getCalculatedValue(),
					"FLOCULANT_KG_INI" => $sheet->getCell('E97')->getCalculatedValue(),
					"FLOCULANT__100_TON_TEBU_INI" => $sheet->getCell('E98')->getCalculatedValue(),
					"FILTER_AID_KG_INI" => $sheet->getCell('E99')->getCalculatedValue(),
					"FILTER_AID__100_TON_TEBU_INI" => $sheet->getCell('E100')->getCalculatedValue(),
					"PELUNAK_KERAK_KG_INI" => $sheet->getCell('E101')->getCalculatedValue(),
					"PELUNAK_KERAK__100_TON_TEBU_INI" => $sheet->getCell('E102')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_INI_A" => $sheet->getCell('E104')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_INI_A" => $sheet->getCell('E105')->getCalculatedValue(),
					"HK_MASAKAN_INI_A" => $sheet->getCell('E106')->getCalculatedValue(),
					"PURITY_DROP_INI_A" => $sheet->getCell('E107')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_INI_A" => $sheet->getCell('E108')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_INI_B" => $sheet->getCell('E110')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_INI_B" => $sheet->getCell('E111')->getCalculatedValue(),
					"HK_MASAKAN_INI_B" => $sheet->getCell('E112')->getCalculatedValue(),
					"PURITY_DROP_INI_B" => $sheet->getCell('E113')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_INI_B" => $sheet->getCell('E114')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_INI_C" => $sheet->getCell('E116')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_INI_C" => $sheet->getCell('E117')->getCalculatedValue(),
					"HK_MASAKAN_INI_C" => $sheet->getCell('E118')->getCalculatedValue(),
					"PURITY_DROP_INI_C" => $sheet->getCell('E119')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_INI_C" => $sheet->getCell('E120')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_INI_D" => $sheet->getCell('E122')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_INI_D" => $sheet->getCell('E123')->getCalculatedValue(),
					"HK_MASAKAN_INI_D" => $sheet->getCell('E124')->getCalculatedValue(),
					"PURITY_DROP_INI_D" => $sheet->getCell('E125')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_INI_D" => $sheet->getCell('E126')->getCalculatedValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_INI" => $sheet->getCell('E127')->getCalculatedValue(),
					"TETES_PERSEN_TEBU_INI" => $sheet->getCell('E128')->getCalculatedValue(),
					"PERSEN_BRIX_TETES_INI" => $sheet->getCell('E129')->getCalculatedValue(),
					"HK_TETES_INI" => $sheet->getCell('E130')->getCalculatedValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_INI" => $sheet->getCell('E131')->getCalculatedValue(),
					"RENDEMEN_KETEL_INI" => $sheet->getCell('E133')->getCalculatedValue(),
					"KG_UAP_KG_TEBU_INI" => $sheet->getCell('E134')->getCalculatedValue(),
					"PEMAKAIAN_BBA_TON_INI" => $sheet->getCell('E135')->getCalculatedValue(),
					"TEBU_TERBAKAR_TS_TON_INI" => $sheet->getCell('E137')->getCalculatedValue(),
					"TEBU_TERBAKAR_TR_TON_INI" => $sheet->getCell('E138')->getCalculatedValue(),
					"JUMLAH_INI" => $sheet->getCell('E139')->getCalculatedValue(),
					"GULA_SISAN_EX_TAHUN_LALU_INI" => $sheet->getCell('E141')->getCalculatedValue(),
					"RE_PROSES_EX_TAHUN_LALU_INI" => $sheet->getCell('E142')->getCalculatedValue(),
					

					"TEBU_SENDIRI_LUAS_HA_SD_INI" => $sheet->getCell('F11')->getCalculatedValue(),
					"TEBU_PETANI_LUAS_HA_SD_INI" => $sheet->getCell('F12')->getCalculatedValue(),
					"JUMLAH_LUAS_HA_SD_INI" => $sheet->getCell('F13')->getCalculatedValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_SD_INI" => $sheet->getCell('F15')->getCalculatedValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_SD_INI" => $sheet->getCell('F16')->getCalculatedValue(),
					"JUMLAH_TEBU_DIGILING_TON_SD_INI" => $sheet->getCell('F17')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_SD_INI" => $sheet->getCell('F19')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR_HASILTON_SD_INI" => $sheet->getCell('F20')->getCalculatedValue(),
					"JUMLAH_HABLUR_HASILTON_SD_INI" => $sheet->getCell('F21')->getCalculatedValue(),
					"TEBU_SENDIRI_RENDEMEN_SD_INI" => $sheet->getCell('F23')->getCalculatedValue(),
					"TEBU_PETANI_RENDEMEN_SD_INI" => $sheet->getCell('F24')->getCalculatedValue(),
					"JUMLAH_RENDEMEN_SD_INI" => $sheet->getCell('F25')->getCalculatedValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_SD_INI" => $sheet->getCell('F27')->getCalculatedValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_SD_INI" => $sheet->getCell('F28')->getCalculatedValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_SD_INI" => $sheet->getCell('F29')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_SD_INI" => $sheet->getCell('F31')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_SD_INI" => $sheet->getCell('F32')->getCalculatedValue(),
					"JUMLAH_HABLUR__HA_TONHA_SD_INI" => $sheet->getCell('F33')->getCalculatedValue(),
					"MILIK_PG_HABLUR_MILIK_TON_SD_INI" => $sheet->getCell('F35')->getCalculatedValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_SD_INI" => $sheet->getCell('F36')->getCalculatedValue(),
					"JUMLAH_HABLUR_MILIK_TON_SD_INI" => $sheet->getCell('F37')->getCalculatedValue(),
					"MILIK_PG_GULA_MILIK_SD_INI" => $sheet->getCell('F39')->getCalculatedValue(),
					"MILIK_PETANI_GULA_MILIK_SD_INI" => $sheet->getCell('F40')->getCalculatedValue(),
					"JUMLAH_GULA_MILIK_SD_INI" => $sheet->getCell('F41')->getCalculatedValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_SD_INI" => $sheet->getCell('F43')->getCalculatedValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_SD_INI" => $sheet->getCell('F44')->getCalculatedValue(),
					"JUMLAH_PRODUKSI_TETES_TON_SD_INI" => $sheet->getCell('F45')->getCalculatedValue(),
					"PERSEN_POL_TEBU_SD_INI" => $sheet->getCell('F46')->getCalculatedValue(),
					"PERSEN_BRIX_TEBU_SD_INI" => $sheet->getCell('F47')->getCalculatedValue(),
					"NILAI_NIRA_SD_INI" => $sheet->getCell('F48')->getCalculatedValue(),
					"KADAR_NIRA_TEBU_SD_INI" => $sheet->getCell('F49')->getCalculatedValue(),
					"KECGILING_EXCL_TON_SD_INI" => $sheet->getCell('F51')->getCalculatedValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_SD_INI" => $sheet->getCell('F52')->getCalculatedValue(),
					"KECGILING_INCL_HARI_RAYA_TON_SD_INI" => $sheet->getCell('F53')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_SD_INI" => $sheet->getCell('F54')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_SD_INI" => $sheet->getCell('F55')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_SD_INI" => $sheet->getCell('F56')->getCalculatedValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_SD_INI" => $sheet->getCell('F57')->getCalculatedValue(),
					"NIRA_MENTAH_PERSEN_TEBU_SD_INI" => $sheet->getCell('F58')->getCalculatedValue(),
					"IMBIBISI_PERSEN_SABUT_SD_INI" => $sheet->getCell('F59')->getCalculatedValue(),
					"HPB_I_SD_INI" => $sheet->getCell('F60')->getCalculatedValue(),
					"HPB_TOTAL_SD_INI" => $sheet->getCell('F61')->getCalculatedValue(),
					"HPG_SD_INI" => $sheet->getCell('F62')->getCalculatedValue(),
					"HPG_125_SD_INI" => $sheet->getCell('F63')->getCalculatedValue(),
					"POL_AMPAS_SD_INI" => $sheet->getCell('F64')->getCalculatedValue(),
					"PERSEN_BAHAN_KERING_AMPAS_SD_INI" => $sheet->getCell('F65')->getCalculatedValue(),
					"SABUT_PERSEN_TEBU_SD_INI" => $sheet->getCell('F66')->getCalculatedValue(),
					"PSHK_SD_INI" => $sheet->getCell('F67')->getCalculatedValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_SD_INI" => $sheet->getCell('F68')->getCalculatedValue(),
					"EFISIENSI_GILINGAN_SD_INI" => $sheet->getCell('F69')->getCalculatedValue(),
					"POL_BLOTONG_SD_INI" => $sheet->getCell('F71')->getCalculatedValue(),
					"PENGASINGAN_BUKAN_GULA_SD_INI" => $sheet->getCell('F72')->getCalculatedValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_SD_INI" => $sheet->getCell('F73')->getCalculatedValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_SD_INI" => $sheet->getCell('F74')->getCalculatedValue(),
					"WINTER_RENDEMEN_SD_INI" => $sheet->getCell('F75')->getCalculatedValue(),
					"BHR__SD_INI" => $sheet->getCell('F76')->getCalculatedValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_SD_INI" => $sheet->getCell('F77')->getCalculatedValue(),
					"POL_HILANG_DALAM_AMPAS_SD_INI" => $sheet->getCell('F78')->getCalculatedValue(),
					"POL_HILANG_DALAM_BLOTONG_SD_INI" => $sheet->getCell('F79')->getCalculatedValue(),
					"POL_HILANG_DALAM_TETES_SD_INI" => $sheet->getCell('F80')->getCalculatedValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_SD_INI" => $sheet->getCell('F81')->getCalculatedValue(),
					"TOTAL_KEHILANGAN_SD_INI" => $sheet->getCell('F82')->getCalculatedValue(),
					"EFFISIENSI_PABRIK_SD_INI" => $sheet->getCell('F84')->getCalculatedValue(),
					"OVERALL_RECOVERY_SD_INI" => $sheet->getCell('F85')->getCalculatedValue(),
					"FAKTOR_RENDEMEN_SD_INI" => $sheet->getCell('F86')->getCalculatedValue(),
					"RENDEMEN_EFEKTIF_SD_INI" => $sheet->getCell('F87')->getCalculatedValue(),
					"HK_NIRA_MENTAH_SD_INI" => $sheet->getCell('F88')->getCalculatedValue(),
					"KEHIL_POL_PERSEN_POL_NM_SD_INI" => $sheet->getCell('F89')->getCalculatedValue(),
					"KAPUR_KG_SD_INI" => $sheet->getCell('F91')->getCalculatedValue(),
					"KAPUR__100_TON_TEBU_SD_INI" => $sheet->getCell('F92')->getCalculatedValue(),
					"BELERANG_KG_SD_INI" => $sheet->getCell('F93')->getCalculatedValue(),
					"BELERANG__100_TON_TEBU_SD_INI" => $sheet->getCell('F94')->getCalculatedValue(),
					"ASAM_PHOSPHAT_KG_SD_INI" => $sheet->getCell('F95')->getCalculatedValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_SD_INI" => $sheet->getCell('F96')->getCalculatedValue(),
					"FLOCULANT_KG_SD_INI" => $sheet->getCell('F97')->getCalculatedValue(),
					"FLOCULANT__100_TON_TEBU_SD_INI" => $sheet->getCell('F98')->getCalculatedValue(),
					"FILTER_AID_KG_SD_INI" => $sheet->getCell('F99')->getCalculatedValue(),
					"FILTER_AID__100_TON_TEBU_SD_INI" => $sheet->getCell('F100')->getCalculatedValue(),
					"PELUNAK_KERAK_KG_SD_INI" => $sheet->getCell('F101')->getCalculatedValue(),
					"PELUNAK_KERAK__100_TON_TEBU_SD_INI" => $sheet->getCell('F102')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_SD_INI_A" => $sheet->getCell('F104')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_SD_INI_A" => $sheet->getCell('F105')->getCalculatedValue(),
					"HK_MASAKAN_SD_INI_A" => $sheet->getCell('F106')->getCalculatedValue(),
					"PURITY_DROP_SD_INI_A" => $sheet->getCell('F107')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_SD_INI_A" => $sheet->getCell('F108')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_SD_INI_B" => $sheet->getCell('F110')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_SD_INI_B" => $sheet->getCell('F111')->getCalculatedValue(),
					"HK_MASAKAN_SD_INI_B" => $sheet->getCell('F112')->getCalculatedValue(),
					"PURITY_DROP_SD_INI_B" => $sheet->getCell('F113')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_SD_INI_B" => $sheet->getCell('F114')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_SD_INI_C" => $sheet->getCell('F116')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_SD_INI_C" => $sheet->getCell('F117')->getCalculatedValue(),
					"HK_MASAKAN_SD_INI_C" => $sheet->getCell('F118')->getCalculatedValue(),
					"PURITY_DROP_SD_INI_C" => $sheet->getCell('F119')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_SD_INI_C" => $sheet->getCell('F120')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_SD_INI_D" => $sheet->getCell('F122')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_SD_INI_D" => $sheet->getCell('F123')->getCalculatedValue(),
					"HK_MASAKAN_SD_INI_D" => $sheet->getCell('F124')->getCalculatedValue(),
					"PURITY_DROP_SD_INI_D" => $sheet->getCell('F125')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_SD_INI_D" => $sheet->getCell('F126')->getCalculatedValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_SD_INI" => $sheet->getCell('F127')->getCalculatedValue(),
					"TETES_PERSEN_TEBU_SD_INI" => $sheet->getCell('F128')->getCalculatedValue(),
					"PERSEN_BRIX_TETES_SD_INI" => $sheet->getCell('F129')->getCalculatedValue(),
					"HK_TETES_SD_INI" => $sheet->getCell('F130')->getCalculatedValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_SD_INI" => $sheet->getCell('F131')->getCalculatedValue(),
					"RENDEMEN_KETEL_SD_INI" => $sheet->getCell('F133')->getCalculatedValue(),
					"KG_UAP_KG_TEBU_SD_INI" => $sheet->getCell('F134')->getCalculatedValue(),
					"PEMAKAIAN_BBA_TON_SD_INI" => $sheet->getCell('F135')->getCalculatedValue(),
					"TEBU_TERBAKAR_TS_TON_SD_INI" => $sheet->getCell('F137')->getCalculatedValue(),
					"TEBU_TERBAKAR_TR_TON_SD_INI" => $sheet->getCell('F138')->getCalculatedValue(),
					"JUMLAH_SD_INI" => $sheet->getCell('F139')->getCalculatedValue(),
					"GULA_SISAN_EX_TAHUN_LALU_SD_INI" => $sheet->getCell('F141')->getCalculatedValue(),
					"RE_PROSES_EX_TAHUN_LALU_SD_INI" => $sheet->getCell('F142')->getCalculatedValue(),
					

					"TEBU_SENDIRI_LUAS_HA_THN_LALU_SD_INI" => $sheet->getCell('G11')->getCalculatedValue(),
					"TEBU_PETANI_LUAS_HA_THN_LALU_SD_INI" => $sheet->getCell('G12')->getCalculatedValue(),
					"JUMLAH_LUAS_HA_THN_LALU_SD_INI" => $sheet->getCell('G13')->getCalculatedValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_THN_LALU_SD_INI" => $sheet->getCell('G15')->getCalculatedValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_THN_LALU_SD_INI" => $sheet->getCell('G16')->getCalculatedValue(),
					"JUMLAH_TEBU_DIGILING_TON_THN_LALU_SD_INI" => $sheet->getCell('G17')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_THN_LALU_SD_INI" => $sheet->getCell('G19')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR_HASILTON_THN_LALU_SD_INI" => $sheet->getCell('G20')->getCalculatedValue(),
					"JUMLAH_HABLUR_HASILTON_THN_LALU_SD_INI" => $sheet->getCell('G21')->getCalculatedValue(),
					"TEBU_SENDIRI_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G23')->getCalculatedValue(),
					"TEBU_PETANI_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G24')->getCalculatedValue(),
					"JUMLAH_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G25')->getCalculatedValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_THN_LALU_SD_INI" => $sheet->getCell('G27')->getCalculatedValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_THN_LALU_SD_INI" => $sheet->getCell('G28')->getCalculatedValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_THN_LALU_SD_INI" => $sheet->getCell('G29')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_THN_LALU_SD_INI" => $sheet->getCell('G31')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_THN_LALU_SD_INI" => $sheet->getCell('G32')->getCalculatedValue(),
					"JUMLAH_HABLUR__HA_TONHA_THN_LALU_SD_INI" => $sheet->getCell('G33')->getCalculatedValue(),
					"MILIK_PG_HABLUR_MILIK_TON_THN_LALU_SD_INI" => $sheet->getCell('G35')->getCalculatedValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_THN_LALU_SD_INI" => $sheet->getCell('G36')->getCalculatedValue(),
					"JUMLAH_HABLUR_MILIK_TON_THN_LALU_SD_INI" => $sheet->getCell('G37')->getCalculatedValue(),
					"MILIK_PG_GULA_MILIK_THN_LALU_SD_INI" => $sheet->getCell('G39')->getCalculatedValue(),
					"MILIK_PETANI_GULA_MILIK_THN_LALU_SD_INI" => $sheet->getCell('G40')->getCalculatedValue(),
					"JUMLAH_GULA_MILIK_THN_LALU_SD_INI" => $sheet->getCell('G41')->getCalculatedValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_THN_LALU_SD_INI" => $sheet->getCell('G43')->getCalculatedValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_THN_LALU_SD_INI" => $sheet->getCell('G44')->getCalculatedValue(),
					"JUMLAH_PRODUKSI_TETES_TON_THN_LALU_SD_INI" => $sheet->getCell('G45')->getCalculatedValue(),
					"PERSEN_POL_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G46')->getCalculatedValue(),
					"PERSEN_BRIX_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G47')->getCalculatedValue(),
					"NILAI_NIRA_THN_LALU_SD_INI" => $sheet->getCell('G48')->getCalculatedValue(),
					"KADAR_NIRA_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G49')->getCalculatedValue(),
					"KECGILING_EXCL_TON_THN_LALU_SD_INI" => $sheet->getCell('G51')->getCalculatedValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_THN_LALU_SD_INI" => $sheet->getCell('G52')->getCalculatedValue(),
					"KECGILING_INCL_HARI_RAYA_TON_THN_LALU_SD_INI" => $sheet->getCell('G53')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_THN_LALU_SD_INI" => $sheet->getCell('G54')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_THN_LALU_SD_INI" => $sheet->getCell('G55')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_THN_LALU_SD_INI" => $sheet->getCell('G56')->getCalculatedValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_THN_LALU_SD_INI" => $sheet->getCell('G57')->getCalculatedValue(),
					"NIRA_MENTAH_PERSEN_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G58')->getCalculatedValue(),
					"IMBIBISI_PERSEN_SABUT_THN_LALU_SD_INI" => $sheet->getCell('G59')->getCalculatedValue(),
					"HPB_I_THN_LALU_SD_INI" => $sheet->getCell('G60')->getCalculatedValue(),
					"HPB_TOTAL_THN_LALU_SD_INI" => $sheet->getCell('G61')->getCalculatedValue(),
					"HPG_THN_LALU_SD_INI" => $sheet->getCell('G62')->getCalculatedValue(),
					"HPG_125_THN_LALU_SD_INI" => $sheet->getCell('G63')->getCalculatedValue(),
					"POL_AMPAS_THN_LALU_SD_INI" => $sheet->getCell('G64')->getCalculatedValue(),
					"PERSEN_BAHAN_KERING_AMPAS_THN_LALU_SD_INI" => $sheet->getCell('G65')->getCalculatedValue(),
					"SABUT_PERSEN_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G66')->getCalculatedValue(),
					"PSHK_THN_LALU_SD_INI" => $sheet->getCell('G67')->getCalculatedValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_THN_LALU_SD_INI" => $sheet->getCell('G68')->getCalculatedValue(),
					"EFISIENSI_GILINGAN_THN_LALU_SD_INI" => $sheet->getCell('G69')->getCalculatedValue(),
					"POL_BLOTONG_THN_LALU_SD_INI" => $sheet->getCell('G71')->getCalculatedValue(),
					"PENGASINGAN_BUKAN_GULA_THN_LALU_SD_INI" => $sheet->getCell('G72')->getCalculatedValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_THN_LALU_SD_INI" => $sheet->getCell('G73')->getCalculatedValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_THN_LALU_SD_INI" => $sheet->getCell('G74')->getCalculatedValue(),
					"WINTER_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G75')->getCalculatedValue(),
					"BHR__THN_LALU_SD_INI" => $sheet->getCell('G76')->getCalculatedValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_THN_LALU_SD_INI" => $sheet->getCell('G77')->getCalculatedValue(),
					"POL_HILANG_DALAM_AMPAS_THN_LALU_SD_INI" => $sheet->getCell('G78')->getCalculatedValue(),
					"POL_HILANG_DALAM_BLOTONG_THN_LALU_SD_INI" => $sheet->getCell('G79')->getCalculatedValue(),
					"POL_HILANG_DALAM_TETES_THN_LALU_SD_INI" => $sheet->getCell('G80')->getCalculatedValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_THN_LALU_SD_INI" => $sheet->getCell('G81')->getCalculatedValue(),
					"TOTAL_KEHILANGAN_THN_LALU_SD_INI" => $sheet->getCell('G82')->getCalculatedValue(),
					"EFFISIENSI_PABRIK_THN_LALU_SD_INI" => $sheet->getCell('G84')->getCalculatedValue(),
					"OVERALL_RECOVERY_THN_LALU_SD_INI" => $sheet->getCell('G85')->getCalculatedValue(),
					"FAKTOR_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G86')->getCalculatedValue(),
					"RENDEMEN_EFEKTIF_THN_LALU_SD_INI" => $sheet->getCell('G87')->getCalculatedValue(),
					"HK_NIRA_MENTAH_THN_LALU_SD_INI" => $sheet->getCell('G88')->getCalculatedValue(),
					"KEHIL_POL_PERSEN_POL_NM_THN_LALU_SD_INI" => $sheet->getCell('G89')->getCalculatedValue(),
					"KAPUR_KG_THN_LALU_SD_INI" => $sheet->getCell('G91')->getCalculatedValue(),
					"KAPUR__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G92')->getCalculatedValue(),
					"BELERANG_KG_THN_LALU_SD_INI" => $sheet->getCell('G93')->getCalculatedValue(),
					"BELERANG__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G94')->getCalculatedValue(),
					"ASAM_PHOSPHAT_KG_THN_LALU_SD_INI" => $sheet->getCell('G95')->getCalculatedValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G96')->getCalculatedValue(),
					"FLOCULANT_KG_THN_LALU_SD_INI" => $sheet->getCell('G97')->getCalculatedValue(),
					"FLOCULANT__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G98')->getCalculatedValue(),
					"FILTER_AID_KG_THN_LALU_SD_INI" => $sheet->getCell('G99')->getCalculatedValue(),
					"FILTER_AID__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G100')->getCalculatedValue(),
					"PELUNAK_KERAK_KG_THN_LALU_SD_INI" => $sheet->getCell('G101')->getCalculatedValue(),
					"PELUNAK_KERAK__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G102')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_A" => $sheet->getCell('G104')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_A" => $sheet->getCell('G105')->getCalculatedValue(),
					"HK_MASAKAN_THN_LALU_SD_INI_A" => $sheet->getCell('G106')->getCalculatedValue(),
					"PURITY_DROP_THN_LALU_SD_INI_A" => $sheet->getCell('G107')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_THN_LALU_SD_INI_A" => $sheet->getCell('G108')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_B" => $sheet->getCell('G110')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_B" => $sheet->getCell('G111')->getCalculatedValue(),
					"HK_MASAKAN_THN_LALU_SD_INI_B" => $sheet->getCell('G112')->getCalculatedValue(),
					"PURITY_DROP_THN_LALU_SD_INI_B" => $sheet->getCell('G113')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_THN_LALU_SD_INI_B" => $sheet->getCell('G114')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_C" => $sheet->getCell('G116')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_C" => $sheet->getCell('G117')->getCalculatedValue(),
					"HK_MASAKAN_THN_LALU_SD_INI_C" => $sheet->getCell('G118')->getCalculatedValue(),
					"PURITY_DROP_THN_LALU_SD_INI_C" => $sheet->getCell('G119')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_THN_LALU_SD_INI_C" => $sheet->getCell('G120')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_D" => $sheet->getCell('G122')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_D" => $sheet->getCell('G123')->getCalculatedValue(),
					"HK_MASAKAN_THN_LALU_SD_INI_D" => $sheet->getCell('G124')->getCalculatedValue(),
					"PURITY_DROP_THN_LALU_SD_INI_D" => $sheet->getCell('G125')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_THN_LALU_SD_INI_D" => $sheet->getCell('G126')->getCalculatedValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G127')->getCalculatedValue(),
					"TETES_PERSEN_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G128')->getCalculatedValue(),
					"PERSEN_BRIX_TETES_THN_LALU_SD_INI" => $sheet->getCell('G129')->getCalculatedValue(),
					"HK_TETES_THN_LALU_SD_INI" => $sheet->getCell('G130')->getCalculatedValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_THN_LALU_SD_INI" => $sheet->getCell('G131')->getCalculatedValue(),
					"RENDEMEN_KETEL_THN_LALU_SD_INI" => $sheet->getCell('G133')->getCalculatedValue(),
					"KG_UAP_KG_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G134')->getCalculatedValue(),
					"PEMAKAIAN_BBA_TON_THN_LALU_SD_INI" => $sheet->getCell('G135')->getCalculatedValue(),
					"TEBU_TERBAKAR_TS_TON_THN_LALU_SD_INI" => $sheet->getCell('G137')->getCalculatedValue(),
					"TEBU_TERBAKAR_TR_TON_THN_LALU_SD_INI" => $sheet->getCell('G138')->getCalculatedValue(),
					"JUMLAH_THN_LALU_SD_INI" => $sheet->getCell('G139')->getCalculatedValue(),
					"GULA_SISAN_EX_TAHUN_LALU_THN_LALU_SD_INI" => $sheet->getCell('G141')->getCalculatedValue(),
					"RE_PROSES_EX_TAHUN_LALU_THN_LALU_SD_INI" => $sheet->getCell('G142')->getCalculatedValue(),
					

					"TEBU_SENDIRI_LUAS_HA_RKO" => $sheet->getCell('H11')->getCalculatedValue(),
					"TEBU_PETANI_LUAS_HA_RKO" => $sheet->getCell('H12')->getCalculatedValue(),
					"JUMLAH_LUAS_HA_RKO" => $sheet->getCell('H13')->getCalculatedValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_RKO" => $sheet->getCell('H15')->getCalculatedValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_RKO" => $sheet->getCell('H16')->getCalculatedValue(),
					"JUMLAH_TEBU_DIGILING_TON_RKO" => $sheet->getCell('H17')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_RKO" => $sheet->getCell('H19')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR_HASILTON_RKO" => $sheet->getCell('H20')->getCalculatedValue(),
					"JUMLAH_HABLUR_HASILTON_RKO" => $sheet->getCell('H21')->getCalculatedValue(),
					"TEBU_SENDIRI_RENDEMEN_RKO" => $sheet->getCell('H23')->getCalculatedValue(),
					"TEBU_PETANI_RENDEMEN_RKO" => $sheet->getCell('H24')->getCalculatedValue(),
					"JUMLAH_RENDEMEN_RKO" => $sheet->getCell('H25')->getCalculatedValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKO" => $sheet->getCell('H27')->getCalculatedValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKO" => $sheet->getCell('H28')->getCalculatedValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKO" => $sheet->getCell('H29')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_RKO" => $sheet->getCell('H31')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_RKO" => $sheet->getCell('H32')->getCalculatedValue(),
					"JUMLAH_HABLUR__HA_TONHA_RKO" => $sheet->getCell('H33')->getCalculatedValue(),
					"MILIK_PG_HABLUR_MILIK_TON_RKO" => $sheet->getCell('H35')->getCalculatedValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_RKO" => $sheet->getCell('H36')->getCalculatedValue(),
					"JUMLAH_HABLUR_MILIK_TON_RKO" => $sheet->getCell('H37')->getCalculatedValue(),
					"MILIK_PG_GULA_MILIK_RKO" => $sheet->getCell('H39')->getCalculatedValue(),
					"MILIK_PETANI_GULA_MILIK_RKO" => $sheet->getCell('H40')->getCalculatedValue(),
					"JUMLAH_GULA_MILIK_RKO" => $sheet->getCell('H41')->getCalculatedValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_RKO" => $sheet->getCell('H43')->getCalculatedValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_RKO" => $sheet->getCell('H44')->getCalculatedValue(),
					"JUMLAH_PRODUKSI_TETES_TON_RKO" => $sheet->getCell('H45')->getCalculatedValue(),
					"PERSEN_POL_TEBU_RKO" => $sheet->getCell('H46')->getCalculatedValue(),
					"PERSEN_BRIX_TEBU_RKO" => $sheet->getCell('H47')->getCalculatedValue(),
					"NILAI_NIRA_RKO" => $sheet->getCell('H48')->getCalculatedValue(),
					"KADAR_NIRA_TEBU_RKO" => $sheet->getCell('H49')->getCalculatedValue(),
					"KECGILING_EXCL_TON_RKO" => $sheet->getCell('H51')->getCalculatedValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_RKO" => $sheet->getCell('H52')->getCalculatedValue(),
					"KECGILING_INCL_HARI_RAYA_TON_RKO" => $sheet->getCell('H53')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKO" => $sheet->getCell('H54')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKO" => $sheet->getCell('H55')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_RKO" => $sheet->getCell('H56')->getCalculatedValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_RKO" => $sheet->getCell('H57')->getCalculatedValue(),
					"NIRA_MENTAH_PERSEN_TEBU_RKO" => $sheet->getCell('H58')->getCalculatedValue(),
					"IMBIBISI_PERSEN_SABUT_RKO" => $sheet->getCell('H59')->getCalculatedValue(),
					"HPB_I_RKO" => $sheet->getCell('H60')->getCalculatedValue(),
					"HPB_TOTAL_RKO" => $sheet->getCell('H61')->getCalculatedValue(),
					"HPG_RKO" => $sheet->getCell('H62')->getCalculatedValue(),
					"HPG_125_RKO" => $sheet->getCell('H63')->getCalculatedValue(),
					"POL_AMPAS_RKO" => $sheet->getCell('H64')->getCalculatedValue(),
					"PERSEN_BAHAN_KERING_AMPAS_RKO" => $sheet->getCell('H65')->getCalculatedValue(),
					"SABUT_PERSEN_TEBU_RKO" => $sheet->getCell('H66')->getCalculatedValue(),
					"PSHK_RKO" => $sheet->getCell('H67')->getCalculatedValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_RKO" => $sheet->getCell('H68')->getCalculatedValue(),
					"EFISIENSI_GILINGAN_RKO" => $sheet->getCell('H69')->getCalculatedValue(),
					"POL_BLOTONG_RKO" => $sheet->getCell('H71')->getCalculatedValue(),
					"PENGASINGAN_BUKAN_GULA_RKO" => $sheet->getCell('H72')->getCalculatedValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_RKO" => $sheet->getCell('H73')->getCalculatedValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_RKO" => $sheet->getCell('H74')->getCalculatedValue(),
					"WINTER_RENDEMEN_RKO" => $sheet->getCell('H75')->getCalculatedValue(),
					"BHR__RKO" => $sheet->getCell('H76')->getCalculatedValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKO" => $sheet->getCell('H77')->getCalculatedValue(),
					"POL_HILANG_DALAM_AMPAS_RKO" => $sheet->getCell('H78')->getCalculatedValue(),
					"POL_HILANG_DALAM_BLOTONG_RKO" => $sheet->getCell('H79')->getCalculatedValue(),
					"POL_HILANG_DALAM_TETES_RKO" => $sheet->getCell('H80')->getCalculatedValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_RKO" => $sheet->getCell('H81')->getCalculatedValue(),
					"TOTAL_KEHILANGAN_RKO" => $sheet->getCell('H82')->getCalculatedValue(),
					"EFFISIENSI_PABRIK_RKO" => $sheet->getCell('H84')->getCalculatedValue(),
					"OVERALL_RECOVERY_RKO" => $sheet->getCell('H85')->getCalculatedValue(),
					"FAKTOR_RENDEMEN_RKO" => $sheet->getCell('H86')->getCalculatedValue(),
					"RENDEMEN_EFEKTIF_RKO" => $sheet->getCell('H87')->getCalculatedValue(),
					"HK_NIRA_MENTAH_RKO" => $sheet->getCell('H88')->getCalculatedValue(),
					"KEHIL_POL_PERSEN_POL_NM_RKO" => $sheet->getCell('H89')->getCalculatedValue(),
					"KAPUR_KG_RKO" => $sheet->getCell('H91')->getCalculatedValue(),
					"KAPUR__100_TON_TEBU_RKO" => $sheet->getCell('H92')->getCalculatedValue(),
					"BELERANG_KG_RKO" => $sheet->getCell('H93')->getCalculatedValue(),
					"BELERANG__100_TON_TEBU_RKO" => $sheet->getCell('H94')->getCalculatedValue(),
					"ASAM_PHOSPHAT_KG_RKO" => $sheet->getCell('H95')->getCalculatedValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_RKO" => $sheet->getCell('H96')->getCalculatedValue(),
					"FLOCULANT_KG_RKO" => $sheet->getCell('H97')->getCalculatedValue(),
					"FLOCULANT__100_TON_TEBU_RKO" => $sheet->getCell('H98')->getCalculatedValue(),
					"FILTER_AID_KG_RKO" => $sheet->getCell('H99')->getCalculatedValue(),
					"FILTER_AID__100_TON_TEBU_RKO" => $sheet->getCell('H100')->getCalculatedValue(),
					"PELUNAK_KERAK_KG_RKO" => $sheet->getCell('H101')->getCalculatedValue(),
					"PELUNAK_KERAK__100_TON_TEBU_RKO" => $sheet->getCell('H102')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_RKO_A" => $sheet->getCell('H104')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_RKO_A" => $sheet->getCell('H105')->getCalculatedValue(),
					"HK_MASAKAN_RKO_A" => $sheet->getCell('H106')->getCalculatedValue(),
					"PURITY_DROP_RKO_A" => $sheet->getCell('H107')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_RKO_A" => $sheet->getCell('H108')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_RKO_B" => $sheet->getCell('H110')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_RKO_B" => $sheet->getCell('H111')->getCalculatedValue(),
					"HK_MASAKAN_RKO_B" => $sheet->getCell('H112')->getCalculatedValue(),
					"PURITY_DROP_RKO_B" => $sheet->getCell('H113')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_RKO_B" => $sheet->getCell('H114')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_RKO_C" => $sheet->getCell('H116')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_RKO_C" => $sheet->getCell('H117')->getCalculatedValue(),
					"HK_MASAKAN_RKO_C" => $sheet->getCell('H118')->getCalculatedValue(),
					"PURITY_DROP_RKO_C" => $sheet->getCell('H119')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_RKO_C" => $sheet->getCell('H120')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_RKO_D" => $sheet->getCell('H122')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_RKO_D" => $sheet->getCell('H123')->getCalculatedValue(),
					"HK_MASAKAN_RKO_D" => $sheet->getCell('H124')->getCalculatedValue(),
					"PURITY_DROP_RKO_D" => $sheet->getCell('H125')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_RKO_D" => $sheet->getCell('H126')->getCalculatedValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_RKO" => $sheet->getCell('H127')->getCalculatedValue(),
					"TETES_PERSEN_TEBU_RKO" => $sheet->getCell('H128')->getCalculatedValue(),
					"PERSEN_BRIX_TETES_RKO" => $sheet->getCell('H129')->getCalculatedValue(),
					"HK_TETES_RKO" => $sheet->getCell('H130')->getCalculatedValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_RKO" => $sheet->getCell('H131')->getCalculatedValue(),
					"RENDEMEN_KETEL_RKO" => $sheet->getCell('H133')->getCalculatedValue(),
					"KG_UAP_KG_TEBU_RKO" => $sheet->getCell('H134')->getCalculatedValue(),
					"PEMAKAIAN_BBA_TON_RKO" => $sheet->getCell('H135')->getCalculatedValue(),
					"TEBU_TERBAKAR_TS_TON_RKO" => $sheet->getCell('H137')->getCalculatedValue(),
					"TEBU_TERBAKAR_TR_TON_RKO" => $sheet->getCell('H138')->getCalculatedValue(),
					"JUMLAH_RKO" => $sheet->getCell('H139')->getCalculatedValue(),
					"GULA_SISAN_EX_TAHUN_LALU_RKO" => $sheet->getCell('H141')->getCalculatedValue(),
					"RE_PROSES_EX_TAHUN_LALU_RKO" => $sheet->getCell('H142')->getCalculatedValue(),
					

					"TEBU_SENDIRI_LUAS_HA_RKAP" => $sheet->getCell('I11')->getCalculatedValue(),
					"TEBU_PETANI_LUAS_HA_RKAP" => $sheet->getCell('I12')->getCalculatedValue(),
					"JUMLAH_LUAS_HA_RKAP" => $sheet->getCell('I13')->getCalculatedValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_RKAP" => $sheet->getCell('I15')->getCalculatedValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_RKAP" => $sheet->getCell('I16')->getCalculatedValue(),
					"JUMLAH_TEBU_DIGILING_TON_RKAP" => $sheet->getCell('I17')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_RKAP" => $sheet->getCell('I19')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR_HASILTON_RKAP" => $sheet->getCell('I20')->getCalculatedValue(),
					"JUMLAH_HABLUR_HASILTON_RKAP" => $sheet->getCell('I21')->getCalculatedValue(),
					"TEBU_SENDIRI_RENDEMEN_RKAP" => $sheet->getCell('I23')->getCalculatedValue(),
					"TEBU_PETANI_RENDEMEN_RKAP" => $sheet->getCell('I24')->getCalculatedValue(),
					"JUMLAH_RENDEMEN_RKAP" => $sheet->getCell('I25')->getCalculatedValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKAP" => $sheet->getCell('I27')->getCalculatedValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKAP" => $sheet->getCell('I28')->getCalculatedValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKAP" => $sheet->getCell('I29')->getCalculatedValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_RKAP" => $sheet->getCell('I31')->getCalculatedValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_RKAP" => $sheet->getCell('I32')->getCalculatedValue(),
					"JUMLAH_HABLUR__HA_TONHA_RKAP" => $sheet->getCell('I33')->getCalculatedValue(),
					"MILIK_PG_HABLUR_MILIK_TON_RKAP" => $sheet->getCell('I35')->getCalculatedValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_RKAP" => $sheet->getCell('I36')->getCalculatedValue(),
					"JUMLAH_HABLUR_MILIK_TON_RKAP" => $sheet->getCell('I37')->getCalculatedValue(),
					"MILIK_PG_GULA_MILIK_RKAP" => $sheet->getCell('I39')->getCalculatedValue(),
					"MILIK_PETANI_GULA_MILIK_RKAP" => $sheet->getCell('I40')->getCalculatedValue(),
					"JUMLAH_GULA_MILIK_RKAP" => $sheet->getCell('I41')->getCalculatedValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_RKAP" => $sheet->getCell('I43')->getCalculatedValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_RKAP" => $sheet->getCell('I44')->getCalculatedValue(),
					"JUMLAH_PRODUKSI_TETES_TON_RKAP" => $sheet->getCell('I45')->getCalculatedValue(),
					"PERSEN_POL_TEBU_RKAP" => $sheet->getCell('I46')->getCalculatedValue(),
					"PERSEN_BRIX_TEBU_RKAP" => $sheet->getCell('I47')->getCalculatedValue(),
					"NILAI_NIRA_RKAP" => $sheet->getCell('I48')->getCalculatedValue(),
					"KADAR_NIRA_TEBU_RKAP" => $sheet->getCell('I49')->getCalculatedValue(),
					"KECGILING_EXCL_TON_RKAP" => $sheet->getCell('I51')->getCalculatedValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_RKAP" => $sheet->getCell('I52')->getCalculatedValue(),
					"KECGILING_INCL_HARI_RAYA_TON_RKAP" => $sheet->getCell('I53')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKAP" => $sheet->getCell('I54')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKAP" => $sheet->getCell('I55')->getCalculatedValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_RKAP" => $sheet->getCell('I56')->getCalculatedValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_RKAP" => $sheet->getCell('I57')->getCalculatedValue(),
					"NIRA_MENTAH_PERSEN_TEBU_RKAP" => $sheet->getCell('I58')->getCalculatedValue(),
					"IMBIBISI_PERSEN_SABUT_RKAP" => $sheet->getCell('I59')->getCalculatedValue(),
					"HPB_I_RKAP" => $sheet->getCell('I60')->getCalculatedValue(),
					"HPB_TOTAL_RKAP" => $sheet->getCell('I61')->getCalculatedValue(),
					"HPG_RKAP" => $sheet->getCell('I62')->getCalculatedValue(),
					"HPG_125_RKAP" => $sheet->getCell('I63')->getCalculatedValue(),
					"POL_AMPAS_RKAP" => $sheet->getCell('I64')->getCalculatedValue(),
					"PERSEN_BAHAN_KERING_AMPAS_RKAP" => $sheet->getCell('I65')->getCalculatedValue(),
					"SABUT_PERSEN_TEBU_RKAP" => $sheet->getCell('I66')->getCalculatedValue(),
					"PSHK_RKAP" => $sheet->getCell('I67')->getCalculatedValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_RKAP" => $sheet->getCell('I68')->getCalculatedValue(),
					"EFISIENSI_GILINGAN_RKAP" => $sheet->getCell('I69')->getCalculatedValue(),
					"POL_BLOTONG_RKAP" => $sheet->getCell('I71')->getCalculatedValue(),
					"PENGASINGAN_BUKAN_GULA_RKAP" => $sheet->getCell('I72')->getCalculatedValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_RKAP" => $sheet->getCell('I73')->getCalculatedValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_RKAP" => $sheet->getCell('I74')->getCalculatedValue(),
					"WINTER_RENDEMEN_RKAP" => $sheet->getCell('I75')->getCalculatedValue(),
					"BHR__RKAP" => $sheet->getCell('I76')->getCalculatedValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKAP" => $sheet->getCell('I77')->getCalculatedValue(),
					"POL_HILANG_DALAM_AMPAS_RKAP" => $sheet->getCell('I78')->getCalculatedValue(),
					"POL_HILANG_DALAM_BLOTONG_RKAP" => $sheet->getCell('I79')->getCalculatedValue(),
					"POL_HILANG_DALAM_TETES_RKAP" => $sheet->getCell('I80')->getCalculatedValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_RKAP" => $sheet->getCell('I81')->getCalculatedValue(),
					"TOTAL_KEHILANGAN_RKAP" => $sheet->getCell('I82')->getCalculatedValue(),
					"EFFISIENSI_PABRIK_RKAP" => $sheet->getCell('I84')->getCalculatedValue(),
					"OVERALL_RECOVERY_RKAP" => $sheet->getCell('I85')->getCalculatedValue(),
					"FAKTOR_RENDEMEN_RKAP" => $sheet->getCell('I86')->getCalculatedValue(),
					"RENDEMEN_EFEKTIF_RKAP" => $sheet->getCell('I87')->getCalculatedValue(),
					"HK_NIRA_MENTAH_RKAP" => $sheet->getCell('I88')->getCalculatedValue(),
					"KEHIL_POL_PERSEN_POL_NM_RKAP" => $sheet->getCell('I89')->getCalculatedValue(),
					"KAPUR_KG_RKAP" => $sheet->getCell('I91')->getCalculatedValue(),
					"KAPUR__100_TON_TEBU_RKAP" => $sheet->getCell('I92')->getCalculatedValue(),
					"BELERANG_KG_RKAP" => $sheet->getCell('I93')->getCalculatedValue(),
					"BELERANG__100_TON_TEBU_RKAP" => $sheet->getCell('I94')->getCalculatedValue(),
					"ASAM_PHOSPHAT_KG_RKAP" => $sheet->getCell('I95')->getCalculatedValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_RKAP" => $sheet->getCell('I96')->getCalculatedValue(),
					"FLOCULANT_KG_RKAP" => $sheet->getCell('I97')->getCalculatedValue(),
					"FLOCULANT__100_TON_TEBU_RKAP" => $sheet->getCell('I98')->getCalculatedValue(),
					"FILTER_AID_KG_RKAP" => $sheet->getCell('I99')->getCalculatedValue(),
					"FILTER_AID__100_TON_TEBU_RKAP" => $sheet->getCell('I100')->getCalculatedValue(),
					"PELUNAK_KERAK_KG_RKAP" => $sheet->getCell('I101')->getCalculatedValue(),
					"PELUNAK_KERAK__100_TON_TEBU_RKAP" => $sheet->getCell('I102')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_RKAP_A" => $sheet->getCell('I104')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_RKAP_A" => $sheet->getCell('I105')->getCalculatedValue(),
					"HK_MASAKAN_RKAP_A" => $sheet->getCell('I106')->getCalculatedValue(),
					"PURITY_DROP_RKAP_A" => $sheet->getCell('I107')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_RKAP_A" => $sheet->getCell('I108')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_RKAP_B" => $sheet->getCell('I110')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_RKAP_B" => $sheet->getCell('I111')->getCalculatedValue(),
					"HK_MASAKAN_RKAP_B" => $sheet->getCell('I112')->getCalculatedValue(),
					"PURITY_DROP_RKAP_B" => $sheet->getCell('I113')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_RKAP_B" => $sheet->getCell('I114')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_RKAP_C" => $sheet->getCell('I116')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_RKAP_C" => $sheet->getCell('I117')->getCalculatedValue(),
					"HK_MASAKAN_RKAP_C" => $sheet->getCell('I118')->getCalculatedValue(),
					"PURITY_DROP_RKAP_C" => $sheet->getCell('I119')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_RKAP_C" => $sheet->getCell('I120')->getCalculatedValue(),
					"MASAKAN_PERSEN_TEBU_RKAP_D" => $sheet->getCell('I122')->getCalculatedValue(),
					"PERSEN_BRIX_MASAKAN_RKAP_D" => $sheet->getCell('I123')->getCalculatedValue(),
					"HK_MASAKAN_RKAP_D" => $sheet->getCell('I124')->getCalculatedValue(),
					"PURITY_DROP_RKAP_D" => $sheet->getCell('I125')->getCalculatedValue(),
					"KRISTAL_PERSEN_POL_RKAP_D" => $sheet->getCell('I126')->getCalculatedValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_RKAP" => $sheet->getCell('I127')->getCalculatedValue(),
					"TETES_PERSEN_TEBU_RKAP" => $sheet->getCell('I128')->getCalculatedValue(),
					"PERSEN_BRIX_TETES_RKAP" => $sheet->getCell('I129')->getCalculatedValue(),
					"HK_TETES_RKAP" => $sheet->getCell('I130')->getCalculatedValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_RKAP" => $sheet->getCell('I131')->getCalculatedValue(),
					"RENDEMEN_KETEL_RKAP" => $sheet->getCell('I133')->getCalculatedValue(),
					"KG_UAP_KG_TEBU_RKAP" => $sheet->getCell('I134')->getCalculatedValue(),
					"PEMAKAIAN_BBA_TON_RKAP" => $sheet->getCell('I135')->getCalculatedValue(),
					"TEBU_TERBAKAR_TS_TON_RKAP" => $sheet->getCell('I137')->getCalculatedValue(),
					"TEBU_TERBAKAR_TR_TON_RKAP" => $sheet->getCell('I138')->getCalculatedValue(),
					"JUMLAH_RKAP" => $sheet->getCell('I139')->getCalculatedValue(),
					"GULA_SISAN_EX_TAHUN_LALU_RKAP" => $sheet->getCell('I141')->getCalculatedValue(),
					"RE_PROSES_EX_TAHUN_LALU_RKAP" => $sheet->getCell('I142')->getCalculatedValue(),
				
					 "TEBU_SENDIRI_LUAS_HA_RKO_PROSEN" => $sheet->getCell('J11')->getCalculatedValue(),
					  "TEBU_PETANI_LUAS_HA_RKO_PROSEN" => $sheet->getCell('J12')->getCalculatedValue(),
					  "JUMLAH_LUAS_HA_RKO_PROSEN" => $sheet->getCell('J13')->getCalculatedValue(),
					  "TEBU_SENDIRI_TEBU_DIGILING_TON_RKO_PROSEN" => $sheet->getCell('J15')->getCalculatedValue(),
					  "TEBU_PETANI_TEBU_DIGILING_TON_RKO_PROSEN" => $sheet->getCell('J16')->getCalculatedValue(),
					  "JUMLAH_TEBU_DIGILING_TON_RKO_PROSEN" => $sheet->getCell('J17')->getCalculatedValue(),
					  "TEBU_SENDIRI_HABLUR_HASILTON_RKO_PROSEN" => $sheet->getCell('J19')->getCalculatedValue(),
					  "TEBU_PETANI_HABLUR_HASILTON_RKO_PROSEN" => $sheet->getCell('J20')->getCalculatedValue(),
					  "JUMLAH_HABLUR_HASILTON_RKO_PROSEN" => $sheet->getCell('J21')->getCalculatedValue(),
					  "TEBU_SENDIRI_RENDEMEN_RKO_PROSEN" => $sheet->getCell('J23')->getCalculatedValue(),
					  "TEBU_PETANI_RENDEMEN_RKO_PROSEN" => $sheet->getCell('J24')->getCalculatedValue(),
					  "JUMLAH_RENDEMEN_RKO_PROSEN" => $sheet->getCell('J25')->getCalculatedValue(),
					  "TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKO_PROSEN" => $sheet->getCell('J27')->getCalculatedValue(),
					  "TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKO_PROSEN" => $sheet->getCell('J28')->getCalculatedValue(),
					  "JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKO_PROSEN" => $sheet->getCell('J29')->getCalculatedValue(),
					  "TEBU_SENDIRI_HABLUR__HA_TONHA_RKO_PROSEN" => $sheet->getCell('J31')->getCalculatedValue(),
					  "TEBU_PETANI_HABLUR__HA_TONHA_RKO_PROSEN" => $sheet->getCell('J32')->getCalculatedValue(),
					  "JUMLAH_HABLUR__HA_TONHA_RKO_PROSEN" => $sheet->getCell('J33')->getCalculatedValue(),
					  "MILIK_PG_HABLUR_MILIK_TON_RKO_PROSEN" => $sheet->getCell('J35')->getCalculatedValue(),
					  "MILIK_PETANI_HABLUR_MILIK_TON_RKO_PROSEN" => $sheet->getCell('J36')->getCalculatedValue(),
					  "JUMLAH_HABLUR_MILIK_TON_RKO_PROSEN" => $sheet->getCell('J37')->getCalculatedValue(),
					  "MILIK_PG_GULA_MILIK_RKO_PROSEN" => $sheet->getCell('J39')->getCalculatedValue(),
					  "MILIK_PETANI_GULA_MILIK_RKO_PROSEN" => $sheet->getCell('J40')->getCalculatedValue(),
					  "JUMLAH_GULA_MILIK_RKO_PROSEN" => $sheet->getCell('J41')->getCalculatedValue(),
					  "MILIK_PG_PRODUKSI_TETES_TON_RKO_PROSEN" => $sheet->getCell('J43')->getCalculatedValue(),
					  "MILIK_PETANI_PRODUKSI_TETES_TON_RKO_PROSEN" => $sheet->getCell('J44')->getCalculatedValue(),
					  "JUMLAH_PRODUKSI_TETES_TON_RKO_PROSEN" => $sheet->getCell('J45')->getCalculatedValue(),
					  "PERSEN_POL_TEBU_RKO_PROSEN" => $sheet->getCell('J46')->getCalculatedValue(),
					  "PERSEN_BRIX_TEBU_RKO_PROSEN" => $sheet->getCell('J47')->getCalculatedValue(),
					  "NILAI_NIRA_RKO_PROSEN" => $sheet->getCell('J48')->getCalculatedValue(),
					  "KADAR_NIRA_TEBU_RKO_PROSEN" => $sheet->getCell('J49')->getCalculatedValue(),
					  "KECGILING_EXCL_TON_RKO_PROSEN" => $sheet->getCell('J51')->getCalculatedValue(),
					  "KECGILING_INCL_TANPA_HARI_RAYA_TON_RKO_PROSEN" => $sheet->getCell('J52')->getCalculatedValue(),
					  "KECGILING_INCL_HARI_RAYA_TON_RKO_PROSEN" => $sheet->getCell('J53')->getCalculatedValue(),
					  "PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKO_PROSEN" => $sheet->getCell('J54')->getCalculatedValue(),
					  "PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKO_PROSEN" => $sheet->getCell('J55')->getCalculatedValue(),
					  "PERSEN_JAM_BERHENTI_BDALAM_RKO_PROSEN" => $sheet->getCell('J56')->getCalculatedValue(),
					  "JAM_BERHENTI_PERSEN_JAM_GILING_RKO_PROSEN" => $sheet->getCell('J57')->getCalculatedValue(),
					  "NIRA_MENTAH_PERSEN_TEBU_RKO_PROSEN" => $sheet->getCell('J58')->getCalculatedValue(),
					  "IMBIBISI_PERSEN_SABUT_RKO_PROSEN" => $sheet->getCell('J59')->getCalculatedValue(),
					  "HPB_I_RKO_PROSEN" => $sheet->getCell('J60')->getCalculatedValue(),
					  "HPB_TOTAL_RKO_PROSEN" => $sheet->getCell('J61')->getCalculatedValue(),
					  "HPG_RKO_PROSEN" => $sheet->getCell('J62')->getCalculatedValue(),
					  "HPG_125_RKO_PROSEN" => $sheet->getCell('J63')->getCalculatedValue(),
					  "POL_AMPAS_RKO_PROSEN" => $sheet->getCell('J64')->getCalculatedValue(),
					  "PERSEN_BAHAN_KERING_AMPAS_RKO_PROSEN" => $sheet->getCell('J65')->getCalculatedValue(),
					  "SABUT_PERSEN_TEBU_RKO_PROSEN" => $sheet->getCell('J66')->getCalculatedValue(),
					  "PSHK_RKO_PROSEN" => $sheet->getCell('J67')->getCalculatedValue(),
					  "NIRA_ASLI_HILANG_PERSEN_SABUT_RKO_PROSEN" => $sheet->getCell('J68')->getCalculatedValue(),
					  "EFISIENSI_GILINGAN_RKO_PROSEN" => $sheet->getCell('J69')->getCalculatedValue(),
					  "POL_BLOTONG_RKO_PROSEN" => $sheet->getCell('J71')->getCalculatedValue(),
					  "PENGASINGAN_BUKAN_GULA_RKO_PROSEN" => $sheet->getCell('J72')->getCalculatedValue(),
					  "KG_AIR_DIUAPKANM2_LPJBP_RKO_PROSEN" => $sheet->getCell('J73')->getCalculatedValue(),
					  "KEHILANGAN_POL_PERSEN_POL_NM_RKO_PROSEN" => $sheet->getCell('J74')->getCalculatedValue(),
					  "WINTER_RENDEMEN_RKO_PROSEN" => $sheet->getCell('J75')->getCalculatedValue(),
					  "BHR__RKO_PROSEN" => $sheet->getCell('J76')->getCalculatedValue(),
					  "POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKO_PROSEN" => $sheet->getCell('J77')->getCalculatedValue(),
					  "POL_HILANG_DALAM_AMPAS_RKO_PROSEN" => $sheet->getCell('J78')->getCalculatedValue(),
					  "POL_HILANG_DALAM_BLOTONG_RKO_PROSEN" => $sheet->getCell('J79')->getCalculatedValue(),
					  "POL_HILANG_DALAM_TETES_RKO_PROSEN" => $sheet->getCell('J80')->getCalculatedValue(),
					  "POL_HILANG_TAK_DIKETAHUI_OV_RKO_PROSEN" => $sheet->getCell('J81')->getCalculatedValue(),
					  "TOTAL_KEHILANGAN_RKO_PROSEN" => $sheet->getCell('J82')->getCalculatedValue(),
					  "EFFISIENSI_PABRIK_RKO_PROSEN" => $sheet->getCell('J84')->getCalculatedValue(),
					  "OVERALL_RECOVERY_RKO_PROSEN" => $sheet->getCell('J85')->getCalculatedValue(),
					  "FAKTOR_RENDEMEN_RKO_PROSEN" => $sheet->getCell('J86')->getCalculatedValue(),
					  "RENDEMEN_EFEKTIF_RKO_PROSEN" => $sheet->getCell('J87')->getCalculatedValue(),
					  "HK_NIRA_MENTAH_RKO_PROSEN" => $sheet->getCell('J88')->getCalculatedValue(),
					  "KEHIL_POL_PERSEN_POL_NM_RKO_PROSEN" => $sheet->getCell('J89')->getCalculatedValue(),
					  "KAPUR_KG_RKO_PROSEN" => $sheet->getCell('J91')->getCalculatedValue(),
					  "KAPUR__100_TON_TEBU_RKO_PROSEN" => $sheet->getCell('J92')->getCalculatedValue(),
					  "BELERANG_KG_RKO_PROSEN" => $sheet->getCell('J93')->getCalculatedValue(),
					  "BELERANG__100_TON_TEBU_RKO_PROSEN" => $sheet->getCell('J94')->getCalculatedValue(),
					  "ASAM_PHOSPHAT_KG_RKO_PROSEN" => $sheet->getCell('J95')->getCalculatedValue(),
					  "ASAM_PHOSPHAT__100_TON_TEBU_RKO_PROSEN" => $sheet->getCell('J96')->getCalculatedValue(),
					  "FLOCULANT_KG_RKO_PROSEN" => $sheet->getCell('J97')->getCalculatedValue(),
					  "FLOCULANT__100_TON_TEBU_RKO_PROSEN" => $sheet->getCell('J98')->getCalculatedValue(),
					  "FILTER_AID_KG_RKO_PROSEN" => $sheet->getCell('J99')->getCalculatedValue(),
					  "FILTER_AID__100_TON_TEBU_RKO_PROSEN" => $sheet->getCell('J100')->getCalculatedValue(),
					  "PELUNAK_KERAK_KG_RKO_PROSEN" => $sheet->getCell('J101')->getCalculatedValue(),
					  "PELUNAK_KERAK__100_TON_TEBU_RKO_PROSEN" => $sheet->getCell('J102')->getCalculatedValue(),
					  "MASAKAN_PERSEN_TEBU_RKO_PROSEN_A" => $sheet->getCell('J104')->getCalculatedValue(),
					  "PERSEN_BRIX_MASAKAN_RKO_PROSEN_A" => $sheet->getCell('J105')->getCalculatedValue(),
					  "HK_MASAKAN_RKO_PROSEN_A" => $sheet->getCell('J106')->getCalculatedValue(),
					  "PURITY_DROP_RKO_PROSEN_A" => $sheet->getCell('J107')->getCalculatedValue(),
					  "KRISTAL_PERSEN_POL_RKO_PROSEN_A" => $sheet->getCell('J108')->getCalculatedValue(),
					  "MASAKAN_PERSEN_TEBU_RKO_PROSEN_B" => $sheet->getCell('J110')->getCalculatedValue(),
					  "PERSEN_BRIX_MASAKAN_RKO_PROSEN_B" => $sheet->getCell('J111')->getCalculatedValue(),
					  "HK_MASAKAN_RKO_PROSEN_B" => $sheet->getCell('J112')->getCalculatedValue(),
					  "PURITY_DROP_RKO_PROSEN_B" => $sheet->getCell('J113')->getCalculatedValue(),
					  "KRISTAL_PERSEN_POL_RKO_PROSEN_B" => $sheet->getCell('J114')->getCalculatedValue(),
					  "MASAKAN_PERSEN_TEBU_RKO_PROSEN_C" => $sheet->getCell('J116')->getCalculatedValue(),
					  "PERSEN_BRIX_MASAKAN_RKO_PROSEN_C" => $sheet->getCell('J117')->getCalculatedValue(),
					  "HK_MASAKAN_RKO_PROSEN_C" => $sheet->getCell('J118')->getCalculatedValue(),
					  "PURITY_DROP_RKO_PROSEN_C" => $sheet->getCell('J119')->getCalculatedValue(),
					  "KRISTAL_PERSEN_POL_RKO_PROSEN_C" => $sheet->getCell('J120')->getCalculatedValue(),
					  "MASAKAN_PERSEN_TEBU_RKO_PROSEN_D" => $sheet->getCell('J122')->getCalculatedValue(),
					  "PERSEN_BRIX_MASAKAN_RKO_PROSEN_D" => $sheet->getCell('J123')->getCalculatedValue(),
					  "HK_MASAKAN_RKO_PROSEN_D" => $sheet->getCell('J124')->getCalculatedValue(),
					  "PURITY_DROP_RKO_PROSEN_D" => $sheet->getCell('J125')->getCalculatedValue(),
					  "KRISTAL_PERSEN_POL_RKO_PROSEN_D" => $sheet->getCell('J126')->getCalculatedValue(),
					  "JUMLAH_MASAKAN_PERSEN_TEBU_RKO_PROSEN" => $sheet->getCell('J127')->getCalculatedValue(),
					  "TETES_PERSEN_TEBU_RKO_PROSEN" => $sheet->getCell('J128')->getCalculatedValue(),
					  "PERSEN_BRIX_TETES_RKO_PROSEN" => $sheet->getCell('J129')->getCalculatedValue(),
					  "HK_TETES_RKO_PROSEN" => $sheet->getCell('J130')->getCalculatedValue(),
					  "POL_TETES_PERSEN_NIRA_MENTAH_RKO_PROSEN" => $sheet->getCell('J131')->getCalculatedValue(),
					  "RENDEMEN_KETEL_RKO_PROSEN" => $sheet->getCell('J133')->getCalculatedValue(),
					  "KG_UAP_KG_TEBU_RKO_PROSEN" => $sheet->getCell('J134')->getCalculatedValue(),
					  "PEMAKAIAN_BBA_TON_RKO_PROSEN" => $sheet->getCell('J135')->getCalculatedValue(),
					  "TEBU_TERBAKAR_TS_TON_RKO_PROSEN" => $sheet->getCell('J137')->getCalculatedValue(),
					  "TEBU_TERBAKAR_TR_TON_RKO_PROSEN" => $sheet->getCell('J138')->getCalculatedValue(),
					  "JUMLAH_RKO_PROSEN" => $sheet->getCell('J139')->getCalculatedValue(),
					  "GULA_SISAN_EX_TAHUN_LALU_RKO_PROSEN" => $sheet->getCell('J141')->getCalculatedValue(),
					  "RE_PROSES_EX_TAHUN_LALU_RKO_PROSEN" => $sheet->getCell('J142')->getCalculatedValue(),

					  "TEBU_SENDIRI_LUAS_HA_RKAP_PROSEN" => $sheet->getCell('K11')->getCalculatedValue(),
					  "TEBU_PETANI_LUAS_HA_RKAP_PROSEN" => $sheet->getCell('K12')->getCalculatedValue(),
					  "JUMLAH_LUAS_HA_RKAP_PROSEN" => $sheet->getCell('K13')->getCalculatedValue(),
					  "TEBU_SENDIRI_TEBU_DIGILING_TON_RKAP_PROSEN" => $sheet->getCell('K15')->getCalculatedValue(),
					  "TEBU_PETANI_TEBU_DIGILING_TON_RKAP_PROSEN" => $sheet->getCell('K16')->getCalculatedValue(),
					  "JUMLAH_TEBU_DIGILING_TON_RKAP_PROSEN" => $sheet->getCell('K17')->getCalculatedValue(),
					  "TEBU_SENDIRI_HABLUR_HASILTON_RKAP_PROSEN" => $sheet->getCell('K19')->getCalculatedValue(),
					  "TEBU_PETANI_HABLUR_HASILTON_RKAP_PROSEN" => $sheet->getCell('K20')->getCalculatedValue(),
					  "JUMLAH_HABLUR_HASILTON_RKAP_PROSEN" => $sheet->getCell('K21')->getCalculatedValue(),
					  "TEBU_SENDIRI_RENDEMEN_RKAP_PROSEN" => $sheet->getCell('K23')->getCalculatedValue(),
					  "TEBU_PETANI_RENDEMEN_RKAP_PROSEN" => $sheet->getCell('K24')->getCalculatedValue(),
					  "JUMLAH_RENDEMEN_RKAP_PROSEN" => $sheet->getCell('K25')->getCalculatedValue(),
					  "TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKAP_PROSEN" => $sheet->getCell('K27')->getCalculatedValue(),
					  "TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKAP_PROSEN" => $sheet->getCell('K28')->getCalculatedValue(),
					  "JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKAP_PROSEN" => $sheet->getCell('K29')->getCalculatedValue(),
					  "TEBU_SENDIRI_HABLUR__HA_TONHA_RKAP_PROSEN" => $sheet->getCell('K31')->getCalculatedValue(),
					  "TEBU_PETANI_HABLUR__HA_TONHA_RKAP_PROSEN" => $sheet->getCell('K32')->getCalculatedValue(),
					  "JUMLAH_HABLUR__HA_TONHA_RKAP_PROSEN" => $sheet->getCell('K33')->getCalculatedValue(),
					  "MILIK_PG_HABLUR_MILIK_TON_RKAP_PROSEN" => $sheet->getCell('K35')->getCalculatedValue(),
					  "MILIK_PETANI_HABLUR_MILIK_TON_RKAP_PROSEN" => $sheet->getCell('K36')->getCalculatedValue(),
					  "JUMLAH_HABLUR_MILIK_TON_RKAP_PROSEN" => $sheet->getCell('K37')->getCalculatedValue(),
					  "MILIK_PG_GULA_MILIK_RKAP_PROSEN" => $sheet->getCell('K39')->getCalculatedValue(),
					  "MILIK_PETANI_GULA_MILIK_RKAP_PROSEN" => $sheet->getCell('K40')->getCalculatedValue(),
					  "JUMLAH_GULA_MILIK_RKAP_PROSEN" => $sheet->getCell('K41')->getCalculatedValue(),
					  "MILIK_PG_PRODUKSI_TETES_TON_RKAP_PROSEN" => $sheet->getCell('K43')->getCalculatedValue(),
					  "MILIK_PETANI_PRODUKSI_TETES_TON_RKAP_PROSEN" => $sheet->getCell('K44')->getCalculatedValue(),
					  "JUMLAH_PRODUKSI_TETES_TON_RKAP_PROSEN" => $sheet->getCell('K45')->getCalculatedValue(),
					  "PERSEN_POL_TEBU_RKAP_PROSEN" => $sheet->getCell('K46')->getCalculatedValue(),
					  "PERSEN_BRIX_TEBU_RKAP_PROSEN" => $sheet->getCell('K47')->getCalculatedValue(),
					  "NILAI_NIRA_RKAP_PROSEN" => $sheet->getCell('K48')->getCalculatedValue(),
					  "KADAR_NIRA_TEBU_RKAP_PROSEN" => $sheet->getCell('K49')->getCalculatedValue(),
					  "KECGILING_EXCL_TON_RKAP_PROSEN" => $sheet->getCell('K51')->getCalculatedValue(),
					  "KECGILING_INCL_TANPA_HARI_RAYA_TON_RKAP_PROSEN" => $sheet->getCell('K52')->getCalculatedValue(),
					  "KECGILING_INCL_HARI_RAYA_TON_RKAP_PROSEN" => $sheet->getCell('K53')->getCalculatedValue(),
					  "PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKAP_PROSEN" => $sheet->getCell('K54')->getCalculatedValue(),
					  "PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKAP_PROSEN" => $sheet->getCell('K55')->getCalculatedValue(),
					  "PERSEN_JAM_BERHENTI_BDALAM_RKAP_PROSEN" => $sheet->getCell('K56')->getCalculatedValue(),
					  "JAM_BERHENTI_PERSEN_JAM_GILING_RKAP_PROSEN" => $sheet->getCell('K57')->getCalculatedValue(),
					  "NIRA_MENTAH_PERSEN_TEBU_RKAP_PROSEN" => $sheet->getCell('K58')->getCalculatedValue(),
					  "IMBIBISI_PERSEN_SABUT_RKAP_PROSEN" => $sheet->getCell('K59')->getCalculatedValue(),
					  "HPB_I_RKAP_PROSEN" => $sheet->getCell('K60')->getCalculatedValue(),
					  "HPB_TOTAL_RKAP_PROSEN" => $sheet->getCell('K61')->getCalculatedValue(),
					  "HPG_RKAP_PROSEN" => $sheet->getCell('K62')->getCalculatedValue(),
					  "HPG_125_RKAP_PROSEN" => $sheet->getCell('K63')->getCalculatedValue(),
					  "POL_AMPAS_RKAP_PROSEN" => $sheet->getCell('K64')->getCalculatedValue(),
					  "PERSEN_BAHAN_KERING_AMPAS_RKAP_PROSEN" => $sheet->getCell('K65')->getCalculatedValue(),
					  "SABUT_PERSEN_TEBU_RKAP_PROSEN" => $sheet->getCell('K66')->getCalculatedValue(),
					  "PSHK_RKAP_PROSEN" => $sheet->getCell('K67')->getCalculatedValue(),
					  "NIRA_ASLI_HILANG_PERSEN_SABUT_RKAP_PROSEN" => $sheet->getCell('K68')->getCalculatedValue(),
					  "EFISIENSI_GILINGAN_RKAP_PROSEN" => $sheet->getCell('K69')->getCalculatedValue(),
					  "POL_BLOTONG_RKAP_PROSEN" => $sheet->getCell('K71')->getCalculatedValue(),
					  "PENGASINGAN_BUKAN_GULA_RKAP_PROSEN" => $sheet->getCell('K72')->getCalculatedValue(),
					  "KG_AIR_DIUAPKANM2_LPJBP_RKAP_PROSEN" => $sheet->getCell('K73')->getCalculatedValue(),
					  "KEHILANGAN_POL_PERSEN_POL_NM_RKAP_PROSEN" => $sheet->getCell('K74')->getCalculatedValue(),
					  "WINTER_RENDEMEN_RKAP_PROSEN" => $sheet->getCell('K75')->getCalculatedValue(),
					  "BHR__RKAP_PROSEN" => $sheet->getCell('K76')->getCalculatedValue(),
					  "POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKAP_PROSEN" => $sheet->getCell('K77')->getCalculatedValue(),
					  "POL_HILANG_DALAM_AMPAS_RKAP_PROSEN" => $sheet->getCell('K78')->getCalculatedValue(),
					  "POL_HILANG_DALAM_BLOTONG_RKAP_PROSEN" => $sheet->getCell('K79')->getCalculatedValue(),
					  "POL_HILANG_DALAM_TETES_RKAP_PROSEN" => $sheet->getCell('K80')->getCalculatedValue(),
					  "POL_HILANG_TAK_DIKETAHUI_OV_RKAP_PROSEN" => $sheet->getCell('K81')->getCalculatedValue(),
					  "TOTAL_KEHILANGAN_RKAP_PROSEN" => $sheet->getCell('K82')->getCalculatedValue(),
					  "EFFISIENSI_PABRIK_RKAP_PROSEN" => $sheet->getCell('K84')->getCalculatedValue(),
					  "OVERALL_RECOVERY_RKAP_PROSEN" => $sheet->getCell('K85')->getCalculatedValue(),
					  "FAKTOR_RENDEMEN_RKAP_PROSEN" => $sheet->getCell('K86')->getCalculatedValue(),
					  "RENDEMEN_EFEKTIF_RKAP_PROSEN" => $sheet->getCell('K87')->getCalculatedValue(),
					  "HK_NIRA_MENTAH_RKAP_PROSEN" => $sheet->getCell('K88')->getCalculatedValue(),
					  "KEHIL_POL_PERSEN_POL_NM_RKAP_PROSEN" => $sheet->getCell('K89')->getCalculatedValue(),
					  "KAPUR_KG_RKAP_PROSEN" => $sheet->getCell('K91')->getCalculatedValue(),
					  "KAPUR__100_TON_TEBU_RKAP_PROSEN" => $sheet->getCell('K92')->getCalculatedValue(),
					  "BELERANG_KG_RKAP_PROSEN" => $sheet->getCell('K93')->getCalculatedValue(),
					  "BELERANG__100_TON_TEBU_RKAP_PROSEN" => $sheet->getCell('K94')->getCalculatedValue(),
					  "ASAM_PHOSPHAT_KG_RKAP_PROSEN" => $sheet->getCell('K95')->getCalculatedValue(),
					  "ASAM_PHOSPHAT__100_TON_TEBU_RKAP_PROSEN" => $sheet->getCell('K96')->getCalculatedValue(),
					  "FLOCULANT_KG_RKAP_PROSEN" => $sheet->getCell('K97')->getCalculatedValue(),
					  "FLOCULANT__100_TON_TEBU_RKAP_PROSEN" => $sheet->getCell('K98')->getCalculatedValue(),
					  "FILTER_AID_KG_RKAP_PROSEN" => $sheet->getCell('K99')->getCalculatedValue(),
					  "FILTER_AID__100_TON_TEBU_RKAP_PROSEN" => $sheet->getCell('K100')->getCalculatedValue(),
					  "PELUNAK_KERAK_KG_RKAP_PROSEN" => $sheet->getCell('K101')->getCalculatedValue(),
					  "PELUNAK_KERAK__100_TON_TEBU_RKAP_PROSEN" => $sheet->getCell('K102')->getCalculatedValue(),
					  "MASAKAN_PERSEN_TEBU_RKAP_PROSEN_A" => $sheet->getCell('K104')->getCalculatedValue(),
					  "PERSEN_BRIX_MASAKAN_RKAP_PROSEN_A" => $sheet->getCell('K105')->getCalculatedValue(),
					  "HK_MASAKAN_RKAP_PROSEN_A" => $sheet->getCell('K106')->getCalculatedValue(),
					  "PURITY_DROP_RKAP_PROSEN_A" => $sheet->getCell('K107')->getCalculatedValue(),
					  "KRISTAL_PERSEN_POL_RKAP_PROSEN_A" => $sheet->getCell('K108')->getCalculatedValue(),
					  "MASAKAN_PERSEN_TEBU_RKAP_PROSEN_B" => $sheet->getCell('K110')->getCalculatedValue(),
					  "PERSEN_BRIX_MASAKAN_RKAP_PROSEN_B" => $sheet->getCell('K111')->getCalculatedValue(),
					  "HK_MASAKAN_RKAP_PROSEN_B" => $sheet->getCell('K112')->getCalculatedValue(),
					  "PURITY_DROP_RKAP_PROSEN_B" => $sheet->getCell('K113')->getCalculatedValue(),
					  "KRISTAL_PERSEN_POL_RKAP_PROSEN_B" => $sheet->getCell('K114')->getCalculatedValue(),
					  "MASAKAN_PERSEN_TEBU_RKAP_PROSEN_C" => $sheet->getCell('K116')->getCalculatedValue(),
					  "PERSEN_BRIX_MASAKAN_RKAP_PROSEN_C" => $sheet->getCell('K117')->getCalculatedValue(),
					  "HK_MASAKAN_RKAP_PROSEN_C" => $sheet->getCell('K118')->getCalculatedValue(),
					  "PURITY_DROP_RKAP_PROSEN_C" => $sheet->getCell('K119')->getCalculatedValue(),
					  "KRISTAL_PERSEN_POL_RKAP_PROSEN_C" => $sheet->getCell('K120')->getCalculatedValue(),
					  "MASAKAN_PERSEN_TEBU_RKAP_PROSEN_D" => $sheet->getCell('K122')->getCalculatedValue(),
					  "PERSEN_BRIX_MASAKAN_RKAP_PROSEN_D" => $sheet->getCell('K123')->getCalculatedValue(),
					  "HK_MASAKAN_RKAP_PROSEN_D" => $sheet->getCell('K124')->getCalculatedValue(),
					  "PURITY_DROP_RKAP_PROSEN_D" => $sheet->getCell('K125')->getCalculatedValue(),
					  "KRISTAL_PERSEN_POL_RKAP_PROSEN_D" => $sheet->getCell('K126')->getCalculatedValue(),
					  "JUMLAH_MASAKAN_PERSEN_TEBU_RKAP_PROSEN" => $sheet->getCell('K127')->getCalculatedValue(),
					  "TETES_PERSEN_TEBU_RKAP_PROSEN" => $sheet->getCell('K128')->getCalculatedValue(),
					  "PERSEN_BRIX_TETES_RKAP_PROSEN" => $sheet->getCell('K129')->getCalculatedValue(),
					  "HK_TETES_RKAP_PROSEN" => $sheet->getCell('K130')->getCalculatedValue(),
					  "POL_TETES_PERSEN_NIRA_MENTAH_RKAP_PROSEN" => $sheet->getCell('K131')->getCalculatedValue(),
					  "RENDEMEN_KETEL_RKAP_PROSEN" => $sheet->getCell('K133')->getCalculatedValue(),
					  "KG_UAP_KG_TEBU_RKAP_PROSEN" => $sheet->getCell('K134')->getCalculatedValue(),
					  "PEMAKAIAN_BBA_TON_RKAP_PROSEN" => $sheet->getCell('K135')->getCalculatedValue(),
					  "TEBU_TERBAKAR_TS_TON_RKAP_PROSEN" => $sheet->getCell('K137')->getCalculatedValue(),
					  "TEBU_TERBAKAR_TR_TON_RKAP_PROSEN" => $sheet->getCell('K138')->getCalculatedValue(),
					  "JUMLAH_RKAP_PROSEN" => $sheet->getCell('K139')->getCalculatedValue(),
					  "GULA_SISAN_EX_TAHUN_LALU_RKAP_PROSEN" => $sheet->getCell('K141')->getCalculatedValue(),
					  "RE_PROSES_EX_TAHUN_LALU_RKAP_PROSEN" => $sheet->getCell('K142')->getCalculatedValue(),
				);
	      $this->crud_model->insert('telgil_evaluasi', $arr_evaluasi);
	
    }

}
