<?php
    require_once "header.php";

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }
	$news_id = $_GET['id'];

	$select_news = mysqli_query($connection, "SELECT * FROM `News` n JOIN `Users` u ON n.AuthorID = u.ID WHERE n.ID = $news_id");
	$result_select = mysqli_fetch_assoc($select_news);

	$update_news = mysqli_query($connection, "UPDATE `News` SET Views = ((SELECT Views FROM `News` Where ID = $news_id) + 1) Where ID = $news_id");

?>
    <div class="container">
	    <div class="row">
            <div class="col-md-8" style="border:1px gray solid;border-radius:10px;">
                <p class="text-center" style="font-size:200%; font-style:italic; font-weight:bolder;"><?php echo $result_select['Title']; ?></p>
                <p class="text-left" style="color:gray; font-weight:bolder;"><span class='glyphicon glyphicon-user'></span> Автор: <?php echo $result_select['FirstName']." ".$result_select['LastName'];?></p>
                <p class="text-left" style="color:gray; font-weight:bolder;"><span class='glyphicon glyphicon-calendar'></span> Дата: <?php echo $result_select['Date'];?></p>
                <?php if($result_select['ImgSource']!=null) echo "<p style='text-align:center'><img class ='img-responsive img-thumbnail img-rounded' src='" . "news_pic\\" . $result_select['ImgSource'] . ".png" .  "'/></p>"; ?>
                <p style="white-space: pre-line;"> <?php echo $result_select['Text']; ?></p>
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