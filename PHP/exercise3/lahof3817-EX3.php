<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--
       *************************************
       * Programmer: 		Lars Hoffbeck
       * Class ID: 		lahof3817
       * Exercise 3: 		Using forms, POST
       * CIS 2800: 		Internet Programming
       * Instructor:		Dr. Miller
       * Spring 2013
       * Due date: 		02/14/13
       * Date completed: 	02/12/13
       *************************************
       * Program Explanation:
       *
       * The program creates a web form, and
       * submits form data to a php page that 
       * performs some manipulations on it.
       **************************************
        -->
        <link rel="stylesheet" type="text/css" href="lahof3817-EX3.css"/>
        <title>Exercise 3 - Results</title>
    </head>
    <body>
        <?php
        //------------------------fields
        $fName = $_POST["fName"];
        $lName = $_POST["lName"];
        //--------------------END fields
        //-------------------------------------print information
        print("<h1>Exercise 3 Results</h1>");
        print("Welcome $fName $lName <br/>");
        print("Your first name initial is <strong>" . $fName[0]
                . "</strong> and your last name initial is <strong>" . $lName[0] . "</strong><br/>");
        print("Did you know your first name has <strong>" . strlen($fName) . "</strong> characters<br/>");
        print("and your last name has <strong>" . strlen($lName) . "</strong> characters?<br/>");
        print("This is a total of <strong class=\"emph\">");
        print strlen($fName) + strlen($lName);
        print("</strong> characters.");
        //----------------------------------END print information
        ?>
    </body>
</html>
