@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="p-3 text-center">
                        <img src="https://lh4.googleusercontent.com/BxVctcd89WmpbbFbO8jZytEkCwNoMJReUalVcw-fR62wuup7xdJKOhIC2LrpVt3RSmGN5e7tc_Z-Xy8dGqn6Ujo=w16383" width="80" />
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                        @csrf
                    
                        <div class="form-group row">
                            
                            <div class="col-md-12">
                                <label for="username" class="col-form-label text-md-right">{{ __('E-Mail atau Username') }}</label>
                                <input id="text" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-12">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row p-3">
                            <button class="btn btn-primary col-12" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
