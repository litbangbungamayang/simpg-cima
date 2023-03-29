<style type="text/css">
	@media print {
  .page-break {page-break-after: always;}
  table, tr, td {
  	font-size:12px;
  }
}
</style>
 <section class="content">
          <div class="row">
            <div class="col-xs-12">	
				
					   <?php
					   	$this->data['do'] = $row;
					   	echo $this->load->view('tdo/cetakkwt', $this->data ,true);
					   	echo "<hr />";
					   	echo $this->load->view('tdo/cetaklampiran', $this->data ,true);	
					   ?>
					   
				
					   <?php
					   	$this->data['do'] = $row;
					   	if($row->is_natura == 1){
					   		echo '<br />';
					   		echo $this->load->view('tdo/cetak10', $this->data ,true);	
					   }
					   ?>
				</div>
				
			</div>	
	
</section>
	  
