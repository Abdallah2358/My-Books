@extends('movies.layout')
@section('title')
    <title>Dashboard</title>
@endsection
@section('page')


    <!-- navigation bar start -->
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <!-- logo -->
                <a href="/" class="d-flex align-items-center me-lg-auto mb-2  text-white text-decoration-none">
                    <img style="background-color: wheat;" src="Logo.png" width="auto" height="auto" alt="digisay">
                </a>


                {{-- filtration area --}}

                {{-- filter based on rating --}}
                <select value="{{ request('rating') }}" class="form-select mx-2" style="width: auto" id="rating"
                    onchange="handleRatingSearch()">
                    @if (!request('rating'))
                        <option selected disabled>Rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    @else
                        <option disabled>Rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            @if (request('rating') == $i)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                            @else
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endif
                        @endfor
                    @endif
                </select>

                {{-- filter based on category --}}
                <select value="{{ request('category') }}" class="form-select mx-2" style="width: auto" id="category"
                    onchange="handleCategorySearch()">
                    @if (!request('category'))
                        <option selected disabled>Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    @else
                        <option disabled>Category</option>
                        @foreach ($categories as $category)
                            @if (request('category') == $category->name)
                                <option selected value="{{ $category->name }}">{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>

                {{-- filter based on search --}}
                <form method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('rating'))
                        <input type="hidden" name="rating" value="{{ request('rating') }}">
                    @endif
                    <input type="search" name="search" class="form-control form-control-dark" placeholder="Search..."
                        value="{{ request('search') }}">
                </form>

                {{-- add movie --}}
                <button type="button" class="btn btn-outline-light me-2" onclick="document.location='/create'">
                    add movie
                </button>

                {{-- logout --}}
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-light">logout</button>
                </form>
            </div>
        </div>
    </header>
    <!-- navigation bar end  -->



    <h1 class="border border-white mt-4 px-4 text-center bg-dark text-white">My Movies List</h1>




    <!-- movies list -->
    </div>
    <ul class="list-group">
        @foreach ($movies as $movie)
            <!-- movie element start -->

            {{-- info --}}
            <li class="list-group-item my-2  bg-dark text-white">
                <div class="row">
                    <div class="col-10">
                        {{-- name --}}
                        <h1>{{ $movie->name }}</h1>

                        {{-- category --}}
                        <span>Category : <a class=" text-decoration-none" style="color: burlywood"
                                href="/?category={{ $movie->category->name }}">{{ $movie->category->name }}</a></span>

                        {{-- descripto --}}
                        <p class="m-4">{{ $movie->descripto }}</p>
                    </div>

                    <!-- rating -->
                    <div class="col-2">
                        <div class="text-center position-relative top-50 start-50 translate-middle">
                            <span class="m-2"><a class="text-decoration-none" style="color: white" href="/?rating={{ $movie->rating }}">
                                    {{ $movie->rating }}
                                </a></span>
                            @for ($i = 0; $i < $movie->rating; $i++)
                                <span class="fa fa-star checked"></span>
                            @endfor
                            @for ($i = $movie->rating; $i < 5; $i++)
                                <span class="fa fa-star"></span>
                            @endfor
                        </div>
                    </div>
                    <!-- rating end -->
                </div>
                {{-- end of info --}}

                {{-- controls --}}
                <div>
                    <form method="POST" action="/delete/{{ $movie->id }}" class="position-absolute bottom-0 end-0 my-2">
                        @csrf
                        {{-- edit --}}
                        <button type="button" class="btn btn-outline-light "
                            onclick="document.location='/edit/{{ $movie->id }}'">edit</button>
                        {{-- delete --}}
                        <button type="submit" class="btn btn-danger mx-4">delete</button>
                    </form>
                </div>
                {{-- controls end --}}
            </li>
            <!-- movie element end -->
        @endforeach
    </ul>
    <!-- movies list end -->


    {{-- built in pagination function --}}
    {{ $movies->links() }}



    {{-- flash card section --}}
    @if (session()->has('success'))
        {{-- flash card --}}
        <span class="position-fixed bottom-0 end-0 text-center bg-primary border border-dark w-25 rounded-pill m-2"
            style="color: white; width: 300rem" id="flash" onclick="removeFlash()">
            {{ session('success') }}
        </span>
    @endif
    {{-- End flash card section --}}


    {{-- custom scripts --}}
    <script>
        // a script to remove falash card either by click or after 3 seconds
        function removeFlash() {
            if (document.getElementById('flash')) {
                document.getElementById('flash').style.display = 'none';

            }
        }
        setTimeout(() => {
            removeFlash();
        }, 3000);
        console.log('object');
        //fuction to handle filteration related to catefory 
        function handleCategorySearch() {
            //get value of category feild
            let value = document.getElementById('category').value;

            //get value of serach query 
            let searchParams = new URLSearchParams(window.location.search);
            // check to see if it contains search 
            if (searchParams.has('search') || searchParams.has('rating')) {
                //if it does  check to see if it has category as well
                if (searchParams.has('category')) {
                    //if it has a category remove it 
                    searchParams.delete('category');
                }
                //append the new category query value 
                searchParams.append('category', `${value}`);
                //get the newly formed query 
                document.location = `/?${searchParams.toString()}`;
            } else {
                //if it does not simply get the query
                document.location = `/?category=${value}`
            }
        }

        function handleRatingSearch() {
            console.log('here');
            //get value of category feild
            let value = document.getElementById('rating').value;

            //get value of serach query 
            let searchParams = new URLSearchParams(window.location.search);
            // check to see if it contains search 
            if (searchParams.has('search') || searchParams.has('category')) {
                //if it does  check to see if it has category as well
                if (searchParams.has('rating')) {
                    //if it has a category remove it 
                    searchParams.delete('rating');
                }
                //append the new category query value 
                searchParams.append('rating', `${value}`);
                //get the newly formed query 
                document.location = `/?${searchParams.toString()}`;
            } else {
                //if it does not simply get the query
                document.location = `/?rating=${value}`
            }
        }
    </script>
@endsection
