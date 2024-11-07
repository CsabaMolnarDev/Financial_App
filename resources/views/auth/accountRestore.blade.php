@extends('layouts.app')
@section('')
    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    <div class="">{{ __('Reactivate Account') }}</div>
                    <div class="">
                        <form action="{{ route('reactivateAccount') }}" method="POST">
                            @csrf
                            <div class="">
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
                                class="">{{ __('Reactivate Account') }}</button>
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
                },//gotta fix this bcs of the removal of bs5!!!
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
