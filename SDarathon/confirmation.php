<!--
    KambathalliParswanatha, Nagachandra
    Fall 2017;
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;
    charset=iso-8859-1" />
    <title>Sample Form Processing with PHP</title>
    <link rel="stylesheet" type="text/css" href="style.css" />


</head>


<body>
<?php
echo <<<ENDBLOCK
    <h1>$params[0], thank you for registering.</h1>
    <table>
        <tr>
            <td>middle_name</td>
            <td>$params[1]</td>
        </tr>
        <tr>
            <td>last_name</td>
            <td>$params[2]</td>
        </tr>
        <tr>
            <td>address_line1</td>
            <td>$params[3]</td>
        </tr>
        <tr>
            <td>address_line2</td>
            <td>$params[4]</td>
        </tr>
        <tr>
            <td>city</td>
            <td>$params[5]</td>
        </tr> 
         <tr>
            <td>state</td>
            <td>$params[6]</td>
        </tr> 
         <tr>
            <td>zip</td>
            <td>$params[7]</td>
        </tr> 
         <tr>
            <td>areacode</td>
            <td>$params[8]</td>
        </tr> 
         <tr>
            <td>phoneprefix</td>
            <td>$params[9]</td>
        </tr> 
         <tr>
            <td>phonenumber</td>
            <td>$params[10]</td>
        </tr> 
         <tr>
            <td>email</td>
            <td>$params[11]</td>
        </tr> 
         <tr>
            <td>gender</td>
            <td>$params[12]</td>
        </tr> 
         <tr>
            <td>month</td>
            <td>$params[13]</td>
        </tr> 
         <tr>
            <td>day</td>
            <td>$params[14]</td>
        </tr> 
         <tr>
            <td>year</td>
            <td>$params[15]</td>
        </tr> 
         <tr>
            <td>medical_conditions</td>
            <td>$params[16]</td>
        </tr> 
         <tr>
            <td>experience_level</td>
            <td>$params[17]</td>
        </tr>   
        <tr>
            <td>category</td>
            <td>$params[18]</td>
        </tr>   
        <tr>
            <td>imagename</td>
            <td>$params[19]</td>
        </tr>           
    </table>                          
ENDBLOCK;


/*echo "<p>The raw query string that came from the browser is ",
file_get_contents("php://input"),"</p>";*/

?>
</body></html>
