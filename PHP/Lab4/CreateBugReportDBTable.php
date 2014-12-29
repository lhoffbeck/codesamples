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
* File: CreateBugReportDBTable.php
********************************************************************
* File Description:
*   This script creates the bug report database and table if they don't
*   exist.
********************************************************************
-->  


<?php
//require that the utility functions be loaded
require("inc_utilities.php");
?>

<?php

//stores the result of the query. Initialized outside the if/else block for usability.
$queryResult = null;

//stores the database connection link variable.
$dbConnect = mysql_connect("localhost", "root", "root");


//If not able to connect to mysql, print an error message to that effect.
//Else, create the database if not exists.
if ($dbConnect === FALSE) {
    print_error("Error connecting to mysql:" . mysql_error($dbConnect));
} else {

    //----------------Create the Database----------------------------
    //###############################################################
    //The name of the database to be created for this project.
    $dbName = "LAB_4";

    //the sql query to check if the database exists.
    $query_checkIfDBExists = "SHOW DATABASES LIKE '$dbName'";

    //queryResult contains the return value from the query.
    $queryResult = mysql_query($query_checkIfDBExists, $dbConnect);

    //if the query ran successully and the database doesn't exist 
    //(no rows were returned), create the database and select it.
    if ($queryResult != FALSE && mysql_num_rows($queryResult) == 0) {
        //TODO
        $query_createDB = "CREATE DATABASE $dbName";

        //create DB and verify it was created. print error message if not and die.
        if (!mysql_query($query_createDB, $dbConnect)) {
            print_error("Error creating the $dbName database: " . mysql_error($dbConnect));
            die();
        }

        //select DB and verify it was selected. print error if not and die.
        if (mysql_select_db($dbName, $dbConnect) == FALSE) {
            print_error("ERROR: could not select the $dbName database: " . msql_error($dbConnect));
            die();
        }

        //Else the database creation was successful, so print a message.
        print_success("SUCCESS: The $dbName database was successfully created.");
    } elseif ($queryResult != FALSE) {
        print_info("The database $dbName already exists.");

        //select DB and verify it was selected. print error if not and die.
        if (mysql_select_db($dbName, $dbConnect) == FALSE) {
            print_error("ERROR: could not select the $dbName database: " . msql_error($dbConnect));
            die();
        }
    } else {
        print_error("ERROR: unable to perform SHOW DATABASE query: " . msql_error($dbConnect));
        die();
    }
}

//------------END Create the Database----------------------------
//###############################################################


//----------------Create the Table----------------------------
//###############################################################
//
//the name of the table used in Lab 4. 
$tableName = "BUG_REPORTS";

//SQL to check if the table exists.
$query_checkIfTableExists = "SHOW TABLES LIKE '$tableName'";

//contains the result from the query.
$queryResult = mysql_query($query_checkIfTableExists);

//if the query ran successully and the table doesn't exist 
//(no rows were returned), and a null value wasn't returned, create the table.
if (($queryResult != FALSE && mysql_num_rows($queryResult) == 0) || $queryResult == NULL) {

    //this variable contains the create table SQL statement.
    $query_createTable = "CREATE TABLE $tableName 
                        (ReportID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        PRODUCT_NAME VARCHAR(80), VERSION VARCHAR(10),
                        HARDWARE_TYPE VARCHAR(20), OPERATING_SYS VARCHAR(20),
                        FREQUENCY VARCHAR(40), PROPOSED_SOLUTIONS LONGTEXT)";

    //create table and verify it was created. print error message if not and die.
    if (!mysql_query($query_createTable, $dbConnect)) {
        print_error("Error creating the $tableName table: " . mysql_error($dbConnect));
        die();
    }

    //Else the table creation was successful, so print a message.
    print_success("SUCCESS: The $tableName table was successfully created.");
} elseif ($queryResult != FALSE) {
    print_info("The table $tableName already exists.");
} else {
    print_error("ERROR: unable to perform SHOW TABLES query: " . msql_error($dbConnect));
    die();
}
?>
