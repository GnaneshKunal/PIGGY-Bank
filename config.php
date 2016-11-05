<?php
if($mysqli=mysqli_connect("localhost","root","","piggy_bank")){
    return true;
}else{
    return false;
}
?>