<?php
mysql_connect($hostname,$username, $password);
mysql_select_db($dbname);

$result = mysql_query($query);
$posts_entry = array();

if($result)
{
  while($row = mysql_fetch_array($result))
  {
    array_push($posts_entry,(object) array('title' => $row['Title'], 'post_body' => $row["Page_Data"]));
  }
  $posts = array("posts" => $posts_entry);
}
?>


    <!-- startup routine -->
    <script type="text/javascript">
    
      $(document).ready(function(){

        var mustacheTemplate = '';

        // get the mustache template and apply it to the page
        $.get( './template.php', function(response) {
          mustacheTemplate = response; 
          document.body.innerHTML = Mustache.to_html(mustacheTemplate, <?php print json_encode($posts); ?>);
        });
      });
    </script>
