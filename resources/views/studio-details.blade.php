@extends('layouts.app')
@section('head')
    @parent
    <style type="text/css">
        ol.breadcrumbs, ol.breadcrumbs > li {
            margin-bottom: 0;
        }
        label {
            font-size: 1em;
        }
        .pricing__head.boxed {
            padding: 1em;
        }
        @media (min-width: 768px) {
            .picker__weekday { padding: 0.6em; }
        }
        @media (min-width: 992px) {
            .picker__weekday { padding: 0.9em; }
        }
        @media (max-width: 990px) {
            #product_hr {
                margin-top: 0;
                margin-bottom: 0.5em;
            }
        }
        #contact-owner {
            font-size: 1em;
            margin-top: 0.5em;
            margin-bottom: 5em;
        }
        #register-modal .modal-content {
            max-width: 600px;
        }
    </style>
@endsection
@section('scripts')
    @parent
    {{-- SWEETALERT2 --}}
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js" type="text/javascript"></script>
    <script src="{{ asset('js/product-details.js') }}"></script>
@endsection
@section('content')
    <div class="main-container">
        <section class="bg--secondary" style="padding-bottom: 3em; padding-top: 3em;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="margin-bottom: 0.2em;">{{ ucwords($studio->name) }}</h1>
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </section>
        <section style="padding-top: 2em;">
            <form action="{{route('studios.book')}}" method="POST">
                {{ csrf_field() }}
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-md-6 col-lg-6">
                        <div class="slider border--round boxed--border" data-paging="true" data-arrows="true"
                             data-autoplay="false">
                            <ul class="slides">
                                <li>
                                    <img alt="Image"
                                         src="{{ asset('img/uploads/' . $studio->image) }}"/>
                                </li>
                            </ul>
                        </div>
                        <!--end slider-->
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <h2>{{ ucwords($studio->name) }}</h2>
                        <p>
                            @foreach(explode('<br>', $studio->description) as $line)
                                {{ $line }}
                                <br />
                            @endforeach
                        </p>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="pricing pricing-3">
                                    <div class="pricing__head bg--secondary">
                                            <span class="h3">Cost: <span class="h4">{{$studio->cost}} Rs</span></span>
                                    </div>
                                </div>
                                <!--end pricing-->
                            </div>
                            <br><br>
                            <div class="col-md-12">
                                <div class="pricing__head bg--secondary">
                                    <h3>Availability: <span class="h5">{{$studio->available_from}}</span> - <span class="h5">{{$studio->available_to}}</span></h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if($errors->any())
                                    <p style="font-size: 1.2em; margin-top: 10px;" class="alert-warning">{{$errors->first()}}</p>
                                @endif
                                @if(session()->has('success'))
                                        <p style="font-size: 1.2em; margin-top: 10px;" class="alert-success">{{session('success')}}</p>
                                    @endif
                            </div>
                            <input type="hidden" id="studio-id" value="{{ $studio->id }}" name="studio-id">
                            <div class="col-md-12">
                                <label style="font-size: 1.2em; margin-top: 10px;" class="col-md-6" for="start-time">Start Time</label>
                                <input type="time" min="{{$studio->available_from}}" max="{{$studio->available_to}}" step="3600" class="col-md-6" name="start-time" id="start-time">
                            </div>
                            <div class="col-md-12">
                                <label style="font-size: 1.2em; margin-top: 10px;" class="col-md-6" for="end-time">End Time</label>
                                <input type="time" min="{{$studio->available_from}}" max="{{$studio->available_to}}" step="3600" name="end-time" class="col-md-6" id="end-time">
                            </div>
                            <div class="col-12">
                                <button type="submit" id="buy-button" class="btn btn-primary" style="padding: 15px 40px; height: unset; width: unset; margin-top: 2em;">
                                    <span style="font-size: 1.7em;">Book Now</span>
                                </button>
                            </div>
                        </div>
                        <!--end of row-->
                    </div>
                </div>
            </div>
            </form>
        </section>
    </div>
    <a id="scroll_to_end" href="#end" class="hidden"></a>
@endsection
