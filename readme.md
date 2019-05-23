## BlogLaravel

Ini adalah project blog dengan fokus utama menggunakan Framework PHP yaitu [Laravel](https://laravel.com). Menggunakan bahasa pemrograman berbasis Web antara lain :

-   HTML,
-   CSS,
-   PHP, dan
-   Javascript.
    Untuk Database project ini menggunakan MySQL.

Menggunaan beberapa framework antara lain :

-   [Bootstrap](https://getbootstrap.com/).
-   [JQuery](https://jquery.com/).

Disini saya menggunakan 2 template, yaitu :

-   Untuk FrontEnd atau tampilan user menggunakan [Wordsmith](https://colorlib.com/wp/template/wordsmith/).
-   Untuk BackEnd atau tampilan Admin menggunakan [SB Admin 2](https://startbootstrap.com/template-overviews/sb-admin-2/).

Ada juga beberapa fitur yang ditambahkan pada project blog ini, antara lain :

-   [Disqus](https://disqus.com/).
-   [Toastr](https://github.com/CodeSeven/toastr).
-   [CKEditor](https://github.com/UniSharp/laravel-ckeditor).
-   [Laravel File Manager](https://github.com/UniSharp/laravel-filemanager).
-   [SweetAlert](https://sweetalert2.github.io/).
-   [AddThis](https://www.addthis.com/).

Untuk menggunakannya silahkan clone atau fork repository ini, lalu jalankan perintah dibawah pada terminal kalian :

```
php artisan migrate
php artisan db:seed
```

Lalu jalankan perintah dibawah untuk mengakses file images posts, portfolio dan avatar

```
php artisan storage:link
```

Lalu pada file AuthenticatesUsers.php pada fungsi sendFailedLoginResponse() ganti seluruh isi fungsi menjadi dibawah ini :

```
$user = User::withTrashed()->where('email', $request->email)->first();
if (!empty($user)) {
    if ($user->deleted_at != null) {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.deleted')],
        ]);
    }
}
throw ValidationException::withMessages([
    $this->username() => [trans('auth.failed')],
]);
```

Jangan lupa untuk import model Usernya
