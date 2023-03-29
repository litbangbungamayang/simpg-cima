<style type="text/css">
	table.tableizer-table {
		border-collapse: collapse;
		font-size: 12px;
		border: 1px solid #CCC; 
		font-family: Arial, Helvetica, sans-serif;
		width: 100%;

	} 
	.tableizer-table td {
		padding: 4px;
		margin: 3px;
		border: 1px solid #CCC;
	}
	.tableizer-table th {
		background-color: #104E8B; 
		color: #FFF;
		font-weight: bold;
	}
</style>
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
<tbody>
<tr>

<td align="left"  style="font-size:11px" colspan="10" >
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" colspan="7" >
TEMPLATE BAGI HASIL<br />
<?=$title;?> 
</td>
</tr>
</table>
<table class="tableizer-table">
<thead>
			<tr>
			<th>ID SPTA</th>
			<th>ID ARI</th>
				<?php foreach ($tableGrid as $k => $t) : ?>
					<?php 
					//$i = 0;
					if($t['view'] =='1'): ?>
						<th><?php echo $t['label'] ?></th>
					<?php endif; ?>
				<?php endforeach; ?>
			  </tr>
        </thead>
<tbody>
<?php

foreach ($rows as $key) {
	$i = 0;
	echo '<tr>';
	echo '<td>'.$key->id.'</td>';
	echo '<td>'.$key->id_ari.'</td>';
	foreach ($tableGrid as $k => $t){
		$i++;
		$fld = $t['field'];
		if($i > 35){
			echo '<td bgcolor="yellow">'.$key->$fld.'</td>';
		}else{
			echo '<td >';
			if($key->$fld=='') echo '-';
			else echo $key->$fld;
			echo '</td>';
		}
	}
	
}
?>
 
 
</tbody></table>