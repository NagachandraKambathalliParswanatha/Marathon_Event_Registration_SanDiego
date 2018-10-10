<!--
    KambathalliParswanatha, Nagachandra
    Fall 2017;
-->
<?php

function validate_data($params) {

    $states = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DC",
        "DE", "FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA",
        "MA", "MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE",
        "NH", "NJ", "NM", "NV", "NY", "OH", "OK", "OR", "PA", "RI", "SC",
        "SD", "TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");


    $msg = "";
    $ImageTitle = $_FILES["userpic"]["name"];
    $target_dir = "/home/jadrn023/public_html/proj3/UploadedImage/";
    $target_file = $target_dir . basename($ImageTitle);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if(strlen($params[0]) == 0)
        $msg .= "Please enter the first name<br />";
    if(strlen($params[2]) == 0)
        $msg .= "Please enter the last name<br />";
    if(strlen($params[3]) == 0)
        $msg .= "Please enter the address<br />";
    if(strlen($params[5]) == 0)
        $msg .= "Please enter the city<br />";
    if(strlen($params[6]) == 0)
        $msg .= "Please enter the state<br />";
    elseif(!in_array($params[6],$states))
        $msg .= "Enter valid two letter state Abreviation in Uppercase<br />";
    if(strlen($params[6]) < 2)
        $msg .= "Only two letter abbreviation<br />";
    if(strlen($params[7]) == 0)
        $msg .= "Please enter the zip code<br />";
    elseif(!is_numeric($params[7]))
        $msg .= "Zip code may contain only numeric digits<br />";
    elseif(strlen($params[7]) < 5)
        $msg .= "Please enter 5 digit zipcode<br />";
    if(strlen($params[8]) == 0)
        $msg .= "Please enter the area code<br />";
    elseif(!is_numeric($params[8]))
        $msg .= "areacode may contain only numeric digits<br />";
    if(strlen($params[8]) < 3)
        $msg .= "Please enter 3 numeric digit area code<br />";
    if(strlen($params[9]) == 0)
        $msg .= "Please enter the phoneprefix<br />";
    elseif(!is_numeric($params[9]))
        $msg .= "phoneprefix may contain only numeric digits<br />";
    elseif(strlen($params[9]) < 3)
        $msg .= "Please enter 3 numeric digit phoneprefix<br />";
    if(strlen($params[10]) == 0)
        $msg .= "Please enter the phonenumber<br />";
    elseif(!is_numeric($params[10]))
        $msg .= "phonenumber may contain only numeric digits<br />";
    elseif(strlen($params[10]) < 3)
        $msg .= "Please enter 4 digit phonenumber<br />";
    if(strlen($params[11]) == 0)
        $msg .= "Please enter email<br />";
    elseif(!filter_var($params[11], FILTER_VALIDATE_EMAIL))
        $msg .= "Your email appears to be invalid<br/>";
    if(empty($params[12]))
        $msg .= "Please select gender<br />";
    if(strlen($params[13]) == 0)
        $msg .= "Please enter the month<br />";
    elseif(!is_numeric($params[13]))
        $msg .= "month may contain only numeric digits<br />";
    elseif(strlen($params[13]) < 2)
        $msg .= "Please enter two digit month<br />";
    if(strlen($params[14]) == 0)
        $msg .= "Please enter the day<br />";
    elseif(!is_numeric($params[14]))
        $msg .= "day may contain only numeric digits<br />";
    if(strlen($params[14]) < 2)
        $msg .= "Please enter two digit day<br />";
    if(strlen($params[15]) == 0)
        $msg .= "Please enter the year<br />";
    elseif(!is_numeric($params[15]))
        $msg .= "year may contain only numeric digits<br />";
    if(strlen($params[15]) < 2)
        $msg .= "Please enter four digit year<br />";
    if(empty($params[17]))
        $msg .= "Please select experience level<br />";
    if(empty($params[18]))
        $msg .= "Please select category<br />";
    if(empty($ImageTitle))
        $msg .= "Image Required<br />";
    if (!empty($ImageTitle) && file_exists($target_file))
        $msg .= "Sorry, file already exists.<br />";
    if($_FILES['userpic']['error'] > 0) {
        $err = $_FILES['userpic']['error'];
        if($err == 1)
            $msg .= "The file was too big to upload, the limit is 2MB<br />";
    }

    /* if ($_FILES["userpic"]["size"] > 1000000)
        $msg .= "Sorry, your file is too large.<br />";*/


    if($msg) {
        write_form_error_page($msg);
        exit;
    }

}
function write_form_error_page($msg)
{
    write_header();
    echo "<h5 id = \"message_line\">Sorry, an error occurred<br />",
    $msg, "</h5>";
    write_form();
    write_footer();
}

function ImageUpload()
    {

         $ImageTitle = $_FILES["userpic"]["name"];
         $target_dir = "/home/jadrn023/public_html/proj3/UploadedImage/";
         $target_file = $target_dir . basename($ImageTitle);
         move_uploaded_file($_FILES["userpic"]["tmp_name"], $target_file);
    }

