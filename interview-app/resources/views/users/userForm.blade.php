<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($user) ? 'Edit User' : 'Create User' }}</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"> <!-- Link to the CSS file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>
        <form id="userForm" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
            @csrf
            @if(isset($user))
                @method('PUT') <!-- This is for the update method -->
            @endif

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ isset($user) ? $user->name : '' }}" required class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ isset($user) ? $user->email : '' }}" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">{{ isset($user) ? 'New Password (Leave blank to keep current)' : 'Password' }}:</label>
                <input type="password" id="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
            </div>
            <div class="form-group">
                <label for="password_confirmation">{{ isset($user) ? 'Confirm New Password (Leave blank to keep current)' : 'Confirm Password' }}:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
            </div>
            <button type="submit">{{ isset($user) ? 'Save User' : 'Create User' }}</button>
        </form>
        <a href="{{ route('users.index') }}">
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

    <script>
        $(document).ready(function() {
            $('#userForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Reset any previous error messages
                $('.error-message').remove();

                let isValid = true;

                // Example client-side validation
                if ($('#name').val() === '') {
                    isValid = false;
                    $('#name').after('<span class="error-message">Name is required.</span>');
                }

                if ($('#email').val() === '') {
                    isValid = false;
                    $('#email').after('<span class="error-message">Email is required.</span>');
                }

                if ($('#password').val() === '' && !$('input[name="_method"]').val()) { // Only require password for new users
                    isValid = false;
                    $('#password').after('<span class="error-message">Password is required.</span>');
                }

                if ($('#password_confirmation').val() !== $('#password').val()) {
                    isValid = false;
                    $('#password_confirmation').after('<span class="error-message">Passwords do not match.</span>');
                }

                // If validation passes, show alert and submit the form using AJAX
                if (isValid) {
                    const isEditing = $('input[name="_method"]').val() === 'PUT';
                    
                    if (isEditing) {
                        alert('Updating user...');
                    } else {
                        alert('Creating a new user...');
                    }

                    $.ajax({
                        url: $(this).attr('action'), // Use the form's action attribute
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            // Handle success
                            alert(isEditing ? 'User updated successfully!' : 'User created successfully!');
                            // Optionally, redirect or clear the form
                            window.location.href = "{{ route('users.index') }}"; // Redirect to users list
                        },
                        error: function(xhr) {
                            // Handle validation errors from the server
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $(`#${key}`).after(`<span class="error-message">${value[0]}</span>`);
                                });
                            } else {
                                alert('An error occurred. Please try again.');
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
