<div id="footer_phone">
  <p>Copyright <?php echo date('Y'); ?>, St. Louis District Water Control</p>
</div>
<a href="<?php echo url_for('/staff/index.php'); ?>" target="_blank"><img src="<?php echo url_for('/images/edit-72.png'); ?>" alt="" /></a>
<p>NOTICE -- All data contained herein is preliminary in nature and therefore subject to change. The data is for general information purposes ONLY and SHALL NOT be used in technical applications such as, but not limited to, studies or designs. All critical data should be obtained from and verified by the United States Army Corps of Engineers. The United States Government assumes no liability for the completeness or accuracy of the data contained herein and any use of such data inconsistent with this disclaimer shall be solely at the risk of the user.</p>

<p>External Link Disclaimer -- Solely for ease of reference to related data, this site contains hyperlinks to a number of external web sites and/or information created and maintained by other public or private entities. The US Army Corps of Engineers neither controls nor guarantees the accuracy, relevance, timeliness, or completeness of any external sites or information, and the agency expressly reserves sole discretion to establish or remove external links from the server at any time. Further, the inclusion of links to particular external sites is not intended to reflect their importance or to endorse any views expressed, products or services offered on those sites, or the organizations sponsoring the sites.</p>

<h2>How to Use Phone Book</h2>
<a href="<?php echo url_for('/how_to_use.php'); ?>" target="_blank"><img src="<?php echo url_for('/images/how_to_icon.png'); ?>" width="100" height="100" alt="" /></a>


<?php
  db_disconnect($db);
?>

