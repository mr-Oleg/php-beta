<nav class="navbar navbar-light" style="background-color: gray;">
                <div class="container-fluid">
                    <div class="navbar-header col-md-3"><a href="index.php" class="navbar-brand" style="color: black;">Преподавательская</a></div>
                    <div class="col-md-6">
                        <ul class="nav navbar-nav">
                            <li><a href="teacher_main.php" style="color: yellow;">Личный кабинет</a></li>
                            <li> <a href="pupils.php" style="color: yellow;">Ученики</a></li>
                            <li> <a href="lections.php" style="color: yellow;">Лекции</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <ul class="nav navbar-nav dropdown">
                            <?php
                                    if(isset($_SESSION['teacher']['fname'])){
                                        $fname = $_SESSION['teacher']['fname'];
                                        $lname = $_SESSION['teacher']['sname'];
                                        echo "<li class='dropdown-toggle' data-toggle='dropdown'> <a href='#' style='color: yellow;'>" . $fname . " " . $lname . "<span class='caret'></span></a></li>
                                                <ul class='dropdown-menu'>
                                                    <li><a href='logout.php'>Выйти</a></li>
                                                </ul>";
                                    }else{
                                        echo "<li> <a href='#' style='color: yellow;'>Вы не авторизованы</a></li>";
                                    }
                            ?>
                        </ul>
                    </div>
                </div>
</nav>        