<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
                   <div class="box-body">

	<div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
	<div class="sbox-content">	
 	
	<?php echo $this->session->flashdata('message'); ?>
		<div class="block-content" style="margin:10px">


			<div class="tab-content m-t">
			  <div class="tab-pane active use-padding" id="info">
			 <form class="form-horizontal row" action="<?php echo site_url('sximo/config/postSavePengolahan');?>" method="post">

				

	<div class="col-sm-6">


			<fieldset > <legend>Setting Pengolahan </legend>

			<div class="form-group">
				<label for="ipt" class=" control-label col-md-4">Tgl Awal Giling</label>
				<div class="col-md-8">
						<input name="pn_awal_giling" type="text" id="pn_awal_giling" class="form-control input-sm number date" value="<?php  echo PN_AWAL_GILING;  ?>" readonly />
				 </div>
			  </div>

		 <div class="form-group">
				<label for="ipt" class=" control-label col-md-4">Faktor Konversi</label>
				<div class="col-md-8">
						<input name="pn_faktor_konversi" type="text" id="pn_faktor_konversi" class="form-control input-sm number" value="<?php echo  PN_FAKTOR_KONVERSI ;?>" />
				 </div>
			  </div>
		<div class="form-group">
				<label for="ipt" class=" control-label col-md-4">Faktor Rendemen</label>
				<div class="col-md-8">
						<input name="pn_faktor_rendemen" type="text" id="pn_faktor_rendemen" class="form-control input-sm number" value="<?php echo  PN_FAKTOR_RENDEMEN ;?>" />
				 </div>
			  </div>

		<div class="form-group">
				<label for="ipt" class=" control-label col-md-4">Faktor Perah</label>
				<div class="col-md-8">
						<input name="pn_faktor_perah" type="text" id="pn_faktor_perah" class="form-control input-sm number" value="<?php echo  PN_FAKTOR_PERAH ;?>" />
				 </div>
			  </div>

		<div class="form-group">
				<label for="ipt" class=" control-label col-md-4">Log Tanggal Terakhir</label>
				<div class="col-md-8">
						<input name="pn_ubah_terakhir" type="text" id="pn_ubah_terakhir" class="form-control input-sm number" value="<?php echo  PN_UBAH_TERAKHIR ;?>" readonly />
				 </div>
			  </div>

		<div class="form-group">
				<label for="ipt" class=" control-label col-md-4">Log User Perubah</label>
				<div class="col-md-8">
						<input name="pn_user_ubah" type="text" id="pn_user_ubah" class="form-control input-sm number" value="<?php echo  PN_USER_UBAH ;?>" readonly />
				 </div>
			  </div>
		
			  
		  </fieldset>


				<div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> </label>
				<div class="col-md-8">
					<button class="btn btn-primary" type="submit"><?php echo $this->lang->line('core.sb_savechanges'); ?> </button>
				 </div>
			  </div>

	</div>
</form>
</div>
</div>
	</div>
</div>	

</div>
</div>
</div>
</div>
</div>
</div>
</div>
        </section>





