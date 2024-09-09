<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Rotuine</title>

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
            top: 56px;
            /* Adjust for header height */
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
            margin-top: 56px;
           
        }
        .square-input {
            border-radius: 0;
            height: 40px;          
            padding: 0.375rem 0.75rem;
            box-shadow: none;
        }

        .select2-container--bootstrap-5 .select2-selection--single {
            border-radius: 0;        
            height: 40px;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            background-color: #fff;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .select2-container--bootstrap-5 .select2-selection--single:hover,
        .select2-container--bootstrap-5 .select2-selection--single:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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
        <a class="nav-link" href="{{ route('semester.index')}}">Add/Rem Semester</a>
        <a class="nav-link" href="{{ route('teacher.index')}}">Add/Rem Teacher</a>
        <a class="nav-link" href="{{ route('room.index')}}">Add/Rem Room</a>
        <a class="nav-link" href="{{ route('course.index')}}">Add/Rem Course</a>
        <a class="nav-link" href="{{ route('section.index')}}">Add/Rem Section</a>
        <a class="nav-link" href="">Add/Rem User</a>
        <a class="nav-link" href="">Class Routine</a>
        <a class="nav-link" href="">Client Specific Report </a>

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
                placeholder: 'Select',
                theme: 'bootstrap-5', 
                width: '100%' 
            });

            $('#faculty_id').on('change', function() {
                var facultyId = $(this).val();
                if (facultyId) {
                    $.ajax({
                        url: "{{ route('getDepartments', '') }}/" + facultyId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#department_id').empty();
                            $('#department_id').append('<option value="">Select Department</option>');
                            $.each(data, function(key, value) {
                                $('#department_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#department_id').empty();
                    $('#department_id').append('<option value="">Select Department</option>');
                }
            });
            $('#department_id').on('change',function(){
                var departmentID= $(this).val();                
                if(departmentID){
                    $.ajax({
                        url: "{{ route('getPrograms','')}}/" +departmentID,
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            $('#program_id').empty();
                            $('#program_id').append('<option value="">Select Program</option>')
                            $.each(data,function(key,value){
                            $('#program_id').append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    });
                }else{
                    $('#program_id').empty();
                    $('#program_id').append('<option value="">Select Department</option>');
                }
            })
        });
    </script>
</body>

</html>