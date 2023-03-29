<section class="content-header">
          <h1>
            <b><?php echo $pageTitle ;?></b>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tperiodegiling') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
              	<?php echo $this->session->flashdata('message');?>	
				<div class="table-responsive">
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
				</div>
				<div class="col-md-12">
				<a href="<?php echo site_url('tperiodegiling');?>" class="btn btn-sm btn-warning"> << Back </a>&nbsp;
				<?
				if($row['status'] == 0){
					?>
						<a href="javascript:prosesawaldo()" class="btn btn-sm btn-danger pull-right"><i class="fa fa-cogs"></i> Proses DO </a>
					<?
				}
				?>
				</div>
			</div>
		</div>		
	

	</div>
</div>
</section>
<script type="text/javascript">
	function prosesawaldo(){
		if(confirm("Apakah anda yakin untuk proses data DO periode ini dari awal ?")){
			window.location = "<?php echo site_url('tperiodegiling/prosesdo').'/'.$id;?>";
		}
	}
</script>