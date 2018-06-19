<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: revenue_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `revenue_login` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["first_name"];
	$name2=$row["emailAdd"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// sum the total earn by current user 
$sum = "";
$dynamic_list = "";

if (isset($_POST['sum']))
{
	$to_date = $_POST['to_date'] ." " . "23:59:59";
	$from_date = $_POST['from_date'] . " " . "00:00:00";
	 $card = "Card";
	 $adm = "Admission deposit";
	 $obs = "Observation";
	 $disb = "Discharged Bill";
	 $phy = "Physiotherapy";
	 $pro = "Prothesis";
	 $xray = "X-Ray";
	 $den = "Dental";
	 $sur	= "Surgery";
	 $dres = "Dressing";
	 $famp = "Family Planning";
	 $immu = "Immunization";
	 $death = "Death Certificate";
	 $birth = "Birth Certificate";
	 $specialclinic = "Special Clinic";
	 $lap = "Laparoscopic";
	 $vip = "Vip Clinic";
	 $eye = "Eye Clinic";
	 $mor = "Morgue";
	 $ember = "Emberment";
	 $ambu = "Ambulance";
	 $medical = "Medical Test";
	 $global = "Global Fund";
	 $empl = "Employment Form";
	 $visit = "Doctors visit";
	 $emergency = "Emergency";
	 $house = "Housemanship Form";
	 $lf = "Lost and Found";
	 $ethical = "Ethical Review Comm";
	 $clinical_fee = "Clinical Training Fee";
	 $training_fee = "Training Fee(College of health)Moro";
	 $oxygen = "Oxygen Fee";
	 $dietician = "Dietician Fee";
	 $staff_health = "Staff Health Registration Fee";
	 $ac = "AC Scrap Sales";
	 $keg = "Keg Sales";
	 $broken = "Broken Tile Sales";
	 $fire = "Fire and Plank Wood Sales";
	 $cash = "Cash Advance";
	 $surplus = "Surplus";
	 $internet = "internet";
	 $counter = 1;
	
	if (isset($_POST['from_date']) && ($_POST['to_date'])){

		$sum_total = array();
		$paid = array();
		// display the specified information
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$card'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];			
			
			foreach ($sum_total as $income){
				if (!empty($income)){
					$date_value = $income;
					$_SESSION['income'] = $income;
					$income = $_SESSION['income'];
				}
			}
			
		
			$dynamic_list .= "<tr>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$card . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$adm'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income2){
				if (!empty($income2)){
					$date_value = $income2;
					$_SESSION['income2'] = $income2;
					$income2 = $_SESSION['income2'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$adm . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income2 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$obs'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income3){
				if (!empty($income3)){
					$date_value = $income3;
					$_SESSION['income3'] = $income3;
					$income3 = $_SESSION['income3'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$obs . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income3 . "</td>";
			$dynamic_list .= "</tr>";
		}
		
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$disb'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income4){
				if (!empty($income4)){
					$date_value = $income4;
					$_SESSION['income4'] = $income4;
					$income4 = $_SESSION['income4'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$disb . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income4 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$phy'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income5){
				if (!empty($income5)){
					$date_value = $income5;
					$_SESSION['income5'] = $income5;
					$income5 = $_SESSION['income5'];
					
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$phy . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income5 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$pro'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income6){
				if (!empty($income6)){
					$date_value = $income6;
					$_SESSION['income6'] = $income6;
					$income6 = $_SESSION['income6'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$pro . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income6 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$xray'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income7){
				if (!empty($income7)){
					$date_value = $income7;
					$_SESSION['income7'] = $income7;
					$income7 = $_SESSION['income7'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$xray . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income7 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$den'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income8){
				if (!empty($income8)){
					$date_value = $income8;
					$_SESSION['income8'] = $income8;
					$income8 = $_SESSION['income8'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$den . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income8 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$sur'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income9){
				if (!empty($income9)){
					$date_value = $income9;
					$_SESSION['income9'] = $income9;
					$income9 = $_SESSION['income9'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$sur . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income9 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$dres'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income10){
				if (!empty($income10)){
					$date_value = $income10;
					$_SESSION['income10'] = $income10;
					$income10 = $_SESSION['income10'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$dres . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income10 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$famp'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income11){
				if (!empty($income11)){
					$date_value = $income11;
					$_SESSION['income11'] = $income11;
					$income11 = $_SESSION['income11'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$famp . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income11 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$immu'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income12){
				if (!empty($income12)){
					$date_value = $income12;
					$_SESSION['income12'] = $income12;
					$income12 = $_SESSION['income12'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$immu . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income12 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$death'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income13){
				if (!empty($income13)){
					$date_value = $income13;
					$_SESSION['income13'] = $income13;
					$income13 = $_SESSION['income13'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$death . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income13 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$birth'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income14){
				if (!empty($income14)){
					$date_value = $income14;
					$_SESSION['income14'] = $income14;
					$income14 = $_SESSION['income14'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$birth . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income14 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$specialclinic'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income15){
				if (!empty($income15)){
					$date_value = $income15;
					$_SESSION['income15'] = $income15;
					$income15 = $_SESSION['income15'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$specialclinic . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income15 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$lap'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income16){
				if (!empty($income16)){
					$date_value = $income16;
					$_SESSION['income16'] = $income16;
					$income16 = $_SESSION['income16'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$lap . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income16 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$vip'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income17){
				if (!empty($income17)){
					$date_value = $income17;
					$_SESSION['income17'] = $income17;
					$income17 = $_SESSION['income17'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$vip . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income17 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$eye'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income18){
				if (!empty($income18)){
					$date_value = $income18;
					$_SESSION['income18'] = $income18;
					$income18 = $_SESSION['income18'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$eye . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income18 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$mor'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income19){
				if (!empty($income19)){
					$date_value = $income19;
					$_SESSION['income19'] = $income19;
					$income19 = $_SESSION['income19'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$mor . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income19 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$ember'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income20){
				if (!empty($income20)){
					$date_value = $income20;
					$_SESSION['income20'] = $income20;
					$income20 = $_SESSION['income20'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$ember . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income20 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$ambu'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income21){
				if (!empty($income21)){
					$date_value = $income21;
					$_SESSION['income21'] = $income21;
					$income21 = $_SESSION['income21'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$ambu . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income21 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$medical'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income22){
				if (!empty($income22)){
					$date_value = $income22;
					$_SESSION['income22'] = $income22;
					$income22 = $_SESSION['income22'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$medical . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income22 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$global'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income23){
				if (!empty($income23)){
					$date_value = $income23;
					$_SESSION['income23'] = $income23;
					$income23 = $_SESSION['income23'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$global . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income23 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$empl'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income24){
				if (!empty($income24)){
					$date_value = $income24;
					$_SESSION['income24'] = $income24;
					$income24 = $_SESSION['income24'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$empl . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income24 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$visit'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income25){
				if (!empty($income25)){
					$date_value = $income25;
					$_SESSION['income25'] = $income25;
					$income25 = $_SESSION['income25'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$visit . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income25 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$emergency'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income26){
				if (!empty($income26)){
					$date_value = $income26;
					$_SESSION['income26'] = $income26;
					$income26 = $_SESSION['income26'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$emergency . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income26 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$house'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income27){
				if (!empty($income27)){
					$date_value = $income27;
					$_SESSION['income27'] = $income27;
					$income27 = $_SESSION['income27'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$house . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income27 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$lf'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income28){
				if (!empty($income28)){
					$date_value = $income28;
					$_SESSION['income28'] = $income28;
					$income28 = $_SESSION['income28'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$lf . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income28 . "</td>";
			$dynamic_list .= "</tr>";
		}
		
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$ethical'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income29){
				if (!empty($income29)){
					$date_value = $income29;
					$_SESSION['income29'] = $income29;
					$income29 = $_SESSION['income29'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$ethical . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income29 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$clinical_fee'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income30){
				if (!empty($income30)){
					$date_value = $income30;
					$_SESSION['income30'] = $income30;
					$income30 = $_SESSION['income30'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$clinical_fee . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income30 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$training_fee'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income31){
				if (!empty($income31)){
					$date_value = $income31;
					$_SESSION['income31'] = $income31;
					$income31 = $_SESSION['income31'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$training_fee . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income31 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$oxygen'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income32){
				if (!empty($income32)){
					$date_value = $income32;
					$_SESSION['income32'] = $income32;
					$income32 = $_SESSION['income32'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$oxygen . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income32 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$dietician'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income33){
				if (!empty($income33)){
					$date_value = $income33;
					$_SESSION['income33'] = $income33;
					$income33 = $_SESSION['income33'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$dietician . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income33 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$staff_health'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income34){
				if (!empty($income34)){
					$date_value = $income34;
					$_SESSION['income34'] = $income34;
					$income34 = $_SESSION['income34'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$staff_health . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income34 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$ac'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income35){
				if (!empty($income35)){
					$date_value = $income35;
					$_SESSION['income35'] = $income35;
					$income35 = $_SESSION['income35'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$ac . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income35 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$keg'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income36){
				if (!empty($income36)){
					$date_value = $income36;
					$_SESSION['income36'] = $income36;
					$income36 = $_SESSION['income36'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$keg . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income36 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$broken'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income37){
				if (!empty($income37)){
					$date_value = $income37;
					$_SESSION['income37'] = $income37;
					$income37 = $_SESSION['income37'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$broken . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income37 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$fire'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income38){
				if (!empty($income38)){
					$date_value = $income38;
					$_SESSION['income38'] = $income38;
					$income38 = $_SESSION['income38'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$fire . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income38 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$cash'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income39){
				if (!empty($income39)){
					$date_value = $income39;
					$_SESSION['income39'] = $income39;
					$income39 = $_SESSION['income39'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$cash . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income39 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$surplus'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income40){
				if (!empty($income40)){
					$date_value = $income40;
					$_SESSION['income40'] = $income40;
					$income40 = $_SESSION['income40'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$surplus . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income40 . "</td>";
			$dynamic_list .= "</tr>";
		}
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='$internet'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		while($result1 = mysqli_fetch_array($sum2)){
			$sum_total[0] = $result1['total_sum1'];	
			
			foreach ($sum_total as $income41){
				if (!empty($income41)){
					$date_value = $income41;
					$_SESSION['income41'] = $income41;
					$income41 = $_SESSION['income41'];
				}
			}
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$counter++ . "</td>";
		    $dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$internet . "</td>";
			$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$income41 . "</td>";
			$dynamic_list .= "</tr>";
		}
		

	} else {
		?><script type="text/javascript">
		alert ('Please enter date');
		window.location = 'revenue_all.php';
		</script><?php
	}
	
	
	 $total = $income + $income2 + $income3 + $income4 + $income5 + $income6 + $income7 + $income8 + $income9 + $income10 + $income11 + $income12 + $income13 + $income14 + $income15 + $income16 + $income17 + $income18 + $income19 + $income20 + $income21 + $income22 + $income23 + $income24 + $income25 + $income26 + $income27 + $income28 + $income29 + $income30 + $income31 + $income32 + $income33 + $income34  + $income35 + $income36 + $income37 + $income38 + $income39 + $income40;
	 $_SESSION['total'] = $total;
	 $total = $_SESSION['total'];
	// sum for others 
	$to_select = "Others";
	$sum = "SELECT  SUM(total_amount) AS total_sum1 FROM transactions WHERE payment_date >= '$from_date' AND payment_date <= '$to_date' AND paid_for='$to_select' AND others IS NOT NULL";
	$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
	while($result1 = mysqli_fetch_array($sum2)){
		$sum_others[0] = $result1['total_sum1'];	
		
		foreach ($sum_others as $other_earn){
			if (!empty($other_earn)){
				$date_value = $other_earn;
				$_SESSION['other_earn'] = $other_earn;
				
			}
		}
	}
	// sum for grand total
	$sum = "SELECT  SUM(total_amount) AS total_sum1 FROM transactions WHERE payment_date >= '$from_date' AND payment_date <= '$to_date'";
	$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
	while($result1 = mysqli_fetch_array($sum2)){
		$sum_all[0] = $result1['total_sum1'];	
		
		foreach ($sum_all as $all_earn){
			if (!empty($all_earn)){
				$date_value = $all_earn;
				$_SESSION['all_earn'] = $all_earn;
				
			}
		}
	}
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Revenue Section|All</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li><a href="account_home.php">Home Page</a></li><br>
	  <li><a href="revenue.php">Income Summary</a></li><br>
	  <li><a href="revenue_all.php">Income Sum. (All)</a></li><br>
	  <li><a href="revenue_others.php">Income Sum. (Others)</a></li><br>
	  <li><a href="other_payments.php">View Other Payments</a></li><br>
      <li><a href="acc_logout.php">Logout</a></li><br>
    </ul>
	<img src="images/money.jpg" width="170px" height="250px" style="margin-left: 15px" alt="Account Session"><br><br>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1><br>
	   <?php echo $msg; ?>
	   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	  <div class="search_angle">
		<div class="total_earn">
			<h2 style='margin-top: auto; font-family: Calibri (Body); font-size: 18px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #FFFFFF'>Sum For All Payments</h2>
			<center><label style="font-family: monospace; font-size: 16px; font-weight: bold" >From</label>
			<input name="from_date" class="userarea0" type="text"  style="width: 150px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $from_date;} ?>">
			<label style="font-family: monospace; font-size: 16px; font-weight: bold">To</label>
			<input name="to_date" class="userarea0" type="text"  style="width: 150px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $to_date;} ?>"></center><br>
		<center><input type="submit" name="sum" class="submit4" value="Sum For All"></center><br>
		</div>
	   </div><br><br>
		<div class="product_formlist">
	  <table width="650px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>S|N</b></td>
		<td width="40%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total Payment For</b></td>
		<td width="40%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Income For Each Payment</b></td>
		</tr>
		<?php echo $dynamic_list; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br><br>
			<center><h3 class="heading_text">Total Income</h3></center>
			<center><input type="text"  id="total_earn_area" disabled="disabled" value="<?php if (isset($_POST['sum'])){echo "="." " ."N".$total;} ?>"></center><br>
			<center><h3 class="heading_text">Others</h3></center>
			<center><input type="text"  id="total_earn_area" disabled="disabled"value="<?php if (isset($_POST['sum'])){echo "="." " ."N".$other_earn;} ?>"></center><br><br>
			<center><h3 class="heading_text">Grand Total</h3></center>
			<center><input type="text"  id="total_earn_area" disabled="disabled" value="<?php if (isset($_POST['sum'])){echo "="." " ."N".$all_earn;} ?>"></center><br>
		</form><br>
		<form action="revenue_all_receipt.php?from=$from_date&to=$to_date" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
		<input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Receipt"></center>
	  </form><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	  </div>
     <?php include_once "footer.php"; ?>
	 
</body>
</html>