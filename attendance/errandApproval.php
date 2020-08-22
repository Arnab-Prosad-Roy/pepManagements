  <?php include 'inc/header.php' ?>
<?php 
  include '../Classes/atteninsert.php';
?>
  <?php 
      $att = new attendenceInsert();
      $atten = new Attendence();
  ?>
<?php 
  $dateTime = date_default_timezone_set('Asia/Dhaka');
  $serverIP = $_SERVER["REMOTE_ADDR"];
  $timestamp = time();
  $date = date("Y-m-d");
  $day = date("(D)");
  $time = date("H:i:s",$timestamp);
  $month = date('M');
?>
   <div class="container">
<div class="row">
<div class="col-md-7">
<div class="">

  <div class="col-md-12"  style="border: 1px solid blue;
margin-top: 20px;
border-radius: 5px;">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Month</th>
      <th scope="col">Day</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $getInfo = $atten->getUseratten($userId);
  if ($getInfo) {
    $i = 0;
    while($data = $getInfo->fetch_assoc()){
      $i++;
  ?>
    <tr>
      <th scope="row"><?php echo $i;?></th>
      <td><?php echo $data['attendence_date'];?></td>
      <td><?php echo $data['month'];?></td>
      <td><?php echo $data['day'];?></td>
      <td><?php echo $data['attendence_time'];?></td>
    </tr>
   <?php } } ?>
  </tbody>
</table>
  </div>
</div>
</div>
<?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
      $attendence = $att->errandAttend($_POST, $userId, $serverIP, $date, $day, $time, $month);
      // $attendence = $atten->errandAttend($_POST, $userId, $serverIP, $date, $day, $time, $month);
    }
?>


<div class="col-md-5" style="margin-top:20px;">
<?php 
if (isset($attendence)) {
  echo $attendence;
}
?>
<form action="" method="post" style="padding:2px">


     <label for="sel1">In Case of Errand:</label><br/>
     <label for="sel1">Errand to:</label> 
     <input type="text" name="errand_place_in" class="form-control">

      <label for="sel1">For</label> <br/>
     <input type="text" name="errand_for_in" class="form-control" placeholder="ex :- HR /CEO/ R&D/ Account & Finance"/>
     
       </select><br/>
     <label for="sel1">From</label>
     <input type="time" name="errand_from_in" class="form-control">
    </select>
    <label for="sel1">to</label>
     <input type="time" name="errand_to_in" class="form-control">
     <br/>

     <button type="submit" name="submit" class="btn btn-lg btn-primary">Request For Errand Approval</button>
   
</form>
</div>
</div>
</div>
    <?php include 'inc/footer.php' ?>