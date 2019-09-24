<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['teacher'])) header("Location: index.php");
    if(isset($_GET['receiver']) && isset($_GET['id'])){
        $_SESSION['receiver'] = $_GET['receiver'];
        $_SESSION['id'] = $_GET['id'];
    }
    if(!isset($_GET['receiver']) && !isset($_SESSION['receiver'])) header("Location: teacher_main.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Letter</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>

        <?php
            require_once "header.php";
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <p style="text-align:center; font-size:150%; font-weight:bolder; font-style:italic;">Искалючение с курса</p>
                    <p style="text-align:left; font-size:100%; font-weight:bolder;">Перед тем, как исключить студента, нужно мотивировать своё решение в данной форме. Бывший студент получит письмо с этой причиной, всё переосмыслит и смирится с грустным положением дел =(</p>
                    <div style="border: 1px gray solid; border-radius:10px;">
                        <form method="POST" action="strike.php" class="form-horizontal" style="margin: 1%;">
                            <div class="form-group">
                                <label for="pass" class="col-sm-2 control-label">Причина:</label>
                                <div class="col-sm-10">
                                    <input required type="text" class="form-control input-xs" id="header" placeholder="Введите данные" name="header" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass" class="col-sm-2 control-label">Подробности:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control input-xs" id="textarea" placeholder="Введите тело письма" name="textarea" style="min-width: 100%;max-width: 100%;" required></textarea>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <input type="submit" class="btn btn-danger" value="Исключить" name="submit"/> 
                                </div>
                                <div class="col-md-3">
                                    <input style="width:100%;" type="reset" class="btn btn-default" value="Очистить" name="reset"/> 
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

        <?php
            if(isset($_POST['submit'])){
                $message = htmlentities($_POST['textarea']);
                $subject = htmlentities($_POST['header']);
                $receiverLogin = $_SESSION['receiver'];
                $temporary = mysqli_query($connection,"SELECT * FROM Users WHERE Login = '$receiverLogin';");
                $temporary = mysqli_fetch_assoc($temporary);
                $to = $temporary['Email'];
                $id = $temporary['ID'];
                $message = $message . $id . $to;
                $from = 'From: pdd2019@admin.ru'."\r\n";
                mail($to,$subject,$message,$from);
                $id_course = $_SESSION['id'];
                // $_query = mysqli_query($connection, "DELETE FROM Users WHERE Login = '$receiverLogin';");
                echo $id;
                echo "<br/>";
                echo $id_course;
                $query = mysqli_query($connection, "DELETE FROM Pupil WHERE UserID = $id AND CourseID = $id_course;");
                echo "<br/>";
                print_r($query);
                
                unset($_SESSION['receiver']);
                header("Location: teacher_main.php");
            }
        ?>
    </body>
</html>