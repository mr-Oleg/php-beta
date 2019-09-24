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
                            $count_1 = mysqli_query($connection,"Select * From TypeOfSign;");
                            $count_1 = mysqli_num_rows($count_1);



                            $temp_query = mysqli_query($connection, "SELECT * FROM TypeOfSign");
                            // $temp = mysqli_fetch_all($temp_query);
                            // print_r($temp);
                            // echo $count_1;
                            for($i = 1; $i <= $count_1; $i++){
                                $temp_fetch = mysqli_fetch_assoc($temp_query);
                                // print_r($temp_fetch);
                                // echo $temp[$i][0]." ";
                                $_id = $temp_fetch['ID'];
                                $title = mysqli_query($connection,"Select Title From TypeOfSign Where ID = '$_id';");
                                $title_1 = mysqli_fetch_assoc($title);
                                $title_1 = $title_1['Title'];
                                echo "<div class='text-center visible_" . $i ."' style=' font-size: 20px;'><a name='$i'></a>".$title_1."</div>";
                                $signArray = mysqli_query($connection,"Select * From signs Where TypeOfSign='$i';");
                                while($result = mysqli_fetch_assoc($signArray)){
                                    $imgSrc = "signs_pic\\" . $result['Number'] . ".png";
                                    $sign = $result['Number'];
                                    //$titleOfSign = $result['Title'];
                                    mb_internal_encoding('UTF-8');
									$titleOfSign = mb_substr($result['Title'],0,50);
                                    echo    "<div class='col-md-3 swing visible_". $i . "' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 245px;'>
                                                <img class ='img-responsive img-thumbnail img-rounded' src='$imgSrc' style='width: 190px; height: 140px;'/>
                                                <div class='text-center' style='color:gray;'><small>$sign</small></div>
                                                <div class='text-center' >
                                                    $titleOfSign...
                                                </div>
                                                <div class='text-center'>
                                                    <a href='details.php?id=".$result['ID']."&type=sign'>Изучить подробнее</a>
                                                </div>
                                            </div>";
                                }
                            }
                        ?>

                    </div>
                    <div class="col-md-3" style="position: sticky; top: 2%;">
                        <div class="col-md-12" style="border: 0px gray solid; border-radius: 10px;">
                                <ul class="list-group list-unstyled">

                                    <?php 
                                        $types = mysqli_query($connection,"Select * From TypeOfSign;");
                                        $localCounter = 1;
                                        while($result = mysqli_fetch_assoc($types)){
                                            $titleOfSign = $result['Title'];
                                            echo "<a href='#" . $localCounter . "' class='list-group-item' onclick='show_" . $localCounter . "();'><li>$titleOfSign</li></a>";
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

    for($u = 2; $u <= $count_1; $u++){
       echo 'a = document.getElementsByClassName("visible_' . $u . '");
        for(var i=0; i<a.length; i++) a[i].style.display = "none";';
    }


    for($i = 1; $i <= $count_1; $i++){
        echo '
                function show_' . $i . '(){
                    var a = document.getElementsByClassName("visible_' . $i . '");
                    for(var i=0; i<a.length; i++) a[i].style.display = "block";';
                    for($o = 1; $o <= $count_1; $o++){
                        if($i == $o) continue;
                        else echo 
                        'a = document.getElementsByClassName("visible_' . $o . '");
                        for(var i=0; i<a.length; i++) a[i].style.display = "none";';
                    }
        echo '  }';
    }
    echo '</script>';

	require_once "footer_1.php";
?>