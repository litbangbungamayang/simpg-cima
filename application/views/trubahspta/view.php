<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('trubahspta') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>
        <?php
        	$arstatus = array("1"=>"Ya","0"=>"Tidak");
        	$arstatustx = array("1"=>"Buat","2"=>"Validasi");
        	$armetode = array("1"=>"Manual","2"=>"Semi Mekanisasi", "3"=>"Mekanisasi");
        ?>

<?php echo $this->session->flashdata('message');?>
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">	
				<div class="table-responsive">
					<table class="table table-striped table-bordered" >
						<tbody>	
					
					<tr>
						<td width='20%' class='label-view text-right'>No BA</td>
						<td width='20%' ><?php echo $row['no_ba'] ;?> </td>
						<td width='30%' class='label-view text-right'>No SPTA</td>
						<td><?php echo $row['no_spta'] ;?> </td>
					</tr>
				
					<tr>
						
						
					</tr>
				
					<tr>
						<td width='20%' class='label-view text-right'>Tebang PG</td>
						<td width='20%'><?php echo $arstatus[$row['tebang_pg']] ;?> </td>
						<td width='30%' class='label-view text-right'>Rubah Tebang PG</td>
						<td><b><?php echo $arstatus[$row['rubah_tebang_pg']] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='20%' class='label-view text-right'>Angkut PG</td>
						<td width='20%'><?php echo $arstatus[$row['angkut_pg']] ;?> </td>
						<td width='30%' class='label-view text-right'>Rubah Angkut PG</td>
						<td><b><?php echo $arstatus[$row['tubah_angkut_pg']] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='20%' class='label-view text-right'>Vendor</td>
						<td width='20%'><?php echo SiteHelpers::gridDisplayView($row['vendor'],'vendor','1:m_vendor:id_vendor:nama_vendor') ;?> </td>
						<td width='30%' class='label-view text-right'>Rubah Vendor</td>
						<td><b><?php echo SiteHelpers::gridDisplayView($row['rubah_vendor'],'vendor','1:m_vendor:id_vendor:nama_vendor') ;?> </td>
						
					</tr>

					<tr>
						<td width='20%' class='label-view text-right'>Jarak / Zona</td>
						<td width='20%'><?php echo SiteHelpers::gridDisplayView($row['jarak_id'],'jarak','1:m_biaya_jarak:id_jarak:keterangan') ;?> </td>
						<td width='30%' class='label-view text-right'>Rubah Jarak / Zona</td>
						<td><b><?php echo SiteHelpers::gridDisplayView($row['rubah_jarak_id'],'jarak','1:m_biaya_jarak:id_jarak:keterangan') ;?> </td>
						
					</tr>
					<tr>
						<td width='20%' class='label-view text-right'>PTA</td>
						<td width='20%'><?php echo SiteHelpers::gridDisplayView($row['persno_pta'],'PTA','1:sap_m_karyawan:Persno:name') ;?> </td>
						<td width='30%' class='label-view text-right'>Rubah PTA</td>
						<td><b><?php echo SiteHelpers::gridDisplayView($row['rubah_perno_pta'],'PTA','1:sap_m_karyawan:Persno:name') ;?> </td>
						
					</tr>
					<tr>
						<td width='20%' class='label-view text-right'>Jenis SPTA</td>
						<td width='20%'><?php echo $row['jenis_spta'] ;?> </td>
						<td width='30%' class='label-view text-right'>Rubah Jenis SPTA</td>
						<td><b><?php echo $row['rubah_jenis_spta'] ;?> </td>
						
					</tr>
					<tr>
						<td width='20%' class='label-view text-right'>Metode TMA</td>
						<td width='20%'><?php echo $armetode[$row['metode_tma']] ;?> </td>
						<td width='30%' class='label-view text-right'>Rubah Metode TMA</td>
						<td><b><?php echo $armetode[$row['rubah_metode_tma']] ;?> </td>
						
					</tr>
				
					
				
					<tr>
						<td width='20%' class='label-view text-right'>Status</td>
						<td width='20%'><?php echo $arstatustx[$row['status']] ;?> </td>
						<td width='30%' class='label-view text-right'>Alasan</td>
						<td><b><?php echo $row['alasan'] ;?> </td>
					</tr>
				
					
					<tr>
						<td width='20%' class='label-view text-right'>User Create</td>
						<td width='20%'><?php echo $row['user_create'] ;?> </td>
						
						<td width='30%' class='label-view text-right'>User Approve</td>
						<td><b><?php echo $row['user_approve'] ;?> </td>
						
					</tr>
				
					<tr>
					<td width='30%' class='label-view text-right'>Tgl Create</td>
						<td><?php echo $row['tgl_create'] ;?> </td>
						<td width='20%' class='label-view text-right'>Tgl Approve</td>
						<td width='20%'><b><?php echo $row['tgl_approve'] ;?> </td>
					</tr>
				
					
				
						</tbody>	
					</table>    
				</div>
				<center>
				<a href="<?php echo site_url('trubahspta');?>" class="btn btn-sm btn-warning"> << Back </a>
				<?php if($row['status'] == 1 && $this->session->userdata('gid') == 11){
					?>
					<a href="javascript:getsetujui()" class="btn btn-sm btn-danger"> Setujui Perubahan </a>
					<?php
				}
				?>
				
				</center>
			</div>
		</div>		
	

	</div>
</div>
</section>
<script type="text/javascript">
	
	function getsetujui(){
		if(confirm("Apakah anda menyetujui perubahan ini ? ")){
			window.location = "<?php echo site_url('trubahspta/setujui').'/'.$row['id'];?>";
		}
	}
</script>
	  