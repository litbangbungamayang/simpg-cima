<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/5/2018
 * Time: 11:51 PM
 */
class Settinggilingmodel extends SB_Model
{
    public function getHariGilingKe()
    {
        return $this->db->query("SELECT get_hari_giling() as hari")->row();
    }
}