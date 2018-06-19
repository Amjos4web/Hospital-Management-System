<?php
    session_start();
	echo '<p style="text-align:center; font-size: 16px; font-family: cursive;">Your complain has been successfully submitted and its been processed.</p>';
	echo '<p style="text-align:center; font-size: 14px; font-family: cursive;">Kindly check back...</p>';
	echo '<p style="text-align:center; font-size: 14px; font-family: cursive;">Thanks</p>';
	echo '<p style="text-align:center; font-size: 14px; font-family: cursive; font-style: italic;">Mr. Olatide - 08034480841</p>';
	unset($_SESSION['emaill']);
	
	echo '<a href="http://connect.buth.edu/login" style="text-decoration: none; font-size: 14px; text-align: center;">Proceed to login page</a>';
?>