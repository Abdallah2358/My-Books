@extends('admins.layout')

@section('title')
    <title>Edit movie</title>
@endsection


@section('content')
    <main class="form-signin" style="max-width: 500px">
        <form method="POST" action="/edit/{{ $movie->id }}">
            @csrf
            <!-- logo image  -->
            <img class="mb-4" src="/Logo.png" alt="Logo" width="auto" height="auto"
                onclick="document.location='/'">

            {{-- movie data --}}
            <div class="mb-3">

                {{-- name field --}}
                <label for="name" class="form-label">Movie Name</label>
                @if (old('name'))
                    <input type="text" class="form-control rounded-pill" id="name" name="name" style="text-align:center;"
                        value="{{ old('name') }}">
                @else
                    <input type="text" class="form-control rounded-pill" id="name" name="name" style="text-align:center;"
                        value="{{ $movie->name }}">
                @endif
                @error('name')
                    <span style="color: blue ">{{ $message }}</span>
                    <br>
                @enderror

                {{-- descripto feild --}}
                <label for="des" class="form-label">Movie Descripto</label>
                @if (old('descripto'))
                    <textarea class="form-control rounded" id="des" name="descripto"
                        rows="3">{{ old('descripto') }}</textarea>

                @else
                    <textarea class="form-control rounded" id="des" name="descripto"
                        rows="3">{{ $movie->descripto }}</textarea>

                @endif
                @error('descripto')
                    <span style="color: blue ">{{ $message }}</span>
                    <br>
                @enderror


                {{-- category feild --}}
                <select class="form-select form-select my-2 text-center" name="category_id">
                    @if (old('category_id'))
                        <option disabled>Category</option>
                        @foreach ($categories as $category)
                            @if (old('category_id') == $category->id)
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    @else
                        <option disabled>Category</option>
                        @foreach ($categories as $category)
                            @if ($movie->category_id == $category->id)
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    @endif

                </select>
                @error('category_id')
                    <span style="color: blue ">{{ $message }}</span>
                    <br>
                @enderror
            </div>

            {{-- rating feild --}}
            <div class="bg-body w-100 text-dark pt-2 my-2 rounded-pill ">

                <input type="hidden" id="rating" name="rating" value="{{ $movie->rating }}">
                @for ($i = 0; $i < $movie->rating; $i++)
                    <span class="fa fa-star align-top checked" id="{{ $i }}"
                        onclick="starHandle({{ $i }})"></span>
                @endfor
                @for ($i = $movie->rating; $i < 5; $i++)
                    <span class="fa fa-star align-top" id="{{ $i }}"
                        onclick="starHandle({{ $i }})"></span>
                @endfor
            </div>
            @error('rating')
                <span style="color: blue ">{{ $message }}</span>
                <br>
            @enderror

            <!-- submit movie -->
            <button class="w-50  mb-2 btn btn-lg btn-primary " type="submit">Update Movie</button>
            </div>
        </form>
    </main>
    {{-- custom scripts --}}
    <script>
        function starHandle(id) {
            //update heddin rating input used to store rating in database
            document.getElementById('rating').setAttribute('value', `${id+1}`)

            let clickledStar = document.getElementById(id);
            //color the stars to the clicked star including the clicked star
            for (let i = 0; i < id + 1; i++) {
                document.getElementById(i).classList.add('checked');
            }
            
            /*remove the coloring from all the stars after the clicked star */
            if (clickledStar.classList.contains('checked')) {
                for (let i = id + 1; i < 5; i++) {
                    if (document.getElementById(i).classList.contains('checked')) {
                        document.getElementById(i).classList.remove('checked');
                    }
                }
            }
        }
    </script>
@endsection
