<?php
/*
// --------------------------
// Webprojekt 3.0
// Copyright Melvin Lauber & David Clausen
// --------------------------
*/

include 'includes/start.php';

// unset session and set new active element
unset($_SESSION['active']);
$_SESSION['active'] = 'my_songs';

$saved_song_query = "SELECT saved_songs.user_id_link, songs.*, artists.artist_firstname, artists.artist_lastname FROM `saved_songs` saved_songs
					INNER JOIN `song` songs ON songs.song_id = saved_songs.song_id
					LEFT JOIN `artist` artists ON artists.artist_id = songs.artist_id
					WHERE `user_id_link` = ".$user_id;

?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Web Player | <?php echo MY_SONGS; ?></title>

		<?php include 'includes/meta_data.php'; ?>
	</head>

	<body>
		<?php include 'includes/navigation_left.php'; ?>
		<?php include 'includes/playbar.php'; ?>

		<div class="main_content_wrapper">
			<div class="main_content_inner">
				<!-- search and main nav -->
				<?php include 'includes/search_navi.php'; ?>
				<h3 class="short_title"><?php echo MY_SONGS; ?></h3>

				<table class="saved_songs_list">
					<tbody>
						<?php foreach ($pdo->query($saved_song_query) as $saved_songs_data) { ?>
							<tr>
								<td class="play"><img src="img/assets/play.svg" class="svg" alt="play"></td>
								<td class="song_name"><?php echo $saved_songs_data['song_name']; ?></td>
								<td class="artist_name"><a href="artist_detail.php?artist_id=<?php echo 1; ?>"><?php echo $saved_songs_data['artist_firstname'].' '.$saved_songs_data['artist_lastname']; ?></a></td>
								<td class="actions"><img src="img/assets/like.svg" class="svg like" alt="Like"><img src="img/assets/show_more.svg" class="svg more" alt="show_more"></td>
								<td class="length"><?php echo $saved_songs_data['length']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
