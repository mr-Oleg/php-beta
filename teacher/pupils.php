<?php
    require_once "../db.php";
    if ($_SESSION['teacher']['type']!=2) {
        header("Location: index.php");
    }
    // print_r($_POST);
    // echo "<br/>";
    if (isset($_POST['accept'])) {
        unset($_POST['accept']);
        $login_user = $_POST['login'];
        $id_course = $_POST['course'];
        $get_id_query = mysqli_query($connection, "SELECT * FROM Users WHERE Login = '$login_user'");
        $get_id_query_result = mysqli_fetch_assoc($get_id_query);
        $id_user = $get_id_query_result['ID'];
        $update_query = mysqli_query($connection, "UPDATE Pupil SET isAccepted = 1 WHERE UserID = $id_user AND CourseID = $id_course;");

        $get_id_pupil = mysqli_query($connection, "SELECT * FROM Pupil WHERE UserID = $id_user AND CourseID = $id_course");
        $get_id_pupil_result = mysqli_fetch_assoc($get_id_pupil);
        $id_pupil = $get_id_pupil_result['ID'];
        // echo "<br/>";
        // print_r($get_id_pupil_result);
        // echo "<br/>";

        $course_with_lections = mysqli_query($connection, "SELECT * FROM Course c JOIN Lections l ON l.CourseID = c.ID WHERE c.ID = $id_course;");
        // $course_with_lections_result = mysqli_fetch_assoc($course_with_lections);
        // echo "<br/><br/><br/>";
        // print_r($course_with_lections_result);
        // echo "<br/><br/><br/>";
        while ($course_with_lections_result = mysqli_fetch_assoc($course_with_lections)) {
            $id_lection = $course_with_lections_result['ID'];
            // echo "<br/>";
            // echo $id_lection." ".$id_user;
            // echo "<br/>";
            $insert_query = mysqli_query($connection, "INSERT INTO Progress (PupilID, Result, LectionID) VALUES ($id_pupil, 0, $id_lection);");
            // echo "<br/>";
            // print_r($insert_query);
            // echo "--------------------<br/>";
        }

        $message = "Здравствуйте!</br> Поздравляем! Вы зачислены на курс.";
        $subject = "ПДД 2019";
        $email = $get_id_query_result['Email'];
        $to = $email;
        $from  = 'From: pdd2019@admin.ru'."\r\n";
        mail($to, $subject, $message,$from);
    }
    if (isset($_POST['decline'])) {
        unset($_POST['decline']);
        $login_user = $_POST['login'];
        $id_course = $_POST['course'];
        $get_id_query = mysqli_query($connection, "SELECT * FROM Users WHERE Login = '$login_user'");
        $get_id_query_result = mysqli_fetch_assoc($get_id_query);
        $id_user = $get_id_query_result['ID'];
        $update_query = mysqli_query($connection, "DELETE FROM Pupil WHERE UserID = $id_user AND CourseID = $id_course;");

        $message = "Здравствуйте!</br> К сожалению Вы не зачислены на курс.";
        $subject = "ПДД 2019";
        $email = $get_id_query_result['Email'];
        $to = $email;
        $from  = 'From: pdd2019@admin.ru'."\r\n";
        mail($to, $subject, $message,$from);
    }
    // print_r($_POST);
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
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 text-center" style="border:1px gray solid; border-radius:10px; height: 800px; overflow: scroll;">
                    <p style="font-weight:bolder; font-size:150%; font-style:italic;">Ученики</p>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4" onclick="show_auth();"><a href="#" ><span class="glyphicon glyphicon-th-list"></span> Авторизованные</a></div>
                        <div class="col-md-4" onclick="show_unauth();"><a href="#" ><span class="glyphicon glyphicon-th-list"></span> Неавторизованные</a></div>
                        <div class="col-md-2"></div>
                    </div>

                    <?php
                        // print_r($_SESSION);
                        // echo "<br/>";
                        $login_user = $_SESSION['teacher']['login'];
                        $get_id_query = mysqli_query($connection, "SELECT * FROM Users WHERE Login = '$login_user'");
                        $get_id_query_result = mysqli_fetch_assoc($get_id_query);
                        $id_user = $get_id_query_result['ID'];
                        // echo $id_user;
                        // echo "<br/>";
                        $temporary = mysqli_query($connection,"SELECT * FROM Users u JOIN Pupil p ON p.UserID = u.ID JOIN Course c ON p.CourseID = c.ID WHERE c.Teacher = $id_user;");
                        if(mysqli_num_rows($temporary)<1) echo "<p style='font-size:125%;font-weight:bolder;font-style:italic;'>Учеников не обнаружено! </p>";
                        else{
                            $counter = 1;
                            $counter_auth = 1;
                            $counter_unauth = 1; 
                            while($result = mysqli_fetch_assoc($temporary)){ 
                                // print_r($result);
                                // echo "<br/><br/>";
                                if ($result['isAccepted']==1) {
                                    $type = "auth";
                                    echo "<div class='row text-left ". $type ."' style='margin-left:1%'>
                                            <p style='font-size:125%;font-weight:bolder;font-style:italic;'> Ученик № " . $counter_auth . " (" . $result['FirstName'] . " " . $result['LastName'] . ")" .
                                            "<div style='margin-top:1%;margin-bottom:1%;font-weight:bolder;font-style:italic;'>".
                                                "<p>Курс: ".$result['Title']."</p>".
                                                "<div class='col-md-6'><a target='blank' href='letter.php?receiver=" . $result['Login'] . "'>
                                                <input type='submit' style='width:100%;' class='btn btn-default' name='message_" . $counter . "' value='Написать письмо'/>".
                                                "</a></div>" .
                                                "<div class='col-md-4'></div>".
                                                    "<div class='col-md-2'><a target='blank' href='strike.php?receiver=" . $result['Login'] . "&id=" . $result['ID'] ."'><input type='submit' style='width:100%;' class='btn btn-danger' name='lost_" . $counter . "' value='Исключить'/></a></div>".
                                            "</div>" .
                                            "<hr/>" .
                                        "</div>";
                                    $counter_auth++;
                                }
                                if ($result['isAccepted']==0) {
                                    $type = "unauth";
                                    echo "<div class='row text-left ". $type ."' style='margin-left:1%'>
                                        <p style='font-size:125%;font-weight:bolder;font-style:italic;'> Ученик № " . $counter_unauth . " (" . $result['FirstName'] . " " . $result['LastName'] . ")" .
                                        "<div class='col-md-12' style='margin-top:1%;margin-bottom:1%;font-weight:bolder;font-style:italic;'>".
                                            "<p>Курс: ".$result['Title']."</p>".
                                            "<div class='row' style='line-height:125%;'>
                                                <div class='col-md-3'><form action='pupils.php' method='POST'><input type='submit' class='btn btn-success' name='accept' value='Авторизовать'/><input name='login' type='hidden' value='".$result['Login']."'><input name='course' type='hidden' value='".$result['ID']."'/></form></div>
                                                <div class='col-md-3'><form action='pupils.php' method='POST'><input type='submit' class='btn btn-danger' name='decline' value='Отклонить'/><input name='login' type='hidden' value='".$result['Login']."'><input name='course' type='hidden' value='".$result['ID']."'/></form></div>".
                                                "<div class='col-md-6'><a target='blank' href='letter.php?receiver=" . $result['Login'] . "'><input type='submit' style='width:100%;' class='btn btn-default' name='message_" . $counter . "' value='Написать письмо'/></a></div>" .
                                            "</div>" .
                                            "<hr/>" .
                                        "</div>" .
                                    "</div>";
                                    $counter_unauth++;
                                }
                                
                                $counter++;
                            }
                        }
                    ?>
                </div>
                <div class="col-md-2"></div>
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

        <script type="text/javascript">
            function show_auth(){
                var a = document.getElementsByClassName('auth');
                for(var i = 0; i < a.length; i++) a[i].style.display = 'block';
                var b = document.getElementsByClassName('unauth');
                for(var i = 0; i < b.length; i++) b[i].style.display = 'none';
            }

            function show_unauth(){
                var a = document.getElementsByClassName('auth');
                for(var i = 0; i < a.length; i++) a[i].style.display = 'none';
                var b = document.getElementsByClassName('unauth');
                for(var i = 0; i < b.length; i++) b[i].style.display = 'block';
            }

            show_auth();
        </script>
    </body>