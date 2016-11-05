<?php
session_start();
require('usr_funcs.php');
require('config.php');
if(!valid_user_check()){
    header('Location:index.php');
}
@$loan_task=$_GET['loan_task'];
do_header('Loan');
do_menu($_SESSION['valid_user']);
do_loan_menu();
if(emp_check()){
  header("Location:index.php");
}
if($loan_task=='check'){
  check_loan();
}
if($loan_task==''){
  do_loan_content("LOAN","Achieve all your goals and aspirations with the right kind of help, exactly when you need it.");
}
if($loan_task=='request'){
  if(loan_active_check()){
    $data=active_loan_amount($_SESSION['valid_user_id']);
    do_loan_content("YOU HAVE AN ACTIVE LOAN OF $data","Come Back Later");
  }else{
    if(!isset($_POST['submit_loan'])){
    ?>
  <div class='container'>
    <h2 class="form-signin-heading">Please Enter An Amount</h2>
    <form method='post' class="form-inline">
      <div class="form-group">
        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
        <div class="input-group">
          <div class="input-group-addon">$</div>
          <input name='amount' type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
          <div class="input-group-addon">.00</div>
        </div>
      </div>
      <button type="submit" name='submit_loan' class="btn btn-primary">LOAN</button>
    </form>
  </div>
  <?php
    }else{
      try{
        $amount=(int)$_POST['amount'];
        $details=array();
        $details=loan_details($_SESSION['valid_user_id']);
        if(empty($details) || !is_array($details)){
          throw new Exception("Can't Fetch User Details");
        }
        if(trim($amount)=='' || empty($amount)){
          throw new Exception ("Fill Form Correctly");
        }
        if($amount<1000 || $amount >500000){
          throw new Exception("LIMIT EXCEEDED");
        }
        $balance=transfer_get_balance($_SESSION['valid_user_id']);
        $new_amount=$amount+$balance;
        $date=date("Y-m-d",time());
        $sql="INSERT INTO loan(customer_id,amount,account_number,loan_active,loan_date) values($details[0],$amount,$details[1],1,'$date')";
        $sql2="update account set balance=$new_amount where account_number=".$_SESSION['valid_user_id'];
        if(do_query($sql)&&do_query($sql2)){
          do_loan_content("LOAN WAS SUCCESSFUL","CLICK <a href='loan.php?loan_task=check'>HERE</a> TO CHECK.      ");
        }else{
          throw new Exception("SOMETHING WENT WRONG");
        }
      }catch(Exception $e){
        do_exp_content($e->getMessage());
      }
    }
  }
}
if($loan_task=='prev'){
  loan_prev();
}
do_footer();
?>