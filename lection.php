<?php
    require_once "header.php";
    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }
    if (!isset($_GET['id'])) {
        header("Location: courses.php");
    }
    //require_once "counter.php"; Включить после изготовления раздела
?>
<div class="container">
    <div class="row">
        <div class="col-md-8" style="border: 1px gray solid; border-radius: 10px;">

            <?php
                $lection_id = $_GET['id'];
                $get_lection = mysqli_query($connection, "SELECT l.Name as 'lection_name', c.Title as 'course_name', l.Description as 'lection_description', l.Image as 'lection_image', l.Text as 'lection_text' FROM Lections l JOIN Course c ON c.ID = l.CourseID WHERE l.ID = $lection_id");
                $get_lection_result = mysqli_fetch_assoc($get_lection);
                // print_r($get_lection_result);

            ?>

            <p class="text-center" style="font-size:150%;font-style:italic;font-weight:bolder;"><?php echo $get_lection_result['lection_name']; ?></p>
            <p style="font-size:90%; color:gray; text-align:left;">Входит в курс: <?php echo $get_lection_result['course_name']; ?></p>
            <p style="text-align:left; font-size:125%; font-weight:bolder; font-style:italic;">Немного о лекции:</p>
            <p style="text-align:left;"><?php echo $get_lection_result['lection_description']; ?></p>
            <p style="text-align:left; font-size:125%; font-weight:bolder; font-style:italic;">Основная часть:</p>
            <p style="text-align:center;"><img class ='img-responsive img-thumbnail img-rounded' src=<?php echo 'lectures_pic/'.$get_lection_result['lection_image']; ?>></p>
            <p><?php echo $get_lection_result['lection_text']; ?></p>
            <p style="text-align:center;"><a target="blank" href=<?php echo 'lection_test.php?id='.$lection_id; ?>>Перейти к тестированию...</a></p>
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

               <!--  <div>
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
<?php
	require_once "footer_1.php";
?>