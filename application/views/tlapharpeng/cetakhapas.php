<!DOCTYPE html>
<html lang="en">

<head>
  <style>

</style>
</head>
<?
$totaltetes = 0;
$totaltebugiling = 0;
$totalshsthnini = 0;
$gulapgexsaudara = 0;
$gulapgextr = 0;
$shsexmsthnini = 0;

$extshablur =0;
$extstonshs =0;
$extstontetes =0;

$hblryll = 0;
$shsyll = 0;
$tetesyll = 0;

$tetessto = 0;
$tetestotal = 0;
$tetesrs = 0;
?>
<page size="A4">
	<table style="width: 100%;font-family: Arial;padding:10px">
		<tr>
			<td style="text-align: center;font-size: 20px;font-weight: bold;">LAPORAN HASIL PASTI<br />GILING TAHUN <?=CNF_TAHUNGILING;?><br /><?=CNF_PG;?></td>
		</tr>
	</table>
	<table style="width: 100%;font-weight: bold;font-family: Arial;font-size: 12px;padding:0 10px 10px 10px">
		<tr><td style="width: 70%">Tanggal Awal Giling</td><td>:</td><td style="text-align: right;"><?=$kontrol->daterpt($row->tgl_awal)?></td></tr>
		<tr><td style="width: 70%">Tanggal Akhir Giling</td><td>:</td><td style="text-align: right;"><?=$kontrol->daterpt($row->tgl_akhir)?></td></tr>
		<tr><td style="width: 70%">Tanggal Stop Hari Raya Idul Fitri</td><td>:</td><td style="text-align: right;"><?= $row->tgl_stop_hif == '0000-00-00' ? '-': $kontrol->daterpt($row->tgl_stop_hif)?></td></tr>
		<tr><td style="width: 70%">Tanggal Start Hari Raya Idul Fitri</td><td>:</td><td style="text-align: right;"><?= $row->tgl_start_hif == '0000-00-00' ? '-': $kontrol->daterpt($row->tgl_start_hif)?></td></tr>
		<tr><td style="width: 70%">Tanggal Stop Hari Raya Idul Adha</td><td>:</td><td style="text-align: right;"><?= $row->tgl_stop_hia == '0000-00-00' ? '-': $kontrol->daterpt($row->tgl_stop_hia)?></td></tr>
		<tr><td style="width: 70%">Tanggal Start Hari Raya Idul Adha</td><td>:</td><td style="text-align: right;"><?= $row->tgl_start_hia == '0000-00-00' ? '-': $kontrol->daterpt($row->tgl_start_hia)?></td></tr>
		<tr><td style="width: 70%">Jumlah Hari Penyelesaian</td><td>:</td><td style="text-align: right;"><?=$row->jml_hari_penyelesaian;?></td></tr>
		<tr><td style="width: 70%">Jumlah Hari Giling Incl JB</td><td>:</td><td style="text-align: right;"><?=$row->jml_hari_gil_inc_jb;?></td></tr>

		<tr><td colspan="3">&nbsp;</td></tr>
		<tr><td colspan="3" style="background-color: #004effb5;color: white;text-align: center;padding: 5px;">URAIAN</td></tr>
		<tr>
			<td colspan="3" style="border:1px solid #ff8100b5">
		<table style="width: 100%">
			<td colspan="2" style="background-color: #ff8100b5;color: black;padding:5px">LUAS</td></tr>
		<?
		$th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '01%' order by kode")->result();
        foreach ($th as $ks) {
        	if($ks->kode == '0103') $totaltebugiling = $ks->ton_tebu;
        	if($totaltebugiling == 0) $totaltebugiling = 1;

        	if($ks->parent == '01'){
        		?>
        		<tr style="background-color: yellow"><td  style="color: black"><span style="color:yellow"><?=$ks->kode;?></span><b> <?=$ks->uraian;?> </b></td><td style="text-align: right;"></td></tr>
        		<?
        	}else{
        		$d = '';$clr = 'white';
        		if($ks->parent == '010000'){
        			$clr = '#dadada';
        			$d = 'background-color:#dadada;font-weight:bold';
        		}else if($ks->parent == '01000'){
        			$clr = 'pink';
        			$d = 'background-color:pink;font-weight:bold;';
        		}
        		$pg = '';
        		if($ks->transfer != '0'){
                     $pg = $kontrol->getnamaunit($ks->plant_code);
                    }
        	?>
        	<tr style="<?=$d;?>"><td  style="color: black"><span style="color:<?=$clr;?>"><?=$ks->kode;?></span><b> 
        		<?=$ks->uraian.' '.$pg;?> </b></td><td style="text-align: right;"><?=$kontrol->numberformat($ks->luas,4);?></td></tr>
        	<?
        }
        }
		?>
	</table>
