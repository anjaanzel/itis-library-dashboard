@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => $patron->full_name,
        'description' => __('Edit basic info, renew the subscription or lend books to this petron.'),
        'class' => 'col-lg-7'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Return all books') }}</a>
                            <a href="#" class="btn btn-sm btn-default float-right">{{ __('Pay year\'s fee') }}</a>
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">{{ $patron->expected_renew_date }}</span>
                                        <span class="description">{{ __('Subscribed until') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ count($patron->books) }}</span>
                                        <span class="description">{{ __('Books lent') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $patron->subscriptionType->name }}</span>
                                        <span class="description">{{ __('Subscription type') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ $patron->full_name }},<span class="font-weight-light">
                                    {{ date_diff(date_create($patron->date_of_birth), date_create('today'))->y }}
                                </span>
                            </h3>
                            <hr class="my-4" />
                            <p>
                            <h3>
                                Books currently lent
                                <br>
                                @foreach($patron->books as $book)
                                <div class="font-weight-light row">
                                    <br>
                                    <span class="float-left col-6 text-left">
                                        {{ $book->author }} - {{$book->title}}
                                    </span>
                                    <br>
                                    <a href="#" class="btn btn-sm float-right col-6">{{ __('Return the book') }}</a>
                                </div>
                                
                                @endforeach
                            </h3>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0 ml-3">{{ __('Lend a book') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('patron.lend') }}" autocomplete="off">
                            @csrf
                            @method('put')
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Chosen book') }}</label>
                                        <select class="form-control selectpicker" name="book" id="book">
                                            @foreach($allBooks as $book)
                                            <option value="{{$book->id}}">{{$book->author}} - {{$book->title}}</option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('book'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('book') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('book_code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Book code') }}</label>
                                    <input type="text" name="book_code" class="form-control form-control-alternative{{ $errors->has('book_code') ? ' is-invalid' : '' }}" placeholder="{{ __('Book code') }}" required>

                                    @if ($errors->has('book_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('book_code') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Lend the book') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">{{ __('Basic information') }}</h3>
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="full_name">
                                        {{ __('Full name') }}
                                    </label>
                                    <input type="text" name="full_name" class="form-control"
                                    placeholder="Full name" value="{{$patron->full_name}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Phone number') }}</label>
                                    <input type="text" name="phone_number" class="form-control"
                                    placeholder="Phone number" value="{{$patron->phone_number}}" required>
                                
                                </div>

                                <div class="form-group">
                                <label class="form-control-label">{{ __('Date of birth') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control datepicker" placeholder="Select date"
                                        type="text" value="{{date('m/d/Y', strtotime($patron->date_of_birth))}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                <label class="form-control-label">{{ __('Expected renewal date') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control datepicker" placeholder="Select date"
                                        type="text" value="{{date('m/d/Y', strtotime($patron->expected_renew_date))}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Subscription type') }}</label>
                                    <select class="form-control selectpicker" name="subscription_type_id">
                                        @foreach($subTypes as $type)
                                        <option value="{{$type->id}}"
                                            @if($type->id == $patron->subscription_type_id)
                                            selected @endif>{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save changes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
        <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    </div>
@endsection
