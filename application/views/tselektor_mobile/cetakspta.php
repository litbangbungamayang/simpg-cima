<style type="text/css">
	table {
		
	} 
	table td {
		font-size: 11px; 
		font-family: Arial, Helvetica, sans-serif;
		text-transform: uppercase;
	}
	.divx   { page-break-inside:avoid; } /* This is the key */
</style>
<div style="width: 99%;float: left; padding:1px;min-height:103mm" >
	<table valign="top" border="1" width="100%" cellspacing="0" cellpadding="0" style="font-family:;font-size:12px;">
		<tbody>
			<tr>
				<td style="text-align: center;">
					<svg class="barcode"
						jsbarcode-format="code128"
						jsbarcode-value="<?php echo $row->no_spat;?>"
						jsbarcode-textmargin="0"
						jsbarcode-height="70"
						jsbarcode-width="1
						jsbarcode-fontSize="10">
					</svg></br>
					<span style="font-size:10px"><b><?php echo strtoupper(CNF_NAMAPERUSAHAAN);?></b></span></br>
					<span style="font-size:10px"><b>UNIT <?php echo strtoupper(CNF_PG);?></b></span></br>
					<span style="font-size:10px"><b><?php echo $row->no_angkutan." / ".$row->ptgs_angkutan;?></b></span>
				</td>
			</tr>
		</tbody>
	</table>
	<table border="1" width="100%" cellspacing="0" cellpadding="0" style="font-family:;font-size:12px;">
		<tbody>
			<tr>
				<td width="50%">
					<table width="100%">
						<tbody>
							<tr><td width="25%">KODE PETAK</td><td><b><? echo $row->kode_blok;?></b></td></tr>
							<tr><td width="25%">DESKRIPSI</td><td><b><? echo $row->deskripsi_blok;?></b></td></tr>
							<tr><td width="25%">PTA</td><td><b><? echo $row->nama_pta;?></b></td></tr>
							<tr><td width="25%">NO TRUK/SOPIR</td><td><b><? echo $row->no_angkutan." / ".$row->ptgs_angkutan;?></b></td></tr>
							<tr><td width="25%">HEKTAR TEBANG</td><td><b><? echo $row->ha_tertebang;?> &nbsp ha</b></td></tr>
							<tr><td width="25%">JAM TEBANG</td><td><b><? echo $row->tgl_tebang;?></b></td></tr>
							<tr><td width="25%">JENIS TEBU</td><td><b><? echo ($row->terbakar_sel == 1) ? "TERBAKAR" : "HIJAU";?></b></td></tr>
						</tbody>
					</table>
				</td>
				<td>
					<table width="100%">
						<tbody>
							<tr><td width="25%">OPR GRAB LOADER</td><td><b><? echo $row->op_gl;?></b></td></tr>
							<tr><td width="25%">NOMOR GL</td><td><b><? echo $row->no_gl;?></b></td></tr>
							<tr><td width="25%">OPR HARVESTER</td><td><b><? echo $row->op_hv;?></b></td></tr>
							<tr><td width="25%">NOMOR HARVESTER</td><td><b><? echo $row->no_hv;?></b></td></tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>

