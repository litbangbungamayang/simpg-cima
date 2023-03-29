<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('sum_history') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">	
				<div class="table-responsive">
					<table class="table table-striped table-bordered" >
						<tbody>	
					
					<tr>
						<td width='30%' class='label-view text-right'>Id</td>
						<td><?php echo $row['id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Spat</td>
						<td><?php echo $row['no_spat'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Plant</td>
						<td><?php echo $row['kode_plant'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Blok</td>
						<td><?php echo $row['kode_blok'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Spta</td>
						<td><?php echo $row['tgl_spta'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Expired</td>
						<td><?php echo $row['tgl_expired'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Cetak</td>
						<td><?php echo $row['tgl_cetak'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Persno Pta</td>
						<td><?php echo $row['persno_pta'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Id Petani Sap</td>
						<td><?php echo $row['id_petani_sap'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tebang Pg</td>
						<td><?php echo $row['tebang_pg'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Angkut Pg</td>
						<td><?php echo $row['angkut_pg'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jenis Spta</td>
						<td><?php echo $row['jenis_spta'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jarak Id</td>
						<td><?php echo $row['jarak_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Vendor Angkut</td>
						<td><?php echo $row['vendor_angkut'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Affd</td>
						<td><?php echo $row['kode_affd'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Kat Lahan</td>
						<td><?php echo $row['kode_kat_lahan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Plant Trasnfer</td>
						<td><?php echo $row['kode_plant_trasnfer'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Plant Ke</td>
						<td><?php echo $row['kode_plant_ke'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Metode Tma</td>
						<td><?php echo $row['metode_tma'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ket</td>
						<td><?php echo $row['ket'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Id Jenis Angkutan</td>
						<td><?php echo $row['id_jenis_angkutan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Buat Spta Status</td>
						<td><?php echo $row['buat_spta_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Buat Spta Tgl</td>
						<td><?php echo $row['buat_spta_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Cetak Spta Status</td>
						<td><?php echo $row['cetak_spta_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Cetak Spta Tgl</td>
						<td><?php echo $row['cetak_spta_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Selektor Status</td>
						<td><?php echo $row['selektor_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Selektor Tgl</td>
						<td><?php echo $row['selektor_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Pintu Masuk Status</td>
						<td><?php echo $row['pintu_masuk_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Pintu Masuk Tgl</td>
						<td><?php echo $row['pintu_masuk_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Timb Bruto Status</td>
						<td><?php echo $row['timb_bruto_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Timb Bruto Tgl</td>
						<td><?php echo $row['timb_bruto_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Timb Netto Status</td>
						<td><?php echo $row['timb_netto_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Timb Netto Tgl</td>
						<td><?php echo $row['timb_netto_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Meja Tebu Status</td>
						<td><?php echo $row['meja_tebu_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Meja Tebu Tgl</td>
						<td><?php echo $row['meja_tebu_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ari Status</td>
						<td><?php echo $row['ari_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ari Tgl</td>
						<td><?php echo $row['ari_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Timbang</td>
						<td><?php echo $row['tgl_timbang'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hari Giling</td>
						<td><?php echo $row['hari_giling'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Giling</td>
						<td><?php echo $row['tgl_giling'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Urut Analisa Rendemen</td>
						<td><?php echo $row['no_urut_analisa_rendemen'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Retur Alasan</td>
						<td><?php echo $row['retur_alasan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Retur Status</td>
						<td><?php echo $row['retur_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Retur Tgl</td>
						<td><?php echo $row['retur_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Upah Tebang Status</td>
						<td><?php echo $row['upah_tebang_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Upah Tebang Tgl</td>
						<td><?php echo $row['upah_tebang_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Upah Angkut Status</td>
						<td><?php echo $row['upah_angkut_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Upah Angkut Tgl</td>
						<td><?php echo $row['upah_angkut_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Sbh Status</td>
						<td><?php echo $row['sbh_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Sbh Tgl</td>
						<td><?php echo $row['sbh_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Sbh Sap</td>
						<td><?php echo $row['sbh_sap'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Sbh Sap Tgl</td>
						<td><?php echo $row['sbh_sap_tgl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Spt Status</td>
						<td><?php echo $row['spt_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Natura Status</td>
						<td><?php echo $row['natura_status'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('sum_history');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  