<?php 
include_once "db.php"; 
header("content-type: text/html; charset=utf-8"); 
session_start(); 
if(isset($_SESSION['id'])){header("location: /");} 
if(isset($_POST['reg_ok'])){ 
    if($_POST['password'] != $_POST['password_2']){ 
        $_SESSION['msg'] = "Пароли не совпали!";} 
        else{ 
            if($_POST['name'] == '' || 
               $_POST['mail'] == '' || 
               $_POST['login'] == '' || 
               $_POST['password'] == ''){ 
                $_SESSION['msg'] = "Поля отмеченные * обязательны для заполнения!";} 
            else{ 
                $mail = $_POST['mail']; 
                $login = $_POST['login']; 
                $sql_res = mysql_query("SELECT id FROM reg WHERE login=`".$login."` OR mail=`".$mail."`") or die(mysql_error());
                if(mysql_num_rows($sql_res) != 0 ){ 
                    $_SESSION['msg'] = "Пользователь с таким логином или e-mail уже существует!";} 
                else{ 
                    $name = $_POST['name']; 
                    $mail = $_POST['mail']; 
                    $login = $_POST['login']; 
                    $password = $_POST['password']; 
                    $telefon = $_POST['telefon']; 
                    $ip = $_SERVER['REMOTE_ADDR']; 
                    mysql_query("INSERT INTO reg SET name=`".$name."`, 
                                                     mail=`".$mail."`, 
                                                     password=`".$password."`, 
                                                     telefon='telefon',
                                                     login=`".$login."`, 
                                                     ip=`".$ip."`"); 
                    $id = mysql_insert_id();
                    $sql_res = mysql_query("SELECT * FROM reg WHERE id=$id");
                    $arr = mysql_fetch_assoc($sql_res);			
                    $_SESSION['id'] = $arr['id']; 
                    $id = $_SESSION['id']; 
                    $usr = mysql_fetch_assoc(mysql_query("SELECT * FROM reg WHERE id=$id")); 
                    header("location: /"); exit;}}}} 
if(isset($_POST['avto_ok'])){ 
    $login = $_POST['login']; 
    $password = $_POST['password']; 
    $sql_res = mysql_query("SELECT * FROM reg WHERE login='$login'") or die(mysql_error());
    if(mysql_num_rows($sql_res) != 0 ){ 
        $arr = mysql_fetch_assoc($sql_res);
        if($arr['password'] === $password){ 
            $_SESSION['id'] = $arr['id']; 
            $id = $_SESSION['id']; 
            header("location: /"); exit;} 
        else{ 
            $_SESSION['msg'] = "Неверный логин и/или пароль!";}} 
            $_SESSION['msg'] = "Пользователь не найден!";}  


<?