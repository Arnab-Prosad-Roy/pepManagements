 <?php include 'inc/header.php' ?>

<?php
     //$intro = new Intro(); 
     $letter = new Letter();
     $db = new Database();    
?>

<?php
     if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
      
    if(empty($_POST["checkone"]) ) { 
     $noc = $letter->insertoverNoc($_POST, $date,$time,$serverIP,$userId);
     }elseif(empty($_POST["checktwo"])) { 
         $noc = $letter->insertNoc($_POST, $date,$time,$serverIP,$userId);
     }       
    }  
?>

<section id="content">
      <!-- Small boxes (Stat box) -->

    <div class="row">
    
      <div class="col-md-8" style="margin-left:223px;" >
<?php
    if (isset($noc)) {
        echo $noc;
      }

?>


  <div id="adminForm">
       
<div class="panel panel-default">
  <div class="panel-heading">Create NOC</div>
  <div class="panel-body">

  <form method="post" action="">
    
    
  
    <div class="form-group">
      <label><span style='color:red;'>*</span>Type of Authority</label>
      <select class="form-control" id="exampleSelect1"  name="typeof_loi">
        <option></option>
        <?php
            $typeof_loi = $letter->getTypeOfLoi();
            if ($typeof_loi) {
              while ($typeOfLoi = $typeof_loi->fetch_assoc()) { ?>
        <option value="<?php echo $typeOfLoi['id']; ?>"><?php echo $typeOfLoi['loi_types']; ?></option>
        <?php } } ?>
      </select>
    </div>
    <div class="form-group">
      <label><span style='color:red;'>*</span>Purpose of NOC</label>
      <select class="form-control" id="Role"  name="purposeof_loi" >
        <option></option>
        <?php
            $purposeof_loi = $letter->getPurposeOfLoi();
            if ($purposeof_loi) {
              while ($purposeOfLoi = $purposeof_loi->fetch_assoc()) { ?>
        <option value="<?php echo $purposeOfLoi['loi_purpose']; ?>"><?php echo $purposeOfLoi['loi_purpose']; ?></option>
        <?php } } ?>
      </select>
    </div>

     <div id="Others" class="SelectRole" style="margin-bottom: 10px;">
   <input type="text" name="others" class="form-control" placeholder="Type Your Purpose">
</div>

<div id="Accademic" class="SelectRole" style="margin-bottom: 10px;">
   <input type="text" name="ins_Name" class="form-control" placeholder="Type Institute Name">
</div>
<div id="Tender" class="SelectRole" style="margin-bottom: 10px;">
   <input type="text" name="ten_details" class="form-control" placeholder="Type Tender Details">
