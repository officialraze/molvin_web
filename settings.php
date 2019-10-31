<?php
session_start();
/*
// --------------------------
// Webprojekt 3.0
// Copyright Melvin Lauber & David Clausen
// --------------------------
*/

include 'includes/start.php';

// unset session and set new active element
unset($_SESSION['active']);
$_SESSION['active'] = 'settings';

?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Web Player | <?php echo SETTINGS; ?></title>

		<?php include 'includes/meta_data.php'; ?>
	</head>
	<body class="<?php echo $body_class; ?>">
		<?php include 'includes/navigation_left.php'; ?>
		<?php include 'includes/playbar.php'; ?>
		<?php include 'includes/cookie_banner.php'; ?>

		<div class="main_content_wrapper">
			<div class="main_content_inner">
				<?php include 'includes/search_navi.php'; ?>

				<div class="settings_change">
					<h2 class="settings"><?php echo SETTINGS_CHANGE; ?></h2>

					<div class="choose_colours">
						<h3 class="settings"><?php echo SWITCH_DARKMODE; ?></h3>
						<label class="switch">
						<input name="switch" type="checkbox" <?php echo ($_SESSION['user']['has_darkmode'] == 1) ? 'checked' : ''; ?>>
						<span class="slider round darkmode"></span>
						</label>
					</div>

					<form class="settings_form" action="classes/class.user.php" method="post">
						<h3 class="settings"><?php echo CHANGE_BASICS; ?></h3>
						<div class="change_username">
							<div class="settings_change_username">
								<input type="text" name="change_username" placeholder="<?php echo USERNAME; ?>">
							</div>
						</div>

						<div class="change_pw">
							<div class="settings_change_pw">
								<input type="password" name="change_pw" placeholder="<?php echo PASSWORD; ?>">
							</div>
						</div>

						<div class="change_email">
							<div class="settings_change_mail">
								<input type="text" name="change_mail" placeholder="<?php echo MAIL; ?>">
							</div>
						</div>

						<input class="button" type="submit" name="basic_settings_save" value="Speichern">
					</form>
				</div>

				<!-- todo in next version -->
				<!-- <div class="language">
					<h2 class="settings"><?php echo LANGUAGE; ?></h2>
					<div class="choose_language">
						<select name="change_language">
						<option value="deutsch"><?php echo DEUTSCH; ?></option>
						<option value="english"><?php echo ENGLISH; ?></option>
						</select>
					</div>
				</div> -->

				<div class="logout">
					<h2 class="settings"><?php echo LOGOUT; ?></h2>
					<div class="logout_button">
					<a class="submit-button-logout" href="logout.php"><?php echo LOGOUT; ?></a>
					</div>
				</div>
			</div>
		</div>

	</body>
	<script type="text/javascript">


		$('.darkmode').click(function() {
			$('body').toggleClass('dark');

			if ($('input[name="switch"]:checked').length) {
				var switch_value = 0;
			}
			else {
				var switch_value = 1;
			}

			$.ajax({
				url: 'classes/class.user.php',
				type: "POST",
				data: {
					switch: switch_value,
				},
				success: function(response) {
					console.log(response);
				}
			});
		});

	</script>
</html>
