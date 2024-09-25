@extends('layout')
@section('content')
<div class="container mt-5 p-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Add Routine</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('routine.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-3">
                            <div class="col-sm-6">
                                <label for="faculty_id" class="col-form-label">Faculty <span class="text-danger">*</span></label>
                                <select name="faculty_id" id="faculty_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Faculty</option>
                                    @foreach($faculty as $key=>$item)
                                    <option value="{{$key}}">{{$item}}</option>
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

                                </select>
                                @error('semester_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>













                        <div class="new_course row">
                            <div class="col-sm-2">
                                <label for="course_id" class="col-form-label">Course <span class="text-danger">*</span></label>
                                <select name="course_id" id="course_id" class="form-control select2" style="width: 100%;">
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
                                <input type="text" name="course_id" id="course_id" class="form-control square-input" disabled style="width: 100%;">
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-1">
                                <label for="course_id" class="col-form-label">Credit<span class="text-danger">*</span></label>
                                <input type="text" name="course_id" id="course_id" class="form-control square-input" disabled style="width: 100%;">
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-2">
                                <label for="teacher_id" class="col-form-label">Teacher <span class="text-danger">*</span></label>
                                <select name="teacher_id" id="teacher_id" class="form-control select2" style="width: 100%;">
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
                                <select name="course_type[]" class="form-control select2">
                                    <option value="">Select Time</option>
                                    <option value="time">9.00AM-10.25AM</option>
                                    <option value="time">10.30AM-11.50AM</option>
                                    <option value="time">12.00PM-1.10PM</option>
                                    <option value="time">1.30PM-2.50PM</option>
                                    <option value="time">3.00PM-4.20PM</option>
                                </select>
                            </div>



                            <div class="col-sm-1">
                                <label for="day" class="col-form-label" style="font-size:15px;">Day One<span class="text-danger">*</span></label>
                                <select name="course_type[]" class="form-control select2">
                                    <option value="">Select Day</option>
                                    <option value="day">Friday</option>
                                    <option value="day">Saturday</option>
                                    <option value="day">Sunday</option>
                                    <option value="day">Monday</option>
                                    <option value="day">Tuesday</option>
                                </select>
                            </div>

                            <div class="col-sm-1">
                                <label for="day" class="col-form-label">Day Two</label>
                                <select name="course_type[]" class="form-control select2">
                                    <option value="">Select Day</option>
                                    <option value="day">Friday</option>
                                    <option value="day">Saturday</option>
                                    <option value="day">Sunday</option>
                                    <option value="day">Monday</option>
                                    <option value="day">Tuesday</option>
                                </select>
                            </div>


                            <div class="col-sm-1">
                                <label for="room_id" class="col-form-label">Room</label>
                                <select name="room_id" id="room_id" class="form-control select2" style="width: 100%;">
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
                                <a class="extra-fields-course btn btn-sm btn-info" style="margin-top: 43px;" href="javascript:void(0)"><i class="fa-solid fa-plus"></i></a>

                            </div>
                        </div>

                        <div class="course_records_dynamic"></div>






                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="submit" id="submit" class="btn btn-success text-uppercase">
                                        <i class="fas fa-save"></i> Save
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
        $('.extra-fields-course').click(function(e) {
            e.preventDefault();
            var newFields = `              
               
                        <div class="new_course row">
                            <div class="col-sm-2">
                                <label for="course_id" class="col-form-label">Course <span class="text-danger">*</span></label>
                                <select name="course_id" id="course_id" class="form-control select2" style="width: 100%;">
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
                                <input type="text" name="course_id" id="course_id" class="form-control square-input" disabled style="width: 100%;">
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-1">
                                <label for="course_id" class="col-form-label">Cradit<span class="text-danger">*</span></label>
                                <input type="text" name="course_id" id="course_id" class="form-control square-input" disabled style="width: 100%;">
                                @error('course_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                           <div class="col-sm-2">
                                <label for="teacher_id" class="col-form-label">Teacher <span class="text-danger">*</span></label>
                                <select name="teacher_id" id="teacher_id" class="form-control select2" style="width: 100%;">
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
                                <select name="course_type[]" class="form-control select2">
                                    <option value="">Select Time</option>
                                    <option value="time">9.00AM-10.25AM</option>
                                    <option value="time">10.30AM-11.50AM</option>
                                    <option value="time">12.00PM-1.10PM</option>
                                    <option value="time">1.30PM-2.50PM</option>
                                    <option value="time">3.00PM-4.20PM</option>
                                </select>
                            </div>



                            <div class="col-sm-1">
                                <label for="day" class="col-form-label" style="font-size:15px;">Day One<span class="text-danger">*</span></label>
                                <select name="course_type[]" class="form-control select2">
                                    <option value="">Select Day</option>
                                    <option value="day">Friday</option>
                                    <option value="day">Saturday</option>
                                    <option value="day">Sunday</option>
                                    <option value="day">Monday</option>
                                    <option value="day">Tuesday</option>
                                </select>
                            </div>

                            <div class="col-sm-1">
                                <label for="day" class="col-form-label">Day Two</label>
                                <select name="course_type[]" class="form-control select2">
                                    <option value="">Select Day</option>
                                    <option value="day">Friday</option>
                                    <option value="day">Saturday</option>
                                    <option value="day">Sunday</option>
                                    <option value="day">Monday</option>
                                    <option value="day">Tuesday</option>
                                </select>
                            </div>


                           <div class="col-sm-1">
                                <label for="room_id" class="col-form-label">Room</label>
                                <select name="room_id" id="room_id" class="form-control select2" style="width: 100%;">
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
            $('.course_records_dynamic').append(newFields);
        });

        $(document).on('click', '.remove-field', function(e) {
            e.preventDefault();
            $(this).closest('.new_course').remove();
        });
    });
</script>

@endpush

@endsection