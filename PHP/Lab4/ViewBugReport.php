<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <!--
        ********************************************************************
        * Programmer: 	Lars Hoffbeck
        * Class ID: 	lahof3817
        * Lab 4:        Using mysql
        * CIS 2800: 	Internet Programming
        * Instructor:	Dr. Miller
        * Spring 2013
        * Date completed: 04/14/13
        *
        * File: ViewBugReport.php
        ********************************************************************
        * File Description:
        *   This script queries the mysql database to display all the queries. 
        *   For each of the queries, the user may click an 'update' button
        *   and will be directed to a page where they may do so.
        ********************************************************************
        -->  
        
        <meta http-equiv="Content-Type"
              content="text/html; charset=iso-8859-1" />

        <link rel="stylesheet" type="text/css" href="lahof3817Lab4.css"/>

        <title>View Bug Reports</title>
    </head>
    <body>
        <?php
        require("inc_utilities.php");
        ?>

        <h2>View Bug Reports</h2>

        <?php
        //connect to the database.
        $dbConnect = mysql_connect("localhost", "root", "root");

        //If not able to connect to database, print a message to that effect.
        //Else, display all of the bug reports in the database.
        if ($dbConnect === FALSE) {
            print_error("Error connecting to the database:" . mysql_error($dbConnect));
        } else {
            //the database name
            $dbName = "LAB_4";

            //the table name
            $tableName = "BUG_REPORTS";

            //query to get the bug reports from the database.
            $query_getBugReports = "SELECT * from $dbName.$tableName";

            //execute the query.
            $queryResult = mysql_query($query_getBugReports, $dbConnect);

            //If the query didn't execute properly, print an error message.
            //Else if there are no bug reports, print a message to that effect.
            //Else if there are bug reports in the database and the query executed
            //successfully, display those suckers. 
            if ($queryResult == FALSE) {
                //print error message.
                print_error("ERROR: unable to select from $tableName: " . mysql_error());
            } else if (mysql_num_rows($queryResult) == 0) {
                //print "no bug reports" message
                print_info("There are currently no bug reports. Please use the link below to add a bug report.");
            } else {
                //The record variable contains a record from the database. 
                //While there are records in the database, print them out. 
                while (($record = mysql_fetch_row($queryResult)) !== FALSE) {
                    //display all the information from the query, and print out 
                    //the query info as a form with hidden fields of the query information
                    //so that the info may be passed to the form handler.
                    ?>
                    <form action="UpdateBugReport.php" method="POST">
                        <strong> Bug Report ID:</strong> <?php print($record[0]) ?>
                        <input type="hidden" name ="ReportID" value="<?php print($record[0]) ?>"/>
                        <br/>
                        <strong>Product Name:</strong> <?php print($record[1]) ?>
                        <input type="hidden" name="PRODUCT_NAME" value="<?php print($record[1]) ?>"/>
                        <br/>
                        <strong>Version:</strong> <?php print($record[2]) ?>
                        <input type="hidden" name="VERSION" value="<?php print($record[2]) ?>"/>
                        <br/>
                        <strong>Hardware Type:</strong> <?php print($record[3]) ?>
                        <input type="hidden" name="HARDWARE_TYPE" value="<?php print($record[3]) ?>"/>
                        <br/>
                        <strong>Operating System:</strong> <?php print($record[4]) ?>
                        <input type="hidden" name="OPERATING_SYS" value="<?php print($record[4]) ?>"/>
                        <br/>   
                        <strong>Frequency of Problem:</strong> <?php print($record[5]) ?>
                        <input type="hidden" name="FREQUENCY" value="<?php print($record[5]) ?>"/>
                        <br/><br/>   
                        <strong>Proposed Solution:</strong>
                        <br/>
                        <div class="halfPage">
                            <?php print($record[6]); ?>
                        </div>
                        <input type="hidden" name="PROPOSED_SOLUTIONS" value="<?php print($record[6]) ?>"/>

                        <br/>
                        <input type="submit" name="UpdateBugReport" value="Update this Report!"/>
                    </form>

                    <br/>
                    <br/>
                    <hr/>
                    <?php
                }
            }
        }
        ?>

        <?php
        //this displays the page navigation links.
        require("inc_pageNav.php");
        ?>

    </body>
</html>