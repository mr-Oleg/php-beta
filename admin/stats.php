<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['admin'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Stats viewer</title>
        <script>
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            require_once "admin_header.php";
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center visible_1" style=" font-size: 20px; margin:1%;">Статистика посещений</div>
                        <div class="row text-center">
                            <div class="col-md-2" onclick="a();switchToDay();"><a href="#" ><span class="glyphicon glyphicon-th-list"></span> По дням</a></div>
                            <div class="col-md-2" onclick="b();switchToMonth();"><a href="#" ><span class="glyphicon glyphicon-th-list"></span> По месяцам</a></div>
                            <div class="col-md-2" onclick="c();switchToYear();"><a href="#" ><span class="glyphicon glyphicon-th-list"></span> По годам</a></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="pass" class="col-sm-4 control-label" style="font-size:150%;">Период</label>
                                    <div class="col-sm-6">
                                        <select class="form-control input-xs" id="day" style="display: block;" name="day" required onchange="selector_1(this.options[this.selectedIndex]);">
                                            <option value="a">7 дней</option>
                                            <option value="b">30 дней</option>
                                            <option value="c">365 дней</option>
                                            <option value="d">Весь период</option>
                                        </select>
                                        <select class="form-control input-xs" id="month" style="display: none;" name="month" required onchange="selector_1(this.options[this.selectedIndex]);">
                                            <option value="e">Полгода</option>
                                            <option value="f">Год</option>
                                            <option value="g">Весь период</option>
                                        </select>
                                        <select class="form-control input-xs" id="year" style="display: none;" name="year" required onchange="selector_1(this.options[this.selectedIndex]);">
                                            <option value="h">Год</option>
                                            <option value="i">2 года</option>
                                            <option value="j">Весь период</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                            </div>
                        </div>

                        <?php
                            //7 дней по дням
                            echo "<div id='1'> <table class='table table-bordered table-hover' style=' margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Дата</td>
                                            <td class='text-center warning'>Уникальные пользователи</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-6 days'));
                            $temporary_1 = mysqli_query($connection,"Select * From Visits Where Date <= '$currentDate' AND Date >= '$date';");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";

                        //30 дней по дням
                        echo "<div id='2' style='display:none;'> <table class='table table-bordered table-hover' style='margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Дата</td>
                                            <td class='text-center warning'>Уникальные пользователи</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-1 months'));
                            $temporary_1 = mysqli_query($connection,"Select * From Visits Where Date <= '$currentDate' AND Date > '$date';");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";

                        //365 дней по дням
                        echo "<div id='3' style='display:none;'><table class='table table-bordered table-hover' style='margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Дата</td>
                                            <td class='text-center warning'>Уникальные пользователи</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-1 years'));
                            $temporary_1 = mysqli_query($connection,"Select * From Visits Where Date <= '$currentDate' AND Date > '$date';");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";
                        
                        //весь период
                        echo "<div id='4' style='display:none;'><table class='table table-bordered table-hover' style='margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Дата</td>
                                            <td class='text-center warning'>Уникальные пользователи</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-100 years'));
                            $temporary_1 = mysqli_query($connection,"Select * From Visits Where Date <= '$currentDate' AND Date > '$date';");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";
                        
                        //полгода по месяцам
                        echo "<div id='5' style='display:none;'><table class='table table-bordered table-hover' style='margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Месяц</td>
                                            <td class='text-center warning'>Посещения</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-6 months'));
                            $temporary_1 = mysqli_query($connection,"SELECT DATE_FORMAT(date, '%m-%y') as 'Date', SUM(Hosts) as 'Hosts', SUM(Views) as 'Views' FROM Visits WHERE Date BETWEEN '$date' AND '$currentDate' GROUP BY DATE_FORMAT(date, '%m-%y') ORDER BY YEAR(date) DESC, MONTH(date) DESC;");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";

                            //год по месяцам
                            echo "<div id='6' style='display:none;'><table class='table table-bordered table-hover' style='margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Месяц</td>
                                            <td class='text-center warning'>Посещения</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-1 years'));
                            $temporary_1 = mysqli_query($connection,"SELECT DATE_FORMAT(date, '%m-%y') as 'Date', SUM(Hosts) as 'Hosts', SUM(Views) as 'Views' FROM Visits WHERE Date BETWEEN '$date' AND '$currentDate' GROUP BY DATE_FORMAT(date, '%m-%y') ORDER BY YEAR(date) DESC, MONTH(date) DESC;");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";
                            
                            //весь период по месяцам
                            echo "<div id='7' style='display:none;'><table class='table table-bordered table-hover' style='margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Месяц</td>
                                            <td class='text-center warning'>Посещения</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-100 years'));
                            $temporary_1 = mysqli_query($connection,"SELECT DATE_FORMAT(date, '%m-%y') as 'Date', SUM(Hosts) as 'Hosts', SUM(Views) as 'Views' FROM Visits WHERE Date BETWEEN '$date' AND '$currentDate' GROUP BY DATE_FORMAT(date, '%m-%y') ORDER BY YEAR(date) DESC, MONTH(date) DESC;");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";

                            //год по годам
                            echo "<div id='8' style='display:none;'><table class='table table-bordered table-hover' style='margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Год</td>
                                            <td class='text-center warning'>Посещения</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-1 years'));
                            $temporary_1 = mysqli_query($connection,"SELECT DATE_FORMAT(date, '%y') as 'Date', SUM(Hosts) as 'Hosts', SUM(Views) as 'Views' FROM Visits WHERE Date BETWEEN '$date' AND '$currentDate' GROUP BY DATE_FORMAT(date, '%y') ORDER BY YEAR(date) DESC;");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";

                            //2 года по годам

                            echo "<div id='9' style='display:none;'><table class='table table-bordered table-hover' style='margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Год</td>
                                            <td class='text-center warning'>Посещения</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-2 years'));
                            $temporary_1 = mysqli_query($connection,"SELECT DATE_FORMAT(date, '%y') as 'Date', SUM(Hosts) as 'Hosts', SUM(Views) as 'Views' FROM Visits WHERE Date BETWEEN '$date' AND '$currentDate' GROUP BY DATE_FORMAT(date, '%y') ORDER BY YEAR(date) DESC;");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";

                            //весь период по годам
                            echo "<div id='10' style='display:none;'><table class='table table-bordered table-hover' style='margin-top:1%;'>
                                    <thead class='active'>
                                        <tr>
                                            <td class='text-center info'>Год</td>
                                            <td class='text-center warning'>Посещения</td>
                                            <td class='text-center success'>Просмотры</td>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $currentDate = date('Y-m-d');
                            $date = date('Y-m-d', strtotime('-100 years'));
                            $temporary_1 = mysqli_query($connection,"SELECT DATE_FORMAT(date, '%y') as 'Date', SUM(Hosts) as 'Hosts', SUM(Views) as 'Views' FROM Visits WHERE Date BETWEEN '$date' AND '$currentDate' GROUP BY DATE_FORMAT(date, '%y') ORDER BY YEAR(date) DESC;");
                            while($temporary = mysqli_fetch_assoc($temporary_1)){
                                $date_td = $temporary['Date'];
                                $hosts_td = $temporary['Hosts'];
                                $views_td = $temporary['Views'];
                                echo "<tr>
                                        <td class='text-center'>$date_td</td>
                                        <td class='text-center'>$hosts_td</td>
                                        <td class='text-center'>$views_td</td>
                                      </tr>";
                            }
                            echo "  </tbody>    
                                </table></div>";
                        ?>
                    </div>  
                </div>
        </div> 
        <script language="javascript">
            function a(){
                document.getElementById('day').style.display = 'block';
                document.getElementById('month').style.display = 'none';
                document.getElementById('year').style.display = 'none';
            }
            function b(){
                document.getElementById('day').style.display = 'none'; 
                document.getElementById('month').style.display = 'block';
                document.getElementById('year').style.display = 'none';
            }
            function c(){
                document.getElementById('day').style.display = 'none'; 
                document.getElementById('month').style.display = 'none';
                document.getElementById('year').style.display = 'block';
            }

            function switchToDay(){
                var value = 1;
                for(var i = 1; i<=10; i++){
                    if(i==value){ 
                        document.getElementById(String(value)).style.display = 'block';
                    }
                    else document.getElementById(String(i)).style.display = 'none';
                }
            }

            function switchToMonth(){
                var value = 5;
                for(var i = 1; i<=10; i++){
                    if(i==value) document.getElementById(String(value)).style.display = 'block';
                    else document.getElementById(String(i)).style.display = 'none';
                }
            }

            function switchToYear(){
                var value = 8;
                for(var i = 1; i<=10; i++){
                    if(i==value) document.getElementById(String(value)).style.display = 'block';
                    else document.getElementById(String(i)).style.display = 'none';
                }
            }

            function selector_1(opt){
                if(opt.value=='a'){
                    var value = 1;
                    for(var i = 1; i<=10; i++){
                        if(i==value){ 
                            document.getElementById(String(value)).style.display = 'block';
                        }
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
                else if(opt.value=='b'){
                    var value = 2;
                    for(var i = 1; i<=10; i++){
                        if(i==value){
                            document.getElementById(String(value)).style.display = 'block';
                        }
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
                else if(opt.value=='c'){
                    var value = 3;
                    for(var i = 1; i<=10; i++){
                        if(i==value) document.getElementById(String(value)).style.display = 'block';
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
                else if(opt.value=='d'){
                    var value = 4;
                    for(var i = 1; i<=10; i++){
                        if(i==value) document.getElementById(String(value)).style.display = 'block';
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
                else if(opt.value=='e'){
                    var value = 5;
                    for(var i = 1; i<=10; i++){
                        if(i==value) document.getElementById(String(value)).style.display = 'block';
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
                else if(opt.value=='f'){
                    var value = 6;
                    for(var i = 1; i<=10; i++){
                        if(i==value) document.getElementById(String(value)).style.display = 'block';
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
                else if(opt.value=='g'){
                    var value = 7;
                    for(var i = 1; i<=10; i++){
                        if(i==value) document.getElementById(String(value)).style.display = 'block';
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
                else if(opt.value=='h'){
                    var value = 8;
                    for(var i = 1; i<=10; i++){
                        if(i==value) document.getElementById(String(value)).style.display = 'block';
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
                else if(opt.value=='i'){
                    var value = 9;
                    for(var i = 1; i<=10; i++){
                        if(i==value) document.getElementById(String(value)).style.display = 'block';
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
                else {
                    var value = 10;
                    for(var i = 1; i<=10; i++){
                        if(i==value) document.getElementById(String(value)).style.display = 'block';
                        else document.getElementById(String(i)).style.display = 'none';
                    }
                }
               
            }
        </script>
    </body>
</html>