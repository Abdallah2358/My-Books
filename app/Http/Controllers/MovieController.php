<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Movie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        $movies = Movie::where('user_id', $user)->orderBy('updated_at','desc')->filter(request(['search', 'category', "rating"]))->paginate()->withQueryString();

        $categories = Category::all();

        return view('movies.dashboard', ['movies' => $movies, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  Category::all();

        return view('movies.add', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate input

        $attributes = request()->validate(
            [
                'name' => ['required', 'max:255'],
                'category_id' => ['required', 'exists:categories,id'],
                'descripto' => ['required'],
                'rating' => ['required', 'integer', 'min:1', 'max:5',],
            ]
        );
        //add the user id  to the attributes
        $user = auth()->user()->id;
        $attributes['user_id'] = "$user";
        $attributes['update_user_id'] = "$user";

        //persist the movie in the data base
        Movie::create($attributes);

        //go back to home page
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $categories =  Category::all();
        return view('movies.edit', ['movie' => $movie, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //validate input

        $attributes = request()->validate(
            [
                'name' => ['required', 'max:255'],
                'category_id' => ['required', 'exists:categories,id'],
                'descripto' => ['required'],
                'rating' => ['required', 'integer', 'min:1', 'max:5',],
            ]
        );
        //add the user id  to the attributes
        $user = auth()->user()->id;
        $attributes['update_user_id'] = "$user";

        $movie->update($attributes);
        return  redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie, Request $req)
    {
        $movie->delete();
        return  redirect('/');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }
}
