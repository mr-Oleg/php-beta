<?php
    // error_reporting(0);

	require_once "header.php";

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }

    if (!isset($_GET['id'])) {
        header("Location: courses.php");
    }

    $id = $_GET['id'];
    $_SESSION['id_lection'] = $id;
    $get_questions = mysqli_query($connection,"SELECT * FROM Lections l JOIN Sets s ON s.LectionID = l.ID JOIN Question q ON s.QuestionID = q.ID JOIN Answers a ON a.QuestionID = q.ID");
    $get_questions_result = mysqli_fetch_all($get_questions);
    // print_r($get_questions_result[0]);
    // echo "<br/><br/><br/>";

    $array = array(array());

    $counter = 0;
    for ($i=0; $i < count($get_questions_result); $i++) { 
        if ($get_questions_result[$i-1][10] == $get_questions_result[$i][10]) {
            continue;
        }
        $array[$counter][0] = $get_questions_result[$i][10];
        $array[$counter][1] = $get_questions_result[$i][11];
        for ($u=0; $u < count($get_questions_result); $u++) { 
            if ($get_questions_result[$i][10] == $get_questions_result[$u][10]) {
                array_push($array[$counter], $get_questions_result[$u][15]);
            }
        }
        $counter++;
    }

    $get_count_of_questions = mysqli_query($connection,"SELECT * FROM Lections l JOIN Sets s ON s.LectionID = l.ID JOIN Question q ON s.QuestionID = q.ID");

    $only_true = mysqli_query($connection,"SELECT * FROM Lections l JOIN Sets s ON s.LectionID = l.ID JOIN Question q ON s.QuestionID = q.ID JOIN Answers a ON a.QuestionID = q.ID WHERE IsTrue = 1;");
    $only_true_result = mysqli_fetch_all($only_true);

    $_SESSION['test'] = $only_true_result;

    $json = json_encode($array);

?>

	<div class="container-fluid">
        <div class="row text-center">
            <p id="timer"></p>
        </div>
    	<div class="row">
    		<div class="col-md-1">
    		</div>
    		<div class="col-md-10 text-center" style="line-height:250%; padding: 1%; font-size:150%; border: 1px gray solid; border-radius:10px;">

                <?php
                    for ($i=0; $i < mysqli_num_rows($get_count_of_questions); $i++) { 
                        echo '<p id='.$i.' class="cell" onclick="show('.$i.')">'.($i+1).'</p>';
                    }

                ?>

    			<p id="question" class="question"></p>
    			<img alt="Вопрос без картинки" id="pic" style="width: 750px; margin-bottom: 10px;" src="https://www.layoutit.com/img/sports-q-c-140-140-3.jpg">
    			<p id="answer1" class="answer" onclick="record(document.getElementById('answer1').innerText)"></p>
    			<p id="answer2" class="answer" onclick="record(document.getElementById('answer2').innerText)"></p>
    			<p id="answer3" class="answer" onclick="record(document.getElementById('answer3').innerText)"></p>
    			<p id="answer4" class="answer" onclick="record(document.getElementById('answer4').innerText)"></p>
    		</div>
    		<div class="col-md-1">
    		</div>
    	</div>
  	</div>	

    <form id="form" action="lection_test_result.php" method="POST">
        <input id="input" type="hidden" name="answers" value="">
        <input id="count" type="hidden" name="count" value="">
    </form>
    		


