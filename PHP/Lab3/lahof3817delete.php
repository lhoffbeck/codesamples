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
        * File: lahof3817delete.php
        ********************************************************************
        * File Description:
        *   This script provides a form whereby the user may delete any of the 
        *   songs in his song list. The user may delete multiple songs at a time.
        *      
        * High Level Pseudocode:
        *   
        *     The program includes the header, inc_functions.php file, and footer.
        *
        *     Function: displaySongsToDelete.
        *       Display a form that lists all the songs in the song list, as well
        *       as a checkbox next to each song for the user to select if the user
        *       wishes to delete that song.
        *
        *     Body of the Script: 
        *
        *       If initial pageload,
        *           Get the songs as an array by calling the getSongsFromFile in 
        *               the inc_functions.php script.
        *           Call the displaySongsToDelete function to display the songs.
        *       Else
        *           Delete the songs that the user selected for deletion and reindex.
        *           If there are no songs left in the song list:
        *               Display a message to that effect.
        *           Else
        *               Call the displaySongsToDelete function to display the songs.
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

        <h2>Delete a Song</h2>

        <!-- The following php block contains functions used by this page. -->
        <?php

        //This function displays the song list along with checkboxes that the user
        //may select if they wish to delete the song corresponding to that checkbox.
        //The function first displays a message instructing the user on the use of
        //the web form, and then displays the form.
        function displaySongsToDelete($allSongs) {

            //print informative paragraph that informs the user that s/he may
            //only have 10 songs in the app, how many they may add, and how
            //to add them.
            print("<p class=\"info\">To delete any song, check the <em>delete</em>
                    checkbox next to that song and click <em>Delete!</em></p>");
            ?>
            <form action="<?php $_SERVER["SCRIPT_NAME"] ?>" method="POST">
                <!--begin the table.-->
                <table>

                    <!--print the table header.-->
                    <th/>
                    <th>Song Name</th>
                    <th>Delete</th>

                    <?php
                    //print all the songs in the song list, nicely formatted.-->
                    foreach ($allSongs as $songIndex => $song) {
                        ?>

                        <!--table row: start-->
                        <tr>
                            <!--print song index number-->
                            <td><?php print(++$songIndex . ".") ?></td>

                            <!--print song name-->
                            <td><?php print $song ?></td>

                            <!-- print the delete checkbox -->
                            <td><input type="checkbox" name="deleteThis[<?php print $songIndex - 1 ?>]"/></td>

                            <!--table row: end-->
                        </tr>

                        <!-- Pass the array of songs along to the form handler so the
                        handler can determine which songs to remove.-->
                        <input type="hidden" name="allSongs[]" value="<?php print $song ?>"/>
                        <?php
                    }//end foreach
                    ?>
                    <!-- the Delete! submit button, with two empty, noBorder td elements
                    for formatting-->
                    <tr><td class="noBorder"/><td class="noBorder"/><td><input type="submit" name="deleteSubmit" value="Delete!"/></td></tr>
                </table>
            </form>

            <?php
        }
        ?>


        <!-- The following php block defines the page generated on initial pageload,
        as well as contains the form handler for this page's web form. -->
        <?php
        //If initial pageload, display a form that the user can use to delete
        //songs from the songs list. 
        if (!isset($_POST["deleteSubmit"])) {

            //don't suppress "No tunes in your library!" message
            $suppressNoTunesMessage = FALSE;

            /*
             * allSongsFromFile is an array that contains all the songs  
             * from the tunes.txt file.
             * 
             * getSongsFromFile gets the songs form the file as an array.
             */
            $allSongsFromFile = getSongsFromFile($suppressNoTunesMessage);

            //If the file contained songs, display a form that the user
            //can use to delete songs from the song list.
            if (!empty($allSongsFromFile)) {
                //display the songs that were read from the file and may be deleted.
                displaySongsToDelete($allSongsFromFile);
            }
        }
        
        //If this is not the initial pageload, delete the appropriate songs
        //and display the resulting song list.
        else {


            //allSongs is an array of all the songs. 
            $allSongs = $_POST['allSongs'];

            //The deleteThis array backs the deletion checkboxes by containing
            //the row number of the checkbox that was ticked. This row
            //number may be used to remove songs from the song list.
            foreach ($_POST["deleteThis"] as $index => $itemToDelete) {
                unset($allSongs[$index]);
            }

            //All the unsets screwed with the array indices, so call array_values
            //to reindex the array.
            $allSongs = array_values($allSongs);

            //If no songs left in the song list, display a message to that effect.
            //Else, redisplay the form so the user may delete more songs.
            if (count($allSongs) == 0) {
                print("<p class=\"info\">Oh snap! No tunes in your library!</p>");
            } else {
                //Redisplay the song list so that the user may continue to delete songs.
                displaySongsToDelete(array_values($allSongs));
            }

            //write all the songs to the tunes.txt file by calling the function
            //in functions.txt
            writeSongListToFile($allSongs);
        }

        include("inc_lahof3817navigation.php");
        ?>
    </body>
</html>