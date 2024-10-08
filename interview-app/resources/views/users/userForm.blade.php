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
        <div id="message" style="display: none;"></div> <!-- Message container -->
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

                // Reset any previous error messages and messages
                $('.error-message').remove();
                $('.message').remove();

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

                // Only validate password fields if it's a new user or password fields are filled during edit
                if (!$('input[name="_method"]').length || $('#password').val() !== '' || $('#password_confirmation').val() !== '') {
                    if ($('#password').val() === '') {
                        isValid = false;
                        $('#password').after('<span class="error-message">Password is required.</span>');
                    }

                    if ($('#password_confirmation').val() !== $('#password').val()) {
                        isValid = false;
                        $('#password_confirmation').after('<span class="error-message">Passwords do not match.</span>');
                    }
                }

                // If validation passes, submit the form using AJAX
                if (isValid) {
                    let action = $('input[name="_method"]').length ? 'Updating User...' : 'Creating User...';
                    $('#message').text(action).show(); // Show a message without needing to dismiss it

                    $.ajax({
                        url: $(this).attr('action'), // Use the form's action attribute
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            // Update the message based on the action
                            let successMessage = $('input[name="_method"]').length ? 'User updated successfully!' : 'User created successfully!';
                            $('#message').text(successMessage); // Update the message on the screen
                            
                            // Redirect to the index page after a short delay (optional)
                            setTimeout(function() {
                                window.location.href = "{{ route('users.index') }}"; // Change to your actual route
                            }, 2000); // 2000 milliseconds = 2 seconds delay
                        },
                        error: function(xhr) {
                            // Handle validation errors from the server
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $(`#${key}`).after(`<span class="error-message">${value[0]}</span>`);
                                });
                            } else {
                                $('#message').text('An error occurred. Please try again.'); // Show an error message
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
