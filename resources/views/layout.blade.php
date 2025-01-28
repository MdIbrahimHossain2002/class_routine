<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Rotuine</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            height: calc(100vh - 56px);
            position: fixed;
            background-color: #e1e5e8;
            padding-top: 20px;
            padding-bottom: 20px;
            top: 70px;
            overflow-y: auto;
        }

        .active {

            background: green;
            color: white !important;

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
            padding: 10px;
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
            height: 70px;
            background-color: #007bff;
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

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 70px;
            height: 45px;
            margin-right: 10px;
            margin-left: 20px;
        }

        .header a {
            padding-left: 10px;
            text-decoration-color: #022e5d
        }

        .header .navbar-brand {
            font-size: 20px;
            color: rgb(249, 242, 242);
            text-decoration: none;
            font-weight: bold;
        }

        .log {
            display: flex;
            height: 100%;
            text-align: center;
        }

        .logout-link {
            font-size: 16px;
            color: rgb(241, 40, 40);
            text-decoration: none;
            font-weight: bold;
            padding: 5px 5px;
            background-color: transparent;
            border: 1px solid white;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-link:hover {
            background-color: white;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-container">
            <img src="{{ asset('assets/lg-removebg-preview.png') }}" alt="University Logo" class="logo">
        </div>

        <a class="navbar-brand" href="{{ route('faculty.index') }}">City University Routine Managment System</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="log">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="logout-link">
                    {{ __('Log Out') }}
                    <i class="fa fa-sign-out"></i>
                </a>

            </div>
        </form>

    </div>


    <div class="sidebar">
        <div class="text-center mb-2">
            <img src="{{ asset('assets/profile.jpeg') }}" alt="Profile Picture" class="rounded-circle mb-2"
                style="width: 60px;">
            <p class="fw-bold">Zihad Hossain</p>
        </div>
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-layers"></i> Dashboard</a>


        <a class="nav-link {{ request()->routeIs('faculty.index') ? 'active' : '' }}"
            href="{{ route('faculty.index') }}"> <i class="bi bi-layers"></i> Add/Rem Faculty</a>
        <a class="nav-link {{ request()->routeIs('department.index') ? 'active' : '' }}"
            href="{{ route('department.index') }}"><i class="bi bi-layers"></i> Add/Rem Department</a>
        <a class="nav-link {{ request()->routeIs('program.index') ? 'active' : '' }}"
            href="{{ route('program.index') }}"><i class="bi bi-layers"></i> Add/Rem Program</a>
        <a class="nav-link {{ request()->routeIs('semester.index') ? 'active' : '' }}"
            href="{{ route('semester.index') }}"><i class="bi bi-layers"></i> Add/Rem Semester</a>
        <a class="nav-link {{ request()->routeIs('teacher.index') ? 'active' : '' }}"
            href="{{ route('teacher.index') }}"><i class="bi bi-layers"></i> Add/Rem Teacher</a>
        <a class="nav-link {{ request()->routeIs('room.index') ? 'active' : '' }}" href="{{ route('room.index') }}"><i
                class="bi bi-layers"></i> Add/Rem Room</a>
        <a class="nav-link {{ request()->routeIs('course.index') ? 'active' : '' }}"
            href="{{ route('course.index') }}"><i class="bi bi-layers"></i> Add/Rem Course</a>
        <a class="nav-link {{ request()->routeIs('section.index') ? 'active' : '' }}"
            href="{{ route('section.index') }}"><i class="bi bi-layers"></i> Add/Rem Section</a>
        <a class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}" href="{{ route('user.index') }}"><i
                class="bi bi-layers"></i> Add/Rem User</a>
        <a class="nav-link {{ request()->routeIs('routine.index') ? 'active' : '' }}"
            href="{{ route('routine.index') }}"> <i class="bi bi-layers"></i> Class Routine</a>

            <a class="nav-link {{ request()->routeIs('report.batch', 'report.room', 'report.teacher', 'report.day') ? 'collapsed' : '' }}"
                data-toggle="collapse"
                href="#clientReportSubmenu"
                role="button"
                aria-expanded="{{ request()->routeIs('report.batch', 'report.room', 'report.teacher', 'report.day') ? 'true' : 'false' }}"
                aria-controls="clientReportSubmenu">
                <i class="bi bi-layers"></i> Client Specific Report
             </a>
             <div class="collapse submenu {{ request()->routeIs('report.batch', 'report.room', 'report.teacher', 'report.day') ? 'show' : '' }}"
                  id="clientReportSubmenu">
                 <a class="nav-link ps-4 {{ request()->routeIs('report.batch') ? 'active' : '' }}"
                    href="{{ route('report.batch') }}">Batch Wise Routine</a>
                 <a class="nav-link ps-4 {{ request()->routeIs('report.room') ? 'active' : '' }}"
                    href="{{ route('report.room') }}">Room Wise Routine</a>
                 <a class="nav-link ps-4 {{ request()->routeIs('report.teacher') ? 'active' : '' }}"
                    href="{{ route('report.teacher') }}">Teacher Wise Routine</a>
                 <a class="nav-link ps-4 {{ request()->routeIs('report.day') ? 'active' : '' }}"
                    href="{{ route('report.day') }}">Day Wise Routine</a>
             </div>

    </div>

    </div>
    <div class="content">
        <div class="container-fluid custom_container">
            @yield('content')
        </div>
    </div>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
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
                            $('#department_id').append(
                                '<option value="">Select Department</option>');
                            $.each(data, function(key, value) {
                                $('#department_id').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#department_id').empty();
                    $('#department_id').append('<option value="">Select Department</option>');
                }
            });

            $('#department_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: "{{ route('getPrograms', '') }}/" + departmentID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // console.log(data);

                            $('#program_id').empty();
                            $('#program_id').append('<option value="">Select Program</option>')
                            $.each(data.program, function(key, value) {
                                $('#program_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                            $('#semester_id').empty();
                            $('#semester_id').append(
                                '<option value="">Select Semester</option>')
                            $.each(data.semester, function(key, value) {
                                $('#semester_id').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                            $('#course_id').empty();
                            $('#course_id').append('<option value="">Select Course</option>')
                            $.each(data.semester, function(key, value) {
                                $('#course_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        }
                    });
                } else {

                    $('#semester_id').empty();
                    $('#semester_id').append('<option value="">Select Semester</option>');
                    $('#program_id').empty();
                    $('#program_id').append('<option value="">Select Department</option>');
                }
            })
            $('#program_id').on('change', function() {
                var programID = $(this).val();
                if (programID) {
                    $.ajax({
                        url: "{{ route('getSections', '') }}/" + programID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#section_id').empty();
                            $('#section_id').append('<option value="">Select Section</option>')
                            $.each(data, function(key, value) {
                                $('#section_id').append('<option value="' + value.id +
                                    '">' + value.batch_number + ' - ' + value
                                    .section + '</option>');
                            });
                        }
                    });
                } else {
                    $('#section_id').empty();
                    $('#section_id').append('<option value="">Select Program</option>');
                }
            })
            $('#teachers_department_id').on('change', function() {
                var teachers_departmentID = $(this).val();
                if (teachers_departmentID) {
                    $.ajax({
                        url: "{{ route('getTeachers', '') }}/" + teachers_departmentID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#teacher_id').empty();
                            $('#teacher_id').append('<option value="">Select Teacher</option>')
                            $.each(data, function(key, value) {
                                $('#teacher_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#teacher_id').empty();
                    $('#teacher_id').append('<option value="">Select Teacher</option>');
                }
            })
        });
    </script>
     <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleSidebar = document.getElementById('toggleSidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('collapsed');
        });
    </script>
</body>

</html>
