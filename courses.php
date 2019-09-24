<?php
    require_once "header.php";
    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }
    require_once "counter.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row text-center">
                <h1>Список курсов:</h1>
                <div class="col-md-3" ><a href="#" onclick="show_courses_1();"><span class="glyphicon glyphicon-th-list"></span> Все курсы</a></div>
                <div class="col-md-3" ><a href="#" onclick="show_courses_2();"><span class="glyphicon glyphicon-th-list"></span> Доступные мне</a></div>
                <div class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <?php
                        // print_r($_SESSION);
                        // echo "<br/><br/>";
                        $user_login = $_SESSION['login'];
                        $id_query = mysqli_query($connection, "SELECT * FROM Users WHERE Login = '$user_login'");
                        $query_result = mysqli_fetch_assoc($id_query);
                        $id_user = $query_result['ID'];
                        $courses = mysqli_query($connection, "SELECT * FROM Course");
                        while ($result = mysqli_fetch_assoc($courses)) {
                            $course_id = $result['ID'];
                            $count_pupil = mysqli_query($connection, "SELECT * FROM Course c JOIN Pupil p ON c.ID = p.CourseID WHERE c.ID = $course_id;");
                            $count_pupil_result = mysqli_fetch_assoc($count_pupil);
                            // print_r($count_pupil_result);
                            // echo "<br/><br/>";
                            if (1==$count_pupil_result['isAccepted']) {
                                echo "<div class='col-md-3 swing visible_courses_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                                    <img class ='img-responsive img-thumbnail img-rounded' src='../courses_pic/".$result['Image']."' style='width: 190px; height: 140px;'/>
                                    <div class='text-center' style='color:gray; '><a href='course_template.php?id=".$course_id."'>Курс : '".$result['Title']."'</a></div>
                                    <div class='text-center' style='color:gray;'><small>Этот курс пройден ".mysqli_num_rows($count_pupil)." раз</small></div>
                                    <div class='text-center' >
                                        ".substr($result['Description'], 0, 20)."...
                                    </div>
                                    <div class='text-center'>
                                        <a href='course_template.php?id=".$course_id."'>Раскрыть</a>
                                    </div>
                                </div>";
                            } else{
                                echo "<div class='col-md-3 swing visible_courses_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                                    <img class ='img-responsive img-thumbnail img-rounded' src='../courses_pic/".$result['Image']."' style='width: 190px; height: 140px;'/>
                                    <div class='text-center' style='color:gray; '><a href='course_template.php?id=".$course_id."'>Курс : '".$result['Title']."'</a></div>
                                    <div class='text-center' style='color:gray;'><small>Этот курс пройден ".mysqli_num_rows($count_pupil)." раз</small></div>
                                    <div class='text-center' >
                                        ".substr($result['Description'], 0, 20)."...
                                    </div>
                                    <div class='text-center'>
                                        <a href='course_template.php?id=".$course_id."'>Раскрыть</a>
                                    </div>
                                </div>";
                            }
                        }

                    ?>

                    <!-- <div class='col-md-3 swing visible_courses_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                        <img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/>
                        <div class='text-center' style='color:gray; '><a href="#">Курс : "Успешный водитель"</a></div>
                        <div class='text-center' style='color:gray;'><small>Этот курс пройден 100 раз</small></div>
                        <div class='text-center' >
                            Здесь будет описание для курса
                        </div>
                        <div class='text-center'>
                            <a href='#'>Раскрыть</a>
                        </div>
                    </div>
    
                    <div class='col-md-3 swing visible_courses_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                        <img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/>
                        <div class='text-center' style='color:gray; '><a href="#">Курс : "Успешный водитель"</a></div>
                        <div class='text-center' style='color:gray;'><small>Этот курс пройден 100 раз</small></div>
                        <div class='text-center' >
                            Здесь будет описание для курса
                        </div>
                        <div class='text-center'>
                            <a href='#'>Раскрыть</a>
                        </div>
                    </div>

                    <div class='col-md-3 swing visible_courses_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                        <img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/>
                        <div class='text-center' style='color:gray; '><a href="#">Курс : "Успешный водитель"</a></div>
                        <div class='text-center' style='color:gray;'><small>Этот курс пройден 100 раз</small></div>
                        <div class='text-center' >
                            Здесь будет описание для курса
                        </div>
                        <div class='text-center'>
                            <a href='#'>Раскрыть</a>
                        </div>
                    </div>

                    <div class='col-md-3 swing visible_courses_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                        <img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/>
                        <div class='text-center' style='color:gray; '><a href="#">Курс : "Успешный водитель"</a></div>
                        <div class='text-center' style='color:gray;'><small>Этот курс пройден 100 раз</small></div>
                        <div class='text-center' >
                            Здесь будет описание для курса
                        </div>
                        <div class='text-center'>
                            <a href='#'>Раскрыть</a>
                        </div>
                    </div>
    
                    <div class='col-md-3 swing visible_courses_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                        <img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/>
                        <div class='text-center' style='color:gray; '><a href="#">Курс : "Успешный водитель"</a></div>
                        <div class='text-center' style='color:gray;'><small>Этот курс пройден 100 раз</small></div>
                        <div class='text-center' >
                            Здесь будет описание для курса
                        </div>
                        <div class='text-center'>
                            <a href='#'>Раскрыть</a>
                        </div>
                    </div>

                    <div class='col-md-3 swing visible_courses_1' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                        <img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/>
                        <div class='text-center' style='color:gray; '><a href="#">Курс : "Успешный водитель"</a></div>
                        <div class='text-center' style='color:gray;'><small>Этот курс пройден 100 раз</small></div>
                        <div class='text-center' >
                            Здесь будет описание для курса
                        </div>
                        <div class='text-center'>
                            <a href='#'>Раскрыть</a>
                        </div>
                    </div>

                    <div class='col-md-3 swing visible_courses_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                        <img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/>
                        <div class='text-center' style='color:gray; '><a href="#">Курс : "Успешный водитель"</a></div>
                        <div class='text-center' style='color:gray;'><small>Этот курс пройден 100 раз</small></div>
                        <div class='text-center' >
                            Здесь будет описание для курса
                        </div>
                        <div class='text-center'>
                            <a href='#'>Раскрыть</a>
                        </div>
                    </div>
    
                    <div class='col-md-3 swing visible_courses_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                        <img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/>
                        <div class='text-center' style='color:gray; '><a href="#">Курс : "Успешный водитель"</a></div>
                        <div class='text-center' style='color:gray;'><small>Этот курс пройден 100 раз</small></div>
                        <div class='text-center' >
                            Здесь будет описание для курса
                        </div>
                        <div class='text-center'>
                            <a href='#'>Раскрыть</a>
                        </div>
                    </div>

                    <div class='col-md-3 swing visible_courses_2' style=' border: 1px gray solid; border-radius: 10px; margin:2%; height: 275px;'>
                        <img class ='img-responsive img-thumbnail img-rounded' src='https://img01.rl0.ru/db27cf456b74e900b6afa5fce3cc2e73/c615x400i/news.rambler.ru/img/2019/08/01040028.222249.1466.jpeg' style='width: 190px; height: 140px;'/>
                        <div class='text-center' style='color:gray; '><a href="#">Курс : "Успешный водитель"</a></div>
                        <div class='text-center' style='color:gray;'><small>Этот курс пройден 100 раз</small></div>
                        <div class='text-center' >
                        Здесь будет описание для курса
                        </div>
                        <div class='text-center'>
                            <a href='#'>Раскрыть</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        
        <div class="col-md-4" style="position: sticky; top: 0;">
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

    function show_courses_1(){
        var a = document.getElementsByClassName("visible_courses_1");
        var b = document.getElementsByClassName("visible_courses_2");
        for(var i=0; i<a.length; i++) a[i].style.display = "block";
        for(var i=0; i<b.length; i++) b[i].style.display = "none";
    }

    function show_courses_2(){
        var a = document.getElementsByClassName("visible_courses_1");
        var b = document.getElementsByClassName("visible_courses_2");
        for(var i=0; i<a.length; i++) a[i].style.display = "none";
        for(var i=0; i<b.length; i++) b[i].style.display = "block";
    }

</script>

<?php
	require_once "footer_1.php";
?>