<!--
    ********************************************************************
    * Programmer: 	Lars Hoffbeck
    * Class ID: 	lahof3817
    * Lab 3:            Using Arrays
    * CIS 2800: 	Internet Programming
    * Instructor:	Dr. Miller
    * Spring 2013
    * Date completed: 	03/23/13
    *
    * File: inc_classIDnavigation.php
    ********************************************************************
    * Description:
    *   This file prints page navigation buttons, and copyright information, 
    *   as well as the current date and time, as per the specification.
    *
    *   The file does the following:  
    *   ~sets the current timezone to be the local timezone
    *   ~prints the page navigation buttons, current date, and copyright 
    *     information within a HTML paragraph tag.
    ***************************************************************************
-->


<br/>
<br/>
<div class="foot">
    <div class="nav">
        <ul>
            <li><a href="lahof3817Lab3.php">Show Song List</a> </li>
            <li><a href="lahof3817add.php">Add a Song</a></li>
            <li><a href="lahof3817delete.php">Delete a Song</a></li>
            <li><a href="lahof3817sortAsc.php">Sort Songs Ascending</a></li>
            <li><a href="lahof3817sortDesc.php">Sort Songs Descending</a></li>
            <li><a href="lahof3817tops.php">Show Top Songs</a></li>
            <li><a href="lahof3817displayBackups.php">Display Backups</a></li>
        </ul>
    </div>

    <div class="copy">
        <?php
        //set the default timezone to be the local timezone of the school.
        date_default_timezone_set("America/detroit");
        print("<p>"); //begin a html paragraph
        //print the current date
        print(date("m/d/y @ H:i:s", time()) . " HRS.<br/>");
        //print copyright information.
        print("&copy Lars Hoffbeck</p>");
        ?>
    </div>
</div>


