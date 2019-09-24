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
                            //$count_1 = mysqli_query($connection,"Select COUNT(ID) From TypeOfMarkup;");
                            //print_r( $count_1);
                            // settype($count,"integer");
                            //$count = mysqli_fetch_assoc($count_1);
                            $count_1 = mysqli_query($connection,"Select * From TypeOfMarkup;");
                            $count_1 = mysqli_num_rows($count_1);
                            for($i = 1; $i <= $count_1; $i++){
                                $title = mysqli_query($connection,"Select Title From TypeOfMarkup Where ID = '$i';");
                                $title_1 = mysqli_fetch_assoc($title);
                                $title_1 = $title_1['Title'];
                                echo "<div class='text-center visible_markup_" . $i ."' style=' font-size: 20px;'><a name='$i'></a>$title_1</div>";
                                $markupArray = mysqli_query($connection,"Select * From Markup Where TypeOfMarkup='$i';");
                                while($result = mysqli_fetch_assoc($markupArray)){
                                    $imgSrc = $result['ImageSrc'];
                                    $mark = $result['Number'];
                                    //$titleOfMarkup = $result['Title'];
                                    mb_internal_encoding('UTF-8');
									$titleOfMarkup = mb_substr($result['Title'],0,50);
                                    echo    "<div class='col-md-3 swing visible_markup_". $i . "' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 245px;'>
                                                <img class ='img-responsive img-thumbnail img-rounded' src='$imgSrc' style='width: 190px; height: 140px;'/>
                                                <div class='text-center' style='color:gray;'><small>$mark</small></div>
                                                <div class='text-center' >
                                                    $titleOfMarkup ...
                                                </div>
                                                <div class='text-center'>
                                                    <a href='details.php?id=".$result['ID']."&type=markup'>Изучить подробнее</a>
                                                </div>
                                            </div>";
                                }
                            }
                        ?>

                    </div>
                    <div class="col-md-3" style="position: sticky; top: 2%;"><!---->
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
    echo '<script language="javascript">';
    for($i = 1; $i <= $count_1; $i++){
        echo '
                function show_markup_' . $i . '(){
                    var a = document.getElementsByClassName("visible_markup_' . $i . '");
                    for(var i=0; i<a.length; i++) a[i].style.display = "block";';
                    for($o = 1; $o <= $count_1; $o++){
                        if($i == $o) continue;
                        else echo 
                        'a = document.getElementsByClassName("visible_markup_' . $o . '");
                        for(var i=0; i<a.length; i++) a[i].style.display = "none";';
                    }
        echo '}';
    }
    echo '</script>';

	require_once "footer_1.php";
?>