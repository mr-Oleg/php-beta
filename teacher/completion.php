<?php
    require_once "../db.php";
    ob_start();
    if(isset($_SESSION['teacher'])){
        if($_SESSION['teacher']['type']!=3) header("Location:index.php");
    }
    $__login = $_SESSION['teacher']['login'];
    $__query = mysqli_query($connection, "SELECT * FROM Users WHERE Login = '$__login';");
    $__query_res = mysqli_fetch_assoc($__query);
    // print_r($__query_res);
    // echo "<br/><br/><br/>";
    $__id = $__query_res['ID'];
    $_check = mysqli_query($connection, "SELECT * FROM Users u JOIN TeacherProfile tp ON u.ID = tp.TeacherID WHERE u.ID = $__id AND Type = 2;");
    // print_r($_check);
    // echo "<br/><br/><br/>";
    // print_r($_SESSION);
    // echo "<br/><br/><br/>";
    if (mysqli_num_rows($_check)>0) {
        $_SESSION['teacher']['type'] = 2;
        // echo "<br/><br/><br/> норм";
        // echo "<br/><br/><br/>";
        // print_r($_SESSION);
        header("Location: teacher_main.php");
        // return;
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
    <body>

    <?php
        require_once "header.php";
    ?>

        <div class="container">

            <?php
                // print_r($_SESSION);    //короче вот здесь хочу чтобы когда заявку отправил больше окно заяки не появлялось
                $_login = $_SESSION['teacher']['login'];
                $check = mysqli_query($connection, "SELECT * FROM Users u JOIN TeacherProfile tp ON u.ID = tp.TeacherID WHERE Login = '$_login' AND Type = 3;");
                // print_r($check);
                // echo "<br/><br/>";
                if (mysqli_num_rows($check)>0) {
                    echo '<div class="row text-center">
                            Ваша заявка на рассмотрении.
                            </div>';
                    return;
                }
                

            ?>

            <div class="row">
                <div class="col-md-2"></div>
                <div style="font-size:150%;font-style:italic;font-weight:bolder;" class="col-md-8 text-center">Подтверждение квалификации</div>
                <div class="col-md-2"></div>
            </div>
            <div style="margin-top:1%;"class="row">
                <div class="col-md-2"></div>
                <div style="border: 1px gray solid; border-radius:10px;" class="col-md-8">
                    <p style="margin:1%;font-weight:bolder;">Здесь вам предлагается ввести личную информацию о себе и прикрепить документ, подтверждающий вашу квалификацию</p>
                    <form method="POST" action="completion.php" class="form-horizontal" style="margin: 1%;" enctype="multipart/form-data">
                        <div class="form-group has-success">
                            <label for="pass" class="col-sm-2 control-label">Город:</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control input-xs" id="add_city" placeholder="Ваш текст" name="add_city" >
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label for="pass" class="col-sm-2 control-label">Прописка:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control input-xs" id="add_adress" placeholder="Введите данные" name="add_adress" style="min-width: 100%;max-width: 100%;" required></textarea>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label for="inputDate" class="col-sm-2 control-label">Дата Рождения:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control input-xs" id="add_date" name="add_date" required>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label for="inputDate" class="col-sm-2 control-label">Пол:</label>
                            <div class="col-sm-10">
                                <select class="form-control input-xs" name="sex" required>
                                    <option value ='m'>Мужской</option>
                                    <option value ='w'>Женский</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label for="inputDate" class="col-sm-2 control-label">Документ:</label>
                            <div class="col-sm-10 text-center">
                                <input type="file" class="form-control input-xs text-center" style="border: 0px gray solid;" id="add_photo" name="add_photo" accept="application/pdf,image/png,image/jpeg,image/bmp,image/gif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-success" value="Подать заявку" name="add_submit"/> 
                            </div>
                        </div>
                    </form>
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
        
        <?php
            if(isset($_POST['add_submit'])){
                $city = htmlentities($_POST['add_city']);
                $registration = htmlentities($_POST['add_adress']);
                $date = htmlentities($_POST['add_date']);
                $sex = htmlentities($_POST['sex']);
                if(isset($_FILES['add_photo'])){
                    $path = "documents/";
                    $name = $_SESSION['teacher']['login'];
                    $maxSize = 1048576; //максимальный размер - 10 мб
                    $currentSize = $_FILES['add_photo']['size'];
                    $tmp = $_FILES['add_photo']['tmp_name'];
                    $array = explode('.', $_FILES['add_photo']['name']);
                    $extension = end($array);
                    if($currentSize < $maxSize){
                        if(copy($tmp,$path . $name . "." . $extension)) {
                            $image = $name;
                            $login = $_SESSION['teacher']['login'];
                            $get_id = mysqli_query($connection,"Select * From Users Where Login = '$login';");
                            $get_id = mysqli_fetch_assoc($get_id);
                            $get_id = $get_id['ID'];
                            $name = $name . "." . $extension;
                            $temporary = mysqli_query($connection,"Insert Into TeacherProfile (City,Registration,DateOfBirth,Sex,DocumentPath,TeacherID) Values ('$city','$registration','$date','$sex','$name','$get_id');");
                            if($temporary){
                                echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Всё прошло успешно, Подтверждение заявки придёт на почту!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                        </script>';
                                header("Refresh: 0");
                            }
                        }
                        else echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Произошла ошибка при загрузке!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';// такого быть не должно
                    }
                    else{
                        //echo "файл слишком большой!";//перезагрузка страницы и скрыпт
                        echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Слишком большой размер файла!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    }
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Не удалось прикрепить файл, попробуйте ещё раз!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
        ?>
    </body>
</html>
