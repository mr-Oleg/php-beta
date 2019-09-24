<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['admin'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tab editor</title>
        <style>
            .checkbox input {
                position: absolute;
                z-index: -1;
                opacity: 0;
                margin: 10px 0 0 20px;
            }
            .checkbox__text {
                position: relative;
                padding: 0 0 0 60px;
                cursor: pointer;
            }
            .checkbox__text:before {
                content: '';
                position: absolute;
                top: -4px;
                left: 0;
                width: 50px;
                height: 26px;
                border-radius: 13px;
                background: #CDD1DA;
                box-shadow: inset 0 2px 3px rgba(0,0,0,.2);
                transition: .2s;
            }
            .checkbox__text:after {
                content: '';
                position: absolute;
                top: -2px;
                left: 2px;
                width: 22px;
                height: 22px;
                border-radius: 10px;
                background: #FFF;
                box-shadow: 0 2px 5px rgba(0,0,0,.3);
                transition: .2s;
            }
            .checkbox input:checked + .checkbox__text:before {
                background: #9FD468;
            }
            .checkbox input:checked + .checkbox__text:after {
                left: 26px;
            }
            .checkbox input:focus + .checkbox__text:before {
                box-shadow: inset 0 2px 3px rgba(0,0,0,.2), 0 0 0 3px rgba(255,255,0,.7);
            }
        </style>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            require_once "admin_header.php";
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 text-center" style="border:1px black solid; border-radius: 10px;">
                    <p style="font-size:150%;">Подключение/Отключение разделов</p>
                    <form method="POST" action="tab-editor.php" class="form-horizontal" style="margin: 1%;">
                            <div class="row">
                                <div class="col-md-6">

                                    <?php
                                        $query = mysqli_query($connection, "Select Name, isActive, NameInTag From Sections;");
                                        while($result = mysqli_fetch_assoc($query)){
                                            $title = $result['Name'];
                                            $name = $result['NameInTag'];
                                            $isActive = $result['isActive'];
                                            echo   "<div class=' form-group has-success' style='padding-left:2%;'>
                                                        <label class='checkbox control-label'>
                                                            <input type='checkbox'";
                                                            if($isActive == 1) echo " checked "; 
                                                            echo "name='" . $name . "' />
                                                            <div class='checkbox__text text-left' style='font-size: 150%; margin-left:1%;'>" . $title . "</div>
                                                        </label>
                                                    </div> ";
                                        }
                                    ?>

                                    <!-- <div class=" form-group has-success" style="padding-left:2%;">
                                        <label class="checkbox control-label">
                                            <input type="checkbox"  name="news" />
                                            <div class="checkbox__text text-left" style="font-size: 150%; margin-left:1%;">Новости</div>
                                        </label>
                                    </div>    
                                    <div class=" form-group has-success" style="padding-left:2%;">
                                            <label class="checkbox control-label">
                                                <input type="checkbox" name="test"/>
                                                <div class="checkbox__text text-left" style="font-size: 150%; margin-left:1%;">Тест</div>
                                            </label>
                                    </div>    
                                    <div class=" form-group has-success" style="padding-left:2%;">
                                                <label class="checkbox control-label">
                                                    <input type="checkbox" name="fines"/>
                                                    <div class="checkbox__text text-left" style="font-size: 150%; margin-left:1%;">Штрафы</div>
                                                </label>
                                    </div>    
                                    <div class=" form-group has-success" style="padding-left:2%;">
                                        <label class="checkbox control-label">
                                            <input type="checkbox" name="markup"/>
                                            <div class="checkbox__text text-left" style="font-size: 150%; margin-left:1%;">Разметка</div>
                                        </label>
                                    </div> 
                                    <div class=" form-group has-success" style="padding-left:2%;">
                                        <label class="checkbox control-label">
                                            <input type="checkbox" name="signs"/>
                                            <div class="checkbox__text text-left" style="font-size: 150%; margin-left:1%;">Знаки</div>
                                        </label>
                                    </div>    -->
                                </div>
                                <div class="col-md-6 text-center" style="border:1px black solid; border-radius: 10px;">
                                        <p>Подсказка:</p>
                                        <span>
                                            Включая и выключая разделы, вы регулируете отображение вкладок для пользователя. 
                                            Если вкладка вами выключена, значит, что пользователь не увидит в верхнем меню таба со ссылкой на неё.
                                            Аналогично работает и наоборот: Включили вкладку - активировали отображение ссылки на вкладку в верхнем меню.
                                            После внесённых изменений (!) не забудьте нажать на кнопку "Сохранить".
                                        </span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center" style="margin:1%;">
                                        <a href="#"><input type="submit" class="btn btn-success" value="Сохранить" name="tab_submit"/></a>
                                    </div>
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
            if(isset($_POST['tab_submit'])){
                $sections = array(
                    "news"=>0,
                    "signs"=>0,
                    "fines" =>0,
                    "markup" =>0,
                    "test" => 0
                );
                $error = 0;
                if(isset($_POST['news'])) $sections["news"] = 1;
                if(isset($_POST['test'])) $sections["test"] = 1;
                if(isset($_POST['fines'])) $sections["fines"] = 1;
                if(isset($_POST['markup'])) $sections["markup"] = 1;
                if(isset($_POST['signs'])) $sections["signs"] = 1;
                $temporary = mysqli_query($connection, "Select NameInTag From Sections;");
                $counter = 0;
                // while($result = mysqli_fetch_assoc($temporary)){
                //     $tag_name = $result['NameInTag'];
                //     $switch = $sections[$counter++];
                //     $query = mysqli_query($connection,"Update Sections Set isActive = '$switch' Where NameInTag = '$tag_name';");
                //     if($query) continue;
                //     else $error = 1;
                //     break;
                // }
                // $q = 0;
                foreach($sections as $item => $value){
                    $query = mysqli_query($connection,"Update Sections Set isActive = '$value' Where NameInTag = '$item';");
                    if($query) continue;
                    else $error = 1;
                    break;
                }
                //echo "</br>" . $q;
                if($error == 0) {
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Изменения успешно внесены! Обновите страницу для верного отображения активности.";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                            </script>';
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Ошибка, обратитесь к администратору!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                            </script>';
                }
            }
            unset($_POST['tab_submit']);
        ?>

    </body>
</html>