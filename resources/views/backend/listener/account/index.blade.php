@extends('backend.layouts.app')

@push('css')

@endpush

@section('content')
<div class="container-fluid">
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        CONFIRM
                        <small>YOUR EMAIL TO BECOME SINGER ACCOUNT</small>
                    </h2>
                </div>
                <div class="body">
                    <h2 class="card-inside-title">Your E-mail</h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group form-group-lg">
                                <form action="{{ route('listener.account.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="form-line">
                                        <input id="email" type="email" name="email" class="form-control" placeholder="Please enter your email" />
                                    </div>
                                    <br>
                                    <button type="submit" class="btn bg-indigo waves-effect">
                                        <i class="material-icons">trending_up</i>
                                        <span>UPGRADE YOUR ACCOUNT</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->
   
</div>
@endsection

@push('js')
@endpush