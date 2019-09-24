<?php
	require_once "db.php";

	if (isset($_GET['question'])&&isset($_GET['answer'])) {
        $to_return;
        for ($y=0; $y < count($_SESSION['test']); $y++) { 
            if (strcmp($_SESSION['test'][$y][1], $_GET['question']) == 0) {
                if ($_SESSION['test'][$y][6] == $_GET['answer'] || $_GET['answer'] == substr($_SESSION['test'][$y][6], 0, strlen($_SESSION['test'][$y][6])-1) || $_GET['answer'] == substr($_SESSION['test'][$y][6], 0, strlen($_SESSION['test'][$y][6])-2) || strcmp($_GET['answer'], $_SESSION['test'][$y][6]) == 0) {
                    $to_return = "true";
                    break;
                } else {
                	$to_return = "false";
                	break;
                }
            }
        }
        echo json_encode($to_return);
        return true;
    } else{
        echo "";
    }


?>