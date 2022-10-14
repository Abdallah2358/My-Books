@extends('admins.layout')
@section('title')
    <title>login</title>
@endsection

@section('content')
    <main class="form-signin">
        <form method="POST" action="/login">
            @csrf
            <!-- image  -->
            <img class="mb-4" src="Logo.png" alt="Logo" width="auto" height="auto">
            <!-- email -->
            <input type="email" class="form-control mb-2"  name="email" id="email" placeholder="Email">
            @error('email')
                <span style="color: blue ">{{ $message }}</span>
            @enderror
            <!-- password -->
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <!-- submit login -->
            <button class="w-100  mb-2 btn btn-lg btn-primary" type="submit">Login</button>
            <!-- go to register -->
            <a class="w-50 btn btn-lg btn-light" href="/register">Register</a>
        </form>
    </main>
    {{-- flash card --}}
    @if (session()->has('success'))
        <span class="position-fixed bottom-0 end-0 text-center bg-primary border border-dark w-25 rounded-pill m-2"
            style="color: white; width: 300rem" id="flash" onclick="removeFlash()">
            {{ session('success') }}
        </span>
        <script>
            //remove falash card either by click or after 3 seconds
            function removeFlash() {
                document.getElementById('flash').style.display = 'none';
            }
            setTimeout(() => {
                removeFlash();
            }, 3000);
        </script>
    @endif
@endsection
