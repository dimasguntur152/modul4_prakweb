<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        // Memasukkan data media dummy (sesuai Modul 3)
        Media::create(['judul' => 'Naruto', 'jenis' => 'Anime', 'genre' => 'Action']);
        Media::create(['judul' => 'One Piece', 'jenis' => 'Anime', 'genre' => 'Adventure']);
        Media::create(['judul' => 'Attack on Titan', 'jenis' => 'Anime', 'genre' => 'Fantasy']);
        Media::create(['judul' => 'Demon Slayer', 'jenis' => 'Anime', 'genre' => 'Action']);
        Media::create(['judul' => 'Solo Leveling', 'jenis' => 'Anime', 'genre' => 'Fantasy']);
        Media::create(['judul' => 'Interstellar', 'jenis' => 'Movie', 'genre' => 'Sci-Fi']);
    }
}
