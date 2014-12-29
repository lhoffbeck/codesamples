<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--
            ********************************************************************
            * Programmer: 	Lars Hoffbeck
            * Class ID: 	lahof3817
            * Lab 2:            Introduction to PHP and Control Structures
            * CIS 2800: 	Internet Programming
            * Instructor:	Dr. Miller
            * Spring 2013
            * Date completed: 	02/16/13
            ********************************************************************
            * Program Explanation (per the specification document):
            *
            * This program uses PHP to create an "all-in-one" form that validates 
            * user entries and maintains sticky data. Also includes copyright info  
            * and timestamp at the bottom of the page. In this lab, you are in 
            * charge of generating the login, password, and new e-mail for students 
            * entering your university. You will collect information from them in 
            * order to do so. As the information is being validated, the 
            * application must generate descriptive error messages to inform users 
            * what errors they need to correct. The application must also maintain 
            * the "sticky" data within the forms that has already been validated.
            * After all information has been validated, the form will generate 
            * output according to the stated parameters discussed below. 
            * All formatting should be accomplished via external CSS.
            *
            * Program Flow (per the specification document):
            *   If the page is not being loaded for the first time: 
            *       Form inputs will be passed to validation methods to be 
            *       validated, and print error messages if invalid. 
            *       If any errors exist in the form, the form will be redisplayed. 
            *       Else, the user will be taken to a successful registration page.
            *   Else, if the page is being loaded for the first time:
            *       The form will be displayed.
            *   
            ***************************************************************************
        -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="lahof3817Lab2.css"/>
        <title>lahof3817's Lab 2</title>
    </head>
    <body>
        <?php
        
        /*
         *     function: error
         *       Summary:
         *           This function prints an error message in a <div>. Uses the 
         *           "error" css class.
         *       Input parameters: 
         *           $message: String. The error message to be printed. 
         *       Return:
         *           none
         */
        function error($message) {
            //print the message
            print("<div class=\"error\">$message</div>");
        }

        /*   function: validateTextNonempty
         *       Summary:
         *           This function validates that textual input from fields  
         *           is nonempty, and increments an error counter and prints 
         *           an error message if the field is empty.
         *       Input parameters:
         *           $data: String. The data that the user entered.
         *           $fieldName: String. The name of the field in which the 
         *           data was entered.
         *       Return:
         *           If the user didn't enter anything in the field, print an error 
         *           message, increment the error counter, and return an empty string. 
         *           Else, return the data that the user entered. 
         * 
         *           This is so that the return value of the function may be used 
         *           for the sticky data value of the field that is validated.
         */
        function validateTextNonempty($data, $fieldName) {
            //If the data that the user entered is null
            if (empty($data)) {
                error("Please enter a $fieldName."); //print an error message
                //increment the error counter, numErrs in the global array
                $GLOBALS['numErrs']++;
                return ""; //"clear" the entry's sticky data.
            }
            return addslashes($data); //return the data the user entered.
        }

        /*   function: validateRegex
         *       Summary:
         *           This function validates an input value against a regular 
         *           expression input, and increments an error counter and 
         *           prints an error message if the value doesn't validate 
         *           against the regex.
         *       Input parameters:
         *           $data:      String. The data that the user entered.
         *           $fieldName: String. The name of the field in which the 
         *                       data was entered.
         *           $regex:     String. Regular expression that the data must be 
         *                       validated against.
         *       Return:
         *           If the data that the user entered matches the regex,
         *           return the data. Else, return an empty string. This is 
         *           so that the return value of the function may be used for 
         *           the sticky data value of the field that is validated.
         */
        function validateRegex($data, $fieldName, $regex) {
            //if the data doesn't match the regex
            if (!preg_match($regex, preg_replace("/\s+/", "", $data))) {
                //print an error message
                error("You must enter a valid " . $fieldName . ".");
                //increment the error counter, numErrs in the global array
                $GLOBALS['numErrs']++;
                return ""; //"clear" the entry's sticky data.
            }
            //if the data matches the regex, return it. 
            return addslashes($data);
        }

        /*   function: displayResults
         *       Summary:
         *           This function displays login/registration information for 
         *           a user, as detailed in the specification document. 
         *       Input parameters:
         *           $firstName: String. The first name of the user.
         *           $lastName:  String. The last name of the user.
         *           $userAge:   String. The age of the user.
         *       Output:
         *           ~Registration confirmation message
         *           ~Login string. Format as follows (all lowercase):
         *               First name initial, first 3 letters of last
         *               name, total length of the first and last name.
         *               e.g. Lars Hoffbeck login: lhof12
         *           ~Password. Format as follows (all lowercase):
         *               Last name reversed, age in binary. 
         *               e.g. Lars Hoffbeck, aged 10: kcebffoh1010
         *           ~SHA1 hash of the above password.
         *           ~Email. Format as follows (all lowercase):
         *               <firstName>.<lastName>@wmich.edu
         *               e.g. Lars Hoffbeck: lars.hoffbeck@wmich.edu
         *       Return:
         *           none 
         */

        function displayResults($firstName, $lastName, $userAge) {
            
        /* the new login string for the user. Login string
         * is in the form: first name initial, first 3 letters of last
         * name, total length of the first and last name, as per the spec. */
        $login = strtolower($firstName[0] . substr($lastName, 0, 3)) . (string) (strlen($firstName) + strlen($lastName));

        /* the new password string for the user. 
         * Password string is in the form: last name reversed, age in binary,
         * as per the spec. */
        $password = strtolower(strrev($lastName)) . decbin($userAge);

        /* the school email address for the user.
         * Email string is in the form <firstName>.<lastName>@wmich.edu as per 
         * the spec. */
        $email = strtolower($firstName . "." . $lastName) . "@wmich.edu";

        //Print generated login, password, SHA1 hash of password, and email
        //as per the spec.
        print("<h1>You're Registered!</h1>");
        print("Your login is: <span class=\"info\">" . $login . "</span><br/>");
        print("Your password is: <span class=\"info\">" . $password . "</span><br/>");
        print("SHA1 hash of your password is: <span class=\"info\">" . sha1($password) . "</span><br/>");
        print("Your email is: <span class=\"info\">" . $email . "</span><br/>");
    }

    /*   function: displayForm
     *       Summary:
     *           This function displays a web form that has fields for a
     *           users first and last name, age, phone number, and email,
     *           as required in the project specification. The web form
     *           also has a submit (via post) and clear form button. The function 
     *           accepts first and last name, age, phone number, and email
     *           as parameters to be used as sticky data for each of the 
     *           corresponding fields.
     *       Input parameters:
     *           $firstName: String. The first name of the user.
     *           $lastName:  String. The last name of the user.
     *           $userAge:   String. The age of the user.
     *           $userPhone: String. The phone number of the user.
     *           $userEmail: String. The .com or .org email address of the user.
     *       Return:
     *           none
     */

    function displayForm($firstName, $lastName, $userAge, $userPhone, $userEmail) {
        ?>
        <h1>Welcome to the WMU login credential generator!</h1>
        
        <!-- The form begins. The $_SERVER autoglobal makes the form submit to the current page. -->
        <form method="post" action="<?php $_SERVER["SCRIPT_NAME"] ?>">
            <table><!-- table for formatting the form -->
                
                <!-- A caption for the form. Put on the form for the sake of
                     beautification and understandability of the form's function. 
                -->
                <caption>Create Your Account!</caption>

                <tr><!-- A row for the first name form info. -->
                    <td>First Name:</td> 
                    <!-- An input field with sticky data (as specified in the requirements.) -->
                    <td><input type="text" name="firstName" value="<?php print($firstName) ?>"/></td>
                </tr>
                <tr><!-- A row for the last name form info.-->
                    <td>Last Name:</td>
                    <!-- An input field with sticky data (as specified in the requirements.) -->
                    <td><input type="text" name="lastName" value="<?php print($lastName) ?>"/></td>
                </tr>  
                <tr><!-- A row for the user's age form info.-->
                    <td>Your Age (0-99):</td>
                    <!-- An input field with sticky data (as specified in the requirements.) -->
                    <td><input type="text" name="userAge" value="<?php print($userAge) ?>"/></td>
                </tr>
                <tr><!-- A row for the user's phone number form info.-->
                    <td>Phone Number:</td>
                    <!-- An input field with sticky data (as specified in the requirements.) -->
                    <td><input type="text" name="userPhone" value="<?php print($userPhone) ?>"/></td>
                </tr> 
                <tr><!-- A row for the user's email address form info.-->
                    <td>Email Address (.com or .org):</td>
                    <!-- An input field with sticky data (as specified in the requirements.) -->
                    <td><input type="text" name="userEmail" value="<?php print($userEmail) ?>"/></td>
                </tr>
                <tr>
                    <td><input type="reset" name="clear" value="Clear Form"/></td>
                    <td><input type="submit" name="submit" value="Submit!"/></td>
                </tr>
            </table><!-- end of the table -->
        </form><!-- end of the form -->
        <?php
    }
    
    //initialize/reinitialize all variables to ensure that the data on the
    //page is only one user's.
    $firstName = "";//the first name of the user
    $lastName = "";//the last name of the user
    $userAge = "";//the age of the user, 0-99
    $userPhone = "";//the U.S. phone number of the user, optional country and area code
    $userEmail = "";//the valid .com or .org email of the user.

    /*
     * If not initial pageload, validate all form information by calling
     * the appropriate validate function, as per specification. The validate
     * methods will return sticky data if the data is valid, which will be 
     * used in redisplaying the form. All as per the spec.
     */
    if (isset($_POST["submit"])) {
        //initialize the error counter so that it can be used by the validate methods.
        $numErrs = 0;

        /* Validate the data the user filled into the firstName field, initialize 
         * the $firstName variable with appropriate sticky data for the user's first name.
         */
        $firstName = validateTextNonempty($_POST["firstName"], "first name");

        /* Validate the data the user filled into the lastName field, initialize 
         * the $lastName variable with appropriate sticky data for the user's last name.
         */
        $lastName = validateTextNonempty($_POST["lastName"], "last name");

        /* Validate the data the user filled into the userAge field, initialize 
         * the $userAge variable with appropriate sticky data for the user's age.
         */
        $userAge = validateRegex($_POST["userAge"], "user age (0-99)", "/^\d\d?$/");

        /* Validate the data the user filled into the userPhone field, initialize 
         * the $userPhone variable with appropriate sticky data for the user's phone number.
         */
        $userPhone = validateRegex($_POST["userPhone"], "U.S. phone number", "/^1?\W?([2-9][0-8][0-9])?\W?([2-9][0-9]{2})\W?([0-9]{4})$/");

        /* Validate the data the user filled into the userEmail field, initialize 
         * the $userEmail variable with appropriate sticky data for the user's email address.
         */
        $userEmail = validateRegex($_POST["userEmail"], "email (.com or .org)", "/^[\w-]+(\.[\w-]+)*@[\w-]+(\.(com|org))$/i");
    }

    //if there are any errors, display form so that the user can reenter data,
    //as per the specification.
    if ($numErrs > 0 || !isset($_POST["submit"])) {
        displayForm($firstName, $lastName, $userAge, $userPhone, $userEmail);
    } else {//if there are no errors, display the results, as per the spec.
        displayResults($firstName, $lastName, $userAge);
    }

    //include copyright information as well as date and time, as per the spec.
    include("lahof3817Lab2DateTime.php");
    ?>
    </body>
</html>