function write_form()
{
  print"<body>
		<div>
		<h1><b>Sign Up to SDSU Marathon</b></h1>
		</div>
    
		<form name=\"Runner_info\" method=\"post\" enctype=\"multipart/form-data\" action=\"process_request.php\" id = \"runnerinformation\"
          autocomplete=\"off\">
			<fieldset>
				<legend>Runner Details</legend>

					<ul>
			
						<li><label for=\"fname\">First Name:</label>
							<input type=\"text\" name=\"fname\" value=\"$_POST[fname]\" id=\"firstname\" size = \"25\"/></li>
						<li><label for=\"mname\">Middle Name:</label>
							<input type=\"text\" name=\"mname\" value=\"$_POST[mname]\" id=\"middlename\" size = \"25\"/></li>
						
						<li>	<label for = \"lastname\">Last Name:</label>
							<input type=\"text\" name=\"lname\" value=\"$_POST[lname]\" id=\"lastname\" size = \"25\"/></li>
							
						<li>	<label for=\"addressone\">Address 1:</label>
							<input type=\"text\" name=\"address1\" value=\"$_POST[address1]\" id=\"address1\" size = \"55\"></li>
							
						<li>	<label for=\"addresstwo\">Address 2:</label>
							<input type=\"text\" name=\"address2\" value=\"$_POST[address2]\" id=\"addresstwo\" size = \"55\"></li>

						<li>	<label for=\"city\">City</label>
							<input type=\"text\" name=\"city\" value=\"$_POST[city]\" id=\"city\" size=\"15\">

							<label for=\"state\">State</label>
							<input type=\"text\" name=\"state\" value=\"$_POST[state]\" id=\"state\" maxlength=\"2\" size=\"5\">

							<label for=\"zip\">Zip</label>
							<input type=\"text\"  name=\"zip\" value=\"$_POST[zip]\" id=\"zip\" maxlength=\"5\" size=\"10\" ></li>
						
						<li><label id = \"fone\">Primary Phone</label> (
							<input class=\"phone\" type=\"tel\" name=\"areacode\" maxlength=\"3\" value=\"$_POST[areacode]\" size = \"4\" >)
							<input class=\"phone\" type=\"tel\" name=\"phoneprefix\" maxlength=\"3\" value=\"$_POST[phoneprefix]\" size = \"4\" > -
							<input class=\"phone\" type=\"tel\" name=\"phoneno\" maxlength=\"4\" value=\"$_POST[phoneno]\" size = \"5\" ></li>
						

						<li><label for=\"email\">Email</label>
						<input type=\"email\" name=\"email\" value=\"$_POST[email]\" id=\"email\" size=\"45\" ></li>";
				        
				        
				        
						    echo "<li><label>Gender :</label>";
                                                        
                            echo "<input id=\"male\" name=\"gender\" type=\"radio\"  value = \"male\"";
                            echo((isset($_POST['gender']) && $_POST['gender'] == "male") ? "checked" : "");
                            echo">Male\n";
							

							echo "<input id=\"female\" name=\"gender\" type=\"radio\"  value = \"female\"";
                            echo((isset($_POST['gender']) && $_POST['gender'] == "female") ? "checked" : "");
                            echo ">Female\n";

							echo "<input id=\"other\" name=\"gender\" type=\"radio\"  value = \"other\"";
                            echo((isset($_POST['gender']) && $_POST['gender'] == "other") ? "checked" : "");
                            echo ">Other</li>\n";

                        print"<li>	<label for=\"dob\">Date of Birth:</label>
							
								<label for=\"mm\">mm</label>
								<input id=\"mm\" name=\"month\"  value=\"$_POST[month]\" type=\"text\" maxlength=\"2\" size = \"3\">
								<label for=\"dd\">dd</label>
								<input id=\"dd\" name=\"day\" value=\"$_POST[day]\" type=\"text\" maxlength=\"2\" size = \"3\">
								<label for=\"yyyy\">yyyy</label>
								<input id=\"yyyy\" name=\"year\" value=\"$_POST[year]\" type=\"text\" maxlength=\"4\" size = \"5\"></li>";
								
								
						    echo"<li><label for=\"experience-level\">Experience Level:</label>";
							
                            echo"<input id=\"expert\" name=\"experiencelevel\" type=\"radio\"  value = \"expert\"";
                            echo((isset($_POST['experiencelevel']) && $_POST['experiencelevel'] == "expert") ? "checked" : "");
                            echo ">Expert\n";

                            echo "<input id=\"experienced\" name=\"experiencelevel\" type=\"radio\"  value = \"Experienced\"";
                            echo((isset($_POST['experiencelevel']) && $_POST['experiencelevel'] == "Experienced") ? "checked" : "");
                            echo ">Experienced\n";


                            echo"<input id=\"novice\" name=\"experiencelevel\" type=\"radio\"  value = \"Novice\"";
                            echo((isset($_POST['experiencelevel']) && $_POST['experiencelevel'] == "Novice") ? "checked" : "");
                            echo ">Novice\n";


						print"<li><label for=\"medical-conditions\">Medical Conditions If An</label></li>
								
						<li><textarea rows=\"4\" cols = \"50\" name=\"medicalconditions\" value=\"$_POST[medicalconditions]\" id=\"medical-conditions\" ></textarea></li>";

            
						    echo"<li><label for=\"category\">Category:</label>";
								
									echo"<input id=\"teen\" name=\"age\" type=\"radio\"  value = \"teen\"";
                                    echo((isset($_POST['age']) && $_POST['age'] == "teen") ? "checked" : "");
                                    echo ">teen\n";

									echo"<input id=\"adult\" name=\"age\" type=\"radio\"  value = \"adult\"";
                                    echo((isset($_POST['age']) && $_POST['age'] == "adult") ? "checked" : "");
                                    echo ">Adult\n";

									echo"<input id=\"senior\" name=\"age\" type=\"radio\"  value = \"senior\"";
                                    echo((isset($_POST['age']) && $_POST['age'] == "senior") ? "checked" : "");
                                    echo ">Senior\n";
						print"<li>    <label for=\"userpic\">Runner's Image:</label>		
								
								<input type=\"file\" class=\"fileinput\" name=\"userpic\" id=\"user-pic\" accept=\"image/*\">
								</label></li>
					</ul>
					
					<h5 id = \"message_line\">&nbsp;</h5>
					 
				
				
				
				<div id = \"Submitbuttons\">
					<input type=\"reset\" id=\"reset-btn\" value=\"ClearData\" class=\"button\"/>
					<input id=\"submit-btn\" type=\"submit\" value=\"Submit\" class = \"button\"/>
				</div>

			</fieldset>

        

		</form>
    
	
	</body>";

}

