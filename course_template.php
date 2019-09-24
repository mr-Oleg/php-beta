<?php
    require_once "header.php";
    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }
    if (!isset($_GET['id'])) {
        header("Location: courses.php");
    }
    if (isset($_POST['id'])&&isset($_POST['course'])) {
        $id = $_POST['id'];
        $course = $_POST['course'];
        unset($_POST['id']);
        unset($_POST['course']);
        $insert = mysqli_query($connection, "INSERT INTO Pupil (isAccepted, isDeclared, UserID, CourseID) VALUES (0, 1, $id, $course);");
    }
    require_once "counter.php";
?>
<div class="container">
    <div class="row">
        <div class="col-md-9">

            <?php
                $id = $_GET['id'];
                $get_course = mysqli_query($connection, "SELECT * FROM Course c JOIN Users u ON c.Teacher=u.ID WHERE c.ID = $id;");
                $get_course_result = mysqli_fetch_assoc($get_course);
            ?>

            <p style="text-align:center; font-size:125%; font-weight:bolder; font-style:italic;">Информация о курсе</p>
            <div style="border:1px gray solid; border-radius:10px; margin:1%;padding:1%;">
                <p class="text-center" style="font-size:150%; font-weight:bolder;font-style:italic;"><?php echo $get_course_result['Title']; ?></p>
                <p class="text-left" style="color:gray;"><span class='glyphicon glyphicon-user'></span> Преподаватель: <?php echo $get_course_result['FirstName']." ".$get_course_result['LastName']; ?></p>
                <p style="text-align:center;">
                    <img class ='img-responsive img-thumbnail img-rounded' <?php echo "src='../courses_pic/".$get_course_result['Image']."'"; ?>/>
                </p>
                <p class="text-center" style="font-size:150%; font-weight:bolder;">Описание</p>
                <p class="text-left"> 
                    <?php echo $get_course_result['Description']; ?>
                </p>

                <?php
                    // print_r($_SESSION);
                    // echo "<br/><br/>";
                    // print_r($_GET);

                    $login_user = $_SESSION['login'];
                    $get_id_query = mysqli_query($connection, "SELECT * FROM Users WHERE Login = '$login_user'");
                    $get_id_query_result = mysqli_fetch_assoc($get_id_query);
                    $id_user = $get_id_query_result['ID'];

                    $id_course = $_GET['id'];
                    $check_course = mysqli_query($connection, "SELECT * FROM Pupil WHERE UserID = $id_user AND CourseID = $id_course");
                    if (mysqli_num_rows($check_course)>0) {
                        $check_course_fetch = mysqli_fetch_assoc($check_course);
                        if ($check_course_fetch['isAccepted']==0) {
                            echo "<p class='text-center' style='font-size:150%; font-weight:bolder;'>Ваша заявка рассматривается!</p>";
                        }
                    } else {
                        echo "<form class='text-center' action='course_template.php' method='POST'> 
                                    <input name='id' type='hidden' value='".$id_user."'>
                                    <input name='course' type='hidden' value='".$id_course."'/>
                                    <input type='submit' class='btn btn-success' name='accept' value='Записаться'/>
                                </form>";
                    }

                ?>

                <div class="row text-center">
                    <p class="text-center" style="font-size:150%; font-weight:bolder;">Лекции</p>
                    <div class="col-md-6" ><a href="#" onclick="show_lection_1();"><span class="glyphicon glyphicon-th-list"></span> Доступные мне</a></div>
                    <div class="col-md-6" ><a href="#" onclick="show_lection_2();"><span class="glyphicon glyphicon-th-list"></span> Все лекции</a></div>
                </div>

                <div class="row">
                    <div class="col-md-12">


                        <?php
                            if (mysqli_num_rows($check_course)>0) {
                                if ($check_course_fetch['isAccepted']==0) {
                                    $get_lections = mysqli_query($connection, "SELECT l.Image as 'Image', l.Name as 'Name', l.Description as 'Description' FROM Lections l LEFT JOIN Course c ON c.ID = l.CourseID WHERE CourseID = $id_course");
                                    while ($get_lections_result = mysqli_fetch_assoc($get_lections)) {
                                        echo "<div class='col-md-3 swing visible_lection_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                                                <p style='text-align:center;''><img class='img-responsive img-thumbnail img-rounded' src='../lectures_pic/".$get_lections_result['Image']."' style='width: 190px; height: 140px;'/></p>
                                                <div class='text-center' style='color:gray; '><a href='#''>'".$get_lections_result['Name']."'</a></div>
                                                <div class='text-center' >
                                                    ".substr($get_lections_result['Description'], 0, 15)."..."."
                                                </div>
                                                <div class='text-center'>
                                                    <p>Лекция не доступна</p>
                                                </div>
                                            </div>";
                                    }
                                }
                                if ($check_course_fetch['isAccepted']==1) {
                                    $get_lections = mysqli_query($connection, "SELECT l.ID as 'ID', l.Image as 'Image', l.Name as 'Name', l.Description as 'Description', p.Result as 'Result' FROM Lections l LEFT JOIN Progress p ON l.ID = p.LectionID WHERE CourseID = $id_course");
                                    $get_lections_result = mysqli_fetch_assoc($get_lections);
                                    echo "  <div class='col-md-3 swing visible_lection_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                                                <p style='text-align:center;''><img class='img-responsive img-thumbnail img-rounded' src='../lectures_pic/".$get_lections_result['Image']."' style='width: 190px; height: 140px;'/></p>
                                                <div class='text-center' style='color:gray; '><a href='lection.php?id=".$get_lections_result['ID']."'>'".$get_lections_result['Name']."'</a></div>
                                                <div class='text-center' >
                                                    ".substr($get_lections_result['Description'], 0, 15)."..."."
                                                </div>
                                                <div class='text-center'>
                                                    <a href='lection.php?id=".$get_lections_result['ID']."'>Раскрыть</a>
                                                </div>
                                            </div>";
                                    $show_next;
                                    if ($get_lections_result['Result']>=0.5) {
                                        $show_next = 1;
                                    } else {
                                        $show_next = 0;
                                    }
                                    while ($get_lections_result = mysqli_fetch_assoc($get_lections)) {
                                        if ($show_next==1) {
                                            echo "<div class='col-md-3 swing visible_lection_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                                                    <p style='text-align:center;''><img class='img-responsive img-thumbnail img-rounded' src='../lectures_pic/".$get_lections_result['Image']."' style='width: 190px; height: 140px;'/></p>
                                                    <div class='text-center' style='color:gray; '><a href='#''>'".$get_lections_result['Name']."'</a></div>
                                                    <div class='text-center' >
                                                        ".substr($get_lections_result['Description'], 0, 15)."..."."
                                                    </div>
                                                    <div class='text-center'>
                                                        <a href='lection.php'>Раскрыть</a>
                                                    </div>
                                                </div>";
                                        } else {
                                            echo "<div class='col-md-3 swing visible_lection_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                                                    <p style='text-align:center;''><img class='img-responsive img-thumbnail img-rounded' src='../lectures_pic/".$get_lections_result['Image']."' style='width: 190px; height: 140px;'/></p>
                                                    <div class='text-center' style='color:gray; '><a href='#''>'".$get_lections_result['Name']."'</a></div>
                                                    <div class='text-center' >
                                                        ".substr($get_lections_result['Description'], 0, 15)."..."."
                                                    </div>
                                                    <div class='text-center'>
                                                        <p>Лекция не доступна</p>
                                                    </div>
                                                </div>";
                                        }
                                        if ($get_lections_result['Result']>=0.5) {
                                            $show_next = 1;
                                        } else {
                                            $show_next = 0;
                                        }
                                    }
                                }
                            } else {
                                $get_lections = mysqli_query($connection, "SELECT l.Image as 'Image', l.Name as 'Name', l.Description as 'Description' FROM Lections l LEFT JOIN Course c ON c.ID = l.CourseID WHERE CourseID = $id_course");
                                while ($get_lections_result = mysqli_fetch_assoc($get_lections)) {
                                    echo "<div class='col-md-3 swing visible_lection_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                                            <p style='text-align:center;''><img class='img-responsive img-thumbnail img-rounded' src='../lectures_pic/".$get_lections_result['Image']."' style='width: 190px; height: 140px;'/></p>
                                            <div class='text-center' style='color:gray; '><a href='#''>'".$get_lections_result['Name']."'</a></div>
                                            <div class='text-center' >
                                                ".substr($get_lections_result['Description'], 0, 15)."..."."
                                            </div>
                                            <div class='text-center'>
                                                <p>Лекция не доступна</p>
                                            </div>
                                        </div>";
                                }
                            }
                        ?>

                        <!-- <div class='col-md-3 swing visible_lection_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/></p>
                            <div class='text-center' style='color:gray; '><a href="#">"Успешный водитель, часть 1"</a></div>
                            <div class='text-center' >
                                Здесь будет описание для лекции
                            </div>
                            <div class='text-center'>
                                <a href='#'>Раскрыть</a>
                            </div>
                        </div>

                        <div class='col-md-3 swing visible_lection_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/></p>
                            <div class='text-center' style='color:gray; '><a href="#">"Успешный водитель, часть 2"</a></div>
                            <div class='text-center' >
                                Здесь будет описание для лекции
                            </div>
                            <div class='text-center'>
                                <a href='#'>Раскрыть</a>
                            </div>
                        </div>

                        <div class='col-md-3 swing visible_lection_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/></p>
                            <div class='text-center' style='color:gray; '><a href="#">"Успешный водитель, часть 3"</a></div>
                            <div class='text-center' >
                                Здесь будет описание для лекции
                            </div>
                            <div class='text-center'>
                                <a href='#'>Раскрыть</a>
                            </div>
                        </div>

                        <div class='col-md-3 swing visible_lection_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/></p>
                            <div class='text-center' style='color:gray; '><a href="#">"Успешный водитель, часть 4"</a></div>
                            <div class='text-center' >
                                Здесь будет описание для лекции
                            </div>
                            <div class='text-center'>
                                <a href='#'>Раскрыть</a>
                            </div>
                        </div>

                        <div class='col-md-3 swing visible_lection_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/></p>
                            <div class='text-center' style='color:gray; '><a href="#">"Успешный водитель, часть 1"</a></div>
                            <div class='text-center' >
                                Здесь будет описание для лекции
                            </div>
                            <div class='text-center'>
                                <a href='#'>Раскрыть</a>
                            </div>
                        </div>

                        <div class='col-md-3 swing visible_lection_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/></p>
                            <div class='text-center' style='color:gray; '><a href="#">"Успешный водитель, часть 2"</a></div>
                            <div class='text-center' >
                                Здесь будет описание для лекции
                            </div>
                            <div class='text-center'>
                                <a href='#'>Раскрыть</a>
                            </div>
                        </div>

                        <div class='col-md-3 swing visible_lection_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/></p>
                            <div class='text-center' style='color:gray; '><a href="#">"Успешный водитель, часть 3"</a></div>
                            <div class='text-center' >
                                Здесь будет описание для лекции
                            </div>
                            <div class='text-center'>
                                <a href='#'>Раскрыть</a>
                            </div>
                        </div>

                        <div class='col-md-3 swing visible_lection_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/></p>
                            <div class='text-center' style='color:gray; '><a href="#">"Успешный водитель, часть 4"</a></div>
                            <div class='text-center' >
                                Здесь будет описание для лекции
                            </div>
                            <div class='text-center'>
                                <a href='#'>Раскрыть</a>
                            </div>
                        </div>

                        <div class='col-md-3 swing visible_lection_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/></p>
                            <div class='text-center' style='color:gray; '><a href="#">"Успешный водитель, часть 5"</a></div>
                            <div class='text-center' >
                                Здесь будет описание для лекции
                            </div>
                            <div class='text-center'>
                                <a href='#'>Раскрыть</a>
                            </div>
                        </div> -->


                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3" style="position: sticky; top: 0;">
            <div class="col-md-12" style="border: 1px gray solid; border-radius: 10px; margin: 1%;">
                <p class="text-center">Популярные курсы</p>

                <?php
                    $all_courses_with_pupils = mysqli_query($connection, "SELECT Title, COUNT(*) as 'Count' FROM Course c JOIN Pupil p ON c.ID = p.CourseID GROUP BY Title ORDER BY 'Count' LIMIT 0, 3");
                    while ($result = mysqli_fetch_assoc($all_courses_with_pupils)) {
                        $title_course = $result['Title'];
                        $get_course = mysqli_query($connection, "SELECT * FROM Course WHERE Title = '$title_course'");
                        $get_course_result = mysqli_fetch_assoc($get_course);
                        echo "<div>
                                <p style='font-weight:bold;'><a href='course_template.php?id=".$get_course_result['ID']."'>Курс : '".$get_course_result['Title']."'</a></p>
                                <img class ='img-responsive img-thumbnail img-rounded' src='../courses_pic/".$get_course_result['Image']."' style='width: 250px;'/>
                                <p>".substr($get_course_result['Description'], 0, 20)."...</p>
                            </div>";
                    }

                ?>

                <!-- <div>
					<p style='font-weight:bold;'><a href='#'>Курс : "Успешный водитель"</a></p>
					<img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg'/>
					<p>Здесь будет описание для курса</p>
                </div>

                <div>
					<p style='font-weight:bold;'><a href='#'>Курс : "Успешный водитель"</a></p>
					<img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg'/>
					<p>Здесь будет описание для курса</p>
                </div>

                <div>
					<p style='font-weight:bold;'><a href='#'>Курс : "Успешный водитель"</a></p>
					<img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg'/>
					<p>Здесь будет описание для курса</p>
                </div>	 -->

            </div>
        </div>
    </div>
</div>

<script language="javascript">

    function show_lection_1(){
        // var a = document.getElementsByClassName("visible_lection_1");
        var b = document.getElementsByClassName("visible_lection_2");
        // for(var i=0; i<a.length; i++) a[i].style.display = "block";
        for(var i=0; i<b.length; i++) b[i].style.display = "none";
    }

    function show_lection_2(){
        // var a = document.getElementsByClassName("visible_lection_1");
        var b = document.getElementsByClassName("visible_lection_2");
        // for(var i=0; i<a.length; i++) a[i].style.display = "none";
        for(var i=0; i<b.length; i++) b[i].style.display = "block";
    }

    show_lection_2();

</script>

<?php
	require_once "footer_1.php";
?>