</td>
</tr>
<tr>
<td colspan="3" style="border:1px solid #00ff2bb5">
		<table style="width: 100%">
		<td colspan="2" style="background-color: #00ff2bb5;color: black;padding:5px">TON TEBU GILING</td></tr>
		<?
		$th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '01%' order by kode")->result();
        foreach ($th as $ks) {
        	if($ks->parent == '01'){
        		?>
        		<tr style="background-color: yellow"><td  style="color: black"><span style="color:yellow"><?=$ks->kode;?></span><b> <?=$ks->uraian;?> </b></td><td style="text-align: right;"></td></tr>
        		<?
        	}else{
        		$d = '';$clr = 'white';
        		if($ks->parent == '010000'){
        			$clr = '#dadada';
        			$d = 'background-color:#dadada;font-weight:bold';
        		}else if($ks->parent == '01000'){
        			$clr = 'pink';
        			$d = 'background-color:pink;font-weight:bold;';
        		}

        		$pg = '';
        		if($ks->transfer != '0'){
                     $pg = $kontrol->getnamaunit($ks->plant_code);
                    }
        	?>
        	<tr style="<?=$d;?>"><td  style="color: black"><span style="color:<?=$clr;?>"><?=$ks->kode;?></span><b> 
        		<?=$ks->uraian.' '.$pg;?> </b></td><td style="text-align: right;"><?=$kontrol->numberformat($ks->ton_tebu,4);?></td></tr>
        	<?
        }
        }
		?>
	</table>
	</td>
</tr>
<tr>
<td colspan="3" style="border:1px solid #00b8ff94">
		<table style="width: 100%">
		<td colspan="2" style="background-color: #00b8ff94;color: black;padding:5px">TON HABLUR DIHASILKAN</td></tr>
		<?
		$th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '01%' order by kode")->result();
        foreach ($th as $ks) {
        	if($ks->parent == '01'){
        		?>
        		<tr style="background-color: yellow"><td  style="color: black"><span style="color:yellow"><?=$ks->kode;?></span><b> <?=$ks->uraian;?> </b></td><td style="text-align: right;"></td></tr>
        		<?
        	}else{
        		$d = '';$clr = 'white';
        		if($ks->parent == '010000'){
        			$clr = '#dadada';
        			$d = 'background-color:#dadada;font-weight:bold';
        		}else if($ks->parent == '01000'){
        			$clr = 'pink';
        			$d = 'background-color:pink;font-weight:bold;';
        		}

        		$pg = '';
        		if($ks->transfer != '0'){
                     $pg = $kontrol->getnamaunit($ks->plant_code);
                    }
        	?>
        	<tr style="<?=$d;?>"><td  style="color: black"><span style="color:<?=$clr;?>"><?=$ks->kode;?></span><b> 
        		<?=$ks->uraian.' '.$pg;?> </b></td><td style="text-align: right;"><?=$kontrol->numberformat($ks->ton_hablur,4);?></td></tr>
        	<?
        }
        }
		?>
	</table>
	</td>
</tr>

