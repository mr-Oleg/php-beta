<?php
	//require_once "header.php";
	require_once "counter.php";

	// error_reporting(0);
	// unset($_SESSION['answers']);
	// unset($_SESSION['test']);

	// unset($_POST);
	// unset($_SESSION);
	// $_POST = array();
	// $_SESSION = array();

	// print_r($_POST);
	// echo "<br/>";
	// print_r($_SESSION);
	if(isset($_SESSION['lname']) && isset($_SESSION['fname'])){
		header("Location: feed.php?page=1");
	}
	$login = "";
	if(isset($_POST['auth'])){
		if(isset($_POST['login_auth'])){
			$login = htmlentities($_POST['login_auth']); 
			$pass = htmlentities($_POST['pass_auth']);
			$res = mysqli_query($connection,"Select * From Users Where Login='$login' And Password='$pass';");
			if($res==true){
				// echo "successful query!";
				$result = mysqli_fetch_assoc($res);
				// print_r($result);
				// if($result['Login']==$login){
				// 	echo "есть такой логин!" ;
				// }
				// else{
				// 	echo "нет такого!" ;
				// 	//exit();
				// }
				$_SESSION['login']=$result['Login'];
				$_SESSION['password']=$result['Password'];
				$_SESSION['fname']=$result['FirstName'];
				$_SESSION['lname']=$result['LastName'];
				$_SESSION['email']=$result['Email'];
				header("Location: feed.php?page=1");
				
			 }else{
				 echo '<script>
				 			alert("Неверный логин или пароль.");
				 		</script>';
				 
			 }
		}
		// if(isset($_POST['pass_auth'])){
		// 	if($login!=""){
		// 		$pass = htmlentities($_POST['pass_auth']);
		// 		$res = mysqli_query($connection,"Select * From Users Where Login='$login';");
		// 		if($res==true){
		// 			$result = mysqli_fetch_assoc($res);
		// 			echo "succeful query!";
		// 			if($pass == $result['Password']){
		// 				echo "Успееех!";
		// 				$_SESSION['login']=$result['Login'];
		// 				$_SESSION['password']=$result['Password'];
		// 				$_SESSION['fname']=$result['FirstName'];
		// 				$_SESSION['lname']=$result['LastName'];
		// 				$_SESSION['email']=$result['Email'];
		// 				//header("Location: feed.php?page=1");
		// 			}
		// 			else{
		// 				echo "Пароли не совпали!";
		// 			}
		// 		}else{
		// 			echo 'no successful query!';					
		// 		}
		// 	}
		// }
	}
	else if(isset($_POST['sup'])){
		if(isset($_POST['login_sup'])){
			$login = $_POST['login_sup'];
			$result = mysqli_query($connection,"Select * From Users Where Login='$login';");
			if($result==true){
				$res = mysqli_fetch_assoc($result);
				if($res['Login']!= $login){
					//echo "Такого имени нет!";
					if(isset($_POST['pass_sup'])&&isset($_POST['fname_sup'])&&isset($_POST['sname_sup'])&&isset($_POST['email_sup'])){
						$data = [
							"login_sup" => $login,
							"pass_sup" => $_POST['pass_sup'],
							"fname_sup" => $_POST['fname_sup'],
							"sname_sup" => $_POST['sname_sup'],
							"email_sup" => $_POST['email_sup']
						];
						$_SESSION['sup_data_completion'] = $data;
						header("Location: completion.php");
						
					}
				}else{
					echo '<script>
							alert("Данный логин уже используется");
							</script>';
				}
			}
			else{
				//echo "оч странная ошибка!";
			}
		}
	}
