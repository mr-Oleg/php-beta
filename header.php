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
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Main page</title>

        <!-- Bootstrap -->
        <link href="bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<script>
		$('a[data-toggle="pill"]').on('hidden.bs.tab', function (e) {
		  console.log(e.target); // вкладка, которая стала активной
		  console.log(e.relatedTarget); // предыдущая активная вкладка
		})
		</script>
    </head>
    <body>
        <nav class="navbar navbar-light" style="background-color: #0B791E;">
            <div class="container">
                <div class="navbar-header"><a href="#" class="navbar-brand" style="color: yellow;">Правила дорожного движения 2019</a></div>
                    <ul class="nav navbar-nav">
                        <li><a href="index.html" style="color: yellow;">Новости</a></li>
                        <li> <a href="#" style="color: yellow;">Знаки</a></li>
                        <li> <a href="#" style="color: yellow;">Штрафы</a></li>
                        <li> <a href="#" style="color: yellow;">Разметка</a></li>
                        <li> <a href="#" style="color: yellow;">Тест</a></li>
                        <?php
                            if(isset($_SESSION['fname'])){
                                $fname = $_SESSION['fname'];
                                $lname = $_SESSION['lname'];
                                echo "<li> <a href='#' style='color: yellow;'>" . $fname . " " . $lname . "</a></li>";
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