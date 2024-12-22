@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light text-black">
                        <h3 class="mb-0">Day Wise Routine</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url()->current() }}" enctype="multipart/form-data">
                            <div class="form-group row mb-3">
                                <div class="col-sm-6">
                                    <label for="section_id" class="col-form-label">Day <span
                                            class="text-danger">*</span></label>
                                    <select name="day" id="day" class="form-control select2" style="width: 100%;">
                                        <option value="">Select Day</option>
                                        <option value="">Select Day</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="title" class="col-form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control square-input"
                                        placeholder="Enter faculty name" style="width: 100%;">
                                    @error('title')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="search" id="submit"
                                            class="btn btn-success text-uppercase">
                                            <i class="fas fa-save"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (request()->has('search'))
        <div class="container">
            <div class="text-right mb-2 mt-2">
                <a href="{{ route('report.export', ['type' => 'pdf', 'filter' => request()->all()]) }}" class="btn btn-danger">
                    Export as PDF</a>
                <a href="{{ route('report.export', ['type' => 'print', 'filter' => request()->all()]) }}"
                    class="btn btn-primary"> Print</a>
            </div>
            <div class="row">
                {{-- @dd(request()->day); --}}
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="container my-4">
                            <h4 class="text-center">Day Wise Routine – Fall 2024</h4>
                            <div class="text-center mb-3">
                                <strong>City University</strong><br>
                                Fall-2024<br>
                            </div>
                            <h2 style="text-align: center;">{{request()->day}}</h2>
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
                                                        $filtered = $rooms->filter(function($room) use ($time) {
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
                    </div>
                </div>
            </div>
    @endif
@endsection
