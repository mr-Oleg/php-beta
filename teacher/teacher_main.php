<?php
    error_reporting(0);

    require_once "../db.php";
    if ($_SESSION['teacher']['type']!=2) {
        header("Location: index.php");
    }

    if (isset($_POST['edit_name'])) {
        unset($_POST['edit_name']);
        $new_fname = htmlentities($_POST['new_fname']);
        $new_lname = htmlentities($_POST['new_lname']);
        $login = $_SESSION['teacher']['login'];
        if (strlen(trim($new_fname))<1 || strlen(trim($new_lname))<1) {
            echo '<script language="javascript">
                    alert("Введены некорректные данные.")
                </script>';
        } else {
            $query = "UPDATE Users SET LastName = '$new_lname', FirstName = '$new_fname' WHERE Login = '$login';";
             //echo $query;
             //echo "<br/>";
            $res = mysqli_query($connection, $query);
            if ($res == true) {
                // echo "<br/><br/>";
                // echo "asdasdasd";
                // echo "<br/><br/>";
                $_SESSION['teacher']['fname'] = $new_fname;
                $_SESSION['teacher']['sname'] = $new_lname;
                header("Refresh: 0");
            } else {
                 // echo "не изменили имя";
                 // echo "<br/>";
            }
        }
    }
    if (isset($_POST['edit_pass'])) {
        unset($_POST['edit_pass']);
        $cur_pass = htmlentities($_POST['cur_pass']);
        $new_pass1 = htmlentities($_POST['new_pass1']);
        $new_pass2 = htmlentities($_POST['new_pass2']);
        $login = $_SESSION['teacher']['login'];
        if (strcmp($new_pass1, $new_pass2) != 0) {
            echo '<script language="javascript">
                    alert("Пароли не совпадают.")
                </script>';
        } elseif (strlen($new_pass1)<6) {
            echo '<script language="javascript">
                    alert("Некорретный новый пароль.")
                </script>';
        } else {
            $res = mysqli_query($connection, "SELECT `Password` FROM Users WHERE Login = '$login';");
            $pass_from_db = mysqli_fetch_assoc($res);
            #print_r($pass_from_db);
            if (strcmp($pass_from_db['Password'], $cur_pass) != 0) {
                echo '<script language="javascript">
                        alert("Введен неверный действующий пароль.")
                    </script>';
            } else {
                $query = "UPDATE Users SET `Password` = '$new_pass1' WHERE Login = '$login';";
                $res = mysqli_query($connection, $query);
            if ($res == true) {
                echo '<script language="javascript">
                        alert("Пароль изменен.")
                    </script>';
                header("Refresh: 0");
            } else {
                // echo "не изменили имя";
                // echo "<br/>";
            }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Teacher Panel</title>
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

<?php

	require_once("header.php");
?>


	<body>
        <?php //print_r($_SESSION); ?>
		<div class="container">
			<div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 text-right">
                            Имя:
                        </div>
                        <div class="col-md-6 text-left">
                            <?php echo $_SESSION['teacher']['fname']; ?>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-6 text-right">
                            Фамилия:
                        </div>
                        <div class="col-md-6 text-left">
                            <?php echo $_SESSION['teacher']['sname']; ?>
                        </div>
                    </div>
                    <br/>
                    <div class="row text-center">
                        <button class="btn btn-success" onclick="show_edit_name()">Сменить имя</button>
                    </div>
                    <br/>
                    <div class="row text-center">
                        <button class="btn btn-success" onclick="show_edit_pass()">Сменить пароль</button>
                    </div>
                </div>
                <div class="col-md-8">

                    <form action="teacher_main.php" method="POST" class="form-horizontal" id="change_name" style="display: none;">
                        <div class="form-group has-success">
                            <label for="pass" class="col-sm-4 control-label">Новое имя</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-xs" placeholder="Введите имя" name="new_fname">
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label for="pass" class="col-sm-4 control-label">Новая фамилия</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-xs" placeholder="Введите фамилию" name="new_lname">
                            </div>
                        </div>
                        <div class="col-sm-10"></div>
                        <input type="submit" class="btn btn-success" value="Изменить" name="edit_name"/> 
                    </form>
                        
                    <form action="teacher_main.php" method="POST" class="form-horizontal" id="change_pass" style="display: none;">
                        <div class="form-group has-success">
                            <label for="pass" class="col-sm-4 control-label">Введите действующий пароль</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control input-xs" placeholder="Введите действующий пароль" name="cur_pass" >
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label for="pass" class="col-sm-4 control-label">Введите новый пароль</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control input-xs" placeholder="Введите новый пароль" name="new_pass1">
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label for="pass" class="col-sm-4 control-label">Повторите новый пароль</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control input-xs" placeholder="Повторите новый пароль" name="new_pass2">
                            </div>
                        </div>
                        <div class="col-sm-10"></div>
                        <input type="submit" class="btn btn-success" value="Изменить" name="edit_pass"/> 
                    </form>      
                </div>
			</div>
            <div class="row text-center">
                <p style="font-size: 120%">Ваши курсы</p>
                <div class="col-md-12" style="height: 350px; overflow: scroll;">
                    <?php
                        $teacher_login = $_SESSION['teacher']['login'];
                        $courses = mysqli_query($connection, "SELECT * FROM Users u JOIN Course c ON c.Teacher = u.ID WHERE Login = '$teacher_login';");
                        // print_r($courses);
                        // echo "<br/>";
                        while ($result = mysqli_fetch_assoc($courses)) {
                            $course_id = $result['ID'];
                            $count_pupil = mysqli_query($connection, "SELECT * FROM Course c JOIN Pupil p ON c.ID = p.CourseID WHERE c.ID = $course_id AND isAccepted = 1;");
                            // print_r($result);
                            // echo "<br/>";
                            echo "<div class='col-sm-12 text-center' style='margin-top: 5px; border: 1px solid;'>
                                    <p><strong>Название: </strong>".$result['Title']."</p>
                                    <p><strong>Описание: </strong>".$result['Description']."</p>
                                    <img src='../courses_pic/".$result['Image']."' style='width: 300px; height: 200px;'>
                                    <p><strong>На курс подписано</strong> ".mysqli_num_rows($count_pupil)." учеников</p>
                                    </div>";
                        }
                    ?>
                </div>
            </div>
		</div>
	</body>


    <script type="text/javascript">
        function show_edit_name(){
            document.getElementById('change_name').style.display = 'block';
            document.getElementById('change_pass').style.display = 'none';
        }

        function show_edit_pass(){
            document.getElementById('change_name').style.display = 'none';
            document.getElementById('change_pass').style.display = 'block';
        }
    </script>

</html>