
<link rel="stylesheet" href="<?php echo base_url();?>/adminlte/bootstrap/css/bootstrap.min.css">
<table style="width: 100%; margin-left: auto; margin-right: auto;" border="1" cellspacing="0" cellpadding="1">
<tbody>
<tr style="height: 26px;">
<td align="center">

<img src="<?php echo base_url(CNF_COMPANYCODE.'.png');?>" height="52px" style="margin:5px" />
</td>
<td style="font-size:11px;height: 26px;padding-right:10px" align="center">
	<b><?=strtoupper(CNF_NAMAPERUSAHAAN);?><br /><?=strtoupper(CNF_PG);?></b></td>
<td style="font-size:11px;height: 26px;" align="center"><b>KARTU PINJAMAN<br />PETANI</b></td>
</tr>
</tbody>
<table class="table table-striped table-bordered" style="font-size: 12px"  >
						<tbody>	
					
					<tr>
						<td width='10%' class='label-view text-right'>No Pinjaman</td>
						<td><?php echo $row['no_pinjaman'] ;?> </td>

						
					
						
					
						<td width='10%' class='label-view text-right'>Tgl Pencairan</td>
						<td><?php echo $row['tgl_pencairan'] ;?> </td>
						

						<td width='10%' class='label-view text-right'>Pokok Pinjaman</td>
						<td align="right"><?php echo number_format($row['pokok_pinjaman']) ;?> </td>
					
						
						
					</tr>
				
					<tr>
						
						
						<td width='15%' class='label-view text-right'>Penyalur</td>
						<td><?php echo $row['penyalur'] ;?> </td>

						<td width='15%' class='label-view text-right'>Nama Petani</td>
						<td><?php echo $row['id_petani_sap'] ;?> / <?php echo $row['nama_petani'] ;?> </td>
					
						<td width='15%' class='label-view text-right'>Bunga Per Tahun</td>
						<td align="right"><?php echo $row['bunga_per_tahun'] ;?> </td>
						
					
						
						
					</tr>
				
					<tr>
						
						<td width='15%' class='label-view text-right'>Keterangan</td>
						<td><?php echo $row['keterangan'] ;?> </td>
						<td width='15%' class='label-view text-right'>Last Update</td>
						<td><?php echo $row['last_update'] ;?> </td>
						<td width='15%' class='label-view text-right'>Saldo Pinjaman</td>
						<td align="right"><?php echo number_format($row['saldo_kredit']) ;?> </td>
						
					</tr>
				
					<tr>
						
						
					</tr>
				
				
						</tbody>	
					</table> 

					<table class="table table-striped table-bordered" style="font-size: 12px" >
						<thead>
							<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Keterangan</th>
							<th>Debet</th>
							<th>Kredit</th>
							<th>Saldo</th>
						</tr>
						</thead>
						<tbody>
					<?
					$row = $this->db->query("SELECT * FROM t_pinjaman_petani_detail WHERE id_pinjaman=$id")->result();
					$no=0;
					foreach($row as $rx){
						$no++;
					?> 
						<tr>
							<td><?=$no;?></td>
							<td><?=SiteHelpers::datereport($rx->tgl);?></td>
							<td><?php
							switch ($rx->jenis_tx) {
								case 1:
									echo "Pencairan Pinjaman #".$rx->no_ref.' <br />'.$rx->keterangan;
								break;
								case 2:
									echo "Potongan DO #".$rx->no_ref.' <br />'.$rx->keterangan;
								break;
								case 3:
									echo "Pembayaran Langsung #".$rx->no_ref.'<br />'.$rx->keterangan;
								break;
								
							}
							?></td>
							<td align="right"><?=number_format($rx->debet);?></td>
							<td align="right"><?=number_format($rx->kredit);?></td>
							<td align="right"><?=number_format($rx->saldo);?></td>
						</tr>
					<?
					}
					?>
					</tbody>
				</table>
				<center style="font-size:10px"><i>Dicetak Oleh <?=$this->session->userdata('fid');?> pada tanggal <?=date('Y-m-d H:i:s');?></i></center>

<script type="text/javascript">
	
	setTimeout(function () { window.print();}, 2000);
	setTimeout(function () { window.close();}, 3000);
	
</script>