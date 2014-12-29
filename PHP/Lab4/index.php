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
        * File: index.php
        ********************************************************************
        * File Description:
        *   This script is the start page of the app, and creates the database
        *   and table if it doesn't exist.
        ********************************************************************
        -->  

        <meta http-equiv="Content-Type"
              content="text/html; charset=iso-8859-1" />

        <link rel="stylesheet" type="text/css" href="lahof3817Lab4.css"/>

        <title>Start Bug Report App</title>
    </head>
    <body>
        <?php
        require("CreateBugReportDBTable.php");

        print("<a href=\"ViewBugReport.php\">Go to the Bug Report App!</a>");
        ?>
    </body>
</html>