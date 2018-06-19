<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: cashier_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `cashier` WHERE `username_id`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["password"];
	$firstname=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// block for receipt
$receipt = "";
$sql8="SELECT patient_name, payment_date FROM `transactions` WHERE receipt_no1='".$_SESSION['result3']."'";
$check8 = mysqli_query($dbconnect, $sql8);
$resultCount8=mysqli_num_rows($check8); //count the out amount 
if($resultCount8>0){
	while($row=mysqli_fetch_array($check8)){
	$received=$row["patient_name"];
	$payment_date = $row["payment_date"];
	}
}
$sql8="SELECT * FROM `transactions` WHERE `patient_name`='$received' AND `payment_date`='$payment_date' LIMIT 1";
$check8 = mysqli_query($dbconnect, $sql8);
$resultCount8=mysqli_num_rows($check8); //count the out amount 
if($resultCount8>0){
	while($row=mysqli_fetch_array($check8)){
	$receipt_id=$row["receipt_no1"];
	$amount_collected=$row["amount_tendered"];
	$amount_to_pay=$row["total_amount"];
	$charges=$row["total_amount2"];
	$discountOff=$row["discount"];
	$being_pay_for=$row["paid_for"];
	$others=$row["others"];
	$receivedBy=$row["received_by"];
	
	$change = $amount_collected - $amount_to_pay;
	// $converter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
	// $in_word = $converter->format($amount_to_pay);
	// get amount in words
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
	$in_word = convertNumberToWord($amount_to_pay);
	$receipt .= '<div class="receipt_stuffs" style="border: 1px dashed #000000; padding: 3px; min-height: 130px;">';
	$receipt .= '<label style="font-family: arial black; font-size: 14px">Charges: <span style="float: right; font-family: arial">'."N" .$charges.'</span></label><br>';
	$receipt .= '<label style="font-family: arial black; font-size: 14px">Payment: <span style="float: right; font-family: arial">'."@" .$discountOff.'</span></label><br>';
	$receipt .= '<label style="font-family: arial black; font-size: 14px">Amount Collected: <span style="float: right; font-family: arial">'."N" .$amount_collected.'</span></label><br>';
	$receipt .= '<label style="font-family: arial black; font-size: 14px">Change: <span style="float: right; font-family: arial">'."N" .$change.'</span></label><br>';
	$receipt .= '<label style="font-family: arial black; font-size: 13px">Amount in words: <span style="float: right; font-family: arial">' .ucwords($in_word). " " . "Naira".'</span></label><br><br>';
	$receipt .= '<center><span style="font-family: arial black; float: right"><b>Total Payment Made:</b>'." " . "N" . $amount_to_pay.'</span></center><br><br>';
	$receipt .= '</div>';
	}
}


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
			<p style="text-align: center; font-family: arial; font-size: 12px; text-transform: uppercase">Payment Receipt</p>
			<p style="font-family: Calibri (Body); font-weight: bold; font-size: 14px"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
			<label style="font-family: Calibri (Body); font-weight: bold; font-size: 14px"><?php echo "Payed By:" . " " .$received; ?></label><br>
			<label style="font-family: arial black; text-align: center; font-size: 11px;  text-transform: uppercase"><?php echo  "Being Pay For" . " " . "[".$being_pay_for ."-" .$others."]"; ?></label>
			<?php echo $receipt; ?><br>
			<center><label><span style="font-family: arial"><?php echo "Received By" . " " . $receivedBy; ?></span></label></center>
			<center><label style='font-family: Bradley Hand ITC; font-size: 24px'>signed</label><center>
			<p style="font-family: arial black; text-align: center; font-size: 11px;  text-transform: uppercase"><?php echo  "Receipt No:" . " ".$receipt_id; ?></p>
			<center><p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered and Designed by ICT BUTH</p></center>
			<center><a href="http://localhost/buth_net/accountSection/general_payment.php">Back</a></center>
		</div>
	</body>
</html>

