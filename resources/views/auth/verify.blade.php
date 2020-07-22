@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('اعتبار سنجی ایمیل شما') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('لینک اعتبار سنجی به ایمیل شما ارسال شد') }}
                        </div>
                    @endif

                    {{ __('ایمیل خود را بررسی کنید') }}
                    {{ __('ایمیل دریافت نکرده اید') }}, <a href="{{ route('verification.resend') }}">{{ __('ارسال دوباره') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
