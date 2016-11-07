<?php
session_start();
require('usr_funcs.php');
require('config.php');

if(!valid_user_check()){
    header("Location: index.php");
}

@$get_task=$_GET['deposit_task'];

do_header("Deposit");
do_menu($_SESSION['valid_user']);
if(emp_check()){
  try{
    throw new Exception("RESTRICTED AREA");
  }catch(Exception $e){
    do_exp_content($e->getMessage());
    do_footer();
    exit();
  }
}
do_deposit_menu();
if($get_task==''){
  do_depo_content(strtoupper("deposit"),"Everything comes with a price. so Deposit");
}
if($get_task=='view_balance'){
  try{
                if($_SESSION['user_type']=='customer'){
                    $sql="SELECT account_number,customer_id,balance from account where account_number=".$_SESSION['valid_user_id']."";
                }else{
                    $sql="select * from employee where employee_id=".$_SESSION['valid_user'];
                }
            if($result=$mysqli->query($sql)){ 
                if($result->num_rows >0){
                    if($row=$result->fetch_array()){
    if(emp_check()){ account_emp(); }else{ ?>
  <table class='table table-striped'>
    <thead>
      <tr>
        <th colspan='2' class='table-inverse'>
          <center>Balance</center>
        </th>
      </tr>
    </thead>
    <tr>
      <td>Account Number: </td>
      <td>
        <?php echo $row[0]; ?>
      </td>
    </tr>
    <tr>
      <td>Customer Id: </td>
      <td>
        <?php echo $row[1]; ?>
      </td>
    </tr>
    <tr>
      <td>Balance: </td>
      <td>
        <?php echo $row[2]; ?>
      </td>
    </tr>
    <?php if($row[2]<10000){echo "<p><span style='color:red;'>*Your Amount should be greater than 10000</span></p>";} ?>
  </table>
  <?php
                    }
                    }else{
                        throw new Exception("Something Went Wrong. Can't fetch_array()");
                    }
                }else{
                    throw new Exception("Sorry You haven't entered the details yet.");
                }
            } else{
                throw new Exception("Something went wrong. Can't execute the query");
            }
        }catch(Exception $e){
                do_exp_content($e->getMessage());
            }
}
if($get_task=='prev_deposit'){
  ?>
    <table class='table table-bordered'>
      <tr>
        <th colspan='2' class='table-inverse'>
          <center>Deposit Details</center>
        </th>
      </tr>
      <?php
    try{
        $sql="select deposit_number,amount,date from deposit where account_number=".$_SESSION['valid_user_id']." and deposit_a=0";
        if($result=$mysqli->query($sql)){
            if($result->num_rows>0){
                while($row=$result->fetch_array()){
                    ?>
        <tr>
          <td>Deposit Number: </td>
          <td>
            <?php echo $row[0]; ?>
          </td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td>
            <?php echo $row[1]; ?>
          </td>
        </tr>
        <tr>
          <td>Date: </td>
          <td>
            <?php echo $row[2]; ?>
          </td>
        </tr>
        <tr>
          <td colspan='2'></td>
        </tr>
        <?php
                }
            }else{
                throw new Exception("You haven't Deposited anything yet");
            }
        }else{
            throw new Exception("Can't Execute the Query");
        }
    }catch(Exception $e){
        do_exp_content($e->getMessage());
    }
    
    ?>
    </table>
    <?php
}
if($get_task=='deposit'){
  if(!isset($_POST['submit_deposit'])){
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
          <button type="submit" name='submit_deposit' class="btn btn-primary">DEPOSIT</button>
        </form>
      </div>
      <?php
    }else{
      try{
        $amount=(int)$_POST['amount'];
        $details=array();
        $details=deposit_details($_SESSION['valid_user_id']);
        if(empty($details) || !is_array($details)){
          throw new Exception("Can't Fetch User Details");
        }
        if(trim($amount)=='' || empty($amount)){
          throw new Exception ("Fill Form Correctly");
        }
        if($amount<1000 || $amount >500000){
          throw new Exception("LIMIT EXCEEDED");
        }
        $date=date('Y-m-d');
        $depo="INSERT INTO deposit(customer_id,amount,account_number,date,deposit_a)  VALUES(".$details[0].",".$amount.",".$_SESSION['valid_user_id'].",'$date',1)";
        if($mysqli->query($depo)){
          do_depo_content("DEPOSIT WAS SUCCESSFUL","We're processing.      ");
        }else{
          throw new Exception("Something Went Wrong Please Try again Later");
        }
        //$amount+=$details[1];
        //$sql="UPDATE account set balance=$amount where account_number=".$_SESSION['valid_user_id'];
        /*if($result=$mysqli->query($sql)){
          do_depo_content("DEPOSIT WAS SUCCESSFUL","We're processing.      ");
        }else{
          throw new Exception("SOMETHING WENT WRONG");
        } */
      }catch(Exception $e){
        do_exp_content($e->getMessage());
      }
    }
}
do_footer();
?>