</div>


    
    <div class="form-group">
      <label>Passport Number</label>
      <input type="text" name="passport" class="form-control">
    </div>

       <div class="form-group">
      <label for="empolyee_name">Addressing Person Prefix</label>
      <select class="form-control" id="exampleSelect1"  name="prefix">
        <option></option>
        <?php
            $employee_name = $letter->getSalutationPrefix();
            if ($employee_name) {
              while ($employee_data = $employee_name->fetch_assoc()) { ?>
        <option value="<?php echo $employee_data['prefix']; ?>"><?php echo $employee_data['prefix']; ?></option>
        <?php } } ?>
      </select>
    </div>


    <div class="form-group">
      <label>Addressing Person Name</label>
      <input type="text" name="addressing_person" class="form-control">
    </div>
    
     <div class="form-group">
      <label for="empolyee_name">Addressing Person Suffix</label>
      <select class="form-control" id="exampleSelect1"  name="suffix">
        <option></option>
        <?php
            $employee_name = $letter->getSalutationSuffix();
            if ($employee_name) {
              while ($employee_data = $employee_name->fetch_assoc()) { ?>
        <option value="<?php echo $employee_data['suffix']; ?>"><?php echo $employee_data['suffix']; ?></option>
        <?php } } ?>
      </select>
    </div>
    <div class="form-group">
      <label><span style='color:red;'>*</span>Addressing Person Designation</label>
      <input type="text" name="addressing_desig" class="form-control">
    </div>
    <!--<div class="form-group">-->
    <!--  <label>Addressing Person Gender</label>-->
    <!--  <select class="form-control" style="width: 31%;" name="gen">-->
    <!--  <option value=""></option>-->
    <!--    <option value="Male">Male</option>-->
    <!--    <option value="Female">Female</option>-->
    <!--  </select>-->
    <!--</div>-->
    
      <div class="form-group">
      <label><span style='color:red;'>*</span>Organization Name</label>
      <input type="text" name="orgName" class="form-control">
    </div>

  
    
    
    <div class="form-group">
      <label>Note 1:</label>
      <textarea name="noteone" name="noteone" class="form-control"></textarea>
    </div>

    <div class="form-group">
      <label>Note 2:</label>
      <textarea name="notetwo" name="notetwo" class="form-control"></textarea>
    </div>
   


    <div class="panel panel-default" style="">
  <div class="panel-heading" style="text-align:center;">Insert Addressing Person Address</div>
  <div class="panel-body">
  <div class="row"> 
    <div class="col-md-6">  
    <div class="checkbox">
      <label><input type="checkbox" id="myCheck"  name="checkone" onclick="myFunction()">Bangladesh</label>
    </div>
  </div>

    <div class="col-md-6">
    <div class="checkbox">
      <label><input type="checkbox" id="myCheck2" name="checktwo" onclick="myFunction2()">Overseas</label>
    </div>
    </div>
  </div>

<div class="row" id="text" style="display: none;">
       <div class="col-md-6">
          <div class="form-group">
            <label>Flat No</label>
           <input type="text" name="flat" class="form-control">
          </div>
          <div class="form-group">
            <label>Suit</label>
           <input type="text" name="suit" class="form-control">
          </div>
          <div class="form-group">
            <label>Level No</label>
           <input type="text" name="level" class="form-control">
          </div>
          <div class="form-group">
            <label>Floor</label>
           <input type="text" name="floor" class="form-control">
          </div>
           <div class="form-group">
             <label>Holding No/Plot</label>
           <input type="text" name="holding" class="form-control">
           </div>
           <div class="form-group">
             <label>Building Name</label>
           <input type="text" name="building" class="form-control">
           </div>
           <div class="form-group">
             <label>Road Name</label>
           <input type="text" name="roadName" class="form-control">
           </div>
           <div class="form-group">
             <label>Road No</label>
           <input type="text" name="road" class="form-control">
           </div>
           <div class="form-group">
             <label>Block</label>
           <input type="text" name="block" class="form-control">
           </div>
          </div>
           <div class="col-md-6">
             <div class="form-group">
             <label>Sector</label>
           <input type="text" name="sector" class="form-control">
           </div>
           <div class="form-group">
             <label>Zone</label>
           <input type="text" name="zone" class="form-control">
           </div>
           <div class="form-group">
             <label>Section</label>
           <input type="text" name="section" class="form-control">
           </div>
             <div class="form-group">
               <label>Area Name</label>
             <input type="text" name="area" class="form-control">
          </div>
          <div class="form-group">
               <label>Village Name</label>
             <input type="text" name="village" class="form-control">
          </div>
         <div class="form-group">
    <label><span style='color:red;'>*</span>Division</label>
    <select id="division" class="division form-control" name="division">

    <?php

        $conn = mysqli_connect("localhost", "kealcom", "Cought#2{Red&Handed}@Salehn", "kealcom_recruitment");
      $divisions = mysqli_query($conn, "SELECT * FROM tbl_division ORDER BY divName ASC");

      if($divisions == ""){
        echo '<option>Select division</option>';
      }else{
        foreach($divisions as $res_div){
        echo "<option value=".$res_div['divId'].">".$res_div['divName']."</option>";
        }
      }
    ?>
    </select>
    </div>

    <div class="form-group">
     <label><span style='color:red;'>*</span>District : </label>
    <select id="district" class="form-control" name="district">
    <option>Select District</option>
    </select>
    </div>

    <div class="form-group">
    <label><span style='color:red;'>*</span>Thana</label>
    <select id="upazila" class="upazila form-control" name="thana">
    <option>Select Thana</option>
    </select>
    </div>

    <div class="form-group">
    <label><span style='color:red;'>*</span>Postoffice : </label>
    <select id="post" class="post form-control" name="postoffice">
    <option>Select Post</option>
    </select>
    </div>
           </div>
       
           </div>

           <div class="row" id="text2" style="display: none;">
       <div class="col-md-6">
          <div class="form-group">
            <label><span style='color:red;'>*</span>Zip Code</label>
           <input type="text" name="zipcode" class="form-control">
          </div>
         
         
       

         <div class="form-group">
      <label for="empolyee_name"><span style='color:red;'>*</span>Country Name</label>
      <select class="form-control" id="exampleSelect1"  name="country">
        <option></option>
        <?php
            $country_name = $letter->getCountryName();
            if ($country_name) {
              while ($country_data = $country_name->fetch_assoc()) { ?>
        <option value="<?php echo $country_data['id']; ?>"><?php echo $country_data['countryName']; ?></option>
        <?php } } ?>
      </select>
    </div>

    <div class="form-group">
      <label><span style='color:red;'>*</span>Address:</label>
      <textarea name="address"  class="form-control"></textarea>
    </div>
   
    </div>
    

    </div>

     <center>  <button type="submit" name="submit" class="btn btn-primary">Submit</button></center>
  </form>
    </div>
