<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Dokumentasi Project

### Clone atau Download

Untuk menjalankan project ini bisa download langsung, atau bisa clone melalui terminal di bawah ini.

```
git clone https://github.com/fiqihr/sirs-uty-fm.git
```

Lalu buka project menggunakan terminal dan ubah file `.env.example` menjadi `.env` <br>
Buka file `.env` nya. <br>

Disini berisi konfigurasi project kita, misal untuk konek ke database. <br>
Bisa atur juga kalau tidak mau pakai mysql, bisa sqlite, dll. <br>
Tapi project ini menggunakan mysql. <br>

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sirs_uty_fm
DB_USERNAME=root
DB_PASSWORD=
```

<hr>
Lalu setelah itu, ketik perintah berikut satu-satu. <br>

```
composer install
npm run dev
php artisan key:generate
php artisan migrate
php artisan db:seed
```

Setelah terinstall semua, ketikkan perintah berikut di 2 terminal berbeda.

```
php artisan serve
```

dan

```
npm run dev
```

<hr>

### Struktur Folder

Di laravel, memiliki struktur folder yang sudah otomatis ada saat project di buat.
Beberapa folder yang penting dan digunakan di project ini adalah

```
routes\

app\Http\Controllers
app\Models

database\
resources\views
```

<hr>

## Penjelasan Singkat Masing-Masing Folder

### routes\

Di folder routes\ berisi 3 file, yaitu `auth.php, console.php dan web.php`.
Untuk fokus di project ini adalah di web.php

Di file `web.php` berisi routing atau jalur atau path dari projectnya.

misalnya ini

```
Route::get('/rancangan-siar/create', [RancanganSiarController::class, 'create'])->name('rancangan-siar.create');
```

Route tersebut menggunakan method `GET` untuk menuju ke alamat `http://url/rancangan-siar/create`. <br>
Lalu menggunakan controller di `RancanganSiarController` yang nama kelasnya adalah `public function create()`. <br>
Nama route ini adalah `rancangan-siar.create`.

Lalu ada lagi,

```
Route::resource('traffic', TrafficController::class);
```

Ini sama juga route, tetapi ini namanya Route Resources. Jadi tidak perlu mendefinisikan method seperti `GET, POST, PUT, DELETE dll..` <br>
Ini otomatis di buatkan laravel saat membuat controller `TrafficController`. <br>
Penjelasannya nanti.

<hr>

### app\Http\Controllers

Di folder controller bisa diibaratkan proses dari aplikasi kita sebelum menuju tampilan browser nya. <br>
Intinya disinilah kita bisa mengolah query database dll, untuk nanti ditampilkan di layar/view.

Misalnya kita pergi ke file `RancanganSiarController.php` <br>
Disini terdapat banyak sekali function, dan function inilah yang mengolah semua proses nya untuk nanti ditampilkan ke view. <br>
Oke, ambil contoh ini

```
public function index(Request $request)
{
  ...
  // disini prosesnya
  ...
  return view('rancangan_siar.index');
}
```

Di akhir controller ada return view. yang berarti controller ini akan meneruskan ke view atau tampilan di browser. <br>
untuk penjelasan code pakai AI saja. <br>
promptnya bisa pakai ini

```
tolong jelaskan kode controller laravel ini.

public function index(Request $request){
  ...
}

// function nya di copy satu satu
```

Pembuatan controller biasanya dilakukan setelah membuat file migration.(penjelasan ada dibawah nanti).<br>
perintah untuk membuat controller:

```
php artisan make:controller NamaController -r

// misalnya

php artisan make:controller RancanganSiarController -r
```

perintah `-r` untuk menambahkan resources nya juga. (ini bisa minta dijelaskan AI)

<hr>

### app\Models

Disini berisi model dari masing masing database. Intinya tabel yang didapatkan dari database kemudian di modelkan dan bisa menambahkan relasi disini. <br>
contoh model `Client.php`

