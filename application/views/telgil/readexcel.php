<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #eee;
    text-align: left;
    padding: 2px;
    font-size: 10px;
    white-space: nowrap;
}
.btn-cetak{
    position: fixed;
    width: 50px;
    height: 50px;
    border-radius: 50px;
    margin-top: -13px;
    right: 160px;
    top: 18px;
}
.btn-excel{
    position: fixed;
    width: 50px;
    height: 50px;
    border-radius: 50px;
    margin-top: -13px;
    right: 100px;
    top: 18px;
}


</style>
<table>
   <?php 
      $lenghtRow = count($read);
      $lenghtHeader = count($read[0][0]);
      $row = ""; 
      for ($j=1; $j < $lenghtRow; $j++) {
          $row .= "<tr>";
                for ($i=0; $i < $lenghtHeader; $i++) { 
                    $row .= "<td>".$read[$j][0][$i]."</td>";
                }
          $row .= "</tr>";
      }
      echo $row; 
    ?>
 </table>

 <?php //echo $lenghtRow; ?>
 <?php //echo $lenghtHeader; ?>
 <?php //print_r($read[0][0][0]); ?>
