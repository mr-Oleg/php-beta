<?php
	require_once "header.php";

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }

     //print_r($_SESSION);
     //echo "<br/>";
     //print_r($_POST);
     //echo "<br/>";

    if (isset($_POST['edit_name'])) {
    	 //echo "меняем имя";
    	 //echo "<br/>";
    	unset($_POST['edit_name']);
    	$new_fname = htmlentities($_POST['new_fname']);
    	$new_lname = htmlentities($_POST['new_lname']);
    	if (strlen(trim($new_fname))<1 || strlen(trim($new_lname))<1) {
    		echo '<script language="javascript">
    				alert("Введены некорректные данные.")
    			</script>';
    	} else {
    		$query = "UPDATE Users SET LastName = '".$new_lname."', FirstName = '".$new_fname."' WHERE Login = '".$_SESSION['login']."';";
    		 //echo $query;
    		 //echo "<br/>";
    		$res = mysqli_query($connection, $query);
    		if ($res == true) {
    			$_SESSION['fname'] = $new_fname;
    			$_SESSION['lname'] = $new_lname;
    			header("Refresh: 0");
    		} else {
    			 echo "не изменили имя";
    			 echo "<br/>";
    		}
    	}
    }
    else if (isset($_POST['edit_pass'])) {
    	unset($_POST['edit_pass']);
    	$cur_pass = htmlentities($_POST['cur_pass']);
    	$new_pass1 = htmlentities($_POST['new_pass1']);
    	$new_pass2 = htmlentities($_POST['new_pass2']);
    	if (strcmp($new_pass1, $new_pass2) != 0) {
    		echo '<script language="javascript">
    				alert("Пароли не совпадают.")
    			</script>';
    	} elseif (strlen($new_pass1)<6) {
    		echo '<script language="javascript">
    				alert("Некорретный новый пароль.")
    			</script>';
    	} else {
    		$res = mysqli_query($connection, "SELECT `Password` FROM Users WHERE Login = '".$_SESSION['login']."';");
    		$pass_from_db = mysqli_fetch_assoc($res);
    		#print_r($pass_from_db);
    		if (strcmp($pass_from_db['Password'], $cur_pass) != 0) {
    			echo '<script language="javascript">
	    				alert("Введен неверный действующий пароль.")
	    			</script>';
    		} else {
    			$query = "UPDATE Users SET `Password` = '".$new_pass1."' WHERE Login = '".$_SESSION['login']."';";
    			$res = mysqli_query($connection, $query);
    		if ($res == true) {
    			echo '<script language="javascript">
	    				alert("Пароль изменен.")
	    			</script>';
	    			header("Refresh: 0");
    		} else {
    			// echo "не изменили имя";
    			// echo "<br/>";
    		}
    		}
    	}
    }

    //print_r($)

    echo '<div class="container-fluid">
			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-2 text-center">
					<div class="row">
						<div class="col-md-6">
							<p class="text-right">
								Имя: 
							</p>
						</div>
						<div class="col-md-6">
							<p class="text-left">
								'.$_SESSION['fname'].'
							</p>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<p class="text-right">
								Фамилия: 
							</p>
						</div>
						<div class="col-md-6">
							<p class="text-left">
								'.$_SESSION['lname'].'
							</p>
						</div>
					</div>

					<button class="text-right" onclick="show_edit_name()">
						Сменить имя
					</button>
					<br/>
					<br/>
					<button class="text-right" onclick="show_edit_pass()">
						Сменить пароль
					</button>
				</div>
				
				<div class="col-md-6">
					<div class="tab-content" >

						<div role="tabpanel" class="tab-pane active" id="edit_name" style="margin:2%; display:none;">
							<form action="profile.php" method="POST" class="form-horizontal">
								<div class="form-group has-success">
										<label for="pass" class="col-sm-4 control-label">Новое имя</label>
										<div class="col-sm-8">
											<input type="text" class="form-control input-xs" placeholder="Введите имя" name="new_fname">
										</div>
								</div>
								<div class="form-group has-success">
										<label for="pass" class="col-sm-4 control-label">Новая фамилия</label>
										<div class="col-sm-8">
											<input type="text" class="form-control input-xs" placeholder="Введите фамилию" name="new_lname">
										</div>
								</div>
								<div class="col-sm-10"></div>
								<input type="submit" class="btn btn-success" value="Изменить" name="edit_name"/> 
							</form>
						</div>

						<div role="tabpanel" class="tab-pane " id="edit_pass" style="margin:2%; display:none;">
							<form action="profile.php" method="POST" class="form-horizontal">
								<div class="form-group has-success">
										<label for="pass" class="col-sm-4 control-label">Введите действующий пароль</label>
										<div class="col-sm-8">
											<input type="password" class="form-control input-xs" placeholder="Введите действующий пароль" name="cur_pass" >
										</div>
								</div>
								<div class="form-group has-success">
										<label for="pass" class="col-sm-4 control-label">Введите новый пароль</label>
										<div class="col-sm-8">
											<input type="password" class="form-control input-xs" placeholder="Введите новый пароль" name="new_pass1">
										</div>
								</div>
								<div class="form-group has-success">
										<label for="pass" class="col-sm-4 control-label">Повторите новый пароль</label>
										<div class="col-sm-8">
											<input type="password" class="form-control input-xs" placeholder="Повторите новый пароль" name="new_pass2">
										</div>
								</div>
								<div class="col-sm-10"></div>
								<input type="submit" class="btn btn-success" value="Изменить" name="edit_pass"/> 
							</form>
						</div>
					 </div>
				</div>
				<div class="col-md-2">
				</div>
			</div>

			<div class="row">
				<p class="text-center">История</p>
				<div class="col-md-1">
				</div>
				<div class="col-md-10">
					';

					$login = $_SESSION['login'];
				    $query1 = mysqli_query($connection,"SELECT ID From `Users` Where Login = '$login';");
				    $result1 = mysqli_fetch_all($query1);
				    $ID_User = $result1[0][0];

					$query2 = mysqli_query($connection, "SELECT * FROM `results` WHERE ID_User = '$ID_User'");
					$result2 = mysqli_fetch_all($query2);

					// print_r($result2);
					// echo "<br/><br/><br/>";

					for ($i=0; $i < count($result2); $i++) { 
						if ($result2[$i][3]==1) {
							$style_p = 'style = "color: green; display: inline-block; width: 50px; margin: auto;"';
							$style_a = 'style = "color: green;"';
						} else {
							$style_p = 'style = "color: red; display: inline-block; width: 50px; margin: auto;"';
							$style_a = 'style = "color: red;"';
						}
						echo '<p id='.$result2[$i][0].' '.$style_p.'><a href="result_details.php?id='.$result2[$i][0].'" '.$style_a.'>'.$result2[$i][2].'/'.$result2[$i][4].'</a></p>';
					}

		echo '
				</div>
				<div class="col-md-1">
				</div>
			</div>

		</div>';
?>





<?php
	echo '<script language="javascript">
    			function show_edit_name(){
    				document.getElementById("edit_name").style.display="block";
    				document.getElementById("edit_pass").style.display="none";
    			}

    			function show_edit_pass(){
    				document.getElementById("edit_name").style.display="none";
    				document.getElementById("edit_pass").style.display="block";
    			}
    		</script>';
	require_once "footer_1.php";
?>