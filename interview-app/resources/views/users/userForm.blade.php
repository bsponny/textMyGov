<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($user) ? 'Edit User' : 'Create User' }}</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"> <!-- Link to the CSS file -->
    
</head>
<body>
    <div class="container">
        <h1>{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>
        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT') <!-- This is for the update method -->
        @endif

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ isset($user) ? $user->name : '' }}" required class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ isset($user) ? $user->email : '' }}" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">{{ isset($user) ? 'New Password (Leave blank to keep current)' : 'Password' }}:</label>
                <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
            </div>
            <div class="form-group">
                <label for="password_confirmation">{{ isset($user) ? 'Confirm New Password (Leave blank to keep current)' : 'Confirm Password' }}:</label>
                <input type="password" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
            </div>
            <button type="submit">{{ isset($user) ? 'Save User' : 'Create User' }}</button>
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
