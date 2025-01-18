@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">View Routine</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url()->current() }}" enctype="multipart/form-data">
                        <div class="form-group row mb-3">
                            <div class="col-sm-6">
                                <label for="department_id" class="col-form-label">Department<span class="text-danger">*</span></label>
                                <select name="department_id" id="teachers_department_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Department</option>
                                    @foreach($department as $key=>$item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="teacher_id" class="col-form-label"> Teacher Name<span class="text-danger">*</span></label>
                                <select name="teacher_id" id="teacher_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Batch</option>
                                    <!-- @foreach($teacher as $item)
                                    <option value="{{$item->id}}">{{ $item->teacher_name}}</option>
                                    @endforeach -->
                                </select>
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

<div class="container">
    <div class="text-right mb-2 mt-2">
        <a href="{{route('report.export3', ['type'=>'pdf', 'filter'=>request()->all()])}}" class="btn btn-danger"> Export as PDF</a>
        <a href="{{route('report.export3', ['type'=>'print', 'filter'=>request()->all()])}}" class="btn btn-primary"> Print</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="container my-4">
                    <h4 class="text-center"> Teacher Wise Routine – Fall 2024</h4>
                    <div class="text-center mb-3">
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
        </div>
    </div>
</div>
@endif
@endsection
