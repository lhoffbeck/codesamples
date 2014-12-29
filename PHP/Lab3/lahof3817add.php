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
         * File: lahof3817add.php
         ********************************************************************
         * File Description:
         *      This script is an all-in-one form. The form first displays a form
         *      that asks the user how many songs they wish to add. The user may add
         *      up to a total of 10 songs in his song list. If there are no songs in the file,
         *      the user is then showed a form that asks for the names of the songs that
         *      he wishes to enter. If there are songs in the file, the user is showed
         *      a form that asks for the names of the songs that he wished to enter
         *      as well as their position in the song list. The user is then displayed
         *      a success or error message on submission of that form.
         *
         *      Note: If the song file has 9 songs in it (i.e. the user may only enter
         *             1 song), the user is not asked how many songs he would like to 
         *             enter and displayed a form with a place to enter one song name.
         *            Also, if the file has no songs in it, the user is not asked 
         *             which position in the song list he would like to put the songs
         *             he is adding.
         *
         * High Level Pseudocode:
         *
         *      The program includes the header, inc_functions.php file, and footer.
         *
         *     Function: printAddSongs.
         *      Display a form that allows the user to add songs. This form will
         *      display as many form inputs for the user to enter song names as
         *      the user specified, as well as the position in the song list that
         *      the user wants to add the songs. If the file didn't contain any songs,
         *      the user will not be asked the position of insertion.
         *      
         *     Body of the Script:
         *      Get the songs from the file as an array by calling the inc_functions.php
         *       function getSongsFromFile.
         *
         *       If this is the initial pageload, display a form asking the user how many songs
         *       he would like to add. If there are 9 songs in the song list, display the 
         *       "add songs" form with one textbox for the user to enter a song title. If there
         *       are 10 songs in the song list, display a message to the user to that effect.
         *       Else, act as a form handler for the "how many songs" form.
         *
         *       Else if the user has filled out and submitted the form on the "add your tunes" page, 
         *       add them to the song list in the position the user specified, or if the position isn't
         *       specified, add the songs to the end of the song list.
         *       Note that this form handler is rather forgiving: if the user decides that
         *       he does not wish to add all the songs he requested to add, the handler 
         *       will only add the fields he filled out. If the user did not fill out any fields,
         *       the page will display an error.
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

        <h2>Add a Song</h2>


        <?php

        //If the user has already entered how many songs he wishes to add to
        //his FavTunes library, display a page for the user to enter the songs.
        function printAddSongs($numSongsToAdd, $numSongs) {
            ?>
            <form action="<?php $_SERVER["SCRIPT_NAME"] ?>" method="POST">
                <table>
                    <caption>Add your tunes</caption>
                    <?php
                    //print form fields in which the user can enter song names,
                    //as many as the user specified.
                    for ($i = 0; $i < $numSongsToAdd; $i++) {

                        //advanced escaping from xhtml
                        ?>
                        <tr>
                            <td>What is the name of the song?</td>
                            <td><input type="text" name="songName[]"/></td>
                        </tr>
                        <?php
                    }

                    //if there are no songs in the file, the songs must be added
                    //to the beginning of the song list.
                    if ($numSongs != 0) {
                        ?>

                        <tr>
                            <!-- Instruct the user to enter an integer of the index where he would like
                            the song(s) to appear, from 1 to the last index where all the songs he enters
                            can fit consecutively -->
                            <td>In which position in the song list would<br/> 
                                you like the song(s) to appear?<br/>
                                Please enter a numeric value from 1-<?php print($numSongs) ?> or<br/> 
                                leave blank to add them to the end of the list. </td>
                            <td><input type="text" name="position"/></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td><input type="reset" value="Reset"/></td>
                        <td><input type="submit" name="SubmitAdd" value="AddSongs"/></td>
                    </tr>
                </table>
            </form>
            <?php
        }
        ?>


        <!-- ENTRY POINT FOR THE SCRIPT -->
        <?php
        //suppress the "No tunes in your library!" message
        $suppressNoTunesMessage = TRUE;

        //allSongsFromFile - this will be an array that will contain the current song titles
        //in the tunes.txt file.
        $allSongsFromFile = getSongsFromFile($suppressNoTunesMessage);

        //The number of songs in the file.
        $numSongs = count($allSongsFromFile);


        //numCanAdd is the number of songs that the user can add, so that there
        //are no more than 10, as per the spec.
        $numCanAdd = 10 - $numSongs;


        //If this is the initial pageload, display a form asking the user how many songs
        //he would like to add. If there are 9 songs in the aplication, display the 
        //"add songs" form with one textbox for the user to enter a song title.
        if (!isset($_POST["SubmitAdd"])) {

            //If the user can only add one song, bypass the page that asks how many songs
            //the user would like to add and only let the user add one.
            if ($numSongs == 9) {
                printAddSongs(1, $numSongs);
            }

            //If the user cannot add any songs(i.e. there are already 10 songs in the song list),
            //display a message to that effect.
            else if ($numSongs == 10) {
                print("<p class=\"info\">There are currently 10 songs in your MyTunes song list,
                so you may not add any songs at this time.</p>");
            }

            //If initial page load or the user wanted to add too many songs (the total number
            //would be greater than 10), or the user entered a number less than 1,
            //display information and a form whereby the user
            //may enter the number of songs he wishes to add to his collection.
            else if (!isset($_POST["numTunesSubmit"]) || $_POST["numTunesToAdd"] > ($numCanAdd)
                    || $_POST["numTunesToAdd"] < 1 || (!isset($_POST["numTunesSubmit"]) && $numSongs < 9)
                    && $numSongs > 1) {

                //print informative paragraph that informs the user that s/he may
                //only have 10 songs in the app, how many they may add, and how
                //to add them.
                print("<p class=\"info\">");
                print("You may have a total of 10 songs in your FavTunes app. Currently,
                you have $numSongs songs in your app. <br/>Please enter a number of songs, "
                        . (10 - $numSongs) . " or less, to add to your FavTunes songs.");
                print("</p>");

                //if the user entered too many or too few songs, display an error message.
                if (isset($_POST["submit"]) && ($_POST["numTunesToAdd"] > ($numCanAdd) || $_POST["numTunesToAdd"] < 1)) {
                    print("<p class=\"error\">You must enter a numerical value between 1 and " . $numCanAdd);
                }

                //display the form that asks how many songs the user would like to add.
                ?>

                <form method="POST" action="<?php $_SERVER["SCRIPT_NAME"] ?>">
                    <table>
                        <caption>How many songs would you like to add?</caption>
                        <tr>
                            <td>Number of songs: <input type="text" class="smallTxbx" name="numTunesToAdd"/></td>
                            <td><input type="submit" name="numTunesSubmit" value="Submit!"/></td>
                        </tr>
                    </table>
                </form>

                <?php
            }
            //If the user filled out the "how many tunes to add" form, display the "Add your tunes" form.
            else {
                printAddSongs($_POST["numTunesToAdd"], $numSongs);
            }
        }

        //FORM HANDLER FOR THE "ADD YOUR TUNES" FORM
        //If the user has filled out and submitted the form on the "add your tunes" page, 
        //add them to the song list in the position the user specified, or if not
        //specified, add the songs to the end of the song list.
        //Note that this form handler is rather forgiving: if the user decides that
        //he does not wish to add all the songs he requested to add, the handler 
        //will only add the fields he filled out. If the user did not fill out any fields,
        //the page will display an error.
        else {

            //allSongs stores both the songs from the file and provided by the user.
            $allSongs = null;

            //songsFromUser is an array that stores the songs entered by the user on 
            //the "add your tunes" form.
            $songsFromUser = array_filter($_POST["songName"]);

            //If the user didn't enter any song names, print an error message.
            if (empty($songsFromUser)) {
                printResultsPageError("You must enter the name of at least one song.");
            } else {

                //Combine the songs from the user with the songs from the file at the 
                //position specified by the user. Else if the user entered bad data for the position, 
                //or tunes.txt has no songs, append the songs to the end of the array.
                if (isset($_POST["position"]) && preg_match("/\d/", $_POST["position"])) {
                    
                    //Splice the songs the user entered with the song list from 
                    //the file at the index specified by the user.
                    array_splice($allSongsFromFile, $_POST["position"] - 1, 0, $songsFromUser);
                    $allSongs = array_values(array_unique($allSongsFromFile));
                } else {
                    //If the song file currently has no songs in it, allSongs is just the songs
                    //that the user entered on the form. Else if the file had songs in it,
                    //merge the songs from the user with the songs from the file.
                    if (empty($allSongsFromFile)) {
                        $allSongs = array_values(array_unique($songsFromUser));
                    }
                    else {
                        $allSongs = array_values(array_unique(array_merge($allSongsFromFile, $songsFromUser)));
                    }
                }

                //write all songs out to the file
                writeSongListToFile($allSongs);
            }
        }
        include("inc_lahof3817navigation.php");
        ?>
    </body>
</html>


