<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 2/28/2018
 * Time: 3:06 PM
 */

class Laporangiling extends SB_Controller
{
    protected $layout 	= "layouts/main";
    public $module 		= 'laporangiling';
    public $per_page	= '10';

    function __construct() {
        parent::__construct();
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Laporan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'laporan',
        ));
    }

    function index(){
        $this->data['content'] =  $this->load->view('laporangiling/index', $this->data ,true);
        $this->load->view('layouts/main',$this->data);
    }

    function printlaporan()
    {
        $this->load->view('laporangiling/print');
    }
}