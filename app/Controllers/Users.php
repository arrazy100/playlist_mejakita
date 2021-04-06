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

	public function detail()
	{
		$pdf = getcwd() . '/assets/files/pdf.pdf';
		$b64_pdf = chunk_split(base64_encode(file_get_contents($pdf)));
		$data = [
			'title' => 'Detail',
			'pdf' => $b64_pdf,
		];

		return view('users/detail', $data);
	}

	public function bookmarked()
	{
		$data = [
			'title' => 'Bookmarked',
		];

		return view('users/bookmarked', $data);
	}

	public function tes()
	{
		$data = [
			'title' => 'Tes',
		];

		return view('users/tes', $data);
	}
}
