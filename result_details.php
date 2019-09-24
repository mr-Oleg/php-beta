<?php
	require_once "header.php";

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }

    // print_r($_SESSION);
    // echo "<br/>";
    // print_r($_GET);
    // echo "<br/>";
    $login = $_SESSION['login'];
    $id = $_GET['id'];

    $query = mysqli_query($connection, "SELECT `User_answer`, `True_answer`, `Question`, `Image` FROM `Users` u JOIN `results` r ON u.`ID` = r.`ID_User` JOIN `results_details` rd ON r.`ID` = rd.`ID_Result` WHERE u.`Login` = '$login' AND r.`ID` = $id ");
    $result = mysqli_fetch_all($query);
    // print_r($result[0]);
    // echo "<br/>";
    // print_r($query);

    echo '<div class="container-fluid">
		    	<div class="row">
		    		<div class="col-md-1">
		    		</div>
		    		<div class="col-md-10 text-center">';

	$style;
    for ($i=0; $i < count($result); $i++) { 
        
    	if (rtrim(ltrim($result[$i][0])) == ltrim(rtrim($result[$i][1]))) {
    		$style = 'style="color: green"';
    	} else {
    		$style = 'style="color: red"';
    	}
        
    	
    	echo '<p id="question">'.$result[$i][2].'</p>
			<br/>';
			
		if (!is_null($result[$i][3]) && $result[$i][3]!=="") {
            echo '<img alt="Вопрос без картинки" id="pic" style="width: 750px;" src="tests_pic\\'.$result[$i][3].'.png"><br/>';
        } else {
            echo '<p style="color: gray;">Вопрос без картинки</p>';
        }

        echo '<br/>
			<p>Ваш ответ: <span '.$style.'>'.$result[$i][0].'</span></p>
			<p>Правильный ответ: '.$result[$i][1].'</p><hr/>';
    }

    echo '			</div>
		    		<div class="col-md-1">
		    		</div>
		    	</div>
		  	</div>'	;




?>



<?php
	require_once "footer_1.php";
?>