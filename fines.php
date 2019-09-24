<?php
    require_once "header.php";
    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }
    require_once "counter.php";
?>

<div class="container">
            <div class="row">
                <div class="col-md-9">

                    <?php
                        $count_1 = mysqli_query($connection,"Select * From TypeOfFines;");
                        $count_1 = mysqli_num_rows($count_1);
                        for($i = 1; $i <= $count_1; $i++){
                            $title = mysqli_query($connection,"Select * From TypeOfFines Where ID = '$i';");
                            $title = mysqli_fetch_assoc($title);
                            $title = $title['Title'];
                            echo    "<div class='text-center visible_fines_" . $i . "' style=' font-size: 20px; margin:1%;'><a name='$i'></a>$title</div>";
                            $fines_1 = mysqli_query($connection,"Select * From Fines Where TypeOfFines ='$i';");
                            echo    "<table class='visible_fines_" . $i . " table table-bordered table-hover'>
                                        <thead class='active'>
                                            <tr>
                                                <td class='text-center info'>КоАП</td>
                                                <td class='text-center warning'>Правонарушение</td>
                                                <td class='text-center danger'>Санкции/Меры</td>
                                            </tr>
                                        </thead>
                                        <tbody>";
                            while($fines = mysqli_fetch_assoc($fines_1)){
                                $number = $fines['CAO'];
                                $offense = $fines['Offense'];
                                $sanctions = $fines['Sanctions'];
                                echo "<tr>
                                        <td class='text-center'>$number</td>
                                        <td class='text-center'>$offense</td>
                                        <td class='text-center'>$sanctions</td>
                                      </tr>";
                            }
                            echo "</tbody></table>";
                        }
                    ?>

                </div>
                <div class="col-md-3" style="position: sticky; top: 2%;">
                    <div class="col-md-12" style="border: 0px gray solid; border-radius: 10px;">
                            <ul class="list-group list-unstyled">

                                <?php
                                    $titles = mysqli_query($connection,"Select Title From TypeOfFines;");
                                    $counter = 1;
                                    while($titleOfFines = mysqli_fetch_assoc($titles)){
                                        $titleOfFines = $titleOfFines['Title'];
                                        echo "<a href='#" . $counter . "' class='list-group-item' onclick='show_fines_" . $counter . "();'><li>$titleOfFines</li></a>";
                                        $counter++;
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
                function show_fines_' . $i . '(){
                    var a = document.getElementsByClassName("visible_fines_' . $i . '");
                    for(var i=0; i<a.length; i++) a[i].style.display = "block";';
                    for($o = 1; $o <= $count_1; $o++){
                        if($i == $o) continue;
                        else echo 
                        'a = document.getElementsByClassName("visible_fines_' . $o . '");
                        for(var i=0; i<a.length; i++) a[i].style.display = "none";';
                    }
        echo '}';
    }
    echo '</script>';

	require_once "footer_1.php";
?>