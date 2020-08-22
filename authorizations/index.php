 <?php include 'inc/header.php'; ?>
<?php include_once "../Classes/Auth.php"; ?>

<?php 
  /*if (isset($_GET['ref']) !empty($_GET['ref'])) {
    $ref = $_GET['ref'];
  }*/
?>

<?php 
  $auth = new Authorization();
  $date = date('Y-m-d');
  $ip = $_SERVER['REMOTE_ADDR'];
?>
<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $authoriz = $auth->insertReferenceData($_POST, $date, $ip);
  }
?>

<?php 
  // $getdata = $auth->getReferenceData($ref);
  // if ($getdata) {
  //   $rowdata = $getdata->fetch_assoc();
  //   $rid = $rowdata['id'];
  // }
?>
<section id="content" style="height: 449px;">
  <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
          <?php if(isset($authoriz)){echo $authoriz;} ?>
          <h1>Reference No</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="box-shadow: 0px 0px 20px 2px #dad4d4;padding: 20px;">
          <form method="post" accept="">
            <div class="form-group">           
               <label>Reference No</label>
               <input type="text" name="ref_no" class="form-control" placeholder="Insert Reference No.">
            </div>
            <div class="form-group">
               <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</section>
<?php include 'inc/footer.php'; ?>