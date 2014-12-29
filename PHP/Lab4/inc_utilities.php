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
* File: inf_utilities.php
********************************************************************
* File Description:
*   This script provides php functions to be used by other php pages.
*   The purpose of externalizing code like this is reusability of code.
********************************************************************
-->  

<?php

//prints an error message passed from the user.
function print_error($message) {
    print("<p class=\"error\">$message</p>");
}

//prints a success message passed from the user.
function print_success($message) {
    print("<p class=\"success\">$message</p>");
}

//prints an informative message passed from the user.
function print_info($message) {
    print("<p class=\"info\">$message</p>");
}

//Displays the form used for creating and updating a bug report.
function displayForm($id, $name, $version, $hardware, $os, $freq, $solution) {
    //variable that stores the name of the current page.
    $thisPage = $_SERVER["SCRIPT_NAME"];
    ?>
    <form action="<?php print($thisPage) ?>" method="POST">
        <input type="hidden" name="ReportID" value="<?php print($id) ?>"/>

        <table>
            <tr>
                <td>Product Name:</td>
                <td><input type="text" value="<?php print($name) ?>" name="BugReport[PRODUCT_NAME]"/></td>
            </tr>
            <tr>
                <td>Version:</td>
                <td><input type="text" value="<?php print($version) ?>" name="BugReport[VERSION]"/></td>
            </tr>
            <tr>
                <td>Hardware Type:</td>
                <td><input type="text" value="<?php print($hardware) ?>" name="BugReport[HARDWARE_TYPE]"/></td>
            </tr>
            <tr>
                <td>Operating System:</td>
                <td><input type="text" value="<?php print($os) ?>" name="BugReport[OPERATING_SYS]"/></td>
            </tr>
            <tr>
                <td>Frequency of Problem:</td>
                <td><input type="text" value="<?php print($freq) ?>" name="BugReport[FREQUENCY]"/></td>
            </tr>

        </table>
        <br/>
        <strong>Proposed Solution:</strong>
        <br/>
        <textarea name="BugReport[PROPOSED_SOLUTIONS]" rows="10" cols="75"><?php print($solution) ?></textarea>

        <br/>
        <input type="submit" name="SubmitBugReport" value="Submit Bug Report"/>
    </form>

    <?php
}

//this function is used to validate that a user entry is valid, according the spec.
//If the entry is null or is too long, print an error message to that effect and 
//return an empty string. Else, return the value that the user entered.
function validateEntry($fieldName, $fieldValue, $length) {
    
    //get instance of the numErrs variable
    global $numErrs;

    //If the field is not filled out, print an error message and increase the
    //error counter. If the user entered too many characters, print an error
    //message and increment the error counter. Else, the user entry is valid.
    if (empty($fieldValue)) {
        
        //print error message
        print_error("You must properly fill out the \"$fieldName\" field.");
       
        //increment error counter
        $numErrs++;
        
    } else if (strlen($fieldValue) >= $length) {
        
        //print error message
        print_error("The $fieldName field must contain less than $length characters.");
        
        //increment error counter
        $numErrs++;
    } else {
        //if the user entered correct info, return it.
        return $fieldValue;
    }
    //if there were any errors, return an empty string.
    return "";
}

//This function is the form handler for the create form and the update form. 
function createUpdateFormHandler($createOrUpdate) {

    //validate all entries. Lengths are as specified in the project description,
    //and correspond to the lengths of each corresponding database column.
    //bugreport is the array populated by form elements 
    $BugReport = $_POST['BugReport'];

    //error counter
    global $numErrs;
    $numErrs = 0;

    //name must have length 80 as per the spec.
    $name = validateEntry("product name", $BugReport['PRODUCT_NAME'], 80);
    //version must have length 10 as per the spec.
    $version = validateEntry("version", $BugReport['VERSION'], 10);
    //hardware must have length 20 as per the spec.
    $hardware = validateEntry("hardware type", $BugReport['HARDWARE_TYPE'], 20);
    //os must have length 20 as per the spec.
    $os = validateEntry("operating system", $BugReport['OPERATING_SYS'], 20);
    //frequency must have length 40 as per the spec.
    $freq = validateEntry("frequency of problem", $BugReport['FREQUENCY'], 40);
    //solution must have less than 1000 chars, as a safety measure.
    $solution = validateEntry("proposed solution", $BugReport['PROPOSED_SOLUTIONS'], 1000);


    //connect to the database.
    $dbConnect = mysql_connect("localhost", "root", "root");

    if ($dbConnect === FALSE) {
        print_error("Error connecting to the database:" . mysql_error($dbConnect));
    }

    //the database name
    $dbName = "LAB_4";

    //the table name
    $tableName = "BUG_REPORTS";

    //the report id
    $id = $_POST['ReportID'];

    //If the handler is operating on the update form and an entry didn't validate, 
    //reset that entry to its previous value from the database.
    if ($createOrUpdate === "update") {

        //get the original record from the database.
        $record = mysql_fetch_row(mysql_query("SELECT * FROM $dbName.$tableName where ReportID = '$id'"));

        //if any of the variables were set to an empty string, revert them to the
        //database values.
        if ($name == "") {
            $name = $record[1];
        }
        if ($version == "") {
            $version = $record[2];
            print($version);
        }
        if ($hardware == "") {
            $hardware = $record[3];
        }
        if ($os == "") {
            $os = $record[4];
        }
        if ($freq == "") {
            $freq = $record[5];
        }
        if ($solution == "") {
            $solution = $record[6];
        }
    }


    //If there were any errors, redisplay the form, again with an empty
    //value for the id field. Else, add the form fields to the database
    // and display a success message. 
    if ($numErrs > 0) {
        displayForm($id, $name, $version, $hardware, $os, $freq, $solution);
    } else {

        //If the form handler is being used for the create form, insert the information
        //into the database.
        if ($createOrUpdate == "create") {
            //query to insert values into the database.
            $query_insertBugReport = "INSERT INTO $dbName.$tableName
                        (PRODUCT_NAME,VERSION,HARDWARE_TYPE,OPERATING_SYS,FREQUENCY,PROPOSED_SOLUTIONS) 
                        VALUES ('$name','$version', '$hardware', '$os', '$freq', '$solution')";

            //get the result of the query.
            $queryResult = mysql_query($query_insertBugReport, $dbConnect);

            //print success or error message depending on if the query failed or not.
            if ($queryResult == FALSE) {
                print_error("ERROR: unable to insert into $tableName: " . mysql_error());
            } else {
                print_success("The bug report was successfully added to the database.");
            }
        } 
        //If the form handler is being used for the update form, update the info in the
        //database.
        else {
            
            //query to update the bug report in the database
            $query_updateBugReport = "UPDATE $tableName  
                SET `PRODUCT_NAME`='$name', `VERSION`='$version', `HARDWARE_TYPE`='$hardware', `OPERATING_SYS`='$os',
                `FREQUENCY`='$freq', `PROPOSED_SOLUTIONS`='$solution'
                WHERE `ReportID`='$id'";

            //execute the query, get the result.
            $queryResult = mysql_db_query($dbName, $query_updateBugReport, $dbConnect);

            //print success or error message depending on if the query failed or not.
            if ($queryResult == FALSE) {
                print_error("ERROR: unable to update table $tableName: " . mysql_error());
            } else {
                print_success("The bug report was successfully added to the database.");
            }
        }
    }
}
?>