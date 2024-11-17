<?php 
include("config.php");
include("firebaseRDB.php");
$timestamp = date("YmdHis");

$db = new firebaseRDB($databaseURL);
?>
<title>Players compare</title>
<link rel="stylesheet" type="text/css" href="style.css?v=<?php echo $timestamp;?>">
<div class="content">
   <div class='main'>
   <div class='card-content'>
   <a><span></span><span>Lionel Messi</span></a>
      <a><span>Season</span><span>Goals</span><span>Assists</span></a>
   <?php
   $data = $db->retrieve("data");
   $data = json_decode($data, 1);
   if(is_array($data)){
      foreach($data as $id => $item){
         if($item['Player'] === 'Messi') {
         echo "<a><span>{$item['Season']}</span><span>{$item['Liga_Goals']}</span><span>{$item['Liga_Asts']}</span></a>";
         }
   }
   }
   ?>
</div>
</div>

<div class='main'>
   <div class='card-content'>
      <a><span></span><span>Cristiano Ronaldo</span></a>
      <a><span>Season</span><span>Goals</span><span>Assists</span></a>
   <?php
   $data = $db->retrieve("data");
   $data = json_decode($data, 1);
   if(is_array($data)){
      foreach($data as $id => $item){
         if($item['Player'] === 'Ronaldo') {
         echo "<a><span>{$item['Season']}</span><span>{$item['Liga_Goals']}</span><span>{$item['Liga_Asts']}</span></a>";
         }
   }
   }
   ?>
</div>
</div>
</div>