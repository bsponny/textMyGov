<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    
</head>
<body>
    <h1>Users List</h1>
    <div>
        <a href="{{ url('/users/create') }}">
            <button>Create New User</button>
        </a>
    </div>


    <table border="2">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <!-- Edit button -->
                    <a href="{{ route('users.edit', $user->id) }}"><button>Edit</button></a>

                    <!-- Form for deleting the user -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE') <!-- Use DELETE method -->
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
