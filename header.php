<?php
    ob_start();
    require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Main page</title>
        <!--<link href="bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet">-->
        <!---->
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script>
		$('a[data-toggle="pill"]').on('hidden.bs.tab', function (e) {
		  console.log(e.target); // вкладка, которая стала активной
		  console.log(e.relatedTarget); // предыдущая активная вкладка
		})
        </script>
        <script>
		    function a(){
	            $('#myModal').modal("toggle");
	
	            $('#myModal').on('shown.bs.modal', function (event) {
	            // функции
	            alert ("Выполенно");
	            });
	        }
        </script>
        <script>
            function show_markup_1(){
                var a = document.getElementsByClassName("visible_markup_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_markup_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
            function show_markup_2(){
                var a = document.getElementsByClassName("visible_markup_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_markup_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
        </script>
        <script>
            function show_1(){
                var a = document.getElementsByClassName("visible_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_3");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_4");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_5");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_6");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_7");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_8");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
            function show_2(){
                var a = document.getElementsByClassName("visible_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_3");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_4");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_5");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_6");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_7");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_8");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
            function show_3(){
                var a = document.getElementsByClassName("visible_3");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_4");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_5");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_6");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_7");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_8");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
            function show_4(){
                var a = document.getElementsByClassName("visible_4");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_3");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_5");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_6");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_7");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_8");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
            function show_5(){
                var a = document.getElementsByClassName("visible_5");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_3");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_4");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_6");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_7");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_8");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
            function show_6(){
                var a = document.getElementsByClassName("visible_6");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_3");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_4");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_5");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_7");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_8");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
            function show_7(){
                var a = document.getElementsByClassName("visible_7");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_3");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_4");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_5");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_6");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_8");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
            function show_8(){
                var a = document.getElementsByClassName("visible_8");
                for(var i=0; i<a.length; i++) a[i].style.display = 'block';
                a = document.getElementsByClassName("visible_2");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_3");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_4");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_5");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_6");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_7");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
                a = document.getElementsByClassName("visible_1");
                for(var i=0; i<a.length; i++) a[i].style.display = 'none';
            }
        </script>
        </head>
        <body>
            <nav class="navbar navbar-light" style="background-color: #0B791E;">
                <div class="container-fluid">
                    <div class="navbar-header col-md-3"><a href="#" class="navbar-brand" style="color: yellow;">Правила дорожного движения 2019</a></div>
                    <div class="col-md-6">
                        <ul class="nav navbar-nav">
                            <li><a href="index.html" style="color: yellow;">Новости</a></li>
                            <li> <a href="#" style="color: yellow;">Знаки</a></li>
                            <li> <a href="#" style="color: yellow;">Штрафы</a></li>
                            <li> <a href="#" style="color: yellow;">Разметка</a></li>
                            <li> <a href="#" style="color: yellow;">Тест</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <ul class="nav navbar-nav dropdown">
                            <?php
                                    if(isset($_SESSION['fname'])){
                                        $fname = $_SESSION['fname'];
                                        $lname = $_SESSION['lname'];
                                        echo "<li class='dropdown-toggle' data-toggle='dropdown'> <a href='#' style='color: yellow;'>" . $fname . " " . $lname . "<span class='caret'></span></a></li>
                                            <ul class='dropdown-menu'>
                                                <li><a href='#'>Личный кабинет</a></li>
                                                <li><a href='logout.php'>Выйти</a></li>
                                            </ul>";
                                    }else{
                                        echo "<li> <a href='#' style='color: yellow;'>Вы не авторизованы</a></li>";
                                    }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>                
        </body>
    </html>