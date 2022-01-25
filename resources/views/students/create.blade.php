<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Create Student</h2>
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" placeholder="Enter First Name"
                    name="first_name" value="{{ old('first_name') }}" required>
                @if ($errors->has('first_name'))
                    <div class="error">{{ $errors->first('first_name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="second_name">Second Name:</label>
                <input type="text" class="form-control" id="second_name" placeholder="Enter Second Name"
                    name="second_name" value="{{ old('second_name') }}" required>
                @if ($errors->has('second_name'))
                    <div class="error">{{ $errors->first('second_name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="third_name">Third Name:</label>
                <input type="text" class="form-control" id="third_name" placeholder="Enter Third Name"
                    name="third_name" value="{{ old('third_name') }}" required>
                @if ($errors->has('third_name'))
                    <div class="error">{{ $errors->first('third_name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" placeholder="Enter Third Name" name="last_name"
                    value="{{ old('last_name') }}" required>
                @if ($errors->has('last_name'))
                    <div class="error">{{ $errors->first('last_name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                    value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>

</html>