function process_parameters($params) {
    $ImageTitle = $_FILES["userpic"]["name"];
    global $bad_chars;
    $params = array();
    $params[] = trim(str_replace($bad_chars, "",$_POST['fname']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['mname']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['lname']));
    $params[] = trim(str_replace($bad_chars, "",$_POST[address1]));
    $params[] = trim(str_replace($bad_chars, "",$_POST[address2]));
    $params[] = trim(str_replace($bad_chars, "",$_POST['city']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['state']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['zip']));
    $params[] = trim(str_replace($bad_chars, "",$_POST[areacode]));
    $params[] = trim(str_replace($bad_chars, "",$_POST[phoneprefix]));
    $params[] = trim(str_replace($bad_chars, "",$_POST['phoneno']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['email']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['gender']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['month']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['day']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['year']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['medicalconditions']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['experiencelevel']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['age']));
    $params[] = trim(str_replace($bad_chars, "",$ImageTitle));
    return $params;
}

function store_data_in_db($params) {
    # get a database connection
    $db = get_db_handle();  ## method in helpers.php
    ##############################################################
    $sqll = "SELECT * FROM runner WHERE ".
        "first_name='$params[0]' AND ".
        "middle_name='$params[1]' AND ".
        "last_name='$params[2]' AND ".
        "address_line1='$params[3]' AND ".
        "address_line2 = '$params[4]' AND ".
        "city='$params[5]' AND ".
        "state = '$params[6]' AND ".
        "zip = '$params[7]' AND ".
        "areacode='$params[8]' AND ".
        "phoneprefix='$params[9]' AND ".
        "phonenumber='$params[10]' AND ".
        "email = '$params[11]' AND ".
        "gender='$params[12]' AND ".
        "month='$params[13]' AND ".
        "day ='$params[14]' AND ".
        "year ='$params[15]' AND ".
        "medical_conditions ='$params[16]' AND ".
        "experience_level ='$params[17]' AND ".
        "category='$params[18]' AND ".
        "imagename = '$params[19]';";
##echo "The SQL statement is ",$sql;
    global $bad_chars;

    $email = trim(str_replace($bad_chars, "",$_POST['email']));
    $sql = "select * from runner where email='$email';";
    $result = mysqli_query($db, $sql);



    if(mysqli_num_rows($result) > 0) {
        write_form_error_page('This record appears to be a duplicate');
        exit;
    }
    elseif (mysqli_num_rows($result) == 0)
    {
        echo("Hello ");
    }
    else
        echo("No");

##OK, duplicate check passed, now insert

    $sql = "INSERT INTO runner(first_name,middle_name,last_name,address_line1,address_line2,city,state,zip,areacode,phoneprefix,phonenumber,email,gender,month,day,year,medical_conditions,experience_level,category,imagename) ".
        "VALUES('$params[0]','$params[1]','$params[2]','$params[3]','$params[4]','$params[5]','$params[6]','$params[7]','$params[8]','$params[9]','$params[10]','$params[11]','$params[12]','$params[13]','$params[14]','$params[15]','$params[16]','$params[17]','$params[18]','$params[19]');";
##echo "The SQL statement is ",$sql;
    $s = mysqli_query($db,$sql);
    if ( false===$s ) {
        printf("error: %s\n", mysqli_error($db));
    }
    $how_many = mysqli_affected_rows($db);
   echo("There were $how_many rows affected");
    close_connector($db);
}

?>   
