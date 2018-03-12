<?php 
$connect = mysqli_connect("localhost", "root", "Wcfajmeojnapa1", "db_etiendahan");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM tbl_products 
  WHERE stock < '$search' AND banned = 0 ORDER BY stock desc";
}
else
{
 $query = "
  SELECT * FROM tbl_products WHERE banned = 2
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th style="width: 15%">Product ID</th>
     <th>Description</th>
     <th style="width: 15%">Quantity</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["id"].'</td>
    <td>'.$row["description"].'</td>
    <td>'.$row["stock"].'</td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}
?>