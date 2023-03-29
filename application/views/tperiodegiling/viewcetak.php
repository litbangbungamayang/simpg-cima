
					<table class="table table-striped table-bordered" >
						<tbody>	
					
					<tr>
						<td width='15%' class='label-view text-right'>Nama Periode</td>
						<td><b><?php echo $row['nama_periode'] ;?></b> </td>
						
					
						<td width='15%' class='label-view text-right'>Tgl Awal</td>
						<td><b><?php echo $row['tgl_awal'] ;?></b> </td>
						
					
						<td width='15%' class='label-view text-right'>Tgl Akhir</td>
						<td><b><?php echo $row['tgl_akhir'] ;?></b> </td>
						
					</tr>
				
					<tr>
						<td width='15%' class='label-view text-right'>Harga Gula</td>
						<td><b> Rp. <?php echo number_format($row['harga_gula'],0) ;?></b> </td>
						
					
						<td width='15%' class='label-view text-right'>Harga Tetes</td>
						<td><b> Rp. <?php echo number_format($row['harga_tetes'],0) ;?></b> </td>
						
					
							<td width='15%' class='label-view text-right'>Total Tetes</td>
						<td><b><?php echo number_format($row['total_tetes'],2) ;?> Kg</b> </td>
						
					</tr>

					<tr>
						<td width='15%' class='label-view text-right'>Netto Tebu SBH</td>
						<td><b><?php echo number_format($row['netto_tebu_sbh'],0) ;?> Kg </b> </td>
						
					
						<td width='15%' class='label-view text-right'>Netto Tebu SPT</td>
						<td><b><?php echo number_format($row['netto_tebu_spt'],0) ;?> Kg </b> </td>
						
					
						<td width='15%' class='label-view text-right'>Netto Tebu Total</td>
						<td><b><?php echo number_format($row['netto_tebu_total'],0) ;?> Kg </b> </td>
						
					</tr>
					<tr>
						<td width='15%' class='label-view text-right'>Gula DO SBH</td>
						<td><b><?php echo number_format($row['gula_do_sbh'],2) ;?> Kg ( <?=$row['lembar_do_sbh'];?> Lembar )</b> </td>
						<td width='15%' class='label-view text-right'>Gula DO SPT</td>
						<td><b><?php echo number_format($row['gula_do_spt'],2) ;?> Kg ( <?=$row['lembar_do_spt'];?> Lembar )</b> </td>
						<td width='15%' class='label-view text-right'>Total DO</td>
						<td><b> Rp. <?php echo number_format($row['total_do'],0) ;?></b> </td>

					</tr>
				
					<tr>
						<td width='15%' class='label-view text-right'>Gula Natura SBH</td>
						<td><b><?php echo number_format($row['gula_natura_sbh'],0) ;?> Kg ( <?=$row['lembar_natura_sbh'];?> Lembar )</b> </td>
					
						<td width='15%' class='label-view text-right'>Gula Natura SPT</td>
						<td><b><?php echo number_format($row['gula_natura_spt'],0) ;?> Kg ( <?=$row['lembar_natura_spt'];?> Lembar )</b> </td>
						<td width='15%' class='label-view text-right'>Total Natura</td>
						<td><b><?php echo number_format($row['total_natura'],0) ;?> Kg</b> </td>
						
					</tr>
				
					<tr>
						
						
					
						
						
					
					
						
					</tr>
				
						</tbody>	
					</table>    
				