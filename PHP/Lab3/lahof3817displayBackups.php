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
        * File: lahof3817displayBackups.php
        ********************************************************************
        * File Description:
        *   This script displays the backup files of the tunes.txt file. The 
        *   backup files are written whenever the file is read..
        *      
        * High Level Pseudocode:
        *   
        *   Include the header and footer.
        *        
        *   Get a list of all the backup files with scandir(./Backups)
        *   For each backup file, display
        *       The file name as a link to the file.
        *       The owner id of the file.
        *       The permissions on the file.
        *       The size of the file in bytes.
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
        include('inc_header.php');
        ?>

        <h2>Display Backups</h2>
        
        <?php
        //backupsDir is the handle for the backups directory
        $backupsDir = "./Backups/";

        //backups are the directory entries in the backupsDir
        $backups = scandir($backupsDir);
        ?>

        <table>
            <caption>Backups of the Tunes Files</caption>
            <tr>
                <th>File Name</th>
                <th>Owner ID</th>
                <th>Permissions</th>
                <th>Size</th>
            </tr>

            <?php
            //For each of the backups, display the filename as a link, the owner of the file,
            //the permissions on the file, and the size of the file.
            foreach ($backups as $backup) {
                $fileName = "$backupsDir$backup";
                if ($backup != "." && $backup != "..") {
                    ?>
                    <tr>
                        <!-- Display a link to the backup so that the user can view it if he so desires. -->
                        <td><a href="<?php print($fileName) ?>"><?php print($backup) ?></a></td>
                        <!-- Display the file owner id -->
                        <td><?php print(fileowner($fileName)) ?></td>
                        <!-- Display the file permissions -->
                        <td><?php $a = substr(sprintf("%o", fileperms($fileName)),-4); print($a);?></td>
                        <td><?php print(filesize($fileName) . "  bytes")?></td>
                    </tr>

                    <?php
                }//end if
            }//end foreach
            ?>

        </table>

        <?php
        include("inc_lahof3817navigation.php");
        ?>
    </body>
</html>