<tr>
<td colspan="3" style="border:1px solid #00b8ff94">
		<table style="width: 100%">
		<?
		$th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode not like '01%' order by kode")->result();
        foreach ($th as $ks) {
        	if($ks->kode == '0405') $totaltetes = $ks->nilai;
        	if($ks->kode == '0403') $totalshsthnini = $ks->nilai;
        	if($ks->kode == '0404') $shsexmsthnini = $ks->nilai;

        	if($ks->kode == '0401') $hblryll = $ks->nilai;
			if($ks->kode == '0402') $shsyll = $ks->nilai;
			if($ks->kode == '0406') $tetesyll = $ks->nilai;

			if($ks->kode == '0407') $tetessto = $ks->nilai;
			if($ks->kode == '0408') $tetesrs = $ks->nilai;
			if($ks->kode == '0409') $tetestotal = $ks->nilai;

        	if($ks->parent == '01'){
        		?>
        		<tr style="background-color: yellow"><td  style="color: black"><span style="color:yellow"><?=$ks->kode;?></span><b> <?=$ks->uraian;?> </b></td><td style="text-align: right;"></td></tr>
        		<?
        	}else{
        		$d = '';$clr = 'white';
        		if($ks->parent == '010000'){
        			$clr = '#dadada';
        			$d = 'background-color:#dadada;font-weight:bold';
        		}else if($ks->parent == '01000'){
        			$clr = 'pink';
        			$d = 'background-color:pink;font-weight:bold;';
        		}

        		$pg = '';
        		if($ks->transfer != '0'){
                     $pg = $kontrol->getnamaunit($ks->plant_code);
                    }
        	?>
        	<tr style="<?=$d;?>"><td  style="color: black"><span style="color:<?=$clr;?>"><?=$ks->kode;?></span><b> 
        		<?=$ks->uraian.' '.$pg;?> </b></td><td style="text-align: right;"><?=$kontrol->numberformat($ks->nilai,4);?></td></tr>
        	<?
        }
        }
		?>
	</table>
	</td>
</tr>

	</table>
</page>
<div style="page-break-before: always"></div>
<page size="A4">
	<table style="width: 100%;font-family: Arial;padding:10px">
		<tr>
			<td style="text-align: center;font-size: 20px;font-weight: bold;">LAPORAN HASIL PASTI<br />GILING TAHUN <?=CNF_TAHUNGILING;?><br /><?=CNF_PG;?></td>
		</tr>
	</table>
	<table style="width: 100%;font-weight: bold;font-family: Arial;font-size: 12px;padding:0 10px 10px 10px">
		<tr><td style="width: 70%">Tanggal Awal Giling</td><td>:</td><td style="text-align: right;"><?=$kontrol->daterpt($row->tgl_awal)?></td></tr>
		<tr><td style="width: 70%">Tanggal Akhir Giling</td><td>:</td><td style="text-align: right;"><?=$kontrol->daterpt($row->tgl_akhir)?></td></tr>
		<tr><td style="width: 70%">Tanggal Stop Hari Raya Idul Fitri</td><td>:</td><td style="text-align: right;"><?= $row->tgl_stop_hif == '0000-00-00' ? '-': $kontrol->daterpt($row->tgl_stop_hif)?></td></tr>
		<tr><td style="width: 70%">Tanggal Start Hari Raya Idul Fitri</td><td>:</td><td style="text-align: right;"><?= $row->tgl_start_hif == '0000-00-00' ? '-': $kontrol->daterpt($row->tgl_start_hif)?></td></tr>
		<tr><td style="width: 70%">Tanggal Stop Hari Raya Idul Adha</td><td>:</td><td style="text-align: right;"><?= $row->tgl_stop_hia == '0000-00-00' ? '-': $kontrol->daterpt($row->tgl_stop_hia)?></td></tr>
		<tr><td style="width: 70%">Tanggal Start Hari Raya Idul Adha</td><td>:</td><td style="text-align: right;"><?= $row->tgl_start_hia == '0000-00-00' ? '-': $kontrol->daterpt($row->tgl_start_hia)?></td></tr>
		<tr><td style="width: 70%">Jumlah Hari Penyelesaian</td><td>:</td><td style="text-align: right;"><?=$row->jml_hari_penyelesaian;?></td></tr>
		<tr><td style="width: 70%">Jumlah Hari Giling Incl JB</td><td>:</td><td style="text-align: right;"><?=$row->jml_hari_gil_inc_jb;?></td></tr>

		<tr><td colspan="3">&nbsp;</td></tr>
		<tr><td colspan="3" style="background-color: #004effb5;color: white;text-align: center;padding: 5px;">HASIL TEBU, HABLUR DAN TETES</td></tr>
		<tr>
