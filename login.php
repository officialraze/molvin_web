<?php
/*
// --------------------------
// Webprojekt 3.0
// Copyright Melvin Lauber
// --------------------------
*/

// includes
include 'language/de.php';
include 'config.php';


$baseurl = 'https://api.spotify.com/';
$get_tracks = 'v1/me/tracks';

?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Web Player | <?php echo LOGIN; ?></title>

		<!-- load all styles -->
		<link rel="stylesheet" href="css/styles.css">
		<script src="js/jquery.min.js" charset="utf-8"></script>
		<script src="js/functions.js" charset="utf-8"></script>
		<script src="js/handlebars.min.js" charset="utf-8"></script>
		<!-- <link href="https://fonts.googleapis.com/css?family=DM+Sans:400,700&display=swap" rel="stylesheet"> -->
	</head>
	<body>
		<div id="login_form_wrapper">
			<div class="login_form_inner">
				<h1 class="title_login"><?php echo PLEASE_LOGIN; ?></h1>
				<form class="form_login" action="" method="post">
					<div class="login_form_element">
						<input type="text" name="username" placeholder="<?php echo USERNAME_MAIL; ?>">
					</div>
					<div class="login_form_element">
						<input type="text" name="password" placeholder="<?php echo PASSWORD; ?>">
					</div>

					<input class="submit-button" type="submit" name="login_submitter" value="<?php echo LOGIN; ?>">
					<a class="submit-button-cancel"href="register.php"><?php echo REGISTER; ?></a>
					<button type="button" id="login_spotify" name="button"><?php echo LOGIN_SPOTIFY; ?></button>
				</form>
			</div>
		</div>
	</body>
	<script>
      (function() {

        var stateKey = 'spotify_auth_state';

        /**
         * Obtains parameters from the hash of the URL
         * @return Object
         */
        function getHashParams() {
          var hashParams = {};
          var e, r = /([^&;=]+)=?([^&;]*)/g,
              q = window.location.hash.substring(1);
          while ( e = r.exec(q)) {
             hashParams[e[1]] = decodeURIComponent(e[2]);
          }
          return hashParams;
        }

        /**
         * Generates a random string containing numbers and letters
         * @param  {number} length The length of the string
         * @return {string} The generated string
         */
        function generateRandomString(length) {
          var text = '';
          var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

          for (var i = 0; i < length; i++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
          }
          return text;
        };

        var params = getHashParams();

        var access_token = params.access_token,
            state = params.state,
            storedState = localStorage.getItem(stateKey);

        if (access_token && (state == null || state !== storedState)) {
          alert('There was an error during the authentication');
        } else {
          localStorage.removeItem(stateKey);
          if (access_token) {
            $.ajax({
                url: 'https://api.spotify.com/v1/me',
                headers: {
                  'Authorization': 'Bearer ' + access_token
                },
                success: function(response) {
                  userProfilePlaceholder.innerHTML = userProfileTemplate(response);

                  $('#login').hide();
                  $('#loggedin').show();
                }
            });
          } else {
              $('#login').show();
              $('#loggedin').hide();
          }

          document.getElementById('login_spotify').addEventListener('click', function() {

            var client_id = '8bcc0337bb3f45359150837eed2035a0'; // Your client id
            var redirect_uri = 'http://localhost/molvin_web'; // Your redirect uri

            var state = generateRandomString(16);

            localStorage.setItem(stateKey, state);
            var scope = 'user-read-private user-read-email';

            var url = 'https://accounts.spotify.com/authorize';
            url += '?response_type=token';
            url += '&client_id=' + encodeURIComponent(client_id);
            url += '&scope=' + encodeURIComponent(scope);
            url += '&redirect_uri=' + encodeURIComponent(redirect_uri);
            url += '&state=' + encodeURIComponent(state);

            window.location = url;
          }, false);
        }

      })();

    </script>
</html>
