<?php
	require_once "header.php";
	
	error_reporting(0);

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }

    $id = $_GET['id'];

    $answers = json_decode($_POST['answers']);
    $counter = json_decode($_POST['count']);

    // print_r($_POST);

    // echo "<br/>";
    // echo "<br/>";
    // echo $counter;
    // echo "<br/>";
    // echo "<br/>";

    // print_r($answers);

    // echo "<br/><br/><br/>";

    // print_r($_SESSION);

   	// $query = mysqli_query($connection,"Select * From `Question` q Join `Answers` a On q.ID = a.QuestionID Where Ticket='$id' And IsTrue = 1;");
    // $result = mysqli_fetch_all($query);

    // print_r($_SESSION['test']);

	echo '<div class="container-fluid">
		    	<div class="row">
		    		<div class="col-md-1">
		    		</div>
		    		<div class="col-md-10 text-center">';
    
    $style;
    $count = 0;
    $errors_in_main = 0;
    $errors_in_extra = 0;

    // echo $counter;

    for ($i=0; $i < $counter; $i++) { 

        if (!isset($answers[$i]) && $i<=19) {
            $errors_in_main++;
            continue;
        }
        if (!isset($answers[$i]) && $i>19 && $i<30) {
            $errors_in_extra++;
            continue;
        }
        
    	if (rtrim(ltrim($answers[$i])) == ltrim(rtrim($_SESSION['test'][$i][6]))) {
    		$style = 'style="color: green"';
            $count++;
    	} else {
            if ($i<=19) {
                $errors_in_main++;
            }
            if ($i>19 && $i<30) {
                $errors_in_extra++;
            }
    		$style = 'style="color: red"';
    	}
        
    	
    	echo '<p id="question">'.$_SESSION['test'][$i][1].'</p>
			<br/>';
			
		if (!is_null($_SESSION['test'][$i][2]) && $_SESSION['test'][$i][2]!=="") {
            echo '<img alt="Вопрос без картинки" id="pic" style="width: 750px;" src="tests_pic\\'.$_SESSION['test'][$i][2].'.png"><br/>';
        } else {
            echo '<p style="color: gray;">Вопрос без картинки</p>';
        }

        echo '<br/>
			<p>Ваш ответ: <span '.$style.'>'.$answers[$i].'</span></p>
			<p>Правильный ответ: '.$_SESSION['test'][$i][6].'</p><hr/>';
    }

    echo '			</div>
		    		<div class="col-md-1">
		    		</div>
		    	</div>
		  	</div>'	;

   
    $result_test;
    if ($errors_in_main<=2 && $errors_in_extra<1) {
        $result_test = 1;
        echo '<script>
                    alert("Поздавляем! Вы сдали экзамен. '.$count.'/'.$counter.'");
                </script>';
    } else {
        $result_test = 0;
        echo '<script>
                    alert("Вы не сдали экзамен. '.$count.'/'.$counter.'");
                </script>';
    }

    //print_r($_SESSION);
    //echo "<br/>";
    $login = $_SESSION['login'];
    $query1 = mysqli_query($connection,"SELECT ID From `Users` Where Login='$login';");
    $result1 = mysqli_fetch_all($query1);
    //print_r($result1);
    //echo "<br/>";
    $ID_User = $result1[0][0];

    $count_of_questions = $counter;

    $query2 = mysqli_query($connection, "INSERT INTO `results`(`ID_User`, `Result`, `Status`, `Count_of_questions`) VALUES ('$ID_User', '$count', '$result_test', '$count_of_questions');");
    $result2 = mysqli_fetch_all($query2);
    print_r($result2);

    $query3 = mysqli_query($connection, "SELECT * FROM `results` WHERE ID=LAST_INSERT_ID();");
    $result3 = mysqli_fetch_all($query3);
    // print_r($result3);
    // echo "<br/>";
    $last_id = $result3[0][0];
    // echo $last_id;
    // echo "<br/>";

    //print_r($result[1]);

    for ($u=0; $u < count($answers); $u++) { 
        // echo "insert<br/>";
        $true_answer = $_SESSION['test'][$u][6];
        $question_to_db = $_SESSION['test'][$u][1];
        $image_to_db = $_SESSION['test'][$u][2];
        // echo $true_answer;
        // echo "<br/>";
        $query4 = mysqli_query($connection, "INSERT INTO `results_details` (`ID_Result`, `User_answer`, `True_answer`, `Question`, `Image`) VALUES ('$last_id', '$answers[$u]', '$true_answer', '$question_to_db', '$image_to_db');");
        $result4 = mysqli_fetch_all($query4);
         print_r($result4);
        // echo "<br/>";
    }

    unset($_SESSION['test']);
   

?>




<?php
	require_once "footer_1.php";
?>