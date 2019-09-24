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
		$pageCounter--;
		$pageCounter=$pageCounter*countOfArticles;
		$count = countOfArticles;
		$res_1 = mysqli_query($connection,"Select * From News Order By ID Desc Limit $pageCounter,$count;");
		// print_r($res_1);
		$temp = mysqli_query($connection,"Select * From News Order By ID Desc Limit $pageCounter,$count;");
		$temp_fetch = mysqli_fetch_all($temp);
		// echo "<br/>";
		// print_r($temp);
		if (!$temp || count($temp_fetch)<1) {
			header("Location: feed.php?page=1");
		}
	}
	else {
		header("Location: ../error.php");
	}
?>
	<div class="container">
			<div class="row">

				<div class="col-md-8">
						<?php
							

							// $asd = mysqli_fetch_all($res_1);
							// print_r($asd[0]);

							if($res_1){
								while($result_1 = mysqli_fetch_assoc($res_1)){
									echo "<div class='col-md-12 ' style='border: 1px gray solid; border-radius: 10px; margin: 1%;'>";
									echo "<p style='font-size:200%;font-weight:bolder;font-style:italic; text-align:center;'> " . $result_1['Title'] ."</p>
									<small style='color:gray;'><span class='glyphicon glyphicon-calendar'></span> " . $result_1['Date'] . "</small>";
									if( $result_1['ImgSource']!=NULL){
										echo "<p style='text-align:center; max-height:20%;'><img class ='img-responsive img-thumbnail img-rounded' src='" . "news_pic\\" . $result_1['ImgSource'] . ".png" . "'/></p>";
									}
									mb_internal_encoding('UTF-8');//
									$text = mb_substr($result_1['Text'],0,50);//
										$id = $result_1['ID'];
										echo "<p> $text...
										</p>
										<p class='col-md-4'><a href='news_details.php?id=".$id."'>Читать полностью...</a></p>";
										$showAuthor = mysqli_query($connection,"SELECT FirstName, LastName From Users INNER JOIN News ON Users.ID = News.AuthorID Where News.ID = '$id';");
										if($showAuthor){
											$showAuthor_1 = mysqli_fetch_assoc($showAuthor);
											echo "<p class='col-md-4 text-center'><span class='glyphicon glyphicon-user'></span> Автор: " . $showAuthor_1['FirstName'] . " " . $showAuthor_1['LastName'] . "</p>";
										}else{
											echo "<p class='col-md-4 text-center'><span class='glyphicon glyphicon-user'></span> Автор: Неизвестен</p>";
										}
										echo "<p class='col-md-4 text-right '><span class='glyphicon glyphicon-eye-open'></span> Просмотров <span class='badge'> " .$result_1['Views'].  "</span></p>";
										echo "</div>";
								}
							}else{
								echo "шот не робит";
							}
						?>
				</div>
                
                <div class="col-md-4" style="position: sticky; top: 2%;">
					<div class="col-md-12" style="border: 1px gray solid; border-radius: 10px; margin: 1%;"><!--margin:1%-->
						<p class="text-center" style="font-size:150%;font-style:italic;font-weight:bolder;">Самые читаемые посты</p>
						<?php 
							$res = mysqli_query($connection,"Select * From News Order by Views DESC Limit 0,3;");
							while($result = mysqli_fetch_assoc($res)){
								echo 	"<div>
											<p style='font-weight:bold;'><a href='news_details.php?id=".$result['ID']."'>" . $result['Title'] . "</a></p>
											<span class='glyphicon glyphicon-calendar'></span><small style='color:gray;'> Date:" . $result['Date'] . "</small>";
								if($result['ImgSource']!=NULL){
									echo "<p style='text-align:center; max-height:20%;'><img class ='img-responsive img-thumbnail img-rounded' src='" . "news_pic\\" . $result['ImgSource'] . ".png" . "'/></p>";
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
		<p><a href=<?php echo "feed.php?page=".($_GET['page']-1); ?> >Предыдущая</a> Страницa: <?php echo $_GET['page']; ?> <a href=<?php echo "feed.php?page=".($_GET['page']+1); ?> >Следующая</a></p> 
	</div>


<?php
	require_once "footer_1.php";
?>