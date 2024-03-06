@extends('layouts.app')
@section('content')
  
{{--TODO: set these into a card + frontend, and possibly make a change option next to them --}}
{{-- show currency, list out all categories --}}

<div class="row justify-content-center">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Profile Details</h3>
                <div><p class="card-text"><strong>Name:</strong> {{ $user->username }}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeUsernameModal">Change Username</button>
                    <!-- Username Modal -->
                    <div class="modal fade" id="changeUsernameModal" tabindex="-1" aria-labelledby="changeUsernameModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeUsernameModalLabel">Change Username</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action=" {{ route('changeUserName') }} " method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="newUsername" class="form-label">New Username</label>
                                            <input type="text" class="form-control" id="newUsername" name="newUsername" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div><p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeEmailModal">Change Email</button>
                   <!-- Email Modal -->
                    <div class="modal fade" id="changeEmailModal" tabindex="-1" aria-labelledby="changeEmailModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeEmailModalLabel">Change Email</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{-- {{ route('change.email') }} --}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="newEmail" class="form-label">New Email</label>
                                            <input type="email" class="form-control" id="newEmail" name="newEmail" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
