<?php
    ob_start();
    require_once "../db.php";
    unset($_SESSION['login']);
	unset($_SESSION['password']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    unset($_SESSION['email']);
    if(isset($_SESSION['admin'])){
        header("Location: admin_main.php");
    }

    // if(isset($_POST['login_adm'])&&isset($_POST['pass_adm'])){
    //     $login = $_POST['login_adm'];
    //     $pass = $_POST['pass_adm'];
    //     $check = mysqli_query($connection, "Select * From Users Where Login = '$login';");
    //     $check = mysqli_fetch_assoc($check);
    //     $login_db = $check['Login'];
    //     $pass_db = $check['Password'];
    //     $status = $check['Status'];
    //     if($login_db != NULL && $pass_db != NULL && $status == 1) {
    //         if($pass == $pass_db){
    //             echo "Всё верно";
    //             $admin = [
    //                 "login" => $login_db,
    //                 "password" => $pass_db,
    //                 "fname" => $check['FirstName'],
    //                 "sname" => $check['LastName'],
    //                 "email" => $check['Email'],
    //                 "status" => $check['Status']
    //             ];
    //             $_SESSION['admin'] = $admin;
    //             //header("Location: ");
    //             // echo "Успешно!";
    //             // echo '<script type="text/javascript">alert("Ураа!");</script>';
    //         }
    //         else{
    //             //echo "Пароль не подошёл!";
    //             echo '<script type="text/javascript">document.getElementById("myModal").style.display = "block";</script>';
    //         }
    //     }
    //     else{
    //         echo "Такого пользователя не существует!";
    //     }
    // }
    // else if(isset($_POST['login_adm'])){
    //     echo "введите пароль!";
    // }
    // else if(isset($_POST['pass_adm'])){
    //     echo "введите логин!";
    // }
    // else{
    //     echo "введите хоть что-нибудь!";
    // }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Panel</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
            function a(){
                var a = document.getElementById("myModal");
                a.style.display = 'none';
            }
            function b(temp){
                var messageBox = document.getElementById("textmessage");
                messageBox.innerHTML = temp;
                var a = document.getElementById("myModal");
                a.style.display = 'block';
            }
        </script>
        <script>
            $('a[data-toggle="pill"]').on('hidden.bs.tab', function (e) {
                console.log(e.target); // вкладка, которая стала активной
                console.log(e.relatedTarget); // предыдущая активная вкладка
            })
        </script>
    </head>
    <body >
        <?php
            require_once "admin_header.php";
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <p class="col-md-8 text-center" style="font-size: 200%; color:black; margin-top:2%;">Вход в панель управления сайтом</p>
                <div class="col-md-2"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4" style="margin-top: 3%; border: 1px gray solid; border-radius: 10px;">
                    <p class="text-center" style="font-size: 150%;">Авторизация</p>
                    <form method="POST" action="index.php" class="form-horizontal" style="margin: 1%;">
                        <div class="form-group has-success">
                                <label for="pass" class="col-sm-2 control-label">Логин*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-xs" id="login" placeholder="Введите логин" name="login_adm" required >
                                </div>
                        </div>
                        <div class="form-group has-success">
                                <label for="pass" class="col-sm-2 control-label">Пароль*</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control input-xs" id="pass" placeholder="Введите пароль" name="pass_adm" required>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <input type="submit" class="btn btn-success" value="Войти" name="auth"/> 
                            </div>
                            <div class="col-md-10 text-center" style="color: black; font-weight: bold; margin-top:1%;">* - Обязательно для заполнения</div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <div id="myModal" class="modal" tabindex="-1" style="display:none;">
				<div class="modal-dialog modal-sm">
				  	<div class="modal-content">
						<div class="modal-header">
						  <button class="close" data-dismiss="modal" onclick="document.getElementById('myModal').style.display = 'none';">х</button>
						  <h4 class="modal-title">Уведомление</h4>
						</div>
						<div class="modal-body" id="textmessage">
                            test
                        </div>
				  	</div>
				</div>
        </div>
        <?php
             if(isset($_POST['login_adm'])&&isset($_POST['pass_adm'])){
                $login = $_POST['login_adm'];
                $pass = $_POST['pass_adm'];
                $check = mysqli_query($connection, "Select * From Users Where Login = '$login';");
                $check = mysqli_fetch_assoc($check);
                $login_db = $check['Login'];
                $pass_db = $check['Password'];
                $status = $check['Status'];
                if($login_db != NULL && $pass_db != NULL && $status == 1) {
                    if($pass == $pass_db){
                        //echo "Всё верно";
                        $admin = [
                            "login" => $login_db,
                            "password" => $pass_db,
                            "fname" => $check['FirstName'],
                            "sname" => $check['LastName'],
                            "email" => $check['Email'],
                            "status" => $check['Status']
                        ];
                        $_SESSION['admin'] = $admin;
                        header("Location: admin_main.php");
                        // echo "Успешно!";
                        // echo '<script type="text/javascript">alert("Ураа!");</script>';
                    }
                    else{
                        //echo "Пароль не подошёл!";
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Неверный пароль!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                    }
                }
                else{
                    //echo "Такого пользователя не существует!";
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Пользователь не существует!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
        ?>
    </body>
</html>