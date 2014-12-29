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
        * Date completed: 	04/14/13
        *
        * File: UpdateBugREport.php
        ********************************************************************
        * File Description:
        *   This script provides a form whereby the user may update a bug report.
        *   Links to a generic form handler method also used by create report
        *   form page.
        ********************************************************************
        -->          
        
        <meta http-equiv="Content-Type"
              content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="lahof3817Lab4.css"/>
        <title>Update Bug Report</title>
    </head>
    <body>
        <?php
        require("inc_utilities.php");
        ?>

        <h2>Update Bug Report</h2>

        <?php
        //if initial pageload, initialize variables and display the update form.
        //if not initial pageload, act as a form handler.
        if (!isset($_POST['SubmitBugReport'])) {

            //the id of the report.
            $id = $_POST['ReportID'];

            //the name of the bug
            $name = $_POST['PRODUCT_NAME'];

            //the version number of the bug
            $version = $_POST['VERSION'];

            //the hardware type of the bug
            $hardware = $_POST['HARDWARE_TYPE'];

            //the operating system of the bug
            $os = $_POST['OPERATING_SYS'];

            //the frequenc of the bug
            $freq = $_POST['FREQUENCY'];

            //the proposed solution to the bug
            $solution = $_POST['PROPOSED_SOLUTIONS'];

            //display the form.
            displayForm(trim($id), trim($name), trim($version), trim($hardware), trim($os), trim($freq), trim($solution));
        } else {
            //call the form handler with 
            createUpdateFormHandler("update");
        }
        ?>

        <?php
        require("inc_pageNav.php");
        ?>
    </body>
</html>