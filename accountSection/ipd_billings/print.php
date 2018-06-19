<?php 
session_start();
ob_start();
// this will refer user to the last visited page
$last_url = basename($_SERVER['PHP_SELF']);
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: ipd_billings_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `ipd_billings` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// block for receipt
$ipd_no = $_SESSION['ipd_no'];
$search = $_SESSION['search'];
if (isset($_GET['ipd_no'])){
	$ipd_nu = $_GET['ipd_no'];
}

$sql8="SELECT * FROM `ipd_billings_form` WHERE ipd_no='".$ipd_nu."' AND ipd_no='".$ipd_no."' OR ipd_no='".$search."'";
$check8 = mysqli_query($dbconnect, $sql8);
$resultCount8=mysqli_num_rows($check8); //count the out amount 
if($resultCount8>0){
	while($row=mysqli_fetch_array($check8)){
		$name_2=$row["name"];
		$ipd_no=$row["ipd_no"];
		$ipd_nu=$row["ipd_no"];
		$deposit=$row["deposit"];
		$amount1=$row["amount1"];
		$amount2=$row["amount2"];
		$amount3=$row["amount3"];
		$amount4=$row["amount4"];
		$amount5=$row["amount5"];
		$amount6=$row["amount6"];
		$amount7=$row["amount7"];
		$amount8=$row["amount8"];
		$amount9=$row["amount9"];
		$amount10=$row["amount10"];
		$amount11=$row["amount11"];
		$amount12=$row["amount12"];
		$amount13=$row["amount13"];
		$amount14=$row["amount14"];
		$amount15=$row["amount15"];
		$amount16=$row["amount16"];
		$amount17=$row["amount17"];
		$amount18=$row["amount18"];
		$amount19=$row["amount19"];
		$amount20=$row["amount20"];
		$amount21=$row["amount21"];
		$amount22=$row["amount22"];
		$amount23=$row["amount23"];
		$amount24=$row["amount24"];
		$amount25=$row["amount25"];
		$amount26=$row["amount26"];
		$amount27=$row["amount27"];
		$amount28=$row["amount28"];
		$amount29=$row["amount29"];
		$amount30=$row["amount30"];
		$amount31=$row["amount31"];
		$amount32=$row["amount32"];
		$amount33=$row["amount33"];
		$amount34=$row["amount34"];
		$amount35=$row["amount35"];
		$amount36=$row["amount36"];
		$amount37=$row["amount37"];
		$amount38=$row["amount38"];
		$amount39=$row["amount39"];
		$amount40=$row["amount40"];
		$amount41=$row["amount41"];
		$amount42=$row["amount42"];
		$amount43=$row["amount43"];
		$amount44=$row["amount44"];
		$amount45=$row["amount45"];
		$amount46=$row["amount46"];
		$amount47=$row["amount47"];
		$amount48=$row["amount48"];
		$amount49=$row["amount49"];
		$amount50=$row["amount50"];
		$amount51=$row["amount51"];
		$amount52=$row["amount52"];
		$amount53=$row["amount53"];
		$amount54=$row["amount54"];
		$amount55=$row["amount55"];
		$amount56=$row["amount56"];
		$amount57=$row["amount57"];
		$amount58=$row["amount58"];
		$amount59=$row["amount59"];
		$amount60=$row["amount60"];
	}
}
$amount_total = $amount1 + $amount2 + $amount3 + $amount4 + $amount5 + $amount6 + $amount7 + $amount8 + $amount9 + $amount10 + $amount11 + $amount12 + $amount13 + $amount14 + $amount15 + $amount16 + $amount17 + $amount18 + $amount19 + $amount20 + $amount21 + $amount22 + $amount23 + $amount24 + $amount25 + $amount26 + $amount27 + $amount28 + $amount29 + $amount30 + $amount31 + $amount32 + $amount33 + $amount34 + $amount35 + $amount36 + $amount37 + $amount38 + $amount39 + $amount40 + $amount41 + $amount42 + $amount43 + $amount44 + $amount45 + $amount46 + $amount47 + $amount48 + $amount49 + $amount50 + $amount51 + $amount52 + $amount53 + $amount54 + $amount55 + $amount56 + $amount57 + $amount58 + $amount59 + $amount60 ;
if ($deposit > $amount_total){
	$total = abs($amount_total - $deposit) . "CR";
} else {
	$total = $amount_total - $deposit;
} 

// $converter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
// $in_word = $converter->format($total);

// convert number to word
function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}
$in_word = convertNumberToWord($total);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Receipt</title>
</head>
<body>
<div id="receipt_wrapper" style="width: 272px; height: 756px; margin-left: auto; margin-right: auto">
	<center><label style="font-family: arial; font-size: 13px; text-transform: uppercase">Bowen University Teaching Hospital, ogbomoso</label></center>
	<p style="text-align: center; font-family: arial; font-size: 12px; text-transform: uppercase">Account Department</p>
	<p style="text-align: center; font-family: Calibri (Body);  font-size: 14px"><?php echo "Date : " . " ". date("l jS \of F Y"); ?></p>
	<p style="text-align: center; monospace; font-weight: bold; font-weight: bold; font-size: 14px; text-transform: uppercase; text-decoration: underline">up to date bill</p>
	<table width="270px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
	<tr>
		<td width="50%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 15px; text-transform: uppercase">ipd</label></td>
		<td width="50%"><label style="font-family: Calibri (Body);  margin-left: 20px; font-size: 15px"><?php echo $ipd_no; ?></label></td>
	</tr>
	<tr>
		<td width="50%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 15px; text-transform: uppercase">Name</label></td>
		<td width="50%"><label style="font-family: Calibri (Body);  margin-left: 20px; font-size: 15px"><?php echo $name_2; ?></label></td>
	</tr>
	<tr>
		<td width="50%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 15px; text-transform: uppercase">Amount</label></td>
		<td width="50%"><label style="font-family: Calibri (Body); margin-left: 20px; font-size: 15px"><?php echo "N" . $amount_total; ?></label></td>
	</tr>
	<tr>
		<td width="50%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 15px; text-transform: uppercase">Less Deposit</label></td>
		<td width="50%"><label style="font-family: Calibri (Body);  margin-left: 20px; font-size: 15px"><?php echo "N" . $deposit; ?></label></td>
	</tr>
	<tr>
		<td width="50%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 15px; text-transform: uppercase">Amount to pay</label></td>
		<td width="50%"><label style="font-family: Calibri (Body);  margin-left: 20px; font-size: 15px"><?php echo "N" . $total; ?></label></td>
	</tr>
	<tr>
		<td width="50%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 15px; text-transform: uppercase">Amount in words</label></td>
		<td width="50%"><label style="font-family: Calibri (Body);  margin-left: 20px; font-size: 15px;"><?php echo ucwords($in_word) . " " . "Naira"; ?></label></td>
	</tr>
	</table>
	<center><p style="text-align: center; font-family: monospace; font-weight: normal; font-size: 15px">Signed <?php echo $name; ?></p></center>
	<center><p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p></center>
	</div>
</body>
</html>