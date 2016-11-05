<?php
require('usr_funcs.php');
require 'config.php';
session_start();
?>
    <?php
do_header("Bank Management Systems");
do_index_menu();
        if(!valid_user() && !valid_user_account_number()){
            $task=@$_GET['task'];
            if($task==''){

                if(!isset($_POST['submit'])){
                ?>
        <div class='container' style='margin-top:50px;'>
            <form class="form-signin" method='post'>
                <h2 class="form-signin-heading">Please sign in</h2>
                <div class="form-group">
                    <label for="formGroupExampleInput">User ID</label>
                    <input name='username' type="text" class="form-control" id="formGroupExampleInput" placeholder="Username"> </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Password</label>
                    <input name='password' type="password" class="form-control" id="formGroupExampleInput" placeholder="password"> </div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="cus_emp" id="gridRadios1" value="customer" checked> Customer </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="cus_emp" id="gridRadios2" value="employee"> Employee </label>
                    </div>
                </div>
                <button name='submit' class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>
        <?php
                }else{
                    try{
                        $username=$_POST['username'];
                        $password=$_POST['password'];
                        $cus_emp=$_POST['cus_emp'];
                        if(trim($username)=='' || trim($password)==''|| empty($username) || empty($password)){
                            throw new Exception("Please Enter the Form");
                        }
                        if($cus_emp=='customer'){
                            $sql="select username,account_number from user_customer where username='$username' and password='".sha1($password)."'";
                        }else{
                            $sql="select username,employee_id from user_employee where username='$username' and password='".sha1($password)."'";
                        }
                        if($result=$mysqli->query($sql)){
                            if($result->num_rows >0){
                               if($row=$result->fetch_array()){
                                   $_SESSION['valid_user']=$row[0];
                                   @$_SESSION['valid_user_id']=$row[1];
                                   $_SESSION['logged_in']=1;
                                   $_SESSION['user_type']=$cus_emp;
                                  //main_customer.php = main.php
                                   header("Location:main.php");
                               }else{
                                   throw new Exception("Something went wrong. Can't fetch Array.");
                               }
                            }else{
                                throw new Exception("Sorry, User not found");
                            }
                        }else{
                            throw new Exception(" User Not Found.");
                        }
                    } catch (Exception $ex) {
                        do_exp_content($ex->getMessage());
                    }
                }
                }
                if($task=='register'){
                    if(!isset($_POST['Rsubmit'])){
                    register_form();
                    }else{
                        try{
                            $username=$_POST['username'];
                            $pass1=$_POST['pass1'];
                            $pass2=$_POST['pass2'];
                            $account_number=(int)$_POST['account_number'];
                            if(empty($account_number) || trim($account_number) =='' || empty($username) || empty($pass1) || empty($pass2) || trim($username) =='' || trim($pass1)=='' || trim($pass2) ==''){
                                throw new Exception("Please Enter the form Correctly");
                            }
                            if($pass1!=$pass2){
                                throw new Exception("The Passwords Doesn't Match");
                            }
                            if(username_check($username)){
                                throw new Exception("The Username is Already Taken\n Please Choose a different name");
                            }/* if(strlen((string)$account_number)!=11){
                                throw new Exception ("The Account Number is Invalid.");
                            }*/
                            $sql="INSERT INTO user_accounts(username,password,account_number) values ('$username','".sha1($pass1)."',$account_number)";
                            if($mysqli->query($sql)){
                                    echo "You have been registered.Please ";
                                    echo "<a href='index.php'>Login </a>";

                            }else{
                                throw new Exception("Can't Execute the Query");
                            }
                        } catch (Exception $ex) {
                            do_exp_content($ex->getMessage());
                        }
                    }
                }
        }else{
            header("Location:/main.php");
        }
do_footer();
        ?>