<?php
	require_once "header.php";
	if(isset($_SESSION['lname']) && isset($_SESSION['fname'])){
		header("Location: feed.php/?page=1");
	}
	$login = "";
	if(isset($_POST['auth'])){
		if(isset($_POST['login_auth'])){
			$login = htmlentities($_POST['login_auth']); 
			$res = mysqli_query($connection,"Select * From Users Where Login='$login';");
			if($res==true){
				echo "successful query!";
				$result = mysqli_fetch_assoc($res);
				if($result['Login']==$login){
					echo "есть такой логин!" ;
				}
				else{
					echo "нет такого!" ;
					exit();
				}
			 }else{
				 echo 'no successful query!';
				 
			 }
		}
		if(isset($_POST['pass_auth'])){
			if($login!=""){
				$pass = htmlentities($_POST['pass_auth']);
				$res = mysqli_query($connection,"Select * From Users Where Login='$login';");
				if($res==true){
					$result = mysqli_fetch_assoc($res);
					echo "succeful query!";
					if($pass == $result['Password']){
						echo "Успееех!";
						$_SESSION['login']=$result['Login'];
						$_SESSION['password']=$result['Password'];
						$_SESSION['fname']=$result['FirstName'];
						$_SESSION['lname']=$result['LastName'];
						$_SESSION['email']=$result['Email'];
						header("Location: feed.php/?page=1");
					}
					else{
						echo "Пароли не совпали!";
					}
				}else{
					echo 'no successful query!';					
				}
			}
		}
	}
	else if(isset($_POST['sup'])){
		if(isset($_POST['login_sup'])){
			$login = $_POST['login_sup'];
			$result = mysqli_query($connection,"Select * From Users Where Login='$login';");
			if($result==true){
				$res = mysqli_fetch_assoc($result);
				if($res['Login']!= $login){
					echo "Такого имени нет!";
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
					echo "такое имя есть!";
				}
			}
			else{
				echo "оч странная ошибка!";
			}
		}
	}
?>
	<div class="col-sm-8"></div>
		<div class="col-sm-4" style=" background-color: #EEDDFF; border: 0px solid blue; border-radius: 15px;"><!---->
		  <ul class="nav nav-pills" role="tablist">
			<li class="active"><a href="#home" role="tab" data-toggle="pill">Авторизация</a></li>
			<li><a href="#profile" role="tab" data-toggle="pill">Регистрация</a></li>
		  </ul>
		  <div class="tab-content" >
			<div role="tabpanel" class="tab-pane active" id="home" style="margin:2%;">
				<form action="/" method="POST" class="form-horizontal">
					<div class="form-group has-success">
							<label for="pass" class="col-sm-2 control-label">Логин</label>
							<div class="col-sm-10">
								<input type="text" class="form-control input-xs" id="pass" placeholder="Введите логин" name="login_auth">
							</div>
					</div>
					<div class="form-group has-success">
							<label for="pass" class="col-sm-2 control-label">Пароль</label>
							<div class="col-sm-10">
								<input type="password" class="form-control input-xs" id="pass" placeholder="Введите пароль" name="pass_auth">
							</div>
					</div>
					<div class="col-sm-10"></div>
					<input type="submit" class="btn btn-success" value="Войти" name="auth"/> 
				</form>
			</div>
			<div role="tabpanel" class="tab-pane " id="profile" style="margin:2%;">
				<form action="/" method="POST" class="form-horizontal">
					<div class="form-group has-success">
							<label for="pass" class="col-sm-2 control-label">Логин*</label>
							<div class="col-sm-10">
								<input type="text" class="form-control input-xs" id="pass" placeholder="Введите логин" name="login_sup" >
							</div>
					</div>
					<div class="form-group has-success">
							<label for="pass" class="col-sm-2 control-label">Пароль*</label>
							<div class="col-sm-10">
								<input type="password" class="form-control input-xs" id="pass" placeholder="Введите пароль" name="pass_sup" value="<?php echo @$_POST['pass_sup'] ?>">
							</div>
					</div>
					<div class="form-group has-success">
							<label for="pass" class="col-sm-2 control-label">Имя*</label>
							<div class="col-sm-10">
								<input type="text" class="form-control input-xs" id="pass" placeholder="Введите имя" name="fname_sup" value="<?php echo @$_POST['fname_sup'] ?>">
							</div>
					</div>
					<div class="form-group has-success">
							<label for="pass" class="col-sm-2 control-label">Фамилия*</label>
							<div class="col-sm-10">
								<input type="text" class="form-control input-xs" id="pass" placeholder="Введите фамилию" name="sname_sup" value="<?php echo @$_POST['sname_sup'] ?>">
							</div>
					</div>
					<div class="form-group has-success">
							<label for="pass" class="col-sm-2 control-label">Email*</label>
							<div class="col-sm-10">
								<input type="text" class="form-control input-xs" id="pass" placeholder="Введите почту" name="email_sup" value="<?php echo @$_POST['email_sup'] ?>">
							</div>
					</div>
					<div class="col-sm-8">* - Обязательно для заполнения</div>
					<input type="submit" class="btn btn-success" value="Присоединиться" name="sup"/> 
				</form>
			</div>
		 </div>
	</div>
	<!-- <div id="myModal" class="modal fade" tabindex="-1">
				<div class="modal-dialog modal-sm">
				  	<div class="modal-content">
						<div class="modal-header">
						  <button class="close" data-dismiss="modal">х</button>
						  <h4 class="modal-title">Продолжение регистрации</h4>
						</div>
						<div class="modal-body">Введите ваш код,высланный на почту</div>
							<form action="completion.php" method="POST">
								<div class="modal-body">
										<input type="text" name="codecompletion" placeholder="Код"/>
								</div>
								<div class="modal-footer">
									<input type="submit" class="btn btn-primary" data-dismiss="modal" value="Подтвердить"/>
								</div>
							</form>
				  		</div> s
				</div>
	</div>-->
	<?php
		require_once "footer.php";
	?>
