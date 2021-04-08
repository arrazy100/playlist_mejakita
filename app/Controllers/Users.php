<?php

namespace App\Controllers;

class Users extends BaseController
{
	private $client;

	function __construct()
	{
		$options = [
			'baseURI' => 'https://jsonplaceholder.typicode.com/',
			'timeout' => 3
		];
		$this->client = \Config\Services::curlrequest($options);
	}

	private function requestJSON($method, $link, $base_uri=null)
	{
		$client = null;

		if ($base_uri) {
			$options = [
				'baseURI' => $base_uri,
				'timeout' => 3
			];
			$client = \Config\Services::curlrequest($options);
		}
		else {
			$client = \Config\Services::curlrequest();
		}

		$response = $this->client->request($method, $link);

		return json_decode($response->getBody());
	}

	public function index()
	{
		$result = self::requestJSON('GET', 'photos', 'https://jsonplaceholder.typicode.com/');

		$per_pages = 6;
		$n_pages = (12 / $per_pages) + 1;

		$cur_page = isset($_GET['page']) ? $_GET['page'] : 1;

		$result = array_slice($result, $cur_page * $per_pages, $per_pages);

		$data = [
			'title' => 'Playlist',
			'daftar_rekomendasi' => $result,
			'n_pages' => $n_pages,
			'per_pages' => $per_pages,
		];

		return view('users/playlist', $data);
	}

	public function detail()
	{
		$pdf = getcwd() . '/assets/files/pdf.pdf';
		$b64_pdf = chunk_split(base64_encode(file_get_contents($pdf)));
		$category = 'catatan';

		$data = [
			'title' => 'Detail',
			'pdf' => $b64_pdf,
			'category' => $category,
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
}
