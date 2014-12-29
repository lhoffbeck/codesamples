<!-- This .php file prints copyright information for WMU as well as the
current date and time, as per the specification.

The php block does the following:  
    ~sets the current timezone to be the local timezone of the school
    ~prints the current date and copyright information within a HTML paragraph tag.
-->

<?php
//set the default timezone to be the local timezone of the school.
date_default_timezone_set("America/detroit");
print("<p class=\"foot\">");//begin a html paragraph
//print the current date
print(date("m/d/y @ H:i:s", time()) . " HRS.<br/>");
//print copyright information.
print("&#169 Western Michigan University</p>");
?>
