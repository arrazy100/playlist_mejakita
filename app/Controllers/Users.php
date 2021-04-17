<?php

namespace App\Controllers;

class Users extends BaseController
{
	// Global Class Variable
	private $base_API = 'http://localhost:8081/index.php/';
	private $base_API_url = 'http://localhost:8081';
	private $user = true;
	private $id_akun = 1;

	private function requestAPI($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}

	private function postAPI($url, $post_data)
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

	private function sortByViews($a, $b)
	{
		return $a->views < $b->views;
	}

	private function sortByRating($a, $b)
	{
		return $a->rating < $b->rating;
	}

	public function index()
	{
		// Read JSON Data
		$result = self::requestAPI($this->base_API.'index_playlist/'.$this->id_akun);
		$result = json_decode($result);

		// Kategori
		$kategori = array_unique(array_column((array)$result, 'kategori'));
		$kategori = array_values($kategori);

		$kategori_slug = [];
		foreach($kategori as $k)
		{
			$slug = preg_replace('/\s+/', '-', $k);
			array_push($kategori_slug, $slug);
		}

		// Sort Playlist By Views
		$sorted_playlist = (array)$result;
		usort($sorted_playlist, array($this, 'sortByViews'));

		// Top Playlist
		$top_playlist = array_slice($sorted_playlist, 0, 3);

		// Daftar Rekomendasi
		$daftar_rekomendasi = $sorted_playlist;
		for ($i = 0; $i < count($daftar_rekomendasi); $i++)
		{
			$daftar_rekomendasi[$i]->rating = $daftar_rekomendasi[$i]->views;
			if (property_exists($daftar_rekomendasi[$i], 'bookmarked_count'))
				$daftar_rekomendasi[$i]->rating += $daftar_rekomendasi[$i]->bookmarked_count;
		}
		usort($daftar_rekomendasi, array($this, 'sortByRating'));
		$daftar_rekomendasi = (object)array_slice($daftar_rekomendasi, 0, 6);

		// Terbaru
		$terbaru = (array)$result;

		// List Bulan Data Playlist
		$terbaru_bulan = array_unique(array_column($terbaru, 'created_at'));
		$terbaru_bulan = array_values($terbaru_bulan);
		for($i = 0; $i < count($terbaru_bulan); $i++)
		{
			$date = strtotime($terbaru_bulan[$i]);
			$terbaru_bulan[$i] = date("m", $date);
		}
		$terbaru_bulan = array_unique($terbaru_bulan);
		asort($terbaru_bulan);
		$terbaru_bulan = array_values($terbaru_bulan);
		for($i = 0; $i < count($terbaru_bulan); $i++)
		{
			$terbaru_bulan[$i] = date("F", mktime(0, 0, 0, $terbaru_bulan[$i], 10));
		}

		// List Tahun Data Playlist
		$terbaru_tahun = array_unique(array_column($terbaru, 'created_at'));
		$terbaru_tahun = array_values($terbaru_tahun);
		for($i = 0; $i < count($terbaru_tahun); $i++)
		{
			$date = strtotime($terbaru_tahun[$i]);
			$terbaru_tahun[$i] = date("Y", $date);
		}
		$terbaru_tahun = array_unique($terbaru_tahun);
		asort($terbaru_tahun);

		// Random Carousel Image
		$random_list = array_rand((array)$result, 3);

		$data = [
			'title' => 'Playlist',
			'user' => $this->user,
			'base_api_url' => $this->base_API_url,
			'kategori' => $kategori,
			'kategori_slug' => $kategori_slug,
			'daftar_rekomendasi' => $daftar_rekomendasi,
			'top_playlist' => $top_playlist,
			'terbaru' => $terbaru,
			'terbaru_bulan' => $terbaru_bulan,
			'terbaru_tahun' => $terbaru_tahun,
			'random_list' => $random_list,
		];

		return view('users/playlist', $data);
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
		// Read JSON Data
		$result = self::requestAPI($this->base_API.'list_bookmarked/'.$this->id_akun);
		$result = json_decode($result);

		$data = [
			'title' => 'Bookmarked',
			'base_api_url' => $this->base_API_url,
			'list' => $result,
		];

		return view('users/bookmarked', $data);
	}

	public function filter_playlist($kategori = null)
	{
		// Read JSON Data
		$result = self::requestAPI($this->base_API.'index_playlist/'.$this->id_akun);
		$result = json_decode($result);

		// Daftar Rekomendasi
		$daftar_rekomendasi = (array)$result;

		if ($kategori)
		{
			// Change Underscore to Whitespace from $kategori
			$kategori = str_replace('-', ' ', $kategori);
			
			// Filtering with Category
			$daftar_rekomendasi = array_filter($daftar_rekomendasi, function($daftar) use ($kategori) {
				if ($daftar->kategori == $kategori) return true;
			});

			$daftar_rekomendasi = array_values($daftar_rekomendasi);
		}

		for ($i = 0; $i < count($daftar_rekomendasi); $i++)
		{
			$daftar_rekomendasi[$i]->rating = $daftar_rekomendasi[$i]->views;
			if (property_exists($daftar_rekomendasi[$i], 'bookmarked_count'))
				$daftar_rekomendasi[$i]->rating += $daftar_rekomendasi[$i]->bookmarked_count;
		}
		usort($daftar_rekomendasi, array($this, 'sortByRating'));
		$daftar_rekomendasi = (object)array_slice($daftar_rekomendasi, 0, 6);

		// Generate new token
		$token = csrf_hash();

		$data = [
			'rekomendasi_title' => $kategori,
			'user' => $this->user,
			'base_api_url' => $this->base_API_url,
			'daftar_rekomendasi' => $daftar_rekomendasi,
		];

		$view_response = view('users/refresh_playlist', $data);

		$json = [
			'token' => $token,
			'html' => $view_response,
		];

		return $this->response->setJSON($json);
	}

	public function filter_bulantahun($bulantahun = null)
	{
		// Read JSON Data
		$result = self::requestAPI($this->base_API.'index_playlist/'.$this->id_akun);
		$result = json_decode($result);

		$terbaru = (array)$result;

		if ($bulantahun)
		{	
			// Filtering with Category
			$terbaru = array_filter($terbaru, function($daftar) use ($bulantahun) {
				$bulantahun_array = explode("-", $bulantahun);
				$date = strtotime($daftar->created_at);
				$terbaru_bulan = date("F", $date);
				$terbaru_tahun = date("Y", $date);

				if ($bulantahun_array[0] && !$bulantahun_array[1])
				{
					if ($terbaru_bulan == $bulantahun_array[0]) return true;
				}
				else if (!$bulantahun_array[0] && $bulantahun_array[1])
				{
					if ($terbaru_tahun == $bulantahun_array[1]) return true;
				}

				if ($terbaru_bulan == $bulantahun_array[0] && $terbaru_tahun == $bulantahun_array[1]) return true;
			});

			$terbaru = array_values($terbaru);
		}

		// Generate new token
		$token = csrf_hash();

		$data = [
			'terbaru' => $terbaru,
		];

		$view_response = view('users/refresh_terbaru', $data);

		$json = [
			'token' => $token,
			'html' => $view_response,
		];

		return $this->response->setJSON($json);
	}

	public function add_bookmark($id_playlist = null)
	{
		// Bookmark Data to POST
		$post_data = [
			'id_akun' => $this->id_akun,
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

		// Delete bookmark to Database API
		$result = self::requestAPI($this->base_API.'/delete_bookmarked/'.$this->id_akun.'/'.$id_playlist);
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
}
