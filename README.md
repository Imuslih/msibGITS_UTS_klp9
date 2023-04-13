<p align="center"> 
<b>Cara Menjalankan Aplikasi</b>
</p>
<ol>
<li>
Melakukan Clone dari github https://github.com/Imuslih/msibGITS_UTS_klp9
>> <i> git clone https://github.com/Imuslih/msibGITS_UTS_klp9.git</i>
<li> Mengarahkan directori kedalam folder projek
>> <i>cd msibGITS_UTS_klp9.git</i>
<li> Membuka code di Visual Studio Code
>> <i>code .</i>
<li> Didalam Visual Studio Code kita menuju ke terminal untuk melakukan install vendor
>> <i>composer install</i>
<li> Melakukan copy paste .env.example menjadi .env
>> <i>cp.env.example .env</i>
<li> Melakukan generate random string yang digunakan sebagai key yang diperlukan untuk semua proses enkripsi dan dekripsi pada aplikasi kita
>> <i>php artisan key:generate</i>
<li> Melakukan migrasi database 
>> <i>php artisan migrate</i>
<li> Menjalankan seeder
>> <i>php artisan db:seed</i>
<li> Silahkan cek folder vendor, jika sudah ada folder bumbummen99, silahkan lewati step nomer 10. Jika belum ada, maka lakukan step nomor 10.

<li> Menginstall package chartshopping https://packagist.org/packages/bumbummen99/shoppingcart 
untuk menjalankannya lakukan langkah sebagai berikut:<br>
>> <i>composer require bumbummen99/shoppingcart</i><br>
>> <i>php artisan vendor:publish --provider="Gloudemans\Shoppingcart\ShoppingcartServiceProvider" --tag="config"</i>
<li> Menjalankan aplikasi
>> <i>php artisan serve</i>
<li> Selanjutnya kita akan diarahan ke halaman Login, kita dapat memasukkan:
email		: admin@gmail.com
password		: 12345
</li>
</ol>