?>


	<div class="fullwidth-bg">
        <div class="container">
            <div class="video-layer row" style="padding-top: 2%;">

            	<div class="row text-center">
            		<div class="col-md-12 anim-show text-center">
	                    <h1 id="text">Лучшее время начать учиться - сейчас!<br/> Присоединяйтесь!</h1>
	                </div>
            	</div>

                
            	<div class="row" id="choose">
					<div class="col-md-4 text-center">
						<p onclick="enter()">Вход для<br/>студентов</p>
					</div>
					<div class="col-md-4 text-center">
						<a href="/teacher" style="text-decoration: none;"><p>Вход для<br/>преподавателей</p></a>
					</div>
					<div class="col-md-4  text-center">
						<a href="/admin" style="text-decoration: none;"><p>Вход для<br/>администраторов</p></a>
					</div>
				</div>

				<div class="row text-center" id="enter">
					<div class="col-md-4"></div>
					<div class="col-md-4 frame" id="form" style="display: inline-block; height: 570px;">
					    <div class="nav" style="padding-top: 10px; height: 60px;">
					    	<ul class="links">
					        	<li class="signin-active" onclick="less()"><a class="btn">Войти</a></li>
					        	<li class="signup-inactive" onclick="more()"><a class="btn">Регистрация</a></li>
					    	</ul>
					    </div>
					    <div ng-app ng-init="checked = false">
							<form class="form-signin text-center" style="padding-top: 5px;" action="/" method="post" name="form">
					          <label for="username">Логин</label>
					          <input class="form-styling" type="text" name="login_auth" placeholder="Введите логин"/>
					          <label for="password">Пароль</label>
					          <input class="form-styling" type="password" name="pass_auth" placeholder="Введите пароль"/>
					          <input type="submit" class="btn btn-success" value="Войти" name="auth"/> 
							</form>
					        
							<form class="form-signup text-center" action="/" style="padding-top: 5px;" method="post" name="form">
							  <label for="fullname">Имя</label>
					          <input class="form-styling" type="text" name="fname_sup" placeholder="Введите имя"/>
					          <label for="fullname">Фамилия</label>
					          <input class="form-styling" type="text" name="sname_sup" placeholder="Введите фамилию"/>
					          <label for="email">Email</label>
					          <input class="form-styling" type="text" name="email_sup" placeholder="Введите email"/>
					          <label for="confirmpassword">Логин</label>
					          <input class="form-styling" type="text" name="login_sup" placeholder="Введите логин"/>
					          <label for="password">Пароль</label>
					          <input class="form-styling" type="password" name="pass_sup" placeholder="Введите пароль"/>
					          <input type="submit" class="btn btn-success" value="Присоединиться" name="sup"/> 
							</form>
					      
				            <div  class="success">
				              <svg width="270" height="270" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				       viewBox="0 0 60 60" id="check" ng-class="checked ? 'checked' : ''">
				                 <path fill="#ffffff" d="M40.61,23.03L26.67,36.97L13.495,23.788c-1.146-1.147-1.359-2.936-0.504-4.314
				                  c3.894-6.28,11.169-10.243,19.283-9.348c9.258,1.021,16.694,8.542,17.622,17.81c1.232,12.295-8.683,22.607-20.849,22.042
				                  c-9.9-0.46-18.128-8.344-18.972-18.218c-0.292-3.416,0.276-6.673,1.51-9.578" />
				                <div class="successtext">
				                   <p> Thanks for signing up! Check your email for confirmation.</p>
				                </div>
				            </div>
					    </div>
				 </div>
				</div>


			</div>
		</div>
        <video class="video" style="width: 106%; margin-top: -13%; margin-left: -5%;" loop muted autoplay class="fullscreen-bg__video">
            <source src="video//test.mp4" type="video/mp4">
        </video>
    </div>

	



<script type=”text/javascript” src=https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js'></script>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="index form.css">
<link rel="stylesheet" href="index.css">


<script src="index.js"></script>

<script type="text/javascript">
	document.getElementById('enter').style.display = 'none';
	if (screen.width < 700) {
		document.getElementById('form').style.height = '350px';
	} else{
		document.getElementById('form').style.height = '300px';
	}
	document.body.style.overflow = 'hidden';

	function enter(){
		document.getElementById('choose').style.display = 'none';
		document.getElementById('enter').style.display = 'block';
	}

	function more(){
		if (screen.width < 700) {
			document.getElementById('form').style.height = '700px';
		} else{
			document.getElementById('form').style.height = '560px';
		}
		document.body.style.overflow = 'scroll';
	}

	function less(){
		if (screen.width < 700) {
			document.getElementById('form').style.height = '355px';
		} else{
			document.getElementById('form').style.height = '300px';
		}
		document.body.style.overflow = 'hidden';
	}
</script>

<?php
	//require_once "footer_1.php";
?>
