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
        * File: CreateBugReport.php
        ********************************************************************
        * File Description:
        *   This script provides a form whereby the user may create a bug report.
        ********************************************************************
        -->        
        
        <meta http-equiv="Content-Type"
              content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="lahof3817Lab4.css"/>
        <title>Enter Bug Report</title>
    </head>
    <body>
        <?php
            //inc_utilities is a file that contains utility functions.
            require("inc_utilities.php");
        ?>

        <h2>Create a Bug Report</h2>

        <?php

        //if initial pageload, initialize all sticky data variables. Else,
        //do form handling.
        if (!isset($_POST['SubmitBugReport'])) {
            //the product name
            $name = "";
            //the product version
            $version = "";
            //the hardware type
            $hardware = "";
            //the operating system
            $os = "";
            //the frequency of the bug
            $freq = "";
            //the proposed solution to the bug.
            $solution = "";
            
            //display form with empty value for id field.
            displayForm("",$name, $version, $hardware, $os, $freq, $solution);
            
        } else {
            //Call the form handler for the create form, with the create form as a parameter.
            createUpdateFormHandler("create");
        }
        ?>
        
        <?php
            //this creates the page navigation links at the bottom of the page.
            require("inc_pageNav.php");
        ?>

    </body>
</html>