</div>
  </div>       
      </div>

</div>

      <!-- /.row -->

      
      <!-- Main row -->
      <div class="row">
        
            </div>
           
    
         

    </section>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script>
        $(function () {
            $('.SelectRole').hide();
            $('#Role').change(function () {
                $('.SelectRole').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>

    <script>

    $(document).ready(function(){
    $('#division').on('change',function(){
    var div_id = $(this).val();
    if(div_id){
    $.get(
    "districts",
    {division : div_id},
    function(data){
    $('#district').html(data);
    }
    );
    }else{
    $('#district').html('<option>Select Division First</option>');
    }
    });
    });

    $(document).ready(function(){
    $('#district').on('change',function(){
    var dis_id = $(this).val();
    if(dis_id){
    $.get(
    "upazilas",
    {district : dis_id},
    function(data){
    $('#upazila').html(data);
    }
    );
    }else{
    $('#upazila').html('<option>Select District First</option>');
    }
    });
    });

    $(document).ready(function(){
    $('#district').on('change',function(){
    var up_id = $(this).val();
    if(up_id){
    $.get(
    "postoffice",
    {upazila : up_id},
    function(data){
    $('#post').html(data);
    }
    );
    }else{
    $('#post').html('<option>Select Upazila First</option>');
    }
    });
    });

    </script>
      <script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>

<script>
function myFunction2() {
  var checkBox = document.getElementById("myCheck2");
  var text = document.getElementById("text2");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>

 <script>

    $(document).ready(function(){
    $('#pdivision').on('change',function(){
    var div_id = $(this).val();
    if(div_id){
    $.get(
    "pdistricts",
    {pdivision : div_id},
    function(data){
    $('#pdistrict').html(data);
    }
    );
    }else{
    $('#pdistrict').html('<option>Select Division First</option>');
    }
    });
    });

    $(document).ready(function(){
    $('#pdistrict').on('change',function(){
    var dis_id = $(this).val();
    if(dis_id){
    $.get(
    "pupazilas",
    {pdistrict : dis_id},
    function(data){
    $('#pupazila').html(data);
    }
    );
    }else{
    $('#pupazila').html('<option>Select District First</option>');
    }
    });
    });

    $(document).ready(function(){
    $('#pdistrict').on('change',function(){
    var up_id = $(this).val();
    if(up_id){
    $.get(
    "ppostoffice",
    {pupazila : up_id},
    function(data){
    $('#ppost').html(data);
    }
    );
    }else{
    $('#ppost').html('<option>Select Upazila First</option>');
    }
    });
    });

    </script>

<?php include 'inc/footer.php'; ?>