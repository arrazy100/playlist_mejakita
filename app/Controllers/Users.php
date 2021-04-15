<?php

namespace App\Controllers;

class Users extends BaseController
{
	private $base_API = 'http://localhost:8081/index.php/';
	private $base_API_url = 'http://localhost:8081';

	public function requestAPI($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}

	public function postAPI($url, $post_data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}

	public function sortByViews($a, $b)
	{
		return $a->views < $b->views;
	}

	public function index()
	{
		// Is User?
		$user = true;

		// Read JSON Data
		$result = self::requestAPI($this->base_API.'playlistbelajar');
		$result = json_decode($result);

		$kategori = array_unique(array_column($result, 'kategori'));

		// Daftar Rekomendasi
		$daftar_rekomendasi = $result;

		// Top Playlist
		$top_playlist = $result;
		usort($top_playlist, array($this, 'sortByViews'));
		$top_playlist = array_slice($top_playlist, 0, 3);

		// Terbaru
		$terbaru = $result;

		// Random Carousel Image
		$random_list = array_rand($result, 3);

		$data = [
			'title' => 'Playlist',
			'user' => $user,
			'base_api_url' => $this->base_API_url,
			'kategori' => $kategori,
			'daftar_rekomendasi' => $daftar_rekomendasi,
			'top_playlist' => $top_playlist,
			'terbaru' => $terbaru,
			'random_list' => $random_list,
		];

		return view('users/playlist', $data);
	}

	public function add_bookmark($id_playlist = null)
	{
		// Id Akun
		$id_akun = 1;

		// Bookmark Data to POST
		$post_data = [
			'id_akun' => $id_akun,
			'id_playlist' => $id_playlist,
		];

		// Add bookmark to Database API
		$result = self::postAPI($this->base_API.'bookmark', $post_data);
		$result = json_decode($result);

		// Success?
		$success = $result->status == 201 ? true : false;

		// Generate new token
		$token = csrf_hash();

		$data = [
			'token' => $token,
			'success' => $success,
		];

		return $this->response->setJSON($data);
	}

	public function delete_bookmark($id_playlist = null)
	{
		// Id Akun
		$id_akun = 1;

		// Delete bookmark to Database API
		$result = self::requestAPI($this->base_API.'/delete_bookmarked/'.$id_akun.'/'.$id_playlist);
		$result = json_decode($result);

		// Success?
		$success = $result->status == 200 ? true : false;

		// Generate new token
		$token = csrf_hash();

		$data = [
			'token' => $token,
			'success' => $success,
		];

		return $this->response->setJSON($data);
	}

	public function detail($id = null)
	{
		// Read JSON Data
		$result = self::requestAPI($this->base_API.'playlistbelajar/'.$id);
		$result = json_decode($result);

		// Data Detail Playlist
		$data_playlist = $result->data_playlist;

		// List Materi
		$materi = $data_playlist->materi;

		$data = [
			'title' => 'Detail',
			'base_api_url' => $this->base_API_url,
			'data_playlist' => $data_playlist,
			'materi' => $materi,
			'category' => null,
			'content' => null,
			'current_uri' => null,
		];

		return view('users/detail', $data);
	}

	public function detail_konten($id = null, $id_materi = null)
	{
		// Read JSON Data
		$result = self::requestAPI($this->base_API.'playlistbelajar/'.$id);
		$result = json_decode($result);

		// Data Detail Playlist
		$data_playlist = $result->data_playlist;

		// List Materi
		$materi = $data_playlist->materi;
		
		// Read JSON Data for Content File or Link
		$result = self::requestAPI($this->base_API.'materibelajar/'.$id_materi);
		$result = json_decode($result);

		$content_object = $result[1][0];

		// Nama Konten
		$nama_konten = $result[0][0]->nama_materi;

		// Kategori Konten
		$category = $content_object->id_tipe;

		// Current Uri
		$uri = $this->request->uri;
		$current_uri = $uri->getSegment(3);

		// Content File or Link
		$content = null;

		if ($content_object->nama_file && !$content_object->link)
		{
			$content = $this->base_API_url.'/files/'.$content_object->nama_file;

			// id_tipe = 1 only link url allowed
			if ($category == 1)
			{
				$content = null;
			}

			// Encoding to base64 for PDF File
			else if ($category == 2 || $category == 3)
			{
				$category = 2;
				$content = chunk_split(base64_encode(file_get_contents($content)));
			}
		}
		else if ($content_object->link && !$content_object->nama_file)
		{
			$content = $content_object->link;

			// id_tipe = 2 only file allowed
			if ($category == 2)
			{
				$content = null;
			}

			// use id_tipe = 5 (youtube) instead for youtube video link
			else if ($category == 4)
			{
				$category = 5;
			}
		}
		else
		{
			// nama_file and link is null
			$content = null;
		}

		$data = [
			'title' => 'Detail',
			'base_api_url' => $this->base_API_url,
			'data_playlist' => $data_playlist,
			'materi' => $materi,
			'nama_konten' => $nama_konten,
			'category' => $category,
			'content' => $content,
			'current_uri' => $current_uri,
		];

		return view('users/detail', $data);
	}

	public function bookmarked()
	{
		$id_akun = 1;
		
		// Read JSON Data
		$result = self::requestAPI($this->base_API.'list_bookmarked/'.$id_akun);
		$result = json_decode($result);

		$data = [
			'title' => 'Bookmarked',
			'base_api_url' => $this->base_API_url,
			'list' => $result,
		];

		return view('users/bookmarked', $data);
	}
}
