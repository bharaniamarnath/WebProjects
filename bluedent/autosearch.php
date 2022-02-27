<?php
include('connect.php');
if(isset($_GET['search_text'])){
$search_text = $_GET['search_text'];
if(!empty($search_text)){
$except = 'Dental Instruments';
$except2 = 'Oral Surgery';
$result = $pdo->prepare("SELECT pid,name,subcategory FROM products WHERE name LIKE '%$search_text%' AND category != '$except' AND category != '$except2'");
$result->execute();
if($result->rowCount() == 0){
echo "<li>No product found for keyword - ".$search_text."</li>";
}
foreach($result as $row){
$id = $row['pid'];
$name = $row['name'];
$subcat = $row['subcategory'];
echo "<li><a href='search.php?search_key=".$row['pid']."'><h5>".$name."<br /><small>".$subcat."</small></h5></a></li>";
}
}
}
?>