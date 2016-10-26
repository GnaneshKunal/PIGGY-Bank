<?php
function do_header($title){
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            <?php echo $title; ?>
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
        <style type="text/css">
            .selector-for-some-widget {
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
            }
            
            .temp1,
            .temp2 {
                margin-top: 150px;
            }
        </style>
    </head>

    <body>


        <?php
}
function do_content(){
    ?>
            <section id="about" class="about temp1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2>KEEP CALM AND BELIEVE IN US</h2>
                            <p class="lead">We Protect you and your money even when you are asleep <a style='text-decoration:none;' href="#">PIGGY BANK</a>.</p>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </section>
            <?php
}
function do_content_emp(){
    ?>
            <section id="about" class="about temp1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2>BANKING IS NECESSARY</h2>
                            <p class="lead">Customer satisfaction is worthless. Customer loyalty is priceless. <a style='text-decoration:none;' href="#">PIGGY BANK</a>.</p>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </section>
            <?php
}
function do_footer(){
    ?>
                <hr class='temp2'>
                <div class="container marketing">
                    <footer>
                        <p>&copy; 2016 PIGGY BANK, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
                    </footer>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
}
function do_exp_content($e){
    echo "<div class='container' style='margin-top:50px;'> $e </div>";
}
function do_index_menu(){
    ?>
        <center>
            <nav class="navbar navbar-light bg-faded">
                <div class="navbar-header">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <a class="navbar-brand" href="main.php">
                        <h2>PIGGY BANK</h2>
                    </a>
                </div>
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link active" href="index.php">Login</a>
                    <a class="nav-item nav-link active" href="index.php?task=register">Register</a>
                </div>
            </nav>
        </center>
        <?php
}
function do_menu($user){
    ?>
            <center>
                <nav class="navbar navbar-light bg-faded">
                    <div class="navbar-header">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <a class="navbar-brand" href="main.php">
                            <h2>PIGGY BANK</h2>
                        </a>
                    </div>
                    <div class="nav navbar-nav">
                        <span class="nav-item nav-link active">
                            <?php echo ucfirst($user); ?>
                        </span>
                        <a class="nav-item nav-link active" href="account.php">Account</a>
                        <a class="nav-item nav-link active" href="branch.php">Branch</a>
                        <a class="nav-item nav-link active" href="customer.php">customer</a>
                        <a class="nav-item nav-link active" href="employee.php">Employee</a>
                        <?php
                        if($_SESSION['user_type']!='employee'){
                            ?>
                        
                        <a class="nav-item nav-link active" href="interest_rates.php.php">interest_rates</a>
                        <a class="nav-item nav-link active" href="loan.php">Loan</a>
                        <a class="nav-item nav-link active" href="account_type.php">account_type</a>
                        <?php
                        }
                            ?>
                        <a class="nav-item nav-link active" href="logout.php">Log_out</a>
                    </div>
                </nav>
            </center>
            <?php
}
function register_form(){
    ?>
                <div class='container' style='margin-top:50px;'>
                    <form method='post' action='index.php?task=register'>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Username</label>
                            <input name='username' type="text" class="form-control" id="formGroupExampleInput" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Password</label>
                            <input type="password" name='pass1' class="form-control" id="formGroupExampleInput2" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Confirm Password</label>
                            <input type="password" name='pass2' class="form-control" id="formGroupExampleInput2" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Account Number:</label>
                            <input name='account_number' type="text" name='pass2' class="form-control" id="formGroupExampleInput2" placeholder="Account Number">
                        </div>
                        <button name='Rsubmit' type="submit" class="btn btn-lg btn-primary btn-block">Register</button>

                    </form>
                </div>
                <?php
}
function username_check($user){
    global $mysqli;
    $sql="select username from user_accounts where username='$user'";
    if($result=$mysqli->query($sql)){
        if($row=$result->num_rows>0){
            return true;
        }else{
            return false;
        }
    }else{
        echo "Can't Execute Query";
    }
}
function generate_name(){
    global $mysqli;
    if($_SESSION['user_type']='employee'){
        $sql="select employee_name from employee where employee_id=".$_SESSION['valid_user'];
        if($result=$mysqli->query($sql)){
            if($row=$result->fetch_array()){
                return $row[0];
            }
        }
    }
}
function valid_user(){
    if(isset($_SESSION['valid_user'])){
        if(trim($_SESSION['valid_user'])!=''){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function valid_user_account_number(){
    if(isset($_SESSION['valid_user_account_number'])){
        if(trim($_SESSION['valid_user_account_number'])!=''){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function view_account($user,$account_number){
    try{
        $account_number=(int)$account_number;
        if(!valid_user()){
            throw new Exception("You have to be signed in to view this.");
        }
        if(!valid_user_account_number()){
            throw new Exception("Something Went Wrong. <br />You have to be signed in to view this.");
        }
        $sql="SELECT * from account where account_number=$account_number";
        if($result=$mysqli->query($sql)){ 
            if($result->num_rows >0){
                if($row=$result->fetch_array()){
                    ?>
                    <table>
                        <tr>
                            <td>Username: </td>
                            <td>
                                <?php echo $user; ?>
                            </td>
                        </tr>
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
                                <?php echo $row[1]; ?>
                            </td>
                        </tr>
                    </table>
                    <?php
                }else{
                    throw new Exception("Something Went Wrong. Can't fetch_array()");
                }
            }else{
                throw new Exception("Sorry You haven't entered the details yet.");
            }
        } else{
            throw new Exception("Something went wrong. Can't execute the query");
        }
    } catch (Exception $ex) {
        do_exp_content($ex->getMessage());
    }
}
function valid_user_check(){
    if(isset($_SESSION['valid_user']) && isset($_SESSION['valid_user_account_number'])){
        if($_SESSION['valid_user']!='' && $_SESSION['valid_user_account_number']!=''){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function emp_check(){
    if($_SESSION['user_type']=='employee'){
        return true;
    }else{
        return false;
    }
}
function account_cus_emp(){
    if(emp_check()){
        $details=['Employee Id: ','Name: ','Telephone: ','Start Date: ','Dependent Name: '];
    }else{
        $details=['Username','Account No.','Customer Id:','Balance: '];
    }
    return $details;
}

function account_emp(){
    global $row;
    global $detail;
    ?>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th colspan='2' class='table-inverse'>
                    <center>Account Details</center>
                </th>
            </tr>
        </thead>
        <tr>
            <td><?php echo $detail[0]?> </td>
            <td>
                <?php echo $_SESSION['valid_user']; ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $detail[1]; ?> </td>
            <td>
                <?php echo $row[1]; ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $detail[2]; ?> </td>
            <td>
                <?php echo $row[2]; ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $detail[3]; ?></td>
            <td>
                <?php echo $row[3]; ?>
            </td>
        </tr>
        <?php
        if(emp_check()){
            ?>
        <tr>
            <td><?php echo $detail[4] ?> </td>
            <td>
                <?php echo $row[4]; ?>
            </td>
        </tr>
</table>
        <?php
        }
}
?>