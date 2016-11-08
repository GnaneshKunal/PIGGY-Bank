<?php
session_start();
require('usr_funcs.php');
require('config.php');

if(!valid_user_check()){
    header("Location: index.php");
}

$user=generate_name();
do_header('Dependent');
do_menu($user);
@$task=($_GET['task']);
if($task==''){
  try{
    if($_SESSION['user_type']=='employee'){
        $sql="select b.customer_name,b.customer_address,a.account_number,a.customer_id,a.balance,a.account_type from account as a,customer as b,employee as c where a.customer_id=b.customer_id and b.customer_name=c.dependent_name and c.employee_id=".$_SESSION['valid_user_id'];
        if($result=$mysqli->query($sql)){
            if($result->num_rows>0){
                if($row=$result->fetch_array()){
                    ?>
  <table class='table table-striped'>
    <thead>
      <tr>
        <th colspan='2' class='table-inverse'>
          <center>My Dependent</center>
        </th>
      </tr>
    </thead>
    <tr>
      <td>Name: </td>
      <td>
        <?php echo $row[0]; ?>
      </td>
    </tr>
    <tr>
      <td>Address: </td>
      <td>
        <?php echo $row[1]; ?>
      </td>
    </tr>
    <tr>
      <td>Account Number: </td>
      <td>
        <?php echo $row[2]; ?>
      </td>
    </tr>
    <tr>
      <td>Customer ID: </td>
      <td>
        <?php echo $row[3]; ?>
      </td>
    </tr>
    <tr>
      <td>Balance: </td>
      <td>
        <?php echo $row[4]; ?>
      </td>
    </tr>
    <tr>
      <td>Account Type: </td>
      <td>
        <?php echo $row[5]; ?>
      </td>
    </tr>
    <tr>
      <td>DEPOSIT:</td>
      <td>
      
        <?php
          if(dep_cus_check(dep_get_cus_deposit($_SESSION['valid_user_id']))){
        ?><a class="btn btn-primary btn-sm" href="dependent.php?task=deposit">DEPOSIT</a>
        <?php
          }else{
            echo "NO DEPOSIT";
          }     
        ?>
        
      </td>
    </tr>
    <tr>
      <td>LOAN: </td>
      <td>
      <?php
          if(dep_cus_loan_check(dep_get_loan_details($_SESSION['valid_user_id']))){
        ?><a class="btn btn-primary btn-sm" href="dependent.php?task=loan">LOAN</a>
        <?php
          }else{
            echo "NO LOANS";
          }     
        ?>
      </td>
    </tr>
  </table>
  <?php
                }else{
                    throw new Exception("Can't fetch Array");
                }
            }else{
                throw new Exception("Something Went Wrong");
            }
        }else{
            throw new Exception("Can't Run the Query");
        }
    }else{
        throw new Exception("Restricted Area");
    }
}catch(Exception $e){
    do_exp_conent($e->getMessage());
}
}
if($task=='deposit'){
  $details=dep_get_cus_deposit($_SESSION['valid_user_id']);
  if($details[0]==1){
    $dep_no=$details[1];
  $dep_amount=$details[3];
  $dep_balance=dep_balance($details[4]);
  $amount_new=$dep_amount+$dep_balance;
  $sql="update deposit set deposit_a=0 where deposit_number=$dep_no and deposit_a=1";
  $sql2="update account set balance=$amount_new where account_number=".$details[4];
  if(do_query($sql)&&do_query($sql2)){
    header('Location:dependent.php');
  }else{
    echo "SOMETHING WENT WRONG";
  }
  }
}
if($task=='loan'){
  
  $details=dep_get_loan_details($_SESSION['valid_user_id']);
  $interest=0.0005;
  
  $k=time();
  $date=date('d-M-y',strtotime($details[5]));
  $m=strtotime($date);
  $datediff=$k-$m;
  $days=floor($datediff / (60 * 60 * 24));
  
  $balance=dep_balance($details[2]);
  $loan_modified=$details[3]+$details[3]*$days*$interest;
  $amount_final=$balance-$loan_modified;
  $sql="update loan set loan_active=0 where account_number=".$details[2]." and loan_active=1";
  $sql2="update account set balance=$amount_final where account_number=".$details[2];
  if(do_query($sql)&&do_query($sql2)){
    header('Location:dependent.php');
  }else{
    echo "SOMETHING WENT WRONG";
  }
}
do_footer();
?>