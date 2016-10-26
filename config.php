<?php
if($mysqli=mysqli_connect("localhost","root","","bank_management")){
    return true;
}else{
    return false;
}
?>