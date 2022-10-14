@extends('admins.layout')

@section('title')
    <title>Register</title>
@endsection

@section('content')
    <main class="form-signin">
        <form method="POST" accept="/register">
            @csrf
            <!-- logo  -->
            <img class="mb-4" src="Logo.png" alt="Logo" width="auto" height="auto">

            <h3 style="color: white;">Register an Admin</h1>
                <!-- Full name  -->
                <input type="text" class="form-control mb-2" name="name" placeholder="Full Name" value="{{ old('name') }}">
                @error('name')
                    <span style="color: blue ">{{ $message }}</span>
                @enderror

                <!-- email -->
                <input type="email" class="form-control mb-2" name="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                    <span style="color: blue ">{{ $message }}</span>
                @enderror

                <!-- password -->
                <input type="password" class="form-control mb-2" name="password" placeholder="Password">
                @error('password')
                    <span style="color: blue ">{{ $message }}</span>
                @enderror

                <!-- phone number -->
                <input type="text" class="form-control mb-2" name="phone" placeholder="Phone number"
                    value="{{ old('phone') }}">
                @error('phone')
                    <span style="color: blue ">{{ $message }}</span>
                @enderror
                
                <!-- submit register -->
                <button class="w-100 btn mb-2 btn-lg  btn-primary" type="submit">Register</button>
        </form>
        <!-- back to login -->
        <button onclick="document.location='/login'" class="w-50  btn btn-lg btn-light">Login</button>
    </main>

@endsection
