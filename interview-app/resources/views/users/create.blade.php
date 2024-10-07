<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <h1>Create New User</h1>
        <form action="/users" method="POST" class="form">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" required class="form-control">
            </div>
            <button type="submit">Create User</button>
        </form>
    </div>
    <div>
        <a href="{{ url('/users/') }}">
            <button>Back to Users Table</button>
        </a>
    </div>

    <div class="errors">
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
