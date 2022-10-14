@extends('admins.layout')

@section('title')
    <title>Add movie</title>
@endsection

@section('content')
    <main class="form-signin" style="max-width: 500px">
        <form method="POST" action="/create">
            @csrf

            <!-- logo image feild -->
            <img class="mb-4" src="Logo.png" alt="Logo" width="auto" height="auto"
                onclick="document.location='/'">


            <div class="mb-3">
                {{-- Moviee name feild --}}

                <input type="text" class="form-control rounded-pill" id="name" name="name" style="text-align:center;"
                    placeholder="Movie Name" value="{{ old('name') }}">
                @error('name')
                    <span style="color: blue ">{{ $message }}</span>
                @enderror

                {{-- Moviee descripto feild --}}
                <textarea class="form-control rounded my-2" id="des" name="descripto" rows="3"
                    placeholder="Movie Descripto">{{ old('descripto') }}</textarea>
                @error('descripto')
                    <span style="color: blue ">{{ $message }}</span>
                @enderror


                {{-- Category feild --}}
                <select class="form-select form-select my-2 text-center" name="category_id">
                    @if (!old('category_id'))
                        <option selected disabled>Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @else
                        <option disabled>Category</option>
                        @foreach ($categories as $category)
                            @if (old('category_id') == $category->id)
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                @error('category_id')
                    <span style="color: blue ">{{ $message }}</span>
                @enderror
            </div>

            {{-- rating feild --}}
            <div class="bg-body w-100 text-dark pt-2 my-2 rounded-pill ">
                {{-- heddin input to hold the submited value --}}
                <input type="hidden" id="rating" name="rating" value="0">
                @for ($i = 0; $i < 5; $i++)
                    <span class="fa fa-star align-top" id="{{ $i }}"
                        onclick="starHandle({{ $i }})"></span>
                @endfor
            </div>
            @error('rating')
                <span style="color: blue ">{{ $message }}</span>
                <br>
            @enderror

            <!-- submit movie -->
            <button class="w-50  mb-2 btn btn-lg btn-primary " type="submit">Add Movie</button>


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
