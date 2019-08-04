<?php
	require_once "header.php";
	
	if(!isset($_SESSION['fname'])){
		header("Location: index.php");
	}
?>
<div class="container">
            <div class="row">
                <div class="col-md-8" style="margin:1%;">
                    <p class="text-center" style="font-size:150%; font-weight: bold;">Упс, что-то пошло не так...</p>
                    <img class ='img-responsive img-thumbnail img-rounded' src='https://pp.userapi.com/c850536/v850536351/17a665/ndb3jMvCLwE.jpg'/>
                </div>
            </div>
</div>
<?php
	require_once "footer_1.php";
?>