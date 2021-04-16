# Playlist Mejakita

## Run First Time on Terminal

`git clone https://github.com/arrazy100/playlist_mejakita`
<br>
`cd playlist_mejakita`
<br>
`composer dump-autoload`
<br>
`composer update`
<br>
`php spark serve --port 8080`

##

## Run REST API (Pastikan Versi PHP adalah 7, PHP 8 Tidak Support)

### 1. Buat database baru di phpmyadmin dengan nama ci4_playlistbelajar<br>

### 2. Pilih database ci4_playlistbelajar, import file .sql dari folder list_belajar_updated_tim_8<br>

### 3. Jalankan REST API<br>

`git clone https://github.com/rudi-usman/list_belajar-web_server`
<br>
`cd list_belajar-web_server/list_belajar_updated_tim_8/`
<br>
`php spark serve --port 8081`

### Akses Front-End melalui http://localhost:8080/
