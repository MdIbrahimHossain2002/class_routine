<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Wise Routine</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        .container {
            font-family: "Times New Roman", Times, serif;
            max-width: 190mm;
            margin: 0 auto;
            padding: 10px;
        }

        h4 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .text-center {
            color: #555;
            font-weight: 600;
        }

        .card {
            border-radius: 8px;
            border: 1px solid #000;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff;
        }

        .table {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 25px;
            border-collapse: collapse;
        }

        .table thead th {
            background-color: #fff;
            font-weight: bold;
            border: 1px solid #000;
            padding: 8px;
            color: #333;
        }

        .table tbody td,
        tfoot th {
            border: 1px solid #000;
            padding: 8px;
            color: #555;
        }

        .table tfoot th {
            font-weight: bold;
            background-color: #fff;
            color: #333;
            padding: 8px;
        }

        .table tbody tr:nth-child(even) {
            background-color: #fff;
        }

        .table-bordered {
            border: 1px solid #000;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .my-4 {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        .shadow-sm {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media print {

            body,
            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .container {
                padding: 0;
                margin: auto;
            }

            .card,
            .mb-3,
            .my-4,
            .mt-5 {
                box-shadow: none !important;
                margin: 0;
                padding: 0;
            }

            .table th,
            .table td {
                padding: 6px;
                font-size: 12px;
            }

            h4 {
                font-size: 18px;
                margin: 10px 0;
            }
        }

        .university {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        td {
            font-weight: normal;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="container my-4">
            <h4 class="text-center"> Teacher Wise Routine – Fall 2024</h4>
            <div class="text-center mb-3 university">
                <strong>City University</strong><br>

                Fall-2024<br>

            </div>

            <strong> Teacher Name : {{$routines[0]->teacher->teacher_name}} </strong><br>

            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Credit</th>
                        <th>Faculty Name</th>
                        <th>Day One</th>
                        <th>Day Two</th>
                        <th>Time</th>
                        <th>Room</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total = 0;
                    @endphp
                    @forelse($routines as $detail)

                    <tr>
                        <td>{{$detail->course->course_code}}</td>
                        <td>{{$detail->course->course_title}}</td>
                        <td>{{ number_format(optional($detail->course)->course_credit, 1) }}</td>
                        <td>{{$detail->teacher->teacher_name}}</td>
                        <td>{{$detail->day_one}}</td>
                        <td>{{$detail->day_two}}</td>
                        <td>{{$detail->time}}</td>

                        <td>{{$detail->room->room_no}}</td>

                        @php
                        $total= $total+$detail->course->course_credit;
                        @endphp
                    </tr>
                    @empty
                    <tr col="30">
                        <td colspan="4" style="display: flex; justify-content: center; align-items: center;">
                            No Subject Has Add
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th>{{ number_format($total,1)}}</th>
                        <th colspan="5"></th>
                    </tr>
                </tfoot>
            </table>
        </div>


    </div>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    @if (isset($is_print))
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
    @endif

</body>

</html>
