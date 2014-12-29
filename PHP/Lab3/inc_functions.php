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
            * File: functions.php
            ********************************************************************
            * Description:
            *   This file contains generic php functions that may be called by 
            *   other php scripts. 
            *
            * Functions:
            *   displaySongs - Displays an array parameter as a table of songs with 
            *                   a caption specified by a parameter.
            *
            *   getSongsFromFile - Retrieves all the songs in the file as an array.
            *                       Displays error messages, unless told not to by
            *                       the suppressMessage parameter.
            *
            *   writeSongListToFile - Writes an array of songs to the tunes.txt file.
            *
            *   printResultsPageSuccess - Prints a success message to the user if the songs 
            *                              were successfully added to the tunes.txt file.
            *   
            *   printResultsPageError - Prints an error message if there was any problem 
            *                            adding the songs to the tunes.txt file. 
            *
            ***************************************************************************
-->


<?php

//This function displays a list of songs passed in as the array $songs. The song
//list is displayed in table form with a caption specified by the $caption parameter.
function displaySongs($songs, $caption) {


    print("<table><caption>$caption</caption>");

//print all the songs in the song list, nicely formatted.
    foreach ($songs as $songIndex => $song) {
        print("<tr>");
        print("<td>" . ++$songIndex . ".</td>");
        print("<td>$song</td>");
        print("</tr>");
    }//end foreach
    print("</table>");
}

//This function retrieves all the songs that are located in the file and returns
//them as an array. If the file doesn't exist or contains no songs, messages
//are printed to that effect.
function getSongsFromFile($suppressMessage) {
    //file handle for the song library
    $fileName = "lab3/tunes.txt";

    //If the file exists, read the file to get the songs in the file 
    //and parse it into an array.
    if (file_exists($fileName)) {

        //if the file is nonempty, put the songs in the file
        //into an array and count the number of songs in the file.
        if (filesize($fileName) > 0) {

            /*
             * allSongs is an array that contains all the songs  
             * from the tunes.txt file.
             * file_get_contents open the file, reads the whole file into a string,
             * and closes the file, explode splits the song list read from the file into an array.
             */
            $allSongs = explode("|", file_get_contents($fileName));

            return $allSongs;
        }

        //If the file contains no tunes, display a message to that effect.
        else {
            //display the message unless the message is supposed to be supressed.
            if (!$suppressMessage) {
                print("<p class=\"info\">Oh snap! No tunes in your library!</p>");
            }
        }
    }

    //if the tunes.txt file does not exist, display a message to that effect.
    else {
        //display the message unless the message is supposed to be supressed.
        if (!$suppressMessage) {
            print("<p class=\"error\">Unable to read the backup file.</p>");
        }
    }

    //if there were no songs in the file or the file didn't exist, return null.
    return null;
}

//This function writes an array of songs to the tunes.txt file.
function writeSongListToFile($songList) {

    //file handle for the tunes.txt file
    $tunesHandle = "lab3/tunes.txt";

    //##########################Make a backup of the tunes.txt file
    //get the current microtime since the Unix epoch, as per the spec.
    $get_as_float = true;
    $time = microtime($get_as_float);

    //file handle for the backup file.
    $backupFile = "Backups/{$time}tunes.txt";

    //Copy tunes.txt to the backup file.
    copy($tunesHandle, $backupFile);
    //##############################################END make backup
    
    
    //remove all null or empty entries from the array, convert to a string with
    //the appropriate delimiters, and write it to the tunes.txt file.
    file_put_contents($tunesHandle, implode("|", array_filter($songList)));

    //display a success message 
    printResultsPageSuccess();
}

//This function prints a success message to the user if the songs were successfully
//added to the tunes.txt file
function printResultsPageSuccess() {
    print("<p class=\"success\">Your updated song list was succesfully written to the tunes.txt file.</p>");
}

//This function prints an error message if there was any problem adding the songs
//to the tunes.txt file. The function also prints a specified error message.
function printResultsPageError($errMess) {
    print("<p class=\"error\">An error occurred adding your songs to the tunes.txt file: $errMess</p>");
}
?>
