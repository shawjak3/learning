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

Route::get('/findmore', function() {
	// $posts = Post::findOrFail(1);
	// return $posts;

	$posts = Post::where('users_count', '<', 50)->firstOrFail();
	return $posts;
});

Route::get('/basicinsert', function() {
	$post = new Post;
	$post->title = 'Basic insert example';
	$post->content = 'This is just some basic content';
	$post->save();
});

Route::get('/updatepost', function() {
	$post = Post::find(1);
	$post->title = 'Updated title';
	$post->content = 'Updated content chunk';
	$post->save();
});

Route::get('/create', function() {
	Post::create(['title'=>'Create title', 'content'=>'Created content with method.']);
});

Route::get('/newupdate', function() {
	Post::where('id', 2)->where('is_admin', 0)->update(['title'=>'Updated title new', 'content'=>'Updated content new again.']);
});

Route::get('/newdelete', function() {
	$post = Post::find(1);
	$post->delete();
});

Route::get('/deleteagain', function() {
	Post::destroy(1);
});

Route::get('/deletemultiple', function() {
	Post::destroy([2,3]);
});

Route::get('/softdelete', function() {
	Post::find(1)->delete();
});

Route::get('/readsoftdelete', function() {
	// $post = Post::find(1);
	// return $post->title;

  // Gets trashed and regular items
	// $post = Post::withTrash()->where('id', 1)->get();
	// return $post->title;

	// Gets only trashed items
	$post = Post::onlyTrashed()->where('is_admin', 0)->get();
	return $post;
});

Route::get('/restore', function() {
	Post::onlyTrashed()->where('is_admin', 0)->restore();
});

Route::get('/forcedelete', function() {
	Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
});
