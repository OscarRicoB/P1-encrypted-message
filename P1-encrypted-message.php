<?php
//Starting test
define("FILE_ROUTE","test-files/");
//Get the file and save it
if(!empty($_FILES['uploaded_file']))
{
  $path = FILE_ROUTE . basename( $_FILES['uploaded_file']['name']);

  if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
    $_POST['file_to_decrypt'] =basename( $_FILES['uploaded_file']['name']);
  } else{
      echo "There was an error uploading the file, please try again!<br>";
      exit;
  }
}
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
  if (count($ln1_arr) == 3) {
    if($ln1_arr[0] < 2 || $ln1_arr[0] > 50) //M1
      exit("Error: M1 need to be a number between 2 and 50");
    if($ln1_arr[1] < 2 || $ln1_arr[1] > 50) //M2
      exit("Error: M2 need to be a number between 2 and 50");
    if($ln1_arr[2] < 3 || $ln1_arr[2] > 5000) //N
      exit("Error: N need to be a number between 3 and 5000");
  }else {
    exit("Error: the first line can only have 3 integers M1, M2 and N not more neither less");
  }
  if (strlen($ln2) != $ln1_arr[0]) {
    exit("Error: the given character count for the first instruction is {$ln1_arr[0]} but the firts function have ".strlen($ln2)." characters");
  }
  if (strlen($ln3) != $ln1_arr[1]) {
    exit("Error: the given character count for the second instruction is {$ln1_arr[1]} but the firts function have ".strlen($ln3)." characters");
  }
  if(preg_match('/[^a-z0-9]/i', $ln4))
  {
    exit("Error: The four line containing the message can only contain characters that fits the regex [a-zA-Z0-9]");
  }
  $nln4 = preg_replace("/(.)\\1+/", "$1", $ln4);
  if (strlen($nln4) == $ln1_arr[2]) {
    $outputFile = fopen(FILE_ROUTE."output.txt", "w");
    fwrite($outputFile, (strpos($nln4, $ln2) !== false) ? "Si\n":"No\n");
    fwrite($outputFile, (strpos($nln4, $ln3) !== false) ? "Si\n":"No\n");
    fclose($outputFile);

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename(FILE_ROUTE."output.txt"));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize(FILE_ROUTE."output.txt"));
    readfile(FILE_ROUTE."output.txt");
    exit;
  }else {
    exit("Error: the number of characters of the message dont match");
  }
  fclose($fh);
}else {
  exit("Error: can't read file {$file_to_decrypt} at ".FILE_ROUTE.$file_to_decrypt);
}
