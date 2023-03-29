<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('sum_history') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">


		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('sum_history/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
									
								  <div class="form-group  " >
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="No Spat" class=" control-label col-md-4 text-left"> No Spat </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_spat'];?>' name='no_spat'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Plant" class=" control-label col-md-4 text-left"> Kode Plant </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_plant'];?>' name='kode_plant'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Blok" class=" control-label col-md-4 text-left"> Kode Blok </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_blok'];?>' name='kode_blok'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Spta" class=" control-label col-md-4 text-left"> Tgl Spta </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl_spta'];?>' name='tgl_spta'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Expired" class=" control-label col-md-4 text-left"> Tgl Expired </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['tgl_expired'];?>' name='tgl_expired'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Cetak" class=" control-label col-md-4 text-left"> Tgl Cetak </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['tgl_cetak'];?>' name='tgl_cetak'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Persno Pta" class=" control-label col-md-4 text-left"> Persno Pta </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['persno_pta'];?>' name='persno_pta'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Id Petani Sap" class=" control-label col-md-4 text-left"> Id Petani Sap </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_petani_sap'];?>' name='id_petani_sap'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tebang Pg" class=" control-label col-md-4 text-left"> Tebang Pg </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tebang_pg'];?>' name='tebang_pg'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Angkut Pg" class=" control-label col-md-4 text-left"> Angkut Pg </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['angkut_pg'];?>' name='angkut_pg'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Jenis Spta" class=" control-label col-md-4 text-left"> Jenis Spta </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['jenis_spta'];?>' name='jenis_spta'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Jarak Id" class=" control-label col-md-4 text-left"> Jarak Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['jarak_id'];?>' name='jarak_id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Vendor Angkut" class=" control-label col-md-4 text-left"> Vendor Angkut </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['vendor_angkut'];?>' name='vendor_angkut'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Affd" class=" control-label col-md-4 text-left"> Kode Affd </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_affd'];?>' name='kode_affd'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Kat Lahan" class=" control-label col-md-4 text-left"> Kode Kat Lahan </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_kat_lahan'];?>' name='kode_kat_lahan'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Plant Trasnfer" class=" control-label col-md-4 text-left"> Kode Plant Trasnfer </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_plant_trasnfer'];?>' name='kode_plant_trasnfer'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Plant Ke" class=" control-label col-md-4 text-left"> Kode Plant Ke </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_plant_ke'];?>' name='kode_plant_ke'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Metode Tma" class=" control-label col-md-4 text-left"> Metode Tma </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['metode_tma'];?>' name='metode_tma'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ket" class=" control-label col-md-4 text-left"> Ket </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ket'];?>' name='ket'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Id Jenis Angkutan" class=" control-label col-md-4 text-left"> Id Jenis Angkutan </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_jenis_angkutan'];?>' name='id_jenis_angkutan'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Buat Spta Status" class=" control-label col-md-4 text-left"> Buat Spta Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['buat_spta_status'];?>' name='buat_spta_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Buat Spta Tgl" class=" control-label col-md-4 text-left"> Buat Spta Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['buat_spta_tgl'];?>' name='buat_spta_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Cetak Spta Status" class=" control-label col-md-4 text-left"> Cetak Spta Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['cetak_spta_status'];?>' name='cetak_spta_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Cetak Spta Tgl" class=" control-label col-md-4 text-left"> Cetak Spta Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['cetak_spta_tgl'];?>' name='cetak_spta_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Selektor Status" class=" control-label col-md-4 text-left"> Selektor Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['selektor_status'];?>' name='selektor_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Selektor Tgl" class=" control-label col-md-4 text-left"> Selektor Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['selektor_tgl'];?>' name='selektor_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Pintu Masuk Status" class=" control-label col-md-4 text-left"> Pintu Masuk Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['pintu_masuk_status'];?>' name='pintu_masuk_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Pintu Masuk Tgl" class=" control-label col-md-4 text-left"> Pintu Masuk Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['pintu_masuk_tgl'];?>' name='pintu_masuk_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Timb Bruto Status" class=" control-label col-md-4 text-left"> Timb Bruto Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['timb_bruto_status'];?>' name='timb_bruto_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Timb Bruto Tgl" class=" control-label col-md-4 text-left"> Timb Bruto Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['timb_bruto_tgl'];?>' name='timb_bruto_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Timb Netto Status" class=" control-label col-md-4 text-left"> Timb Netto Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['timb_netto_status'];?>' name='timb_netto_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Timb Netto Tgl" class=" control-label col-md-4 text-left"> Timb Netto Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['timb_netto_tgl'];?>' name='timb_netto_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Meja Tebu Status" class=" control-label col-md-4 text-left"> Meja Tebu Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['meja_tebu_status'];?>' name='meja_tebu_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Meja Tebu Tgl" class=" control-label col-md-4 text-left"> Meja Tebu Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['meja_tebu_tgl'];?>' name='meja_tebu_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ari Status" class=" control-label col-md-4 text-left"> Ari Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ari_status'];?>' name='ari_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ari Tgl" class=" control-label col-md-4 text-left"> Ari Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['ari_tgl'];?>' name='ari_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Timbang" class=" control-label col-md-4 text-left"> Tgl Timbang </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl_timbang'];?>' name='tgl_timbang'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hari Giling" class=" control-label col-md-4 text-left"> Hari Giling </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['hari_giling'];?>' name='hari_giling'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Giling" class=" control-label col-md-4 text-left"> Tgl Giling </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl_giling'];?>' name='tgl_giling'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="No Urut Analisa Rendemen" class=" control-label col-md-4 text-left"> No Urut Analisa Rendemen </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_urut_analisa_rendemen'];?>' name='no_urut_analisa_rendemen'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Retur Alasan" class=" control-label col-md-4 text-left"> Retur Alasan </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['retur_alasan'];?>' name='retur_alasan'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Retur Status" class=" control-label col-md-4 text-left"> Retur Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['retur_status'];?>' name='retur_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Retur Tgl" class=" control-label col-md-4 text-left"> Retur Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['retur_tgl'];?>' name='retur_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Upah Tebang Status" class=" control-label col-md-4 text-left"> Upah Tebang Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['upah_tebang_status'];?>' name='upah_tebang_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Upah Tebang Tgl" class=" control-label col-md-4 text-left"> Upah Tebang Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['upah_tebang_tgl'];?>' name='upah_tebang_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Upah Angkut Status" class=" control-label col-md-4 text-left"> Upah Angkut Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['upah_angkut_status'];?>' name='upah_angkut_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Upah Angkut Tgl" class=" control-label col-md-4 text-left"> Upah Angkut Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['upah_angkut_tgl'];?>' name='upah_angkut_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Sbh Status" class=" control-label col-md-4 text-left"> Sbh Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['sbh_status'];?>' name='sbh_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Sbh Tgl" class=" control-label col-md-4 text-left"> Sbh Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['sbh_tgl'];?>' name='sbh_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Sbh Sap" class=" control-label col-md-4 text-left"> Sbh Sap </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['sbh_sap'];?>' name='sbh_sap'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Sbh Sap Tgl" class=" control-label col-md-4 text-left"> Sbh Sap Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['sbh_sap_tgl'];?>' name='sbh_sap_tgl'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Spt Status" class=" control-label col-md-4 text-left"> Spt Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['spt_status'];?>' name='spt_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Natura Status" class=" control-label col-md-4 text-left"> Natura Status </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['natura_status'];?>' name='natura_status'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('sum_history');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 
});
</script>		 