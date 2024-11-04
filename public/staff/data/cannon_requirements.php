<?php
require_once('../../../private/initialize.php');
require_login();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set("xdebug.var_display_max_children", '-1');
ini_set("xdebug.var_display_max_data", '-1');
ini_set("xdebug.var_display_max_depth", '-1');

date_default_timezone_set('America/Chicago');
if (date_default_timezone_get()) {
    //echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
}
if (ini_get('date.timezone')) {
    //echo 'date.timezone: ' . ini_get('date.timezone');
}
$date_mdY =  date('m/d/Y');
$datetime = date('m-d-Y H:i:s'); 
?>
<?php include(SHARED_PATH . '/INTERNAL.header.php'); ?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--APP START-->
<div class="box-usace">
	<h2 class="box-header-striped">
		<span class="titleLabel title">Cannon Requirements <?php echo $date_mdY; ?> [DISCONTINUED]</span>
		<span class="rss"></span>
	</h2>
</div>

<!--
<navigation>
    <ul>
        <li>user: <?php //echo $_SESSION['username'] ?? ''; ?></li>
        <li><a href="<?php //echo url_for('/staff/index.php'); ?>">Menu</a></li>
        <li><a href="<?php //echo url_for('/staff/logout.php'); ?>">Logout</a></li>
    </ul>
</navigation>
-->

<?php
// Read existing data from the JSON file
$jsonFile = 'form_data_cannon_requirements.json';
$existingData = file_get_contents($jsonFile);

// Check if the JSON decoding was successful
$existingArray = json_decode($existingData, true);
if ($existingArray === null) {
    $existingArray = [];
}
// Sort the array based on the 'datetime' field in descending order
usort($existingArray, function ($a, $b) {
return strtotime($a['datetime']) - strtotime($b['datetime']);
});

// Extract the last entry
$lastEntry = end($existingArray);
//print_r($lastEntry);
?>

<form action="process_form.php" method="post">
    <label for="name">SWPA’s Scheduled Generation: </label>
    <input type="text" name="swpa_scheduled_generation" id="swpa_scheduled_generation" required value="<?php echo $lastEntry['swpa_scheduled_generation']; ?>">
    <br><br>
    <label for="name">USACE Maximum: </label>
    <input type="text" name="usace_maximum" id="usace_maximum" required value="<?php echo $lastEntry['usace_maximum']; ?>">
    <br><br>
    <label for="name">USACE Minimum: </label>
    <input type="text" name="usace_minimum" id="usace_minimum" required value="<?php echo $lastEntry['usace_minimum']; ?>">
    <br><br>
    <label for="name">USACE Target: </label>
    <input type="text" name="usace_target" id="usace_target" required value="<?php echo $lastEntry['usace_target']; ?>">

        <!--
        <select name="usace_target" id="usace_target" required>
            <?php
            /*
            // Check if $lastEntry['usace_minimum'] is 'na'
            if ($lastEntry['usace_target'] == 'na') {
                echo '<option value="na" selected>n/a</option>';
                echo '<option value="firm">firm</option>';
                echo '<option value="0">0</option>';
            } else if ($lastEntry['usace_target'] == 'firm') {
                echo '<option value="na">n/a</option>';
                echo '<option value="firm" selected>firm</option>';
                echo '<option value="0">0</option>';
            } else if ($lastEntry['usace_target'] == '0') {
                echo '<option value="na">n/a</option>';
                echo '<option value="firm">firm</option>';
                echo '<option value="0" selected>0</option>';
            } else {
                echo '<option value="na">n/a</option>';
                echo '<option value="firm">firm</option>';
                echo '<option value="0">0</option>';
            }
            */
            ?>
        </select>
        -->
    <br><br>
    <label for="ismodified">Is Modified:</label>
        <select name="ismodified" id="ismodified" required>
            <option value="off">Off</option>
            <option value="on">On</option>
        </select>
    <br><br>
    <input type="submit" value="Submit">
</form>
<br>
<br>
<br>
<h2>How to Use Cannon Requirements</h2>
<img src='../../../../../images/icons/how_to_icon.png' width="100" height="100" alt="" />
<pre>
    1. Default (pre populated) values are from previous (yesterday) email sent
    2. Type in your input
    3. Select your target
    4. Select Is Modified "On" or "Off"
    5. Modified "Off" = first requirements email of the day
    6. Modified "On" = modified requirements which will append "[Updated]" to the email's title
    7. Click "Submit" will save today's requirements to a JSON file and send out email to SWPA
</pre>
<br>
<!--APP ENDS-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                            </div>
                        </div>
                    </div>
                </div>
                <button id="returnTop" title="Return to Top of Page">Top</button>
            </div>
        </div>
        <footer id="footer">
            <!--Footer content populated here by script tag at end of body -->
        </footer>
        <script src="../../../../../js/libraries/jQuery-3.3.6.min.js"></script>
        <script defer>
            // When the document has loaded pull in the page header and footer skins
            $(document).ready(function () {
                // Change the v= to a different number to force clearing the cached version on the client browser
                $('#header').load('../../../../../templates/INTERNAL.header.php?app=True');
				$('#sidebar').load('../../../../../templates/INTERNAL.sidebar.php?app=True');
                $('#footer').load('../../../../../templates/INTERNAL.footer.php?app=True');
            })
        </script>
    </body>
</html>
<?php db_disconnect($db); ?>

<script>alert("This Cannon Requirements verion was discontinued.");</script>