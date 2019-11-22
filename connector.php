<?php
  $name = $_GET['name'];
  $purchase = $_GET['presentValue'];
  $deposit = $_GET['depositPaid'];
  $years= $_GET['years'];
  $rate = $_GET['interestRate'];
  $monthlypay = $_GET['monthyPayments'];
  $totalpay = $_GET['totalpay'];
  $interestpay = $_GET['interestpay'];


  //conntion to DB
  $connect= new mysqli('localhost', 'root','','homeloan');
  if ($connect->connect_error){
    die('connetion failed:' .$connect->connect_error);
  }else {
    $stmt= $connect->prepare("insert into loan (name,purchase, deposit, years, rate, monthlypay, interestpay,totalpay ) values(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sddidddd",$name ,$purchase ,$deposit ,$years,$rate,$monthlypay,$interestpay,$totalpay);
    $stmt->execute();
    $stmt->close();
    $connect->close();
  }
  header("Location:http://localhost/mydatabase/index.html ");
  die();
?>
