@extends('layout')
@section('content')
<div class="container mt-5 p-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Edit Routine</h3>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('routine.update', $routine->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3">
                            <div class="col-sm-6">
                                <label for="faculty_id" class="col-form-label">Faculty <span class="text-danger">*</span></label>
                                <select name="faculty_id" id="faculty_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Faculty</option>
                                    @foreach($faculty as $key=>$item)

                                    <option value="{{$key}}" {{ $routine->faculty_id == $key ? 'selected': '' }}>{{$item}}</option>

                                    @endforeach
                                </select>
                                @error('faculty_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>


                            <div class="col-sm-6">
                                <label for="department_id" class="col-form-label">Department<span class="text-danger">*</span></label>
                                <select name="department_id" id="department_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Department</option>
                                    @foreach($department as $key=>$item)
                                    <option value="{{$key}}" {{$routine->department_id == $key ? 'selected':''}}>{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>


                            <div class="col-sm-6">
                                <label for="program_id" class="col-form-label">Program<span class="text-danger">*</span></label>
                                <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Program</option>
                                    @foreach($program as $key=>$item)
                                    <option value="{{$key}}" {{$routine->program_id == $key ? 'selected':''}}> {{$item}}</option>
                                    @endforeach
                                </select>
                                @error('program_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>



                            <div class="col-sm-6">
                                <label for="section_id" class="col-form-label">Section<span class="text-danger">*</span></label>
                                <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Section</option>
                                    @foreach($section as $item)
                                    <option value="{{$item->id}}" {{$routine->section_id == $item->id ?'selected':''}}> {{$item->batch_number}} - {{$item->section}}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="semester_id" class="col-form-label">Semester<span class="text-danger">*</span></label>
                                <select name="semester_id" id="semester_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Room</option>
                                    @foreach($semester as $key=>$item)
                                    <option value="{{$key}}" {{$routine->semester_id == $key ? 'selected':''}}> {{$item}}</option>
                                    @endforeach
                                </select>

                                @error('semester_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>












                        @foreach($routine->routineDetails as $key=>$detail)
                        <div class="new_course row">
                            <div class="col-sm-2">
                                <label for="course_id" class="col-form-label">Course <span class="text-danger">*</span></label>
                                <select name="course_id[]" id="course_id_1" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Course</option>
                                    @foreach($course as $key=>$item)
                                    <option value="{{$key}}" {{ $detail->course_id == $key ?'selected':''}}>{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-2">
                                <label for="course_id" class="col-form-label">Courese Title <span class="text-danger">*</span></label>
                                <input type="text" id="course_title_1" class="form-control square-input" disabled style="width: 100%;" value="{{$detail->course->course_title}}">
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-1">
                                <label for="course_id" class="col-form-label">Credit<span class="text-danger">*</span></label>
                                <input type="text" id="course_credit_1" class="form-control square-input" disabled style="width: 100%;" value="{{$detail->course->course_credit}}">
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-2">
                                <label for="teacher_id" class="col-form-label">Teacher <span class="text-danger">*</span></label>
                                <select name="teacher_id[]" id="teacher_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Teacher</option>
                                    @foreach($teacher as $key => $item)
                                    <option value="{{ $key }}" {{ isset($detail->teacher_id) && $detail->teacher_id == $key ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>




                            <div class="col-sm-1">
                                <label for="time" class="col-form-label">Time <span class="text-danger">*</span></label>
                                <select name="time[]" id="time" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Time</option>
                                    <option value="9.00AM-10.25AM" {{ $detail->time == '9.00AM-10.25AM' ? 'selected':''}}>9.00AM-10.25AM</option>
                                    <option value="10.30AM-11.50AM" {{ $detail->time == '10.30AM-11.50AM' ? 'selected':''}}>10.30AM-11.50AM</option>
                                    <option value="12.00PM-1.10PM" {{ $detail->time == '12.00PM-1.10PM' ? 'selected':''}}>12.00PM-1.10PM</option>
                                    <option value="1.30PM-2.50PM" {{ $detail->time == '1.30PM-2.50PM' ? 'selected':''}}>1.30PM-2.50PM</option>
                                    <option value="3.00PM-4.20PM" {{ $detail->time == '3.00PM-4.20PM' ? 'selected':''}}>3.00PM-4.20PM</option>
                                </select>

                            </div>



                            <div class="col-sm-1">
                                <label for="day_one" class="col-form-label" style="font-size:15px;">Day One<span class="text-danger">*</span></label>
                                <select name="day_one[]" class="form-control select2">
                                    <option value="">Select Day</option>
                                    <option value="Friday" {{ $detail->day_one == 'Friday' ? 'selected':''}}>Friday</option>
                                    <option value="Saturday"  {{ $detail->day_one == 'Saturday' ? 'selected':''}}>Saturday</option>
                                    <option value="Sunday"  {{ $detail->day_one == 'Sunday' ? 'selected':''}}>Sunday</option>
                                    <option value="Monday"  {{ $detail->day_one == 'Monday' ? 'selected':''}}>Monday</option>
                                    <option value="Tuesday"  {{ $detail->day_one == 'Tuesday' ? 'selected':''}}>Tuesday</option>
                                </select>
                            </div>

                            <div class="col-sm-1">
                                <label for="day_two" class="col-form-label">Day Two</label>
                                <select name="day_two[]" class="form-control select2">
                                    <option value="">Select Day</option>
                                    <option value="Friday" {{ $detail->day_two == 'Friday' ? 'selected':''}}>Friday</option>
                                    <option value="Saturday"  {{ $detail->day_two == 'Saturday' ? 'selected':''}}>Saturday</option>
                                    <option value="Sunday"  {{ $detail->day_two == 'Sunday' ? 'selected':''}}>Sunday</option>
                                    <option value="Monday"  {{ $detail->day_two == 'Monday' ? 'selected':''}}>Monday</option>
                                    <option value="Tuesday"  {{ $detail->day_two == 'Tuesday' ? 'selected':''}}>Tuesday</option>
                                </select>
                            </div>


                            <div class="col-sm-1">
                                <label for="room_id" class="col-form-label">Room</label>
                                <select name="room_id[]" id="room_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Room</option>
                                    @foreach($room as $key=>$item)
                                    <option value="{{$key}}" {{ $detail->room_id == $key ? 'selected' : '' }}>{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            @if($loop->index==0)
                            <div class="col-sm-1">
                                <a class="extra-fields-course btn btn-sm btn-info" style="margin-top: 43px;" href="javascript:void(0)"><i class="fa-solid fa-plus"></i></a>

                            </div>
                            @else
                            <div class="col-sm-1">
                                <a href="#" class="remove-field btn btn-sm btn-danger" style="margin-top: 40px;">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                            @endif

                        </div>
                        @endforeach
                        <div class="course_records_dynamic"></div>






                        <div class="form-group row mt-3">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="submit" id="submit" class="btn btn-success text-uppercase">
                                        <i class="fas fa-save"></i> Update
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

@push('script')
<script>
    $(document).ready(function() {
        var row = 1;

        $('.extra-fields-course').click(function(e) {
            e.preventDefault();
            row++;
            var newFields = `              
               
                        <div class="new_course row">
                            <div class="col-sm-2">
                                <label for="course_id" class="col-form-label">Course <span class="text-danger">*</span></label>
                                <select name="course_id[]" id="course_id_${row}" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Course</option>
                                    @foreach($course as $key=>$item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                        
                            <div class="col-sm-2">
                                <label for="course_id" class="col-form-label">Courese Title <span class="text-danger">*</span></label>
                                <input type="text"  id="course_title_${row}" class="form-control square-input" disabled style="width: 100%;">
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-1">
                                <label for="course_id" class="col-form-label">Cradit<span class="text-danger">*</span></label>
                                <input type="text"  id="course_credit_${row}" class="form-control square-input" disabled style="width: 100%;">
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                           <div class="col-sm-2">
                                <label for="teacher_id" class="col-form-label">Teacher <span class="text-danger">*</span></label>
                                <select name="teacher_id[]" id="teacher_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Teacher</option>
                                    @foreach($teacher as $key=>$item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>



                            <div class="col-sm-1">
                                <label for="time" class="col-form-label">Time <span class="text-danger">*</span></label>
                                <select name="time[]" class="form-control select2">
                                    <option value="">Select Time</option>
                                    <option value="9.00AM-10.25AM">9.00AM-10.25AM</option>
                                    <option value="10.30AM-11.50AM">10.30AM-11.50AM</option>
                                    <option value="12.00PM-1.10PM">12.00PM-1.10PM</option>
                                    <option value="1.30PM-2.50PM">1.30PM-2.50PM</option>
                                    <option value="3.00PM-4.20PM">3.00PM-4.20PM</option>
                                </select>
                            </div>



                            <div class="col-sm-1">
                                <label for="day_noe" class="col-form-label" style="font-size:15px;">Day One<span class="text-danger">*</span></label>
                                <select name="day_one[]" class="form-control select2">
                                    <option value="">Select Day</option>
                                 <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                </select>
                            </div>

                            <div class="col-sm-1">
                                <label for="day_two" class="col-form-label">Day Two</label>
                                <select name="day_two[]" class="form-control select2">
                                    <option value="">Select Day</option>
                               <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                </select>
                            </div>


                           <div class="col-sm-1">
                                <label for="room_id" class="col-form-label">Room</label>
                                <select name="room_id[]" id="room_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Room</option>
                                    @foreach($room as $key=>$item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>



                    <div class="col-sm-1">
                        <a href="#" class="remove-field btn btn-sm btn-danger" style="margin-top: 40px;">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>
            `;
            $('.select2').select2({
                placeholder: 'Select',
                theme: 'bootstrap-5',
                width: '100%'
            });

            $('.course_records_dynamic').append(newFields);
        });

        $(document).on('click', '.remove-field', function(e) {
            e.preventDefault();
            $(this).closest('.new_course').remove();
        });
        $(document).on('change', '[id^=course_id_]', function() {
            var row_id = $(this).attr('id').split('_')[2];
            var course_id = $(this).val();

            $.ajax({
                url: "{{route('getCourse')}}",
                dataType: 'json',
                type: 'GET',
                data: {
                    course_id: course_id
                },
                success: function(data) {
                    $("#course_title_" + row_id).val(data.course_title);
                    $("#course_credit_" + row_id).val(data.course_credit);
                }
            });
        });

    });
</script>

@endpush

@endsection