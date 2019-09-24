<nav class="navbar navbar-light" style="background-color: gray;">
                <div class="container-fluid">
                    <div class="navbar-header col-md-3"><a href="index.php" class="navbar-brand" style="color: black;">Панель администрирования</a></div>
                    <div class="col-md-6">
                        <ul class="nav navbar-nav">
                            <li><a href="admin_main.php" style="color: yellow;">CRUD</a></li>
                            <li> <a href="stats.php" style="color: yellow;">Статистика</a></li>
                            <li> <a href="tab-editor.php" style="color: yellow;">Вкладки</a></li>
                            <li> <a href="teachers.php" style="color: yellow;">Преподаватели</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <ul class="nav navbar-nav dropdown">
                            <?php
                                    if(isset($_SESSION['admin']['fname'])){
                                        $fname = $_SESSION['admin']['fname'];
                                        $lname = $_SESSION['admin']['sname'];
                                        echo "<li class='dropdown-toggle' data-toggle='dropdown'> <a href='#' style='color: yellow;'>" . $fname . " " . $lname . "<span class='caret'></span></a></li>
                                                <ul class='dropdown-menu'>
                                                    <li><a href='logout_admin.php'>Выйти</a></li>
                                                </ul>";
                                    }else{
                                        echo "<li> <a href='#' style='color: yellow;'>Вы не авторизованы</a></li>";
                                    }
                            ?>
                        </ul>
                    </div>
                </div>
</nav>           