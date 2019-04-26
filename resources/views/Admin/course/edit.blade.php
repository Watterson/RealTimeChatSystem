@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Add Course</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('admin/courses/edit') }}">
                        @csrf
                        <input id="courseId" name="courseId" type="hidden" value="{{$course->id}}">
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $course->title }}" required autocomplete="title" autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"  required autocomplete="description" autofocus>{{ $course->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="university" class="col-md-4 col-form-label text-md-right">{{ __('University') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="university" name="university">
                                  <option value="">--Select Course Leader--</option>
                                  @foreach($unis as $uni)
                                  <option value="{{$uni->id}}">{{$uni->name}}</option>
                                  @endforeach
                              </select>
                                @if ($errors->has('university'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('university') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leader" class="col-md-4 col-form-label text-md-right">{{ __('Leader') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="leader" name="leader">
                                  <option value="">--Select Course Leader--</option>
                                  @foreach($leaders as $leader)
                                  <option value="{{$leader->id}}">{{$leader->first_name}} {{$leader->last_name}}</option>
                                  @endforeach
                              </select>
                                @if ($errors->has('leader'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('leader') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                  Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
