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
        * File: lahof3817tops.php
        ********************************************************************
        * File Description:
        *   This script displays the top n songs to the user, where n is the
        *   number of songs the user wishes to see.
        *      
        * High Level Pseudocode:
        *   
        *   Include the header and footer.
        *
        *   Function: dispTopTunesForm.
        *       This function displays a form that gets the number of top tunes
        *       from the user.
        *        
        *   Get an array of all the songs in the file by calling getSongsFromFile
        *   If initial pageload:
        *       Display the top tunes form
        *   Else
        *       If the user entered an invalid number of tunes to display: 
        *           Display an error message to that effect
        *           Redisplay the form
        *       Else
        *           Display the top n tunes, where n is the number given by the user.
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
        
        <h2>Show Top Tunes</h2>

        <?php

        function dispTopTunesForm($numSongs) {
            ?>
            <p class="info">See your top tunes!<br/>Please enter a number from 1-<?php print($numSongs) ?>.</p>

            <div class="centered"/>
            <form action="<?php $_SERVER["SCRIPT_NAME"] ?>" method="POST">
                Show me my top <input type="text" class="smallTxbx" name="numTopTunes"/> tunes!
                <input type="submit" name="topSubmit" value="Go get 'em!"/>
            </form>
            </div>
            <?php
        }
        ?>

        <?php
        //don't suppress "No tunes in your library!" message
        $suppressNoTunesMessage = FALSE;
        
        //get all the songs from the file.
        $allSongs = getSongsFromFile($suppressNoTunesMessage);

        //$numSongs is the number of songs that exist in the file.
        $numSongs = count($allSongs);

        //numTopTunes is the number of top tunes the user specified.
        $numTopTunes = $_POST['numTopTunes'];

        //if there is only one song in the song list, display that one song.
        if($numSongs == 1){
            displaySongs($allSongs, "My Top Tune");
        }
        
        //If this is the initial pageload, display the "top tunes" form.
        elseif (!isset($_POST['topSubmit']) && !empty($allSongs)) {
            dispTopTunesForm($numSongs);
        } 
        //FORM HANDLING. If there are songs in the song list, 
        elseif (!empty($allSongs)) {
            //if the user did not valid numerical value, redisplay the "show me my 
            //top tunes" form with an error message.
            if (!preg_match("/\d/", $numTopTunes) || $numTopTunes > $numSongs) {
                //print an informative error message
                print("<p class=\"error\">Error: you must enter a number between 1 and $numSongs.<p>");

                //display the "show me my top tunes" form
                dispTopTunesForm($numSongs);
            }
            //If the user's entry for number of top tunes was valid, 
            //display the top tunes.
            else {
                //TopTunes is an array containing the number of top tunes specified 
                //by the user in the "show me my top tunes" form.
                $topTunes = array_slice($allSongs, 0, $numTopTunes);

                //displaySongs displays the topTunes array with the caption "My top 
                //<number of top tunes> tunes" by calling the displaySongs function
                //in inc_functions.php
                displaySongs($topTunes, "My top $numTopTunes tunes.");
            }
        }

        include("inc_lahof3817navigation.php");
        ?>
    </body>
</html>