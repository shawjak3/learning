<?php

use App\Post;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::resource('posts', 'PostsController');
Route::get('/contact', 'PostsController@contact');
Route::get('/post/{id}', 'PostsController@showPost');
// Using raw queries
Route::get('/insert', function() {
	DB::insert('insert into posts(title, content) values(?, ?)', ['Php with Elixir', 'Elixir is pretty dang cool']);
});
Route::get('/read', function() {
	$results = DB::select('select * from posts where id = ?', [1]);
	return $results;
	// foreach ($results as $result) {
	// 	return $result->title;
	// }
});
Route::get('/update', function() {
	$updated = DB::update('update posts set title = ?', ['New updated title']);
	return $updated;
});
Route::get('/delete', function() {
	$deleted = DB::delete('delete from posts where id = ?', [1]);
	return $deleted;
});

// Using eloquent
Route::get('/find', function() {
	$posts = Post::all();
	foreach ($posts as $post) {
		return $post->title;
	}
});

Route::get('/findone', function() {
	$post = Post::find(2);
	return $post->title;
});

Route::get('/where', function() {
	$posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
	return $posts;
});


