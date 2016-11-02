<?php
require 'config.php';
require 'usr_funcs.php';
session_start();
@$task=$_GET['task'];
if(!valid_user_check()){
    header("Location: index.php");
}
?>
    <?php 
if($_SESSION['user_type']=='customer'){
    do_header("PIGGY BANK");
?>
        <?php
        if(isset($_SESSION['logged_in'])){
            if($_SESSION['logged_in']==1){
                ?>
            <h1>Welcome to the Bank Page</h1>
            <?php
                unset($_SESSION['logged_in']);
            }else{
                unset($_SESSION['logged_in']);
            }
        }
do_menu($_SESSION['valid_user']);
        do_content();
        do_footer();
}else{
    do_header("PIGGY BANK");
?>
                <?php
        if(isset($_SESSION['logged_in'])){
            if($_SESSION['logged_in']==1){
                ?>
                    <h1>Welcome to the Bank Page</h1>
                    <?php
                unset($_SESSION['logged_in']);
            }else{
                unset($_SESSION['logged_in']);
            }
        }
        do_menu(generate_name());
        do_content_emp();
        do_footer();
}
?>