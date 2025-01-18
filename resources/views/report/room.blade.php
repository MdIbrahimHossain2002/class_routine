@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Add Semester</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url()->current() }}" enctype="multipart/form-data">
                        <div class="form-group row mb-3">
                            <div class="col-sm-6">
                                <label for="room_id" class="col-form-label">Room Number<span class="text-danger">*</span></label>
                                <select name="room_id" id="room_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Batch</option>
                                    @foreach($room as $item)
                                    <option value="{{$item->id}}">{{ $item->room_no}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="title" class="col-form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control square-input" placeholder="Enter faculty name" style="width: 100%;">
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
                                    <button type="submit" name="search" id="submit" class="btn btn-success text-uppercase">
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


@if(request()->has('search'))

<div class="container mt-5">
    <div class="text-right mb-2 mt-2">
        <a href="{{route('report.export2', ['type'=>'pdf', 'filter'=>request()->all()])}}" class="btn btn-danger"> Export as PDF</a>
        <a href="{{route('report.export2', ['type'=>'print', 'filter'=>request()->all()])}}" class="btn btn-primary"> Print</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">

                <h4 class="text-center">Room Wise Routine – Fall 2024</h4>
                <div class="text-center mb-3">
                    <strong>City University</strong><br>

                    Fall-2024<br>

                </div>
                <strong> Room Number- {{$routines[0]->room->room_no}}<sup>th</sup> </strong><br>

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
    </div>
</div>
</div>
@endif
@endsection
