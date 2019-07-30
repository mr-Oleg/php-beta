<?php
    require_once "header.php";
    $fname = $_SESSION['sup_data_completion']['fname_sup'];
	$sname = $_SESSION['sup_data_completion']['sname_sup'];
    if(isset($_POST['sup'])){
        echo "есть sup!";
        if(isset($_POST['codeactivation'])){
            $codeAct = $_POST['codeactivation'];
            if($codeAct == $_SESSION['code']){
                echo "вроде норм!";
                $login = $_SESSION['sup_data_completion']['login_sup'];
                $pass = $_SESSION['sup_data_completion']['pass_sup'];
                $email = $_SESSION['sup_data_completion']['email_sup'];
                $result = mysqli_query($connection,"INSERT INTO Users (Login,Password,FirstName,LastName,Email) VALUES ('$login','$pass','$fname','$sname','$email');");
                if($result){
                    echo "Успееех!";
					$_SESSION['login']=$_SESSION['sup_data_completion']['login_sup'];
					$_SESSION['password']=$_SESSION['sup_data_completion']['pass_sup'];
					$_SESSION['fname']=$_SESSION['sup_data_completion']['fname_sup'];
					$_SESSION['lname']=$_SESSION['sup_data_completion']['sname_sup'];
					$_SESSION['email']=$_SESSION['sup_data_completion']['email_sup'];
                    unset($_SESSION['sup_data_completion']);
                    unset($_SESSION['code']);
                    header("Location: feed.php");
                }
                else{
                    echo "хуёвый запрос!";
                }
            }
            else{
                echo 'Код неверный!';
            }
        }
        else{
            echo 'неверный код!';
        }
    }
    else if(isset($_SESSION['sup_data_completion'])){
        $login = $_SESSION['sup_data_completion']['login_sup'];
        $pass = $_SESSION['sup_data_completion']['pass_sup'];
		$fname = $_SESSION['sup_data_completion']['fname_sup'];
		$sname = $_SESSION['sup_data_completion']['sname_sup'];
		$email = $_SESSION['sup_data_completion']['email_sup'];
        $code = rand(1000, 9999);
        $_SESSION['code'] = $code;
        $message = "Здравствуйте, уважаемый $fname $sname !</br> Вот ваш код - $code. Введите его в запрашиваемую форму для продолжения регистрации.";
		$subject = "Регистрация на сайте ПДД 2019";
		$to= "$email";
		$from = 'From: pdd2019@admin.ru'."\r\n";
        //mail($to,$subject,$message,$from);
        echo "$code";
        
    }else{
        echo "Неизвестная ошибка!";
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p>
                <?php 
                    echo "Дорогой $fname $sname, Приветствуем вас на нашем сайте! Вам на почту был выслан код активации, введите его в форму ниже.";
                ?>
            </p>
            <form method="POST" action="completion.php" class="form-horizontal">
                <input type="text" name="codeactivation" placeholder="Введите сюда ваш код:"/>
                <input type="submit" class="btn btn-primary" value="Подтвердить" name="sup"/> 
            </form>
        </div>
    </div>
</div>
<?php
    require_once "footer.php";
?>