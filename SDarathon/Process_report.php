<!--
    KambathalliParswanatha, Nagachandra
    Fall 2017;
-->
<?php
$passwordInput = $_POST['password'];
$valid = false;
$raw = file_get_contents('passwords.dat');
$data = explode("\n", $raw);
foreach ($data as $item) {
    if (crypt($passwordInput, $item) === $item)
        $valid = true;
}  #end foreach
if ($valid)
    show_report();
else
    Invalid_Password($valid);


function show_report()
{
    echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <title>Runners Report</title>
    <link rel=\"stylesheet\" href=\"report.css\">
</head>
<body>
    <h1>Registered Runners Report</h1>";

    $server = 'opatija.sdsu.edu:3306';
    $user = 'jadrn023';
    $password = 'briefcase';
    $database = 'jadrn023';
    if (!($db = mysqli_connect($server, $user, $password, $database)))
        echo "ERROR in connection " . mysqli_error($db);
    else {
               /* CONCAT(month,' ',day,' ',year,')*/
        //query orders by category in decreasing order
        $sql = "select last_name, first_name,category,TIMESTAMPDIFF(YEAR, CONCAT(year,'-',month,'-',day), CURDATE()), experience_level,imagename from runner
                ORDER BY category DESC ;";
        $result = mysqli_query($db, $sql);

        //to display error message if any

        if (false == $result){
            echo "ERROR in query" . mysqli_error($db);
        }

        echo "<table>";
        echo "<tr><td>Last Name</td><td>First Name</td><td>Category</td><td>Age</td><td>Experience Level</td><td>Runner Image</td></tr>";
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>";
            $tableColumns = array_slice($row, 0);
            $columnwithimageName = end($tableColumns);
            foreach ($tableColumns as $item)
                if($item == $columnwithimageName)
                {
                    //traverse through the column names untill item is image name
                    $Images = "UploadedImage/".$item;
                    echo"<td align=\"center\"><img src=\"$Images\" width='80' align='middle'></td>";
                }
                else{
                    echo "<td>$item</td>";
                }
            echo "</tr>\n";
        }
        mysqli_close($db);
    }
    echo "</table>";
    echo "</body></html>";
}

function Invalid_Password()
{
    echo "<!DOCTYPE html>
<html>

<head>
    <meta http-equiv=\"content-type\" content=\"text/html;charset=utf-8\" />
     <link rel=\"stylesheet\" href=\"MyStyle.css\" type=\"text/css\"/>
</head>
<body>
    <div>
    <form method=\"post\" action=\"report.php\" name=\"login\">
        <h3>Sign in for the Report</h3>
        <p>
            Password: <input type=\"password\" name=\"password\" placeholder=\"Enter password\"/><br />
        </p>
        <p>
            <input type=\"reset\" value=\"Clear\" />
            <input type=\"submit\" value=\"View Report\" />
        </p>";
    echo "<h3 id=\"message_line\">Password entered is Incorrect</h3>";
    echo"</form></div></body></html>";
}
