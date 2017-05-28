<?php
/* Displays user information and some useful messages */
require 'db.php';
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $uid = $_SESSION['uid'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Register Device - Minnie Dashboard</title>
  <?php include 'css/css.html'; ?>
    <style>
        label {position: relative; line-height: 1.8; margin-bottom: 5px; font-size: 1em;}
        input[type=text],select {margin:0 0 5px 0 !important; color: #000 !important; font-size: 1em !important; font-weight: bold;}
        input[type=text] {background: #fff !important;}
    </style>
</head>

<body>
<div class="midrow row">
<div class="vcenter columns large-6 large-centered"><div class="vcent_p"><div class="vcent_c">

<form name="regdevice" action="regdevice.php" method="post">
    <div class="form">
  <div class="row">
      <div class="row">
          <div class="small-12 large-12 columns text-center">
              <nav aria-label="You are here:" role="navigation">
                  <ul class="breadcrumbs">
                      <li><a href="profile.php">Home</a></li>
                      <li><a href="register_module.php">Register Modules</a></li>
                      <li>
                          <span class="show-for-sr">Current: </span> Add Devices
                      </li>
                  </ul>
              </nav>
          </div>
      </div>
      
  <div class="row">
    <div class="small-12 large-12 columns text-center">
      <h1>Register Device</h1><br/>
    </div>
  </div>
  <div class="row">
    <div class="small-12 large-5 columns">
      <label for="mapid" class="large-text-right">Module ID:</label>
    </div>
    <div class="small-12 large-7 columns">
      <!--input type="text" id="mapid" name="mapid" placeholder="your module's AP name" value="ESP" disabled-->
        <select class="linput_edit" id="mapid" name="mapid" style="height: auto;">
            <option>Select Your Module</option>
            <?php
                $result_modules = $mysqli->query("SELECT * FROM minmodules WHERE minumid='$uid'") or die($mysqli->error());
                $total_pins = 0;
                $mname = "";

                if ( $result_modules->num_rows > 0 ) {
                    while($row_modules = $result_modules->fetch_assoc()) {
                        $mapid = $row_modules["mapid"];
                        $mname = $row_modules["mname"];
            ?>
            <option value="<?php echo $mapid; ?>"><?php echo $mname; ?></option>
            <?php
                    }
                }
            ?>
        </select>
        <input type="hidden" id="modname" name="modname" value="" />
    </div>
  </div>
  <div class="row">
    <div class="small-12 large-5 columns">
      <label for="dname" class="large-text-right">Device Name:</label>
    </div>
    <div class="small-12 large-7 columns">
      <input type="text" class="linput_edit" id="dname" name="dname" placeholder="this will be used for voice command" required>
    </div>
  </div>
  <div class="row">
    <div class="small-12 large-5 columns">
      <label for="dpin" class="large-text-right">Pin Number:</label>
    </div>
    <div class="small-12 large-7 columns">
      <input type="text" class="linput_edit" id="dpin" name="dpin" placeholder="your module's free pin number" disabled>
        <input type="hidden" id="dpinh" name="dpinh" />
    </div>
  </div>
  <div class="row">
    <div class="small-12 large-5 columns">
      <label for="dtype" class="large-text-right">Type:</label>
    </div>
    <div class="small-12 large-7 columns">
      <select class="linput_edit" name="dtype" style="height: auto;">
    <option value="digital">Digital</option>
    <option value="analog">Analog</option>
  </select>
    </div>
  </div>
  <div class="row">
    <div class="small-12 large-5 columns">
      <label for="dstatus" class="large-text-right">Status:</label>
    </div>
    <div class="small-12 large-7 columns">
      <select class="linput_edit" name="dstatus" style="height: auto;">
    <option value="off">On/Off</option>
  </select>
    </div>
  </div>
  <div class="row">
    <div class="small-12 large-12 columns">
        <button type="submit" class="button button-block" id="register" name="register" />REGISTER</button>
	   <!-- input type="submit" class="button float-center large-6" value="CREATE MODULE" -->
    </div>
  </div>

  </div>
</div>
</form>
</div></div></div></div>
    
    
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/foundation/6.0.1/js/vendor/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/foundation/6.0.1/js/foundation.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src='js/pre.js'></script>
<script src='js/device.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/js/plugins/foundation.accordion.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/js/plugins/foundation.util.keyboard.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/js/plugins/foundation.util.motion.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
