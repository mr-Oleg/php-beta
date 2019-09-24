<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['News'])) header("Location: admin_main.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>News editor</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row" >
                <div class="col-md-2"></div>
                <div class="col-md-8" style="margin-top: 10%; border: 1px solid gray; border-radius:10px;">
                    <div class="text-center" style="font-size: 150%;">
                            Редактирование новости
                            <form method="POST" action="news_editor.php" style="margin: 1%;" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Заголовок</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="edit_news_title" placeholder="Введите текст" name="edit_news_title" value="<?php echo $_SESSION['News']['title']; ?>" >
                                        </div>
                                </div>
                                <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Тело</label>
                                        <div class="col-sm-10">
                                            <textarea required class="form-control input-xs" id="edit_news_text" placeholder="Введите текст статьи" name="edit_news_text" style="min-width: 100%;max-width: 100%;"><?php echo $_SESSION['News']['text']; ?></textarea>
                                        </div>
                                </div>
                                <div class="form-group has-warning">
                                    <label for="inputDate" class="col-sm-2 control-label">Дата</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control input-xs" id="edit_news_date" name="edit_news_date" value="<?php echo date('Y-m-d\TH:i', strtotime($_SESSION['News']['date'])); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group has-warning">
                                    <label for="inputDate" class="col-sm-2 control-label">Автор</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-xs" name="people" required>
                                            <?php
                                                $people = mysqli_query($connection,"Select * From Users Where Status = 1 Order by ID;");
                                                while($admin = mysqli_fetch_assoc($people)){
                                                    if($admin['ID']==$_SESSION['News']['author']) echo '<option selected value =' . $admin['ID'] . '>' . $admin['FirstName'] . " " . $admin['LastName'] . '</option>';
                                                    else echo '<option value =' . $admin['ID'] . '>' . $admin['FirstName'] . " " . $admin['LastName'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row text-center has-success" style="font-size: 50%;">
                                    <div class="col-md-4 has-success">
                                        <input value="r" onclick="document.getElementById('edit_news_photo').disabled = true;" type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Удалить прошлую картинку</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="s" checked onclick="document.getElementById('edit_news_photo').disabled = true;" type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Не изменять картинку</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="c" onclick="document.getElementById('edit_news_photo').disabled = false;" type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio3">Заменить</label>
                                    </div>
                                </div>
                                <div class="form-group has-warning">
                                    <label for="inputDate" class="col-sm-2 control-label">Фото</label>
                                    <div class="col-sm-10 text-center">
                                        <input type="file" disabled class="form-control input-xs text-center" style="border: 0px gray solid;" id="edit_news_photo" name="edit_news_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-warning" value="Редактировать" name="edit_news_submit"/> 
                                    </div>
                                </div>
                        </form>
                    </div>
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
            if(isset($_POST['edit_news_submit'])){
                $title = htmlentities($_POST['edit_news_title']);
                $description = htmlentities($_POST['edit_news_text']);
                $date = date("Y-m-d H:i:s",strtotime(htmlentities($_POST['edit_news_date'])));
                $author = htmlentities($_POST['people']);
                $switch = htmlentities($_POST['customRadio']);
                $id = $_SESSION['News']['id'];
                $image = NULL;
                if($switch == 'r'){ //удалить прошлую картинку
                    $path = "../news_pic/";
                    $temporary = mysqli_query($connection,"Select * From News Where ID = '$id';");
                    $temporary = mysqli_fetch_assoc($temporary);
                    if($temporary['ImgSource']!=NULL) unlink($path . $temporary['ImgSource']);
                    $temporary = mysqli_query($connection,"Update News Set Title = '$title', Text = '$description', Date = '$date', AuthorID = '$author', ImgSource = '$image'  Where ID = '$id';");
                    if($temporary) {
                        unset($_SESSION['News']);
                        $_SESSION['Status'] = 8;
                        header("Location: admin_main.php");
                    }
                    else {
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Что-то пошло не так!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                              </script>';
                    }
                }
                else if($switch == 's'){ //не изменять картинку
                    $temporary = mysqli_query($connection,"Select * From News Where ID = '$id';");
                    $temporary = mysqli_fetch_assoc($temporary);
                    $image = $temporary['ImgSource'];
                    $temporary = mysqli_query($connection,"Update News Set Title = '$title', Text = '$description', Date = '$date', AuthorID = '$author', ImgSource = '$image'  Where ID = '$id';");
                    if($temporary) {
                        unset($_SESSION['News']);
                        $_SESSION['Status'] = 8;
                        header("Location: admin_main.php");
                    }
                    else {
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Что-то пошло не так!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                              </script>';
                    }
                }
                else if($switch == 'c'){ //заменить картинку
                    if(isset($_FILES['edit_news_photo'])){
                        $path = "../news_pic/";
                        $name = $title . $date;
                        $maxSize = 1048576; //максимальный размер - 10 мб
                        $currentSize = $_FILES['edit_news_photo']['size'];
                        $tmp = $_FILES['edit_news_photo']['tmp_name'];
                        $name=str_replace(':','',$name);
                        if($currentSize < $maxSize){
                            $temporary = mysqli_query($connection,"Select * From News Where ID = '$id';");
                            $temporary = mysqli_fetch_assoc($temporary);
                            unlink($path . $temporary['ImgSource']);
                            if(@copy($tmp,$path . $name . ".png")){
                                $image = $name;
                                $temporary = mysqli_query($connection,"Update News Set Title = '$title', Text = '$description', Date = '$date', AuthorID = '$author', ImgSource = '$image'  Where ID = '$id';");
                                if($temporary) {
                                    unset($_SESSION['News']);
                                    $_SESSION['Status'] = 8;
                                    header("Location: admin_main.php");
                                }
                                else {
                                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                messageBox.innerHTML = "Что-то пошло не так!";
                                                var a = document.getElementById("myModal");
                                                a.style.display = "block";
                                        </script>';
                                }
                            }
                            else echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                messageBox.innerHTML = "Картинка не загружена!";
                                                var a = document.getElementById("myModal");
                                                a.style.display = "block";
                                        </script>';
                        }
                        else{
                            echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Слишком большой размер картинки!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';
                        }
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Загрузите изображение!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                              </script>';
                    }
                }
            }
        ?>

    </body>
</html>