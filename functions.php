<?php
    function injProtect($conn,$temp){
        if (get_magic_quotes_gpc()){
            $temp = stripcslashes($temp);
        }
        return mysqli_real_escape_string($conn,$temp);
    }


?>