@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-light">
                    <div class="card-header">{{ __('Reactivate Account') }}</div>
                    <div class="card-body">
                        <form action="{{ route('reactivateAccount') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input oninput="checkIfUserDisabled(this.value);" id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                <div id="responseTextEmail"></div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button id="reactivateBTN" type="submit"
                                class="btn btn-success">{{ __('Reactivate Account') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkIfUserDisabled(input) {
            $.ajax({
                type: 'POST',
                url: '{{ route('checkIfUserDisabled') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'email': input
                },
                success: function(data) {
                    if (data.status === "failed") {
                        $('#responseTextEmail').removeClass('text-success').addClass('text-danger').html(data
                            .message);
                        $('#reactivateBTN').prop('disabled', true);
                    } else if (data.status === "success") {
                        $('#responseTextEmail').removeClass('text-danger').html('');
                        $('#reactivateBTN').prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " " + error);
                    $('#responseTextEmail').html('An error occurred. Please try again later.').addClass(
                        'text-danger');
                }
            });
        }
    </script>
@endsection
