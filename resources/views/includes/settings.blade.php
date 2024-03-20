@extends('layouts.app')
@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                {{-- Card --}}
                <div class="card bg-dark text-light">
                    {{-- Card tittle --}}
                    <div class="card-header">
                        <h3 class="card-title">Profile Details</h3>
                    </div>
                    {{-- Card body --}}
                    <div class="card-body">
                        {{-- Top row for names --}}
                        <div class="row">
                            {{-- Fullname area --}}
                            <div class="col-6">
                                <p class="card-text"><strong>Full name:</strong> {{ $user->fullname }}</p>
                                <button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal"data-bs-target="#changeFullnameModal">Change Fullname</button>
                                <!-- Fullname Modal -->
                                <div class="modal fade" id="changeFullnameModal"
                                    tabindex="-1"aria-labelledby="changeFullnameModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changeFullnameModalLabel">Change Fullname</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action=" {{ route('changeFullName') }} " method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="newFullname" class="form-label">New Fullname</label>
                                                        <input type="text" class="form-control"id="newFullname"
                                                            name="newFullname" required>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Username area --}}
                            <div class="col-6">
                                <p class="card-text"><strong>Name:</strong> {{ $user->username }}</p>
                                <button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal"data-bs-target="#changeUsernameModal">Change Username</button>
                                <!-- Username Modal -->
                                <div class="modal fade" id="changeUsernameModal"
                                    tabindex="-1"aria-labelledby="changeUsernameModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changeUsernameModalLabel">Change Username</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action=" {{ route('changeUserName') }} " method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="newUsername" class="form-label">New Username</label>
                                                        <input type="text" class="form-control"id="newUsername"
                                                            name="newUsername" required>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- 2nd row for Email and notification --}}
                        <div class="row">
                            {{-- Email area --}}
                            <div class="col-6">
                                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#changeEmailModal">Change Email</button>
                                <!-- Email Modal -->
                                <div class="modal fade" id="changeEmailModal" tabindex="-1"
                                    aria-labelledby="changeEmailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changeEmailModalLabel">Change Email</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action=" {{ route('changeEmail') }} " method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="newEmail" class="form-label">New Email</label>
                                                        <input type="email" class="form-control" id="newEmail"
                                                            name="newEmail" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Phone area --}}
                            <div class="col-6">
                                
                                @if($user->phone)
                                    <p class="card-text"><strong>Phone number: </strong> {{ $user->phone }}</p>
                                @else
                                    <p class="card-text"><strong>Phone number: </strong>Not set</p>
                                @endif

                                <button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal"data-bs-target="#changePhoneNumberModal">Change phone number</button>
                                <!-- Phone Modal -->
                                <div class="modal fade" id="changePhoneNumberModal"
                                    tabindex="-1"aria-labelledby="changePhoneNumberModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changePhoneNumberModalLabel">Change phone number</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action=" {{ route('changePhone') }} " method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="newPhone" class="form-label">New phone number</label>
                                                        <input type="text" class="form-control"id="newPhone"
                                                            name="newPhone" required>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- 3rd row --}}
                        <div class="row">
                            {{-- Currency area --}}
                            <div class="col-6">
                                <p class="card-text"><strong>Current currency type: {{ $user->currency->name }}</strong>
                                </p>
                                <form action="{{ route('changeCurrency') }}" method="POST">
                                    @csrf
                                    <select name="newCurrency" id="currency">
                                        <option value="" disabled selected hidden></option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }} -
                                                {{ $currency->symbol }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Change currency</button>
                                </form>
                            </div>
                            {{-- CSV --}}
                            <div class="col-6">
                                <p class="card-text"><strong>Download spendings in csv: </strong></p>
                                <button id="downloadButton" type="submit" class="btn btn-primary">Download</button>
                                {{-- https://www.npmjs.com/package/json-to-csv-export --}}
                            </div>
                        </div>
                        {{-- 4th row --}}
                        <div class="row">
                            {{-- Notification --}}
                            <div class="col-6">
                                <p class="card-text"><strong>Notification: </strong></p>
                                <form action="{{ route('enableNotification') }}" method="POST">
                                    @csrf
                                    <input type="checkbox" id="notification" name="notification">
                                    <label for="notification"> I want to get notified to log my spendings</label><br>
                                    <button id="enableNotificationBtn" type="submit" class="btn btn-primary">Enable
                                        notification</button>
                                    <input type="hidden" id="timezone" name="timezone">
                                </form>
                            </div>
                            {{-- Change theme --}}
                            <div class="col-6">
                                <h3>Change theme</h3>
                            </div>
                        </div>
                        {{-- 5th row --}}
                        <div class="row">
                            {{-- Change langage area --}}
                            <div class="col-6">
                                <p>Change language</p>
                            </div>
                            {{-- Add family member(s) --}}
                            <div class="col-6">
                                <form action="{{route('addFamilyMember')}}" method="POST">
                                    @csrf
                                    <p><strong>Add family member: </strong></p>
                                    <input type="search" name="familymember" id="familymember" required>
                                    <button type="submit" class="btn btn-primary">Add family member</button>
                                </form>
                            </div>
                        </div>
                        {{-- 6th row --}}
                        <div class="row">
                            {{-- Family system --}}
                            <div class="col-6">
                                <p>Family system</p>
                            </div>
                            {{-- Deactivate account --}}
                            <div class="col-6">
                                <p>Deactivate account</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <script>
        /* Change background image */
        document.body.style.backgroundImage = "url('../storage/pictures/settings.jpg')";
        var financesData = @json($finances);
        document.getElementById('downloadButton').addEventListener('click', function() {

            const dataToConvert = {
                data: financesData,
                filename: 'Spendings',
                delimiter: ',',
                headers: ['Name', 'Price', 'Time']
            };
            csvDownload(dataToConvert);
        });
        //notification handler
        document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.getElementById('notification');
            document.getElementById('enableNotificationBtn').addEventListener('click', function(event) {
                var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                document.getElementById('timezone').value = userTimezone;
            });
        });
    </script>
@endsection
