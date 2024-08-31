<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 7</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #e1e5e8;
            padding-top: 20px;
            padding-bottom: 20px;
            top: 56px; /* Adjust for header height */
        }

        .sidebar a {
            padding: 10px 15px;
            display: block;
            color: #333;
        }

        .sidebar a:hover {
            background-color: #ddd;
            color: #000;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            margin-top: 56px; /* Adjust for header height */
        }

        /* Custom CSS to make input fields square-shaped */
        .square-input {
            border-radius: 0;
            /* Removes any rounded corners */
            height: 40px;
            /* Set a fixed height to ensure square appearance */
            padding: 0.375rem 0.75rem;
            /* Default Bootstrap padding for consistency */
            box-shadow: none;
            /* Optional: Removes any shadow effect */
        }

        /* Select2 adjustment to match square design */
        .select2-container--bootstrap-5 .select2-selection--single {
            border-radius: 0;
            /* Makes the Select2 dropdown square-shaped */
            height: 40px;
            /* Matches height with input fields */
            padding: 0.375rem 0.75rem;
            /* Adjust padding */
            border: 1px solid #ced4da;
            /* Matches default input border */
            background-color: #fff;
            /* Background color to match input fields */
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .select2-container--bootstrap-5 .select2-selection--single:hover,
        .select2-container--bootstrap-5 .select2-selection--single:focus {
            border-color: #80bdff;
            /* Match default Bootstrap hover/focus border */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            /* Adds a blue shadow on focus/hover */
        }

        .header {
            height: 56px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            padding: 0 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .header .navbar-brand {
            margin-right: auto;
        }

        .header .logout {
            margin-left: auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <a class="navbar-brand" href="{{ route('faculty.index') }}">City University</a>
        <a class="btn btn-danger logout" href="#"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="#" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <div class="sidebar">
        <a class="navbar-brand" href="{{ route('faculty.index') }}">Add/Rem Faculty</a>
        <a class="nav-link" href="{{ route('department.index') }}">Add/Rem Department</a>
        <a class="nav-link" href="{{ route('program.index')}}">Add/Rem Program</a>
        <a class="nav-link" href="">Add/Rem Semester</a>        
        <a class="nav-link" href="">Add/Rem Teacher</a>
        <a class="nav-link" href="">Add/Rem Room</a>
        <a class="nav-link" href="">Add/Rem Course</a>
        <a class="nav-link" href="">Add/Rem Section</a>
        <a class="nav-link" href="">Add/Rem User</a>
    </div>
    <div class="content">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    @stack('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select Faculty',
                theme: 'bootstrap-5', // Assuming you're using Select2 with Bootstrap 5 theme
                width: '100%' // Ensures that Select2 uses the full width of the container
            });
        });
    </script>
</body>

</html>
