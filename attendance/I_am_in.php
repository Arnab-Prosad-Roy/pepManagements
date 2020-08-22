  <?php include 'inc/header.php' ?>
  <?php 
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
      $attendence = $atten->markAttendence($_POST, $userId, $serverIP, $date, $day, $time, $month);
    }
?>


<div class="col-md-5" style="margin-top:20px;">
<?php 
if (isset($attendence)) {
  echo $attendence;
}
?>
<form action="" method="post" style="padding:2px">
                                   
<label for="sel1">Reason for being Late:</label>
    <select class="form-control" name="late_reason">
      <option>---</option>
                                           
        <option value="Traffic" >Traffic</option> 
        <option value="Sickness" >Sickness</option> 
        <option value="Net Problem" >Net Problem</option>
        <option value="Errand">Errand</option>
        <option value="Emargency Personal Issue" >Emargency Personal Issue</option>
        <option value="Festival">Festival</option>
        <option value="Study">Study</option>                                     
      </select>
       <br/>

    <label for="sel1">In Case of Net Problem Original Time:</label>
    <input type="time" name="original_time" class="form-control"><br/>

     <label for="sel1">In Case of Errand:</label><br/>
     <label for="sel1">Errand to:</label> 
     <input type="text" name="errand_place_in" class="form-control">

      <label for="sel1">For</label> <br/>
     <input type="text" name="errand_for_in" class="form-control" placeholder="ex :- HR /CEO/ R&D/ Account & Finance"/>

<!--        <label class="radio-inline"><input type="radio" name="errand_for_in"    value="HR">HR</label>
       <label class="radio-inline"><input type="radio" name="errand_for_in"    value="CEO">CEO</label>
        <label class="radio-inline"><input type="radio" name="errand_for_in"   value="R&D">R&D</label> 
        <label class="radio-inline"><input type="radio" name="errand_for_in"   value="Account & Finance">Account & Finance</label>          
 -->
     
       </select><br/>
    <label for="sel1">From</label>


     <input type="time" name="errand_from_in" class="form-control">
    </select>
    <label for="sel1">to</label>


     <input type="time" name="errand_to_in" class="form-control">
     <br/>

     <button type="submit" name="submit" class="btn btn-lg btn-primary">Done</button>
   
</form>
</div>
</div>
</div>
    <?php include 'inc/footer.php' ?>