<script>
	var questions = JSON.parse('<?php echo $json; ?>');
    var count_of_questions = questions.length;
    var count_of_errors = 0;
    var question_id = 0;
	var answers = new Array();
	console.log(questions);
	
    show(question_id);

    var response;

	function record(answer){
		answers[question_id] = answer;

        document.getElementById(question_id).onclick = function(){};
        //document.getElementById(question_id).style.color = "red";


        // let request = new XMLHttpRequest();
        // let url = "check.php?question=" + questions[question_id][0] + "&answer=" + answer;
        // request.open('GET', url);
        // request.setRequestHeader('Content-Type', 'application/json');
        // request.addEventListener("readystatechange", () => 
        // {
        //     if (request.readyState === 4 && request.status === 200) {
        //         //console.log(request.responseText);
        //         response = JSON.parse(request.responseText);
        //         console.log(response);
        //         if ("true".localeCompare(response)==0) {
        //             document.getElementById(question_id).style.color = "green";
        //         } else {
        //             //console.log("ne true");
        //             document.getElementById(question_id).style.color = "red";
        //             count_of_errors++;
        //             if (count_of_errors<3 && question_id<20) {
        //                 switch (count_of_errors){
        //                     case 1: count_of_questions = 25;
        //                             break;
        //                     case 2: count_of_questions = 30;
        //                             break;
        //                     default: break;
        //                 }
        //                 for (let i = 0; i < (5 * count_of_errors); i++) {
        //                     document.getElementById(20 +  i).style.display = "inline-block";
        //                 }
        //             }
                    
        //         }
        //         //console.log(response);
                
        //       //response = request.responseText;
        //     }
        // });
        
        // request.send();

        setTimeout(show_next, 1000);

        // show_next();
	}

    function show(number){
        // if (typeof(answers[question_id]) == "undefined") {
        //     document.getElementById(question_id).style.fontSize = "30px";
        // } else {
        //     document.getElementById(question_id).style.fontSize = "15px";
        // }
        // console.log(response);
        document.getElementById(question_id).style.fontSize = "20px";
        question_id = number;
        document.getElementById(question_id).style.fontSize = "30px";
        document.getElementById('question').innerText = questions[question_id][0];
        if (questions[question_id][1]==null || questions[question_id][1]=="") {
            document.getElementById('pic').style.display = "none";
        } else {
            document.getElementById('pic').style.display = "block";
            document.getElementById('pic').style.margin = "10px auto";
            // document.getElementById('pic').style.marginBottom = "auto";
            document.getElementById('pic').src = "tests_pic\\"+questions[question_id][1]+".png";
        }
        document.getElementById('answer1').innerText = questions[question_id][2];
        document.getElementById('answer2').innerText = questions[question_id][3];
        
        //document.getElementById('answer3').innerText = questions[question_id][4];
        
        if (typeof(questions[question_id][4]) != "undefined") {
            document.getElementById('answer3').innerText = questions[question_id][4];
            document.getElementById('answer3').style.display = "block";
        } else {
            document.getElementById('answer3').style.display = "none";
        }
        
        if (typeof(questions[question_id][5]) != "undefined") {
            document.getElementById('answer4').innerText = questions[question_id][5];
            document.getElementById('answer4').style.display = "block";
        } else {
            document.getElementById('answer4').style.display = "none";
        }


    }

    function show_next(){
        for (let i = 0; i < count_of_questions; i++) {
            if (typeof(answers[i]) == "undefined") {
                show(i);
                return;
            }
        }

        let flag = true;
        for (let i = 0; i < count_of_questions; i++) {
            if (typeof(answers[i]) == "undefined") {
                flag = false;
            }
        }
        if (flag) {
            end();
        }
        flag = true;
    }

    function end(){
        let temp = JSON.stringify(answers);
        // document.location.href = "result.php?answers="+temp;
        document.getElementById('input').value = temp;
        
        let count = JSON.stringify(count_of_questions);
        document.getElementById('count').value = count;

        document.getElementById('form').submit();
    }

    // function startTimer(duration, display) {
    //     var timer = duration, minutes, seconds;
    //     setInterval(function () {
    //         minutes = parseInt(timer / 60, 10)
    //         seconds = parseInt(timer % 60, 10);

    //         minutes = minutes < 10 ? "0" + minutes : minutes;
    //         seconds = seconds < 10 ? "0" + seconds : seconds;

    //         display.innerText = minutes + ":" + seconds;

    //         if (minutes == 0 && seconds == 0) {
    //             end();
    //         }

    //         if (--timer < 0) {
    //             timer = duration;
    //         }
    //     }, 1000);
    // }

    // window.onload = function () {
    //     var minutes = 60 * 20,
    //         display = document.getElementById('timer');
    //     startTimer(minutes, display);
    // };

  

</script>


<link rel="stylesheet" href="test.css">


<?php
	require_once "footer_1.php";
?>