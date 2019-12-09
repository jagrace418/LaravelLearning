<?php

function gravatar_url ($email) {
	$email = md5($email);

	return "https://gravatar.com/avatar/{$email}" . http_build_query([
			//add http query params to the url
			's' => 60,
		]);
}