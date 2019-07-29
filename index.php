<?php
    require_once "header.php";
	
	$login = "";
	if(isset($_POST['auth'])){
		if(isset($_POST['login_auth'])){
			$login = htmlentities($_POST['login_auth']); 
			$res = mysqli_query($connection,"Select * From Users Where Login='$login';");
			if($res==true){
				echo "succeful query!";
				$result = mysqli_fetch_assoc($res);
				if($result['Login']==$login){
					echo "есть такой логин!" ;
				}
				else{
					echo "нет такого!" ;
					exit();
				}
			 }else{
				 echo 'no succeful query!';
				 
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
						$_SESSION['fname']=$result['First Name'];
						$_SESSION['lname']=$result['Last Name'];
						header("Location: feed.php");
						//exit();
					}
					else{
						echo "Пароли не совпали!";
					}
				}else{
					echo 'no succeful query!';					
				}
			}
		}
	}
	else if(isset($_POST['sup'])){
		if(isset($_POST['login_sup'])){
			
		}
		if(isset($_POST['pass_sup'])){
			
		}
		if(isset($_POST['fname_sup'])){
			
		}
		if(isset($_POST['sname_sup'])){
			
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
								<input type="text" class="form-control input-xs" id="pass" placeholder="Введите логин" name="login_sup" value="<?php echo @$_POST['login_sup'] ?>">
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
								<input type="text" class="form-control input-xs" id="pass" placeholder="Введите фамилию" name="sname_sup" <?php echo @$_POST['sname_sup'] ?>">
							</div>
					</div>
					<div class="col-sm-8">* - Обязательно для заполнения</div>
					<input type="submit" class="btn btn-success" value="Присоединиться" name="sup"/> 
				</form>
			</div>
		 </div>
	</div>
