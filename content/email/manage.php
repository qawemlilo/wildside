<?php
include("ch19_include.php");

//determine if they need to see the form or not
if (!$_POST) {
	//they need to see the form, so create form block
	$display_block = "
	<form method=\"POST\" action=\"".$_SERVER["PHP_SELF"]."\">

	<p><strong>Your E-Mail Address:</strong><br/>
	<input type=\"text\" name=\"email\" size=\"40\" maxlength=\"150\">

	<p><strong>Action:</strong><br/>
	<input type=\"radio\" name=\"action\" value=\"sub\" checked> subscribe
	<input type=\"radio\" name=\"action\" value=\"unsub\"> unsubscribe

	<p><input type=\"submit\" name=\"submit\" value=\"Submit Form\"></p>
	</form>";

} else if (($_POST) && ($_POST["action"] == "sub")) {
	//trying to subscribe; validate email address
	if ($_POST["email"] == "") {
		header("Location: manage.php");
		exit;
	} else {
		//connect to database
		doDB();

		//check that email is in list
		emailChecker($_POST["email"]);

		//get number of results and do action
		if (mysqli_num_rows($check_res) < 1) {
			//free result
			mysqli_free_result($check_res);

			//add record
			$add_sql = "INSERT INTO w_email_list (email) VALUES('".$_POST["email"]."')";
			$add_res = mysqli_query($mysqli, $add_sql) or die(mysqli_error($mysqli));
			$display_block = "<p>Thanks for signing up!</p>";

			//close connection to MySQL
			mysqli_close($mysqli);
		} else {
			//print failure message
			$display_block = "<p>You're already subscribed!</p>";
		}
	}
} else if (($_POST) && ($_POST["action"] == "unsub")) {
	//trying to unsubscribe; validate email address
	if ($_POST["email"] == "") {
		header("Location: manage.php");
		exit;
	} else {
		//connect to database
		doDB();

		//check that email is in list
		emailChecker($_POST["email"]);

		//get number of results and do action
		if (mysqli_num_rows($check_res) < 1) {
			//free result
			mysqli_free_result($check_res);

			//print failure message
			$display_block = "<p>Couldn't find your address!</p>
			<p>No action was taken.</p>";
		} else {
			//get value of ID from result
			while ($row = mysqli_fetch_array($check_res)) {
				$id = $row["id"];
			}

			//unsubscribe the address
			$del_sql = "UPDATE w_email_list SET status=1 WHERE id = '".$id."'";
			$del_res = mysqli_query($mysqli, $del_sql) or die(mysqli_error($mysqli));
			$display_block = "<P>You're unsubscribed!</p>";
		}
		mysqli_close($mysqli);
	}
}
?>
<html>
<head>
<title>Subscribe/Unsubscribe to a Mailing List</title>
</head>
<body>
<h1>Subscribe/Unsubscribe to a Mailing List</h1>
<?php echo "$display_block"; ?>
</body>
</html>