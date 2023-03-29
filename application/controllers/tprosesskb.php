<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tprosesskb extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tprosesskb';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tprosesskbmodel');
		$this->model = $this->tprosesskbmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tprosesskb',
		));
		$this->col = array();
		$this->con = array();
		$inf = $this->info['config']['grid'];
		$inf = SiteHelpers::array_sort($inf, 'sortlist', SORT_ASC);
		$in=0;
		foreach ($inf as $key => $t) {
			if($t['view'] =='1'){
				
				$in++;
				$this->col[$in] = $t['field'];
				$this->con[$in] = $t['conn'];
				
			}
			
		}
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}

	function grids($status, $tgl_giling){
		
		$sort = $this->model->primaryKey; 
		$order = 'asc';
		$filter = "";
		//$filter = (!is_null($this->input->get('search', true)) ? $this->buildSearch() : '');
		//order 
		if(isset($_POST['order']))
        {
            if(($_POST['order']['0']['column'])==0){
        		$sort = $this->col[($_POST['order']['0']['column'])+1];
            	$order = $_POST['order']['0']['dir'];
        	}else{
            	$sort = $this->col[($_POST['order']['0']['column'])];
            	$order = $_POST['order']['0']['dir'];
        	}

        }

        for ($i=0; $i < count($this->col) ; $i++) {
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filter .= " AND ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }


        $filter .= "AND d.tgl_giling = '$tgl_giling'";
		if($status == "1"){
            $filter .= "AND c.rendemen_ari >= (select r_min_skb from tb_setting limit 1)";
        }else{
            $filter .= "AND c.rendemen_ari < (select r_min_skb from tb_setting limit 1)";
        }


		$params = array(
			'limit'		=> $_POST['start'],
			'page'		=> $_POST['length'],
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		$rows = $results['rows'];
		$total = $results['total'];
		$totalfil = $results['totalfil'];
		
		//run data to view
		$data = array();$no=0;
		foreach ($rows as $dt) {
            $row = array();
            $row[] = $no+1;
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('tprosesskb/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('tprosesskb/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tprosesskb/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
            }
           
 			$row[] = $btn;
            $data[] = $row;
            $no++;
        }
         $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $totalfil,
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

	}
	
	function index($id = null)
	{
		/**if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}	
		
		$this->data['tableGrid'] 	= $this->info['config']['grid'];

		// Group users permission
		$this->data['access']		= $this->access;
		// Render into template
		
		$this->data['content'] = $this->load->view('tprosesskb/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );**/

        if($id =='')
            if($this->access['is_add'] ==0) redirect('dashboard',301);

        if($id !='')
            if($this->access['is_edit'] ==0) redirect('dashboard',301);

        $row = $this->model->getRow( $id );
        if($row)
        {
            $this->data['row'] =  $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('t_skbspt');
        }
        $this->data['tableGrid'] 	= $this->info['config']['grid'];
        $this->data['id'] = $id;
        $this->data['content'] = $this->load->view('tprosesskb/form',$this->data, true );
        $this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function show( $id = null) 
	{
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		

		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_skbspt'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tprosesskb/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
  
	function add( $id = null ) 
	{
		/**if($id =='')
			if($this->access['is_add'] ==0) redirect('dashboard',301);

		if($id !='')
			if($this->access['is_edit'] ==0) redirect('dashboard',301);	

		$row = $this->model->getRow( $id );
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_skbspt'); 
		}
        $this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tprosesskb/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );*/
	
	}

	function ditolak($id = null)
    {
        if($id =='')
            if($this->access['is_add'] ==0) redirect('dashboard',301);

        if($id !='')
            if($this->access['is_edit'] ==0) redirect('dashboard',301);

        $row = $this->model->getRow( $id );
        if($row)
        {
            $this->data['row'] =  $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('t_skbspt');
        }
        $this->data['tableGrid'] 	= $this->info['config']['grid'];
        $this->data['id'] = $id;
        $this->data['content'] = $this->load->view('tprosesskb/form_ditolak',$this->data, true );
        $this->load->view('layouts/main', $this->data );
    }
	
	function save() {

	    $tgl_giling = $this->GetPost('tgl_giling');
		$data_seleksi = $this->model->QuerySeleksi($tgl_giling);
		$rend_skb = "(select r_min_skb from tb_setting limit 1)";
		$row_rend_skb = $this->db->query($rend_skb)->row();
		$count = 0;
		foreach($data_seleksi->result() as $row){
		    $data_update = array(
		        'tgl_timbang' => $row->tgl_timbang_spta,
		        'tgl_giling' => $row->tgl_giling_spta,
                'rend_skb' => $row_rend_skb->r_min_skb,
                'tgl_proses' => $this->getDateNow()
            );
            $this->db->where(array('id_skbspt' => $row->id_skbspt));
		    $this->db->update('t_skbspt', $data_update);

		    if($row->rendemen_ari > $row_rend_skb->r_min_skb){
		        $data_update_spta = array(
                    "kode_blok" => $row->kode_blok_perubahan,
                    "id_petani_sap" => "",
                    "kode_affd" => $row->kode_affd_perubahan,
                    "kode_kat_lahan" => $row->kode_kat_lahan_perubahan
                );

                $this->db->where(array('id' => $row->id_spta));
                $this->db->update('t_spta', $data_update_spta);
            }
            $count++;
        }

        $this->session->set_flashdata('message',SiteHelpers::alert('success',"$count SPTA memenuhi kualifikasi, tgl giling $tgl_giling"));
        redirect( 'tprosesskb',301);
	}


    private function getDateNow()
    {
        $sql = "SELECT NOW() as sekarang";
        $query = $this->db->query($sql);
        $sekarang = $query->row();
        return $sekarang->sekarang;
    }

	function destroy($tgl_giling)
	{
		if($this->access['is_remove'] ==0)
		{ 
			echo "err : maaf anda tidak memiliki hak untuk memproses data";
	  	}

        /*$result = $this->model->ProsesSKB($tgl_giling);
        $this->session->set_flashdata('message',SiteHelpers::alert('success',"$result SPTA memenuhi kualifikasi, tgl giling $tgl_giling"));
        redirect( 'tprosesskb',301);*/

    }

    private function GetPost($input){
        if($this->input->get($input)){
            $output = $this->input->get($input);
        }elseif($this->input->post($input)){
            $output = $this->input->post($input);
        }else{
            $output = "";
        }
        return $output;
    }


    function petak($affd, $cc, $pc){
        $query = "SELECT a.kode_blok, a.`kode_kat_lahan`, a.`kode_affd`,
FORMAT(SUM(b.netto)/1000, 2) AS total_netto, 
FORMAT(SUM(c.`ha_tertebang`),2) AS total_ha, COUNT(a.id) jum_spta, 
FORMAT((SUM(b.`netto`)/COUNT(a.id))/1000, 2) AS per_spta, 
FORMAT((SUM(b.`netto`)/1000)/SUM(c.`ha_tertebang`),2) AS per_ha, 
SUM(d.`gula_total`), FORMAT(SUM(d.`gula_total`)/SUM(b.`netto`),3) AS shs 
FROM ".$cc.$pc."_t_spta AS a
JOIN ".$cc.$pc."_t_timbangan AS b ON b.`id_spat` = a.`id`
JOIN ".$cc.$pc."_t_selektor AS c ON c.`id_spta` = a.id
JOIN ".$cc.$pc."_t_ari AS d ON d.`id_spta` = a.id
WHERE a.`kode_affd` = '$affd' GROUP BY a.`kode_blok`";


$ba = $this->db->query($query)->result();
		$html = '';
		foreach($ba as $rw){
            $html .= '<tr style="font-size:14px"><td>'.$rw->kode_blok.'</td>
		<td align="right"><b>'.$rw->kode_kat_lahan.' Unit</b></td>
		<td align="center"><b>'.$rw->kode_affd.' Unit</b><br /><b style="color:orange">'.$rw->total_ha.'</b> Ha</td>
		<td align="center"><u class="text-primary"><b>'.$rw->jum_spta.' Lembar</b></u><br /><b class="text-danger">'.number_format($rw->total_netto,2).'</b> Ton<br /><b class="text-info">'.number_format($rw->hatimbang,2).'</b> Ha</td>
		<td align="right"><b>'.number_format($rw->per_ha,2).'</b><br />Ton/ha<br /><b>'.number_format($rw->hatimbang/$rw->per_spta,2).'</b> Ha/SPTA</td></tr>';

        }
		echo $html;
	}

}
