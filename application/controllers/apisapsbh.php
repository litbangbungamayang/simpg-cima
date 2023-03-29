<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/20/2018
 * Time: 4:15 PM
 */
class Apisapsbh extends SB_Controller
{
    function __construct() {
        parent::__construct();
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Api Timbangan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'apitimbangan',
        ));

        $this->load->model('apisapsbhmodel');
        $this->model = $this->apisapsbhmodel;
    }

    function index()
    {
        $tgl = $this->GetPost('tgl');
        $result = $this->model->getSbh($tgl);
        $output = array(
            'data' => $result,
            'count' => count($result)
        );
        echo json_encode($output);
    }



    function excel()
    {
        $tgl = $this->GetPost('tgl');
        $result = $this->model->getSbh($tgl);
        $data['result'] = $result;
        header("Content-disposition: attachment; filename=".str_replace('-', '',$tgl).'_sbh'." ".date("Y-m-d").".xls");
        header("Content-Type: application/vnd.ms-excel");
        $this->load->view('apisbh/tpl_excel', $data);
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
}