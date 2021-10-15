<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cdv', function () {
    return view('cdv');
});

Route::get('/cdv', function () {
    return ['name' => 'cdv', 'base' => 'classic'];
});

Route::get('/cdv', function () {
    return view('cdv', ['name' => 'Patryk', 'surname' => 'Szymkowiak', 'city' => 'Poznań']);
});

Route::get('/pages/{x}', function($x){
    $pages = [
        'about' => 'Strona CDV',
        'contact' => 'Poznań; ul. Polna 13',
        'home' => 'Strona domowa'
    ];
    return $pages[$x];
});

Route::get('/address/{city?}/{street?}/{zipcode?}', function(String $city = "brak danych", 
String $street = " - ", int $zipcode = null){
    if(is_null($zipcode))
        $zipcode = "brak";
    else
        $zipcode = substr($zipcode,0,2)."-".substr($zipcode,2,3);
    echo <<<ADDRESS
    Kod pocztowy: $zipcode<br>
    Miasto: $city<br>
    Ulica: $street
    <hr>
ADDRESS;
})->name('address');

Route::redirect('/adres/{city?}/{street?}/{zipcode?}', '/address/{city?}/{street?}/{zipcode?}');

Route::prefix('admin')->group(function(){
    Route::get('/home/{name}', function(String $name){
        echo "Witaj $name na stronie administracyjnej";
    });

    Route::get('users', function(){
        echo "<h3>Użytkownicy systemu</h3>";
    });
});

Route::redirect('/admin/{name}', '/admin/home/{name}');

Route::get('/user/{name}/{age?}', function(String $name, int $age = null){
    echo "Imię: $name";
    if($age != null){
        echo "<br>Wiek: $age";
    }
})->where(['name' => '[A-Zz-z]+', 'age' => '[0-9]+']);