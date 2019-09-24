<?php
    error_reporting(0);

	require_once "header.php";

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }

    //array_push($_SESSION, array());
    // $_SESSION['answers'] = array();
    // print_r($_SESSION);
    // echo "<br/><br/><br/>";

    // echo '<div class="container-fluid">
    //         <div class="row">
    //             <div class="col-md-1">
    //             </div>
    //             <div class="col-md-10 text-center">';

    // if (count($_SESSION['answers'])==0) {
        $id = $_GET['id'];
        // $query1 = mysqli_query($connection,"Select Text, Image From `Question` Where Ticket='$id';");
        // $result1 = mysqli_fetch_all($query1);

        // print_r($result1);
        // echo "<br/><br/><br/>";
        $query2 = mysqli_query($connection,"Select * From `Question` q Join `Answers` a On q.ID = a.QuestionID Where Ticket='$id';");
        $result2 = mysqli_fetch_all($query2);
        //$_SESSION['test'] = $result2[0][0];
        //print_r($result2);

        $array = array(array());

        // print_r($result2);
        // echo "<br/><br/><br/>";



        // for ($i=0; $i < count($result1); $i++) { 
        //     $array[$i][0] = $result1[$i][0];
        //     $array[$i][1] = $result1[$i][1];
        //     for ($u=0; $u < count($result2); $u++) { 
        //         if (strcmp($result1[$i][0], $result2[$u][1])==0) {
        //             // echo $result1[$i][0];
        //             // echo "   ";
        //             // echo $result2[$u][1];
        //             // echo "   ";
        //             // echo $result2[$u][6];
        //             // echo "<br/>";
        //             array_push($array[$i], $result2[$u][6]);
        //         }
        //     }
        // }

        $counter = 0;
        for ($i=0; $i < count($result2); $i++) { 
            if ($result2[$i-1][0] == $result2[$i][0]) {
                continue;
            }
            $array[$counter][0] = $result2[$i][1];
            $array[$counter][1] = $result2[$i][2];
            for ($u=0; $u < count($result2); $u++) { 
                if ($result2[$i][1] == $result2[$u][1]) {
                    array_push($array[$counter], $result2[$u][6]);
                }
            }
            $counter++;
        }

        // echo $array[-1]."asdasdasd";
        // echo "<br/><br/><br/>";



        //print_r($array);
        
    // } else {

    // }

        // $query3 = mysqli_query($connection,"Select * From `Question`;");
        // $result3 = mysqli_fetch_all($query3);
        // $count_of_questions = count($result3);
        // echo $count_of_questions;
        // echo "<br/><br/><br/>";
        // $random_number = rand(1, $count_of_questions - 10);
        // echo $random_number;
        // echo "<br/><br/><br/>";







                            // $query4 = mysqli_query($connection, "SSelect * From (Select * From `Question` que Where Ticket <> $id Order By rand() Limit 10) q Join `Answers` a On q.ID = a.QuestionID ORDER BY `q`.`Text`"); 

                            //reaskommentit' kogda budut testi!!!!!!!!!!!!!!!!!

        





        $query4 = mysqli_query($connection, "Select * From (Select * From `Question` que Order By rand() Limit 10) q Join `Answers` a On q.ID = a.QuestionID ORDER BY `q`.`Text`");
        $result4 = mysqli_fetch_all($query4);
        // print_r($result4);
        // echo "<br/><br/><br/>";

        for ($i=0; $i < count($result4); $i++) { 
            if ($result4[$i-1][0] == $result4[$i][0]) {
                continue;
            }
            $array[$counter][0] = $result4[$i][1];
            $array[$counter][1] = $result4[$i][2];
            for ($u=0; $u < count($result4); $u++) { 
                if ($result4[$i][1] == $result4[$u][1]) {
                    array_push($array[$counter], $result4[$u][6]);
                }
            }
            $counter++;
        }

        // print_r($result4);
        // echo "<br/><br/><br/>";

        // for ($i=0; $i < count($result1); $i++) { 
        //     $array[$i][0] = $result1[$i][0];
        //     $array[$i][1] = $result1[$i][1];
        //     for ($u=0; $u < count($result2); $u++) { 
        //         if (strcmp($result1[$i][0], $result2[$u][1])==0) {
        //             // echo $result1[$i][0];
        //             // echo "   ";
        //             // echo $result2[$u][1];
        //             // echo "   ";
        //             // echo $result2[$u][6];
        //             // echo "<br/>";
        //             array_push($array[$i], $result2[$u][6]);
        //         }
        //     }
        // }




    // echo '  </div>
    //         <div class="col-md-1">
    //         </div>
    //     </div>
    // </div>';

        $only_true = mysqli_query($connection,"Select * From `Question` q Join `Answers` a On q.ID = a.QuestionID Where Ticket='$id' And IsTrue = 1;");
        $only_true_result = mysqli_fetch_all($only_true);

        for ($i=0; $i < count($result4); $i++) { 
            if ($result4[$i][7]==1) {
                array_push($only_true_result, $result4[$i]);
            }
        }

        $_SESSION['test'] = $only_true_result;

        // print_r($_SESSION['test'][1]);

        // print_r($_SESSION);

        $json = json_encode($array);

        // $json = json_encode(array('asd', 'asdf'));

        // print_r($_SESSION);

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
                    for ($i=0; $i < 20; $i++) { 
                        echo '<p id='.$i.' class="cell" onclick="show('.$i.')">'.($i+1).'</p>';
                    }
                    echo "<br/>";
                    for ($i=20; $i < 30; $i++) { 
                        echo '<p id='.$i.' style="display: none;" class="cell" onclick="show('.$i.')">'.($i+1).'</p>';
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

    <form id="form" action="result.php" method="POST">
        <input id="input" type="hidden" name="answers" value="">
        <input id="count" type="hidden" name="count" value="">
    </form>
    		


<script>
	var questions = JSON.parse('<?php echo $json; ?>');
    // var questions = new Array();
    var count_of_questions = 20;
    var count_of_errors = 0;
    var question_id = 0;
	var answers = new Array();
	console.log(questions);
	
    show(question_id);

    var response;

	function record(answer){
		answers[question_id] = answer;

        // console.log(answer);

        document.getElementById(question_id).onclick = function(){};
        //document.getElementById(question_id).style.color = "red";


        let request = new XMLHttpRequest();
        let url = "check.php?question=" + questions[question_id][0] + "&answer=" + answer;
        request.open('GET', url);
        request.setRequestHeader('Content-Type', 'application/json');
        request.addEventListener("readystatechange", () => 
        {
            if (request.readyState === 4 && request.status === 200) {
                //console.log(request.responseText);
                response = JSON.parse(request.responseText);
                console.log(response);
                if ("true".localeCompare(response)==0) {
                    document.getElementById(question_id).style.color = "green";
                } else {
                    //console.log("ne true");
                    document.getElementById(question_id).style.color = "red";
                    count_of_errors++;
                    if (count_of_errors<3 && question_id<20) {
                        switch (count_of_errors){
                            case 1: count_of_questions = 25;
                                    break;
                            case 2: count_of_questions = 30;
                                    break;
                            default: break;
                        }
                        for (let i = 0; i < (5 * count_of_errors); i++) {
                            document.getElementById(20 +  i).style.display = "inline-block";
                        }
                    }
                    
                }
                //console.log(response);
                
              //response = request.responseText;
            }
        });
        
        request.send();

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

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.innerText = minutes + ":" + seconds;

            if (minutes == 0 && seconds == 0) {
                end();
            }

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    window.onload = function () {
        var minutes = 60 * 20,
            display = document.getElementById('timer');
        startTimer(minutes, display);
    };

  

</script>


<link rel="stylesheet" href="test.css">


<?php
	require_once "footer_1.php";
?>