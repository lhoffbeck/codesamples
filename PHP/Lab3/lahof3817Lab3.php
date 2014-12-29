<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"
      lang="en">
    <head>
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
         * File: lahof3817Lab3.php
         ********************************************************************
         * File Description:
         *      This script displays all the songs from the file in a table.
         *
         * High Level Pseudocode:
         *
         *      The program includes the header, inc_functions.php file, and footer.
         *
         *      Get all the songs from the file as an array by calling the getSongsFromFile
         *      function in the inc_functions.php file
         *      If there were songs in the file:
         *          Display the songs
         *      
         ********************************************************************
        -->

        <meta http-equiv="Content-Type"
              content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="lahof3817Lab3.css"/>
        <title>Lahof3817's Lab 3</title>
    </head>
    <body>
        <?php
        //include the header file
        include('inc_header.php');

        //inc_functions.php contains functions used by the script.
        require('inc_functions.php');
        ?>

        <h2>My Song List</h2>

        <?php
        //Get all the songs from the file as an array by calling the getSongsFromFile
        //function in inc_functions.php.
        $allSongs = getSongsFromFile();

        //If the file contained songs, display the songs.
        if (!empty($allSongs)) {

            //call the displaySongs function in the inc_functions.php file. displaySongs
            //formats and prints an array parameter with a caption, also as a parameter.
            displaySongs($allSongs, "Lars' Favorite Songs");
        }
        ?>

        <?php
        //include the footer.
        include("inc_lahof3817navigation.php");
        ?>
    </body>
</html>