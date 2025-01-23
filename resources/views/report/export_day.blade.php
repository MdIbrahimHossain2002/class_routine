<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day Wise Routine</title>
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
        <h4 class="text-center">Day Wise Routine – Fall 2024</h4>
        <div class="text-center mb-3 university">
            <strong>City University</strong><br>

            Fall-2024<br>
        </div>
        <h2 style="text-align: center;">{{ request()->filter['day'] }}</h2>
        <table class="table table-bordered text-center align-middle">
            @php
                $groupedTime = $routineDetail->groupBy('time');
                $groupedRoom = $routineDetail->groupBy('room_id');
            @endphp
            <thead>
                <tr>
                    <th>Room</th>
                    @foreach ($groupedTime as $time => $details)
                        <th>{{ $time ?? 'N/A' }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedRoom as $roomId => $rooms)
                    <tr>
                        <th scope="row">
                            {{ \App\Models\Room::find($roomId)?->room_no ?? 'Unknown Room' }}
                        </th>
                        @foreach ($groupedTime as $time => $details)
                            <td>
                                @php
                                    $filtered = $rooms->filter(function ($room) use ($time) {
                                        return $room->time === $time;
                                    });
                                @endphp
                                @if ($filtered->isNotEmpty())
                                    @foreach ($filtered as $item)
                                        <div>{{ $item->course?->course_code ?? 'N/A' }}</div>
                                        <div>{{ $item->teacher?->teacher_name ?? 'N/A' }}</div>
                                    @endforeach
                                @else
                                    <div>-</div>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </table>
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
