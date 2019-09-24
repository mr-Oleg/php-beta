<?php
	require_once "header.php";
	
	error_reporting(0);

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }

    $id = $_GET['id'];

    $answers = json_decode($_POST['answers']);
    $counter = json_decode($_POST['count']);

	echo '<div class="container-fluid">
		    	<div class="row">
		    		<div class="col-md-1">
		    		</div>
		    		<div class="col-md-10 text-center">';
    
    $style;
    $count = 0;
    $errors = 0;

    for ($i=0; $i < $counter; $i++) { 

        if (strcasecmp($answers[$i], $_SESSION['test'][$i][15])==0) {
            $style = 'style="color: green"';
            $count++;
        } else {
            $errors++;
            $style = 'style="color: red"';
        }
        
    	echo '<p id="question">'.$_SESSION['test'][$i][10].'</p>
			<br/>';
			
		if (!is_null($_SESSION['test'][$i][11]) && $_SESSION['test'][$i][11]!=="") {
            echo '<img alt="Вопрос без картинки" id="pic" style="width: 750px;" src="tests_pic\\'.$_SESSION['test'][$i][11].'.png"><br/>';
        } else {
            echo '<p style="color: gray;">Вопрос без картинки</p>';
        }

        echo '<br/>
			<p>Ваш ответ: <span '.$style.'>'.$answers[$i].'</span></p>
			<p>Правильный ответ: '.$_SESSION['test'][$i][15].'</p><hr/>';
    }

    echo '			</div>
		    		<div class="col-md-1">
		    		</div>
		    	</div>
		  	</div>'	;


    echo '<script>
                alert("Поздавляем! Вы ответили правильно на '.$count.' из '.$counter.' вопросов!");
            </script>';
    
    $id_lection = $_SESSION['id_lection'];
    $get_id_course = mysqli_query($connection, "SELECT * FROM Lections WHERE ID = $id_lection;");
    $get_id_course_result = mysqli_fetch_assoc($get_id_course);
    $id_course = $get_id_course_result['CourseID'];

    $login = $_SESSION['login'];
    $get_id_user = mysqli_query($connection, "SELECT * FROM Users WHERE Login = '$login';");
    $get_id_user_result = mysqli_fetch_assoc($get_id_user);
    $id_user = $get_id_user_result['ID'];

    $get_id_pipil = mysqli_query($connection, "SELECT * FROM Pupil WHERE UserID = $id_user AND CourseID = $id_course;");
    $get_id_pipil_result = mysqli_fetch_assoc($get_id_pipil);
    $id_pupil = $get_id_pipil_result['ID'];

    $result = floatval($count / $counter);
    // echo "<br/><br/><br/>";
    // echo $count;
    // echo "<br/><br/><br/>";
    // echo $counter;
    // echo "<br/><br/><br/>";
    // echo floatval($count / $counter);
    // echo "<br/><br/><br/>";
    $update = mysqli_query($connection, "UPDATE Progress SET Result = $result WHERE PupilID = $id_pupil AND LectionID = $id_lection;");
    
    unset($_SESSION['id_lection']);
    unset($_SESSION['test']);
   

?>




<?php
	require_once "footer_1.php";
?>