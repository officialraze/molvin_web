<?php
include 'includes/start.php';

// unset session and set new active element
unset($_SESSION['active']);
$_SESSION['active'] = 'my_songs';

?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Web Player | <?php echo MY_SONGS; ?></title>

		<?php include 'includes/meta_data.php'; ?>
	</head>

	<body>
		<!-- navigation left -->
		<?php include 'includes/navigation_left.php'; ?>

		<div class="main_content_wrapper">
			<div class="main_content_inner">
				<!-- search and main nav -->
				<?php include 'includes/search_navi.php'; ?>
			</div>
		</div>
	</body>
