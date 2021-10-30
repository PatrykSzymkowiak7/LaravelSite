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

Route::get('/wsb', function (){
  // echo 'WSB';
  // return view('wsb');
  // return ['name' => 'Janusz', 'surname' => 'Nowak'];
  return view('wsb', ['name' => 'Patryk', 'surname' => 'Szymkowiak']);
});

Route::get('/pages/{x}', function($x){
  $pages = [
    'about' => 'Strona WSB',
    'contact' => 'anna@o2.pl',
    'home' => 'Strona domowa'
  ];
  return $pages[$x];
});

Route::get('/address/{city?}/{street?}/{zipCode?}', function(String $city = '-', String $street = '-', int $zipCode = null){
  $zipCode = substr($zipCode, 0, 2)."-".substr($zipCode, 2, 3);
  echo <<<ADDRESS
    Kod pocztowy: $zipCode,
     miasto: $city<br>
    Ulica: $street
    <hr>
ADDRESS;
})->name('address');

Route::redirect('adres/{city?}/{street?}/{zipCode?}', '/address/{city?}/{street?}/{zipCode?}');

Route::prefix('admin')->group(function(){
  Route::get('/home/{name}', function(String $name){
    echo "Witaj $name na stronie";
  })->where(['name' => '[A-Za-z]+']);

  Route::get('/users', function(){
    echo "Użytkownicy serwisu";
  });
});

Route::redirect('/admin/{name}', '/admin/home/{name}');

Route::get("/site/{CdvSite}", "CdvSite@index");

Route::get('site/{wsbsite}', [WsbSite::class, 'index']);