<?php
//if the user submitted the form, set a cookie with the user's name.
if (isset($_POST['firstName'])) {
    //if setting the cookie succeeds, print a success message. Else, print a fail message.
    if (setcookie("firstName", $_POST['firstName'], false, "", false)) {
        //print success message.
        print("The cookie has been set.");
    } else {
        //print failure message.
        print("Error setting the cookie.");
    }
}
?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Exercise 9</title>

        <style type="text/css">
            body {
                /*set the font to be times.*/
                font-family: times, serif; 
                color: lawngreen; /*make text color light green */
                background-color: cornflowerblue;/*make background light blue. */
            }
            /*styling for displaying the cookie. */
            .cookieColor {
                color: yellow; /*make the text yellow */
                /* set the font to be arial */
                font-family: Arial, sans-serif;
            }
        </style>
    </head>
<body>
        <?php
        //the value of the cookie set up top
        $cookieVal = $_COOKIE['firstName'];

        //stores the first name of the user from the post array.
        $firstName = $_POST['firstName'];

        //If the cookie has been set, display Hello <firstName>! Else if the form has not
        //been submitted with the user's name, display the form. Else,
        //the cookie was just set and the user should refresh the page, so display a 
        //link for him to do that.
        if (!empty($cookieVal)) {
            //display the cookie value
            print("<p class =\"cookieColor\">Hello {$cookieVal}!</p>");
        } elseif (!isset($_POST['firstName'])) {
            //display the form that gets the cookie info from the user.
            ?>

            <form method="post" action="index.php">
                <label>First Name:</label>
                <input type="text" name="firstName" id="firstName" size="30" maxlength="30" value="" /><br />
                <input type="submit" name="submit" id="submit" value="Set Cookie" /><br />	
            </form>
        <?php
        } else{
            //display an anchor that refreshes this page.
            print("<br/><a href=\"index.php\">Refresh Page</a>");
        }
        ?>

</body>
</html>