<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::insert([
            [
                'genre_id' => 2,
                'name' => 'Resep Makanan Padang',
                'description' => 'Kunci pembuatan masakan Padang adalah penggunaan aneka bumbu yang berlimpah. Itulah yang membuat masakan ini lezat walau tanpa penyedap rasa atau bahan kimia.',
                'picture' => 'books_299382773829_27718283999203.jpg',
                'publication_year' => 2012,
                'author' => 'ANISSA NURHIDAYATI',
                'count_views' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'genre_id' => 3,
                'name' => 'Belajar HTML CSS & PHP Dasar',
                'description' => 'HTML, PHP, dan MySQL merupakan tiga komponen pembentuk website kekinian. Jika ingin menguasai pembuatan website, maka dasar-dasar HTML, PHP, dan MySQL harus dipahami dengan baik. HTML untuk membentuk layout dan tampilan website. PHP sebagai penunjang untuk menciptakan website yang dinamis, dan MySQL untuk penyimpanan data website di server. Buku ini memberikan panduan mudah dan cepat untuk menguasai HTML, PHP, dan MySQL. Dengan pembahasan yang mudah dimengerti untuk orang awam, diharapkan setelah membaca dan praktek pembaca menjadi mahir menguasai HTML, PHP, dan MySQL.',
                'picture' => 'books_2883728377747_8393288827383.jpg',
                'publication_year' => 2017,
                'author' => 'ARISTA PRASETYA ADI',
                'count_views' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'genre_id' => 3,
                'name' => 'Framework Laravel',
                'description' => 'Laravel adalah salah satu framework berbasis open source yang paling populer saat ini. Sejak diluncurkan tahun 2011, aplikasi berbasis Laravel ini banyak digemari oleh para komunitas programmer di Github hingga akhirnya menyebar ke seluruh dunia. Framework Laravel menyediakan beberapa jenis PHP library dan beberapa fungsi lain yang bisa memudahkan kita dalam menuliskan baris kode program. Framework Laravel juga dibuat dengan tujuan mempermudah cara untuk membuat aplikasi berbasis web dan memperindah tampilan karena modelnya yang sederhana dan elegan. Framework ini juga terkenal dengan dokumentasinya yang lengkap dan selalu update. Setiap ada pembaharuan versi terbaru selalu ada pembaharuan pada dokumentasinya. Buku ini selain berisi teori dasar juga memberikan studi kasus aplikasi CRUD dan Toko Online. Mengacu kepada buku karya penulis sebelumnya yang berjudul “Panduan Mudah Belajar Framework Laravel”, buku ini telah di-update dan direvisi sedemikian rupa agar semakin lengkap untuk pembaca.',
                'picture' => 'books_8399283928882_38829388819000.jpg',
                'publication_year' => 2015,
                'author' => 'YUDHO YUDHANTO',
                'count_views' => 800,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'genre_id' => 3,
                'name' => 'Mengenal Bahasa Pemrograman Go Lang',
                'description' => 'Buku ini membahas bahasa pemrograman Go (Golang). Pembahasan meliputi sintaks dasar, I/O di konsol, parsing nilai, percabangan bersyarat, pengulangan, array, slice, map, fungsi, goroutine, sampai dengan channel. Buku ini ditujukan untuk yang ingin belajar cepat bahasa pemrograman Go.',
                'picture' => 'books_938829388823333_82938889230019233.png',
                'publication_year' => 2019,
                'author' => 'NOVAL AGUNG PRAYOGO',
                'count_views' => 600,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
