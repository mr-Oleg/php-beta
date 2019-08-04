<?php
    require_once "header.php";

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }
?>

            <div class="container">
                <div class="row">
                    <div class="col-md-9">

                        <?php
                            for($i = 1; $i <= 2; $i++){
                                $title = mysqli_query($connection,"Select Title From TypeOfMarkup Where ID = '$i';");
                                $title_1 = mysqli_fetch_assoc($title);
                                $title_1 = $title_1['Title'];
                                echo "<div class='text-center visible_markup_" . $i ."' style=' font-size: 20px;'><a name='$i'></a>$title_1</div>";
                                $markupArray = mysqli_query($connection,"Select * From Markup Where TypeOfMarkup='$i';");
                                while($result = mysqli_fetch_assoc($markupArray)){
                                    $imgSrc = $result['ImageSrc'];
                                    $mark = $result['Number'];
                                    $titleOfMarkup = $result['Title'];
                                    echo    "<div class='col-md-3 swing visible_markup_". $i . "' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 245px;'>
                                                <img class ='img-responsive img-thumbnail img-rounded' src='$imgSrc' style='width: 190px; height: 140px;'/>
                                                <div class='text-center' style='color:gray;'><small>$mark</small></div>
                                                <div class='text-center' >
                                                    $titleOfMarkup
                                                </div>
                                                <div class='text-center'>
                                                    <a href='#'>Изучить подробнее</a>
                                                </div>
                                            </div>";
                                }
                            }
                        ?>

                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12" style="border: 0px gray solid; border-radius: 10px;">
                                <ul class="list-group list-unstyled">

                                    <?php 
                                        $types = mysqli_query($connection,"Select * From TypeOfMarkup;");
                                        $localCounter = 1;
                                        while($result = mysqli_fetch_assoc($types)){
                                            $titleOfType = $result['Title'];
                                            echo "<a href='#" . $localCounter . "' class='list-group-item' onclick='show_markup_" . $localCounter . "();'><li>$titleOfType</li></a>";
                                            $localCounter++;
                                        }
                                    ?>
                                    
                                </ul>
                        </div>
                    </div>
                </div>
            </div>

<?php
	require_once "footer_1.php";
?>