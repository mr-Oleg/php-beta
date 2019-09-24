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
        <style>
          html,body{
            height:100%;
          }
          #wrap:after{
            content: "";
            display: block;
          }
          #wrap {
            margin-bottom: 5%;
            min-height:75%;
          }
          #wrap:after{
            height: 100%;
          }
        </style>
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
        
        </head>
        <body>
            <div id="wrap">
                <nav class="navbar navbar-default" style="background-color: #0B791E;"><!--light-->
                    <div class="container-fluid">
                        <div class="navbar-header col-md-3">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main"><!----> 
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button><!---->
                            <a href="index.php" class="navbar-brand" style="color: yellow;">Правила дорожного движения 2019</a>
                        </div>
                        <div class="col-md-6 collapse navbar-collapse" id="navbar-main"><!--collapse navbar-collapse" id="navbar-main"-->
                            <ul class="nav navbar-nav">
                                <!-- <li><a href="index.php" style="color: yellow;">Новости</a></li>
                                <li> <a href="signs.php" style="color: yellow;">Знаки</a></li>
                                <li> <a href="fines.php" style="color: yellow;">Штрафы</a></li>
                                <li> <a href="markup.php" style="color: yellow;">Разметка</a></li>
                                <li> <a href="#" style="color: yellow;">Тест</a></li> -->

                                <?php
                                    $temporary = mysqli_query($connection,"Select * From Sections Where isActive = 1;");
                                    while($results = mysqli_fetch_assoc($temporary)){
                                        $title = $results['Name'];
                                        $url = $results['Url'];
                                        echo '<li><a href="' . $url . '" style="color: yellow;">' . $title . '</a></li>';
                                    }
                                ?>

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
                                                    <li><a href='profile.php'>Личный кабинет</a></li>
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
                         
        <!-- </body>
    </html> -->