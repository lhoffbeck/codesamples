<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"
      lang="en">
    <head>
       <!--
        ********************************************************************
        * Programmer: 	Lars Hoffbeck
        * Class ID: 	lahof3817
        * Lab 3:       Using Arrays
        * CIS 2800: 	Internet Programming
        * Instructor:	Dr. Miller
        * Spring 2013
        * Date completed: 	03/23/13
        *
        * File: lahof3817sortAsc.php
        ********************************************************************
        * File Description:
        *   This script sorts the song list in ascending order.
        *      
        * High Level Pseudocode:
        *   
        *   Include the header and footer.
        *        
        *   Get an array of all the songs in the file by calling getSongsFromFile
        *   If there are songs in the file:
        *       Sort the songs in ascending order
        *       Display the song list to the user
        *       Write the song list to the file.
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
        
        <h2>Sort Songs in Ascending Order</h2>

        <?php
        //don't suppress "No tunes in your library!" message
        $suppressNoTunesMessage = FALSE;

        //get all the songs from the file.
        $allSongs = getSongsFromFile($suppressNoTunesMessage);


        //if the song list is not empty, perform the ascending sort and write the
        //updated song list to the file.
        if (!empty($allSongs)) {
            //sort the allSongs array in ascending order
            sort($allSongs);

            //call the displaySongs function in the inc_functions.php file
            //to display the songs sorted in ascending order.
            displaySongs($allSongs, "Songs in ascending order.");

            writeSongListToFile($allSongs);
        }
        ?>

        <?php
        include("inc_lahof3817navigation.php");
        ?>
    </body>
</html>