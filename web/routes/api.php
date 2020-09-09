<?php
// api

use App\Http\Controllers\Api\Data;

Route::get('/dorms',  [Data::class, 'dorms']);
Route::get('/shift',  [Data::class, 'shift']);
Route::get('/lists',  [Data::class, 'lists']);
Route::post('/sign',  [Data::class, 'sign']);
Route::post('/remark',  [Data::class, 'remark']);