```
class Client extends Model
{
    use HasFactory;  // bawaan laravel
    protected $table = 'client';  // model ini menggunakan tabel client
    protected $primaryKey = 'id_client'; // primary key nya id_client
    protected $guarded = []; // kolom yang tidak boleh diisi. ini kosong, berarti boleh diisi semua

    // ini relasi dengan tabel iklan, foreign key nya adalah id_client
    public function iklan()
    {
        return $this->hasMany(Iklan::class, 'id_client', 'id_client');
    }
}
```

Untuk penjelasan model yang lebih lengkap bisa pakai AI seperti tadi, atau bisa juga langsung ke dokumentasi laravel nya. <br>
[Laravel Eloquent](https://laravel.com/docs/12.x/eloquent).

Model ini bisa dipanggil di controllers untuk proses pengolaha data nya. <br>
Misal pergi ke controller `ClientController`.
Di line ke 83. <br>

```
public function show(string $id)
    {
        // query menampilkan detail client, Client di ambil dari model nya.
        $client = Client::with('iklan')->where('id_client', $id)->first();

        // jika ada, maka tampilkan client show
        if ($client) {
            return view('client.show', compact('client'));
        } else {
            return redirect()->back();
        }
    }
```

Kalau kita memanggil Model, sudah pasti harus diimpor di controller nya. <br>

```
use App\Models\Client;
```

Untuk membuat model juga tidak dibuat secara manual, tetapi menggunakan perintah:

```
php artisan make:model NamaModel

// misalnya

php artisan make:model Client
```

lalu otomatis terbuat.

<hr>

### resources\views

Di folder ini berisi html, yang dalam laravel sering disebut `Blade Template Engine`. <br>
Misalnya pergi ke sub folder `resources\views\rancangan_siar`. <br>
Disini berisi file file blade yang nanti akan di tampilkan di browser. <br>

Misalnya di file `index.blade.php`
di file ini berisi tampilan yang diteruskan dari function controller `public function index` tadi

Di `index.blade.php` ini berisi tabel yang akan menampilkan semua rancangan siar.
Untuk penjelasan kode lebih lengkap di dalamnya bisa pakai AI seperti tadi. copy semua isi file nya, lalu minta dijelaskan. <br>

```
<x-sidebar-navbar-layout>
...
// copy semua isinya lalu minta jelaskan AI
....
</x-sidebar-navbar-layout>

```

<hr>

### database\

Di folder database ada sub folder lagi yang namanya migrations. <br>
Disini berisi file file untuk pembuatan database nya. <br>
Jadi di laravel, kita tidak perlu membuat database nya secara manual lewat MySQL, tinggal buat migrasi nya saja. <br>
Sebagai contoh, ambil file yang urutan 4, yaitu `2025_04_02_073138_create_clients_table.php`
Disinilah pembuatan database nya. <br>

```
public function up(): void
    {
        Schema::create('client', function (Blueprint $table) {
            $table->bigIncrements('id_client');
            $table->string('nama_client');
            $table->timestamps();
        });
    }
```

ada kolom `id_client` tipenya bigIncrements, karena primary key. <br>
kolom `nama_client` tipe nya VARCHAR, kalo di laravel biasanya string. <br>
kolom timestamp() untuk menambahkan `created_at` dan `updated_at` secara otomatis.

Lalu buka file file lain, disitu juga ada proses untuk pembuatan tabel dan ada juga proses untuk edit tabel, seperti tambah kolom dll. <br>
Pakai bantuan AI untuk dijelaskan kode nya. <br>

untuk membuat file migrasi ini, biasanya juga tidak dilakukan manual, tetapi pakai perintah: <br>

```
php artisan make:migration nama_migrasi

// misalnya

php artisan make:migration create_client_table
```

untuk folder di `factories` dan `seeders` di database bisa minta dijelaskan AI. Copy semua isi code di dalam file nya dan minta dijelaskan.

Mungkin yang penting itu sih.<br>
Segini dulu dokumentasi nya, kalo ada yg kurang jelas nanti tanyain saja.

<hr>
