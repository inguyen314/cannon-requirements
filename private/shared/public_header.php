<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Control - Phone List <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?><?php if(isset($preview) && $preview) { echo ' [PREVIEW]'; } ?></title>
    <meta name="Description" content="U.S. Army Corps of Engineers St. Louis District Home Page" />
    <link rel="stylesheet" href="../../../css/body.css" />
    <link rel="stylesheet" href="../../../css/breadcrumbs.css" />
    <link rel="stylesheet" href="../../../css/jumpMenu.css" />
    <script type="text/javascript" src="../../../js/main.js"></script>

    <!-- Additional CSS -->
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
    <style id="antiClickjack">
        body {
            display: none !important;
        }
    </style>
    <script type="text/javascript">
        if (self === top) {
            var antiClickjack = document.getElementById("antiClickjack");
            antiClickjack.parentNode.removeChild(antiClickjack);
        } else {
            top.location = self.location;
        }
    </script>

    <!-- Include Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Include the Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include the Moment.js adapter for Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>
</head>

<!--
<div id="header_phone">
  <a href="<?php //echo url_for('/index.php'); ?>">
    <img src="<?php //echo url_for('/images/gbi_logo.png'); ?>" alt="" />
  </a>
</div>
-->