<td colspan="3" style="border:1px solid #00b8ff94">
		<table style="width: 100%">
			<tr>
		<td style="background-color: #00b8ff94;color: black;padding:5px">URAIAN</td>
		<td style="background-color: #00b8ff94;color: black;padding:5px">HA DIGILING</td>
		<td style="background-color: #00b8ff94;color: black;padding:5px">TON TEBU</td>
		<td style="background-color: #00b8ff94;color: black;padding:5px">TON HABLUR</td>
		<td style="background-color: #00b8ff94;color: black;padding:5px">TON TETES</td>

	</tr>
		<?
		$th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '01%' order by kode")->result();
        foreach ($th as $ks) {
        	if($ks->kode == '010107') $gulapgexsaudara = $ks->ton_gula_milik;
        	if($ks->kode == '010207') $gulapgextr = $ks->ton_gula_milik;
        	if($ks->parent == '01'){
        		?>
        		<tr style="background-color: yellow"><td  style="color: black" colspan="4"><span style="color:yellow"><?=$ks->kode;?></span><b> <?=$ks->uraian;?> </b></td><td style="text-align: right;"></td></tr>
        		<?
        	}else{
        		$d = '';$clr = 'white';
        		if($ks->parent == '010000'){
        			$clr = '#dadada';
        			$d = 'background-color:#dadada;font-weight:bold';
        		}else if($ks->parent == '01000'){
        			$clr = 'pink';
        			$d = 'background-color:pink;font-weight:bold;';
        		}

        		$pg = '';
        		if($ks->transfer != '0'){
                     $pg = $kontrol->getnamaunit($ks->plant_code);
                    }
        	?>
        	<tr style="<?=$d;?>"><td  style="color: black"><span style="color:<?=$clr;?>"><?=$ks->kode;?></span><b> 
        		<?=$ks->uraian.' '.$pg;?> </b></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($ks->luas,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($ks->ton_tebu,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($ks->ton_hablur,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($totaltetes/$totaltebugiling*$ks->ton_tebu,4);?></td>
        	</tr>
        	<?
        }
        }
		?>
	</table>
	</td>
</tr>
<tr><td colspan="3" style="background-color: #004effb5;color: white;text-align: center;padding: 5px;">PEMBAGIAN HASIL GULA DAN TETES</td></tr>
		<tr>
<td colspan="3" style="border:1px solid #00b8ff94">
		<table style="width: 100%">
			<tr>
		<td style="background-color: #00b8ff94;color: black;padding:5px">URAIAN</td>
		<td style="background-color: #00b8ff94;color: black;padding:5px">TON HABLUR</td>
		<td style="background-color: #00b8ff94;color: black;padding:5px">TON SHS</td>
		<td style="background-color: #00b8ff94;color: black;padding:5px">ON SHS SISA</td>
		<td style="background-color: #00b8ff94;color: black;padding:5px">TON TETES</td>

	</tr>
	<tr><td colspan="4">1. MILIK SENDIRI</td></tr>
		<?
		$th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '0101%' order by kode")->result();
        foreach ($th as $ks) {
        	if($ks->parent == '01'){
        		?>
        		<tr style="background-color: yellow"><td  style="color: black" colspan="4"><span style="color:yellow"><?=$ks->kode;?></span><b>1.A EX <?=$ks->uraian;?> </b></td><td style="text-align: right;"></td></tr>
        		<?
        	}else{
        		$d = '';$clr = 'white';
        		if($ks->parent == '010000'){
        			$clr = '#dadada';
        			$d = 'background-color:#dadada;font-weight:bold';
        		}else if($ks->parent == '01000'){
        			$clr = 'pink';
        			$d = 'background-color:pink;font-weight:bold;';
        		}

        		$pg = '';
        		if($ks->transfer != '0'){
                     $pg = $kontrol->getnamaunit($ks->plant_code);
                    }
        	?>
        	<tr style="<?=$d;?>"><td  style="color: black"><span style="color:<?=$clr;?>"><?=$ks->kode;?></span><b> 
        		<?=$ks->uraian.' '.$pg;?> </b></td>
        		<?
        		$onsisa = 0;$hblr = $ks->ton_gula_milik/1.003;
        		if($ks->kode == '010101' || $ks->kode == '010108'){ 
        			$onsisa =  $shsexmsthnini;
        			$hblr = $ks->ton_hablur;
        		}
                //$ks->ton_gula_milik = $ks->ton_gula_milik - $onsisa;
        		?>
        		<td style="text-align: right;"><?=$kontrol->numberformat($hblr,4);?></td>
        		<td style="text-align: right;"> <?=$kontrol->numberformat(($ks->ton_gula_milik),4);?></td>
        		
        		<td style="text-align: right;"><?=$kontrol->numberformat($onsisa,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($totaltetes/$totaltebugiling*$ks->ton_tebu,4);?></td>
        	</tr>
        	<?
        	if($ks->kode == '010108'){
        		$extshablur =$hblr;
				$extstonshs =$ks->ton_gula_milik;
				$extstontetes =$totaltetes/$totaltebugiling*$ks->ton_tebu;
        	}
        }
        }
		?>

		<?
		$th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '0102%' order by kode")->result();
        foreach ($th as $ks) {
        	if($ks->parent == '01'){
        		?>
        		<tr style="background-color: yellow"><td  style="color: black" colspan="4"><span style="color:yellow"><?=$ks->kode;?></span><b>1.B EX <?=$ks->uraian;?> </b></td><td style="text-align: right;"></td></tr>
        		<?
        	}else{
        		$d = '';$clr = 'white';
        		if($ks->parent == '010000'){
        			$clr = '#dadada';
        			$d = 'background-color:#dadada;font-weight:bold';
        		}else if($ks->parent == '01000'){
        			$clr = 'pink';
        			$d = 'background-color:pink;font-weight:bold;';
        		}

        		$pg = '';
        		if($ks->transfer != '0'){
                     $pg = $kontrol->getnamaunit($ks->plant_code);
                    }
        	?>
        	<tr style="<?=$d;?>"><td  style="color: black"><span style="color:<?=$clr;?>"><?=$ks->kode;?></span><b> 
        		<?=$ks->uraian.' '.$pg;?> </b></td>
        		<?
        		$hblr = $ks->ton_gula_milik/1.003;
        		
        		?>
        		<td style="text-align: right;"><?=$kontrol->numberformat($hblr,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat(($ks->ton_gula_milik),4);?></td>
        		
        		<td style="text-align: right;"><?=$kontrol->numberformat(0,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat(($totaltetes/$totaltebugiling*$ks->ton_tebu)-($ks->ton_tebu*3/100),4);?></td>
        	</tr>
        	<?
        	if($ks->kode == '010207'){
        		$extshablur = $extshablur + $hblr;
				$extstonshs = $extstonshs + $ks->ton_gula_milik;
				$extstontetes =$extstontetes + ($totaltetes/$totaltebugiling*$ks->ton_tebu)-($ks->ton_tebu*3/100);
        	}
        }
        }
		?>
		<tr style="background-color:pink;font-weight:bold;"><td style="color: black"><span style="color:pink">0103</span><b> 
        		TOTAL Ex TS + Ex TR  </b></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($extshablur,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($extstonshs,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($onsisa,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($extstontetes,4);?></td>
        	</tr>
		<tr><td colspan="4">2. MILIK SENDIRI PG SAUDARA</td></tr>
		<?
		$th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '01010%' AND transfer != 0 order by kode")->result();
        foreach ($th as $ks) {
        	if($ks->parent == '01'){
        		?>
        		<tr style="background-color: yellow"><td  style="color: black" colspan="4"><span style="color:yellow"><?=$ks->kode;?></span><b>1.B EX <?=$ks->uraian;?> </b></td><td style="text-align: right;"></td></tr>
        		<?
        	}else{
        		$d = '';$clr = 'white';
        		if($ks->parent == '010000'){
        			$clr = '#dadada'; 
        			$d = 'background-color:#dadada;font-weight:bold';
        		}else if($ks->parent == '01000'){
        			$clr = 'pink';
        			$d = 'background-color:pink;font-weight:bold;';
        		}

        		$pg = '';
        		if($ks->transfer != '0'){
                     $pg = $kontrol->getnamaunit($ks->plant_code);
                    }
        	?>
        	<tr style="<?=$d;?>"><td  style="color: black"><span style="color:<?=$clr;?>"><?=$ks->kode;?></span><b> 
        		<?=$ks->uraian.' '.$pg;?> </b></td>
        		<?
        		$hblr = $ks->ton_gula_ptr/1.003;
        		
        		?>
        		<td style="text-align: right;"><?=$kontrol->numberformat($hblr,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat(($ks->ton_gula_ptr),4);?></td>
        		
        		<td style="text-align: right;"><?=$kontrol->numberformat(0,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($ks->ton_tebu*0/100,4);?></td>
        	</tr>
        	<?
        }
        }
		?>
		<tr><td colspan="4">3. MILIK PETANI (PTR)</td></tr>
		<?
		$th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '01020%' order by kode")->result();
        foreach ($th as $ks) {
        	if($ks->parent == '01'){
        		?>
        		<tr style="background-color: yellow"><td  style="color: black" colspan="4"><span style="color:yellow"><?=$ks->kode;?></span><b>1.B EX <?=$ks->uraian;?> </b></td><td style="text-align: right;"></td></tr>
        		<?
        	}else{
        		$d = '';$clr = 'white';
        		if($ks->parent == '010000'){
        			$clr = '#dadada';
        			$d = 'background-color:#dadada;font-weight:bold';
        		}else if($ks->parent == '01000'){
        			$clr = 'pink';
        			$d = 'background-color:pink;font-weight:bold;';
        		}

        		$pg = '';
        		if($ks->transfer != '0'){
                     $pg = $kontrol->getnamaunit($ks->plant_code);
                    }
        	?>
        	<tr style="<?=$d;?>"><td  style="color: black"><span style="color:<?=$clr;?>"><?=$ks->kode;?></span><b> 
        		<?=$ks->uraian.' '.$pg;?> </b></td>
        		<?
        		$hblr = $ks->ton_gula_ptr/1.003;
        		
        		?>
        		<td style="text-align: right;"><?=$kontrol->numberformat($hblr,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat(($ks->ton_gula_ptr),4);?></td>
        		
        		<td style="text-align: right;"><?=$kontrol->numberformat(0,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($ks->ton_tebu*3/100,4);?></td>
        	</tr>
        	<?

        	if($ks->kode == '010207'){
        		$extshablur = $extshablur + $hblr;
				$extstonshs = $extstonshs + $ks->ton_gula_ptr;
				$extstontetes =$extstontetes + ($ks->ton_tebu*3/100);
        	}
        }
        }
		?>
		<tr style="background-color:pink;font-weight:bold;"><td style="color: black"><b> 
        		TOTAL 1 + 2 + 3 </b></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($extshablur,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat(round($extstonshs,2),4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($onsisa,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($extstontetes,4);?></td>
        	</tr>
        	<tr style="background-color:pink;font-weight:bold;"><td style="color: black"><b> 
        		Ex MS Tahun Yll </b></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($hblryll,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($shsyll,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat(0,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($tetesyll,4);?></td>
        	</tr>
        	<tr style="background-color:pink;font-weight:bold;"><td style="color: black"><b> 
        		Total Jumlah Incl Ms Thn Yll </b></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($extshablur+$hblryll,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat(round($extstonshs+$shsyll,2),4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat(0,4);?></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($extstontetes+$tetesyll,4);?></td>
        	</tr>
        	<tr style="background-color:pink;font-weight:bold;"><td style="color: black" colspan="4"><b> 
        		JUMLAH TETES Ex RS </b></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($tetesrs,4);?></td>
        	</tr>
        	<tr style="background-color:pink;font-weight:bold;"><td style="color: black" colspan="4"><b> 
        		JUMLAH TETES STO </b></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($tetessto,4);?></td>
        	</tr>
        	<tr style="background-color:pink;font-weight:bold;"><td style="color: black" colspan="4"><b> 
        		JUMLAH TETES TOTAL </b></td>
        		<td style="text-align: right;"><?=$kontrol->numberformat($tetestotal,4);?></td>
        	</tr>
	</table>
	</td>
</tr>
</table>
<table style="width: 100%;font-family: Arial;padding:10px;font-size: 12px">
  <tr>
  	<td>&nbsp;</td>
    <td style="width: 50%; text-align: center; font-weight: bold;"><?=CNF_PG?>, <?=$kontrol->daterpt($row->tgl_akhir)?>
    	<br /><?=CNF_NAMAPERUSAHAAN;?>
    </td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td style="text-align: center;"><br /><br /><br /><br /><br /><br /><?php echo CNF_GM;?></td>
  </tr>
</table>
</page>
</html>