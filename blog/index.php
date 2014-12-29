<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Blug</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Raleway:200,400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=UnifrakturCook:700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" media="screen" href="http://openfontlibrary.org/face/hans-kendrick" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" media="screen" href="http://openfontlibrary.org/face/just-letters" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="./css/prism.css">

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="./js/mustache.js"></script>
	<script type="text/javascript" src="./js/prism.js"></script>

	<style type="text/css">
@font-face {
    font-family: "Aaargh";
    src: url(./fonts/Aaargh.ttf) format("truetype");
}

body{
 font-family: 'Open Sans', sans-serif;
}
	</style>

      <!-- helper functions -->
    <script type="text/javascript">
      function getUrlParameter(param){
        var url = window.location.search.substring(1);
        var urlVars = url.split('&');
        for(var i = 0; i < urlVars.length; i++){
          var parmSplit = urlVars[i].split('=');
          if(parmSplit[0] == param){return parmSplit[1]}
        }
      }
    </script>
</head>
<body>

  <?php

	$hostname="localhost";
	$username="lars";
	$password="lars_admin";
	$dbname="blog";
	$table="Blog_Post";
	$whereClause = "";
  	switch ($_GET['page']) {
  		case 'prog':
  			$whereClause = "where isprogramming = 1";
  			break;
  		case 'food':
  			$whereClause = "where isfood = 1";
  			break;
  		case 'travel':
  			$whereClause = "where istravel = 1";
  			break;
  		case 'other':
  			$whereClause = "where isother = 1";
  			break;
  		default:
  			$whereClause = "";
  			break;
  	}

  	$query = "SELECT * FROM $table $whereClause";

	require 'data.php';

  ?>
  
</body>
</html>