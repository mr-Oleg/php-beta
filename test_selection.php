<?php
	require_once "header.php";

    if(!isset($_SESSION['fname'])){
        header("Location: index.php");
    }

?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				<h3 class="text-center">
					Выберите билет
				</h3>
				<div class="row">
					<div class="col-md-1">
					</div>
					<div class="col-md-10">
						<?php
							echo '<div class="col-md-1"></div>';
							echo '<div class="col-md-10 text-center">
									<table style="margin: auto; border-spacing: 25px 15px; border-collapse: separate;">
										<tr>';
							for ($i=1; $i <= 40; $i++) { 
								echo '<td><a href="test.php?id='.$i.'"><p>'.$i.'</p></a></td>';
								if ($i%10==0) {
									echo '</tr>
											<tr>';
								}
							}
							echo '		</tr>
									</table>
								</div>';
							echo '<div class="col-md-1"></div>';
						?>
					</div>
					<div class="col-md-1">
					</div>
				</div>
				<h3 class="text-center">
					Сформировать случайный билет
				</h3>
			</div>
			<div class="col-md-2">
			</div>
		</div>
	</div>

<?php
	require_once "footer_1.php";
?>