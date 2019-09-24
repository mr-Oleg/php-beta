<?php
	require_once "header.php";

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }

    $id = $_GET['id'];

    switch ($_GET['type']) {
    	case 'sign':
    		$res = mysqli_query($connection,"Select * From signs Where id='$id';");
			$route = 'signs_pic\\';
			$result = mysqli_fetch_assoc($res);
			$id = $result['TypeOfSign'];
			$type = mysqli_query($connection,"Select * From TypeOfSign Where ID='$id';");
			$type_1 = mysqli_fetch_assoc($type);
			$type_1 = $type_1['Title'];
    		break;

    	case 'markup':
    		$res = mysqli_query($connection,"Select * From Markup Where id='$id';");
			$route = 'markups_pic\\';
			$result = mysqli_fetch_assoc($res);
			$id = $result['TypeOfMarkup'];
			$type = mysqli_query($connection,"Select * From TypeOfMarkup Where ID='$id';");
			$type_1 = mysqli_fetch_assoc($type);
			$type_1 = $type_1['Title'];
    		break;
    	
    	default:
    		# code...
    		break;
    }

    ?>

<div class="container">
	<div class="row">
		<div class="col-md-8" style="border:1px gray solid;border-radius:10px;">
			<p class="text-center" style="font-size:200%;font-style:italic;font-weight:bolder;">Подробная информация</p>
			<p class="text-left" style="font-size:150%;font-weight:bolder;">Наименование: <span style="font-weight:normal;"><?php echo $result['Title']; ?></span></p>
			<p class="text-left" style="font-size:150%;font-weight:bolder;">Номер: <span style="font-weight:normal;"><?php echo $result['Number']; ?></span></p>
			<p class="text-left" style="font-size:150%;font-weight:bolder;">Раздел: <span style="font-weight:normal;"><?php echo $type_1; ?></span></p>
			<p class="text-left" style="font-size:150%;font-weight:bolder;">Описание: <span style="font-weight:normal;"><?php if($result['Description']!="") echo $result['Description'];else echo "Подробное описание отсутствует"; ?></span></p>
			<p class="text-center" style="text-align:center;font-size:150%;font-weight:bolder;">Изображение:</p> <?php echo "<p style='text-align:center;'><img alt='Bootstrap Image Preview' style='width: 300px;' src='" . $route.$result['Number']. ".png' /></p>";?>
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
									echo "<p style='text-align:center;'><img class ='img-responsive img-thumbnail img-rounded' src='" . "news_pic\\" . $result['ImgSource'] . ".png" . "'/></p>";
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
<?php
	require_once "footer_1.php";
?>