@extends('layout')

@section('content')
<br><br><br><br><br><br>
<center>
    <div class="ajax-wrapper-login">
        <form action="/authenticate" method="POST" class="authenticate-user-ajax">
            @csrf
            <p>Member Computer Technology</p>
            <label for=""><i class="fa fa-user"></i> Username</label><br>
            <input type="text" name="username" id="" placeholder="Username . . ."><br>
            @error('username')
            <span>Username is required!</span>
            @enderror
            <br>
            <label for=""><i class="fas fa-key"></i> Password:</label><br>
            <input type="password" name="password" id="" minlength="8" placeholder="Password . . ."><br>
            @error('password')
            <span>Password is required!</span>
            @enderror
            <br>
            <button type="submit"><i class="fa fa-sign-in"></i> Sign In</button><br><br>
        </form>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br>
</center>


@endsection