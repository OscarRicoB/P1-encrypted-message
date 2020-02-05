<?php
//Starting test
define("FILE_ROUTE","test-files/");
//Define the file to read
$file_to_decrypt = isset($_POST['file_to_decrypt']) ? $_POST['file_to_decrypt']:(isset($_GET['file_to_decrypt'])? $_GET['file_to_decrypt']:"file1.txt");

//Reading the file
$fh = @fopen(FILE_ROUTE.$file_to_decrypt,'r');
if ($fh) {
  $ln1 = rtrim(fgets($fh));
  $ln2 = rtrim(fgets($fh));
  $ln3 = rtrim(fgets($fh));
  $ln4 = rtrim(fgets($fh));
  $ln1_arr = explode(" ", $ln1);

  $nln4 = preg_replace("/(.)\\1+/", "$1", $ln4);
  if (strlen($nln4) == $ln1_arr[2]) {
    echo (strpos($nln4, $ln2) !== false) ? "Si<br>\n":"No<br>\n";
    echo (strpos($nln4, $ln3) !== false) ? "Si<br>\n":"No<br>\n";
  }else {
    // echo strlen($nln4). " != " .$ln1_arr[2]."<hr>";
    echo "Error: the number of characters of the message dont match<br>\n";
    exit;
  }
  //only for cycle
  // if (!feof($fh)) {
  //   echo "Error: unexpected fgets() fail\n";
  //   exit;
  // }
  fclose($fh);
}else {
  echo "Error: can't read file {$file_to_decrypt} at ".FILE_ROUTE.$file_to_decrypt."<br>\n";
  exit;
}
