<?php
	require_once "header.php";
	
	if(!isset($_SESSION['fname'])){
		header("Location: index.php");
	}
?>
<?php
	global $pageCounter;
	define("countOfArticles",5);
	if(isset($_GET['page'])){
		$pageCounter = $_GET['page'];
		settype($pageCounter,"integer");
	}
	else {
		header("Location: ../error.php");
	}
?>
	<div class="container">
			<div class="row">

				<div class="col-md-8">
						<?php
							$pageCounter--;
							$pageCounter=$pageCounter*countOfArticles;
							$count = countOfArticles;
							$res_1 = mysqli_query($connection,"Select * From News Order By ID Desc Limit $pageCounter,$count;");
							if($res_1){
								while($result_1 = mysqli_fetch_assoc($res_1)){
									echo "<div class='col-md-12 ' style='border: 1px gray solid; border-radius: 10px; margin: 1%;'>";
									echo "<h1> " . $result_1['Title'] ."</h1>
									<small style='color:gray;'><span class='glyphicon glyphicon-calendar'></span> " . $result_1['Date'] . "</small>";
									if( $result_1['ImgSource']!=NULL){
										echo "<img class ='img-responsive img-thumbnail img-rounded' src='" . $result_1['ImgSource'] . "'/>";
									}
									$text = substr($result_1['Text'],0,50);
										echo "<p> $text
										</p>
										<p class='col-md-4'><a href='#'>Читать полностью...</a></p>";
										$id = $result_1['ID'];
										$showAuthor = mysqli_query($connection,"SELECT FirstName, LastName From Users INNER JOIN News ON Users.ID = News.AuthorID Where News.ID = '$id';");
										if($showAuthor){
											$showAuthor_1 = mysqli_fetch_assoc($showAuthor);
											echo "<p class='col-md-4 text-center'><span class='glyphicon glyphicon-user'></span>Автор: " . $showAuthor_1['FirstName'] . " " . $showAuthor_1['LastName'] . "</p>";
										}else{
											echo "<p class='col-md-4 text-center'><span class='glyphicon glyphicon-user'></span>Автор: Неизвестен</p>";
										}
										echo "<p class='col-md-4 text-right '><span class='glyphicon glyphicon-eye-open'></span> Просмотров <span class='badge'> " .$result_1['Views'].  "</span></p>";
										echo "</div>";
								}
							}else{
								echo "шот не робит";
							}
						?>
				</div>
                
                <div class="col-md-4">
                        <div class="col-md-12" style="border: 1px gray solid; border-radius: 10px; margin: 1%;"><!--margin:1%-->
                                <p class="text-center">Самые читаемые посты</p>
                                <?php 
									$res = mysqli_query($connection,"Select * From News Order by Views DESC Limit 0,3;");
									while($result = mysqli_fetch_assoc($res)){
									echo 	"<div>
											<p style='font-weight:bold;'><a href='#'>" . $result['Title'] . "</a></p>
											<span class='glyphicon glyphicon-calendar'></span><small style='color:gray;'>Date:" . $result['Date'] . "</small>";
									if($result['ImgSource']!=NULL){
										echo "<img class ='img-responsive img-thumbnail img-rounded' src='".$result['ImgSource']."'/>";
									}
									$text = substr($result['Text'],0,200);
									echo	"<p>" . $text . "
											</p>
											</div>";
									}
								?>
                        </div>
				</div>		
			</div>
	</div>
	<div class="container text-center">
		<p><a href="#">Предыдущая</a> Страницa: 1 <a href="#">Следующая</a></p> 
	</div>


<?php
	require_once "footer_1.php";
?>