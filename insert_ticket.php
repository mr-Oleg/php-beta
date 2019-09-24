<?php
	error_reporting(0);

	require_once "db.php";

// 	if (true) {
// 		for ($i=3; $i <= 40; $i++) { 
// 			$title = 'Экзаменационный билет №'.$i;
// 			$query4 = mysqli_query($connection, "INSERT INTO `Tickets` (`Title`) VALUES ('$title')");
//         		$result4 = mysqli_fetch_all($query4);
// 		}
// 		return;
// 	}

	// print_r($_POST);

	echo "<br/><br/>";

	$ticket = trim($_POST['ticket']);
	$question = trim($_POST['question']);
	$type_of_question = trim($_POST['type_of_question']);
	$num_pic = trim($_POST['num_pic']);
	$answer1 = trim($_POST['answer1']);
	$answer2 = trim($_POST['answer2']);
	$answer3 = trim($_POST['answer3']);
	$answer4 = trim($_POST['answer4']);
	$answer_true = $_POST['answer_true'];


	// echo $answer4;
	// echo "<br/><br/>";


	$flag = true;

	if (strlen($question)<1 || strlen($answer1)<1 || strlen($answer2)<1) {
		echo '<script>
				alert("Неверные данные ввода!!!");
				</script>';
		$flag = false;
	}

	if ($ticket<2 || $ticket>40) {
		echo '<script>
				alert("Неверный номер билета!!!");
				</script>';
		$flag = false;
	}

	if ($type_of_question<1 || $type_of_question>20) {
		echo '<script>
				alert("Неверный номер вопроса!!!");
				</script>';
		$flag = false;
	}

	if (!isset($_POST['answer_true'])) {
		echo '<script>
				alert("Не выбран верный ответ!!!");
				</script>';
		$flag = false;
	}

	if (flag) {
		$insert_question = mysqli_query($connection,"INSERT INTO `Question`(`Text`, `Image`, `Ticket`, `TypeOfQuestion`) VALUES ('$question', '$num_pic', $ticket, $type_of_question)");

		$last_redcord = mysqli_query($connection, "SELECT * FROM `Question` WHERE ID=LAST_INSERT_ID();");
   		$result = mysqli_fetch_all($last_redcord);
   		// print_r($result3);
   		$last_id = $result[0][0];
		// $result_insert_question = mysqli_fetch_all($insert_question);
		// print_r($result_insert_question);
		// $question_id = 
		switch ($answer_true) {
			case 'answer1':
				 // echo $_POST[$answer_true];
				$insert_true_answer = mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer1', 1, $last_id)");
				$insert_other_answer1 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer2', 0, $last_id)");
				if (strlen($answer3)>0) {
					$insert_other_answer2 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer3', 0, $last_id)");
				}
				if (strlen($answer4)>0) {
					$insert_other_answer3 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer4', 0, $last_id)");
				}
				break;
			case 'answer2':
				 // echo $_POST[$answer_true];
				$insert_other_answer1 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer1', 0, $last_id)");
				$insert_true_answer1 = mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer2', 1, $last_id)");
				if (strlen($answer3)>0) {
					$insert_other_answer2 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer3', 0, $last_id)");
				}
				if (strlen($answer4)>0) {
					$insert_other_answer3 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer4', 0, $last_id)");
				}
				break;
			case 'answer3':
				 // echo $_POST[$answer_true];
				$insert_other_answer1 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer1', 0, $last_id)");
				$insert_other_answer2 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer2', 0, $last_id)");
				$insert_true_answer = mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer3', 1, $last_id)");
				if (strlen($answer4)>0) {
					$insert_other_answer3 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer4', 0, $last_id)");
				}
				break;
			case 'answer4':
				 // echo $_POST[$answer_true];
				$insert_other_answer1 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer1', 0, $last_id)");
				$insert_other_answer2 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer2', 0, $last_id)");
				$insert_other_answer3 =  mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer3', 0, $last_id)");
				$insert_true_answer = mysqli_query($connection,"INSERT INTO `Answers`(`Text`, `IsTrue`, `QuestionID`) VALUES ('$answer4', 1, $last_id)");
				break;
		}
		// $query = mysqli_query($connection,"");
		// $result = mysqli_fetch_all($query);
	}

	$flag = true;

?>

<br/>
<br/>
<br/>
<br/>


<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-8 text_center">

				<form action="insert_ticket.php" method="POST" style="margin: auto; width: 600px;">

					<label>Билет: </label>
					<input type="text" style="width: 540px;" class="form-control input-xs" placeholder="Введите номер билета" name="ticket">
					<br/>
					<br/>

					<label>Вопрос: </label>
					<input type="text" style="width: 540px;" class="form-control input-xs" placeholder="Введите вопрос" name="question">
					<br/>
					<br/>

					<label>Номер вопроса: </label>
					<input type="text" style="width: 540px;" class="form-control input-xs" placeholder="Введите номер вопроса" name="type_of_question">
					<br/>
					<br/>

					<label>Номер картинки: </label>
					<input type="text" style="width: 540px;" class="form-control input-xs" placeholder="Введите номер картинки" name="num_pic">
					<br/>
					<br/>

					<label>Ответ 1: </label>
					<input type="text" style="width: 540px;" class="form-control input-xs" placeholder="Введите ответ" name="answer1">
					<input type="radio" name="answer_true" value="answer1">
					<br/>
					<br/>

					<label>Ответ 2: </label>
					<input type="text" style="width: 540px;" class="form-control input-xs" placeholder="Введите ответ" name="answer2">
					<input type="radio" name="answer_true" value="answer2">
					<br/>
					<br/>

					<label>Ответ 3: </label>
					<input type="text" style="width: 540px;" class="form-control input-xs" placeholder="Введите ответ" name="answer3">
					<input type="radio" name="answer_true" value="answer3">
					<br/>
					<br/>

					<label>Ответ 4: </label>
					<input type="text" style="width: 540px;" class="form-control input-xs" placeholder="Введите ответ" name="answer4">
					<input type="radio" name="answer_true" value="answer4">
					<br/>
					<br/>


					<input type="submit" class="btn btn-success" value="Отправить" name="send"/> 
					
				</form>

			</div>
			<div class="col-md-2">
			</div>
		</div>
	</div>