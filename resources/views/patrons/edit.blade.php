@extends('layouts.app', ['title' => __('User Profile')])
@section('content')
    @include('users.partials.header', [
        'title' => $patron->full_name,
        'description' => __('Edit basic info, renew the subscription or lend books to this patron.'),
        'class' => 'col-lg-9'
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
                            <a href="{{route('book-patron.destroy-all', $patron->id)}}" class="btn btn-sm btn-info mr-4">{{ __('Return all books') }}</a>
                            <a href="{{route('patrons.pay', $patron)}}" class="btn btn-sm btn-default float-right">{{ __('Pay year\'s fee') }}</a>
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
                                        <span class="heading">@if($patron->books) {{ count($patron->books) }} @else 0 @endif </span>
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
                                @if($patron->books)
                                @foreach($patron->books as $book)
                                <div class="font-weight-light row">
                                    <br>
                                    <span class="float-left col-6 text-left">
                                        {{ $book->author }} - {{$book->title}}
                                    </span>
                                    <br>
                                    <a href="{{route('book-patron.destroy', $book->book_patron_id)}}" class="btn btn-sm float-right col-6">{{ __('Return the book') }}</a>
                                </div>
                                
                                @endforeach
                                @else
                                <span class="text-muted text-center text-sm">Patron does not hold any books</span>
                                @endif
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
                        <form method="post" action="{{ route('book-patron.store') }}" autocomplete="off">
                            @csrf
                            @method('put')
                            
                            @if (session('status'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group">
                                <input type="hidden" name="patron_id" value="{{$patron->id}}">
                                    <label class="form-control-label" for="input-name">{{ __('Chosen book') }}</label>
                                        <select class="form-control selectpicker" name="book_id">
                                            @foreach($allBooks as $book)
                                            <option value="{{$book->id}}">{{$book->author}} - {{$book->title}}</option>
                                            @endforeach
                                        </select>
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
                        <form method="post" action="{{ route('patrons.update', $patron) }}" autocomplete="off">
                            @csrf
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
                                        <input name="date_of_birth" class="form-control datepicker" placeholder="Select date"
                                        type="text" value="{{date('m/d/Y', strtotime($patron->date_of_birth))}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                <label class="form-control-label">{{ __('Expected renewal date') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input name="expected_renew_date" class="form-control datepicker" placeholder="Select date"
                                        type="text" value="{{date('m/d/Y', strtotime($patron->expected_renew_date))}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">{{ __('Subscription type') }}</label>
                                    <select class="form-control selectpicker" name="subscription_type_id">
                                        @foreach($subTypes as $type)
                                        <option value="{{$type->id}}"
                                            @if($type->id == $patron->subscription_type_id)
                                            selected @endif>{{$type->name}}  - {{ $type->price }} RSD</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                <div class="text-left col-6">
                                    <a href="{{ route('patrons.show') }}" type="button" class="btn btn-success mt-4">
                                    
                                    {{ __('Go back') }}
                                    </a>
                                </div>
                                <div class="text-right col-6">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save changes') }}</button>
                                </div>
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
