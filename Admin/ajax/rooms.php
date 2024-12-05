<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if(isset($_POST['add_room']))
{
    $frm_data=filteration($_POST);
    $flag=0;
    $query = "INSERT INTO `rooms`(`name`, `department`, `description`) VALUES (?,?,?)";
    $values = [$frm_data['name'],$frm_data['department'],$frm_data['description']];

    $stmt = $pdo->prepare($query);
    $res = $stmt->execute($values);

    if($res)
    {
        
    }
}