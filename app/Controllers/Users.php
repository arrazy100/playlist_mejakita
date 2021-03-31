<?php

namespace App\Controllers;

class Users extends BaseController
{
	public function index()
	{
		$data = [
            'title' => 'Playlist',
        ];

        return view('users/playlist', $data);
	}
}
