<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/13/2018
 * Time: 3:56 PM
 */
class Dashboardtimbangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        //$this->load->view('dashboardtimbangan/dashboard');
    }

    function listdata()
    {
        $this->load->view('dashboardtimbangan/index');
    }

    function data($jenis)
    {
        $this->load->model('dashboardtimbanganmodel');
        if($jenis == "LORI"){
            $result = $this->dashboardtimbanganmodel->AntrianLori();
        }else{
            $result = $this->dashboardtimbanganmodel->AntrianTruk();
        }

        if(count($result) > 0){
            $output = array('data' => $result);
        }else{
            $output = array('data' => array());
        }

        echo json_encode($output);
    }

    function indexlori()
    {
        $this->load->view('dashboardtimbangan/indexlori');
    }

    function sisapagi()
    {
        $this->load->view('dashboardtimbangan/sisapagi');
    }

    function datasisapagi()
    {
        $this->load->model('dashboardtimbanganmodel');
        $result = $this->dashboardtimbanganmodel->AntrianSisapagi();
        if(count($result) > 0){
            $output = array('data' => $result);
        }else{
            $output = array('data' => array());
        }

        echo json_encode($output);
    }

    function formcetaklori()
    {
        $sql_loko = "SELECT * FROM m_no_loko";
        $query = $this->db->query($sql_loko);
        $data['loko'] = $query->result();
        $this->load->view('dashboardtimbangan/formcetaklori', $data);
    }

    function printlori()
    {
        $no_trainstat = $this->GetPost('no_trainstat');
        $no_loko = $this->GetPost('no_loko');
        $tgl_timbang = $this->GetPost('tgl_timbang');
        $this->load->model('dashboardtimbanganmodel');
        $result = $this->dashboardtimbanganmodel->PrintDataCetakLori($no_trainstat, $no_loko, $tgl_timbang);
        $data['lori'] = $result;
        $data['no_trainstat'] = $no_trainstat;
        $data['no_loko'] = $no_loko;
       // var_dump($data);
        $this->load->view('dashboardtimbangan/printlori', $data);
    }

    function datalori()
    {
        $no_trainstat = $this->GetPost('no_trainstat');
        $no_loko = $this->GetPost('no_loko');
        $tgl_timbang = $this->GetPost('tgl_timbang');
        $this->load->model('dashboardtimbanganmodel');
        $result = $this->dashboardtimbanganmodel->DataCetakLori($no_trainstat, $no_loko, $tgl_timbang);

        if(count($result) > 0){
            $output = array('data' => $result);
        }else{
            $output = array('data' => array());
        }

        echo json_encode($output);
    }

    public function getDashGiling()
    {
        $sql = "SELECT get_tgl_giling() AS tgl,jm.jam,IFNULL(ylsltruk.ttl,0) AS ylstruk,IFNULL(ylsllori.ttl,0) AS ylslori,IFNULL(sltruk.ttl,0) AS struk,IFNULL(sllori.ttl,0) AS slori,
IFNULL(yltimtruk.ttl,0) AS yltimtruk,IFNULL(yltimlori.ttl,0) AS yltimlori,IFNULL(timtruk.ttl,0) AS timtruk,IFNULL(timlori.ttl,0) AS timlori,
IFNULL(ylgiltruk.ttl,0) AS ylgiltruk,IFNULL(ylgillori.ttl,0) AS ylgillori,IFNULL(giltruk.ttl,0) AS giltruk,IFNULL(gillori.ttl,0) AS gillori FROM t_lap_jam jm 
LEFT JOIN (SELECT COUNT(id_spta) AS ttl,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`=get_tgl_giling() AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS sltruk ON sltruk.jam=jm.jam
LEFT JOIN (SELECT COUNT(id_spta) AS ttl,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`=get_tgl_giling() AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS sllori ON sllori.jam=jm.jam 
LEFT JOIN (SELECT COUNT(id_spta) AS ttl,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS ylsltruk ON ylsltruk.jam=jm.jam
LEFT JOIN (SELECT COUNT(id_spta) AS ttl,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS ylsllori ON ylsllori.jam=jm.jam 
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE IF(STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(timb_netto_tgl),' 06:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d'))=get_tgl_giling() AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS timtruk ON timtruk.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE IF(STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(timb_netto_tgl),' 06:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d'))=get_tgl_giling() AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS timlori ON timlori.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE IF(STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(timb_netto_tgl),' 06:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d'))=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS yltimtruk ON yltimtruk.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE IF(STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(timb_netto_tgl),' 06:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d'))=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS yltimlori ON yltimlori.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.meja_tebu_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_giling`=get_tgl_giling() AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(meja_tebu_tgl,'%H')) AS giltruk ON giltruk.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.meja_tebu_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_giling`=get_tgl_giling() AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(meja_tebu_tgl,'%H')) AS gillori ON gillori.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.meja_tebu_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_giling`=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(meja_tebu_tgl,'%H')) AS ylgiltruk ON ylgiltruk.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.meja_tebu_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_giling`=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(meja_tebu_tgl,'%H')) AS ylgillori ON ylgillori.jam=jm.jam
 GROUP BY jm.`jam` ORDER BY jm.id ASC";

        $ax = $this->db->query($sql)->result();
        $htm = '';
        $ttlselyl = 0;
        $ttlselhi = 0;
        $ttltimbyl = 0;
        $ttltimbhi = 0;
        $ttlgilyl = 0;
        $ttlgilhi = 0;
        foreach ($ax as $rw) {
            $htm .= '
 			<tr>
 			<td style="text-align:center">'.$rw->jam.':00'.'</td>
 			<td style="text-align:center">'.$rw->ylstruk.'</td>
 			<td style="text-align:center">'.$rw->ylslori.'</td>
 			<td style="text-align:center">'.($rw->ylstruk+$rw->ylslori).'</td>
 			<td style="text-align:center">'.$rw->struk.'</td>
 			<td style="text-align:center">'.$rw->slori.'</td>
 			<td style="text-align:center">'.($rw->struk+$rw->slori).'</td>
 			<td style="text-align:center">'.number_format($rw->yltimtruk/1000,2).'</td>
 			<td style="text-align:center">'.number_format($rw->yltimlori/1000,2).'</td>
 			<td style="text-align:center">'.number_format(($rw->yltimlori+$rw->yltimtruk)/1000,2).'</td>
 			<td style="text-align:center">'.number_format($rw->timtruk/1000,2).'</td>
 			<td style="text-align:center">'.number_format($rw->timlori/1000,2).'</td>
 			<td style="text-align:center">'.number_format(($rw->timlori+$rw->timtruk)/1000,2).'</td>
 			<td style="text-align:center">'.number_format($rw->ylgiltruk/1000,2).'</td>
 			<td style="text-align:center">'.number_format($rw->ylgillori/1000,2).'</td>
 			<td style="text-align:center">'.number_format(($rw->ylgillori+$rw->ylgiltruk)/1000,2).'</td>
 			<td style="text-align:center">'.number_format($rw->giltruk/1000,2).'</td>
 			<td style="text-align:center">'.number_format($rw->gillori/1000,2).'</td>
 			<td style="text-align:center">'.number_format(($rw->giltruk+$rw->gillori)/1000,2).'</td></tr>';

            $ttlselyl = $ttlselyl+($rw->ylstruk+$rw->ylslori);
            $ttlselhi = $ttlselhi+($rw->struk+$rw->slori);
            $ttltimbyl = $ttltimbyl+(($rw->yltimlori+$rw->yltimtruk)/1000);
            $ttltimbhi = $ttltimbhi+(($rw->timlori+$rw->timtruk)/1000);
            $ttlgilyl = $ttlgilyl+(($rw->ylgillori+$rw->ylgiltruk)/1000);
            $ttlgilhi = $ttlgilhi+(($rw->giltruk+$rw->gillori)/1000);
        }

        $htm .= '
 			<tr style="background:black;color:white;font-weight:bold;font-weight:13px">
 			<td style="text-align:center" colspan="3">TOTAL</td>
 			<td style="text-align:center">'.($ttlselyl).'</td>
 			<td style="text-align:center" colspan="2">TOTAL</td>
 			<td style="text-align:center">'.($ttlselhi).'</td>
 			<td style="text-align:center" colspan="2">TOTAL</td>
 			<td style="text-align:center">'.number_format($ttltimbyl,2).'</td>
 			<td style="text-align:center" colspan="2">TOTAL</td>
 			<td style="text-align:center">'.number_format($ttltimbhi,2).'</td>
 			<td style="text-align:center" colspan="2">TOTAL</td>
 			<td style="text-align:center">'.number_format($ttlgilyl,2).'</td>
 			<td style="text-align:center" colspan="2">TOTAL</td>
 			<td style="text-align:center">'.number_format($ttlgilhi,2).'</td></tr>';

        echo $htm;
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