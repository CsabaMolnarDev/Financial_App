@extends('layouts.app')
@section('content')
    <div class="container text-center">
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
                        {{-- 1st row for names --}}
                        <div class="row" id="settingsRow">
                            {{-- Fullname area --}}
                            <div class="col-6">
                                <p class="card-text">Full name: <i>{{ $user->fullname }}</i></p>
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
                                <p class="card-text">Name: <i>{{ $user->username }}</i> </p>
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
                        <div class="row" id="settingsRow">
                            {{-- Email area --}}
                            <div class="col-6">
                                <p class="card-text">Email:<i>{{ $user->email }}</i> </p>
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

                                @if ($user->phone)
                                    <p class="card-text">Phone number: <i>{{ $user->phone }}</i></p>
                                @else
                                    <p class="card-text">Phone number: <i>Not set</i></p>
                                @endif

                                <button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal"data-bs-target="#changePhoneNumberModal">Change phone
                                    number</button>
                                <!-- Phone Modal -->
                                <div class="modal fade" id="changePhoneNumberModal"
                                    tabindex="-1"aria-labelledby="changePhoneNumberModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changePhoneNumberModalLabel">Change phone
                                                    number</h5>
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
                        <div class="row" id="settingsRow">
                            {{-- Currency area --}}
                            <div class="col-6">
                                <p class="card-text">Current currency type: </p>
                                <form action="{{ route('changeCurrency') }}" method="POST">
                                    @csrf
                                    <select name="newCurrency" id="currency">
                                        <option value="" disabled selected>{{ $user->currency->name }}</option>
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
                                <p class="card-text">Download spendings in csv:</p>
                                <button id="downloadButton" type="submit" class="btn btn-primary">Download</button>
                                {{-- https://www.npmjs.com/package/json-to-csv-export --}}
                            </div>
                        </div>
                        {{-- 4th row --}}
                        <div class="row" id="settingsRow">
                            {{-- Notification --}}
                            <div class="col-6">
                                <p class="card-text">Notification:</p>
                                <form action="{{ route('enableNotification') }}" method="POST">
                                    @csrf
                                    <input type="checkbox" id="notification" name="notification">
                                    <label for="notification"> I want to get notified</label><br>
                                    <button id="enableNotificationBtn" type="submit" class="btn btn-primary">Enable
                                        notification</button>
                                    <input type="hidden" id="timezone" name="timezone">
                                </form>
                            </div>
                            {{-- Change theme --}}
                            <div class="col-6">
                                <p>Change theme</p>
                            </div>
                        </div>
                        {{-- 5th row --}}
                        <div class="row" id="settingsRow">
                            {{-- Change langage area --}}
                            <div class="col-6">
                                <p>Change language</p>
                            </div>
                            {{-- Family system area --}}
                            {{-- Add family member(s) --}}
                            <div class="col-6">
                                {{-- We only show this if user doesn't have family --}}
                                @if (!$user->family_id)
                                    <form action="{{ route('createFamily') }}" method="POST">
                                        @csrf
                                        <p>Create family <button type="submit" id="createFamily">+</button></p>
                                    </form>
                                    {{-- If they have we show the delete option --}}
                                @else
                                    @if ($user->family->creator_id === $user->id)
                                        <form action="{{ route('deleteFamily') }}" method="POST">
                                            @csrf
                                            <p>Delete family <button type="submit" id="deleteFamily">-</button></p>
                                        </form>
                                        <form action="{{ route('addFamilyMember') }}" method="POST"
                                            id="addfamilymemberinput">
                                            @csrf
                                            <div>
                                                <input oninput="checkIfUserExists(this.value);" type="search"
                                                    name="familymember" id="familymember" required>
                                                <button type="submit" class="btn btn-primary">Add family member</button>
                                                <div id="responseText"></div>
                                            </div>
                                        </form>
                                        @foreach ($family as $member)
                                            @if ($member->id !== $user->id && $member->family_id !== null)
                                                <form action="{{ route('deleteFamilyMember', ['id' => $member->id]) }}"
                                                    method="GET">
                                                    @csrf
                                                    <p>{{ $member->fullname }}: <button type="submit"
                                                            id="deleteFamilyMember">-</button></p>
                                                </form>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>You are the member of the {{ $user->family?->name }} family.</p>
                                        <form action="{{ route('leaveFamily') }}" method="POST">
                                            @csrf
                                            <p><button type="submit" id="leaveFamily">Leave family</button></p>
                                        </form>
                                    @endif
                                @endif
                                {{-- We list out the family members --}}
                            </div>
                        </div>
                        {{-- 6th row --}}
                        <div class="row" id="settingsRow">
                            {{-- Empty --}}
                            <div class="col-6">
                                <p>Something...</p>
                            </div>
                            {{-- Deactivate account --}}
                            <div class="col-6">
                                <br>
                                <form action="" method="post">
                                    <button type="submit" class="btn btn-primary">Deactivate account</button>
                                </form>
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
        /* document.body.style.backgroundImage = "url('../storage/pictures/settings.jpg')";*/ //uncomment it
        var financesData = @json($finances);

        //csv downloader (under construction)
        //maybe use the apexcharts's csv download functionality
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


        function checkIfUserExists(input) {
            $.ajax({
                type: 'POST',
                url: '/checkIfUserExists',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'username': input
                },
                success: function(data) {
                    if (data.status === "failed") {
                        $('#responseText').removeClass('text-success').addClass('text-danger').html(data
                            .message);
                    } else if (data.status === "failed2") {
                        $('#responseText').removeClass('text-success').addClass('text-danger').html(data
                            .message);
                    } else {
                        // If the user exists, you may choose not to display any message
                        $('#responseText').removeClass('text-danger').removeClass('text-success').html('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " " + error);
                    $('#responseText').html('An error occurred. Please try again later.').addClass(
                        'text-danger');
                }
            });
        }
    </script>
@endsection
