@extends('layouts.app')
@section('content')
    <div class="">
        <div class="">
            <div class=""></div>
            <div class="">
                {{-- Card --}}
                <div class="">
                    {{-- Card tittle --}}
                    <div class="">
                        <h3 class="">Profile Details</h3>
                    </div>
                    {{-- Card body --}}
                    <div class="">
                        {{-- 1st row for names --}}
                        <div class="" id="settingsRow">
                            {{-- Fullname area --}}
                            <div class="">
                                <p class="">Full name: <i>{{ $user->fullname }}</i></p>
                                <button type="button" class=""
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
                                                        <button type="submit" class="">Save
                                                            Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Username area --}}
                            <div class="">
                                <p class="">Name: <i>{{ $user->username }}</i> </p>
                                <button type="button" class=""
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
                                                    <div class="">
                                                        <label for="newUsername" class="form-label">New Username</label>
                                                        <input type="text" class="form-control"id="newUsername"
                                                            name="newUsername" required>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="">Save
                                                            Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- 2nd row for Email and notification --}}
                        <div class="" id="settingsRow">
                            {{-- Email area --}}
                            <div class="">
                                <p class="">Email:<i>{{ $user->email }}</i> </p>
                                <button type="button" class="" data-bs-toggle="modal"
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
                                                    <div class="">
                                                        <label for="newEmail" class="form-label">New Email</label>
                                                        <input type="email" class="form-control" id="newEmail"
                                                            name="newEmail" required>
                                                    </div>
                                                    <button type="submit" class="">Save
                                                        Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Phone area --}}
                            <div class="">
                                @if ($user->phone)
                                    <p class="">Phone number: <i>{{ $user->phone }}</i></p>
                                @else
                                    <p class="">Phone number: <i>Not set</i></p>
                                @endif
                                <button type="button" class=""
                                    data-bs-toggle="modal"data-bs-target="#changePhoneNumberModal">Change phone
                                    number</button>
                                <form action="{{ route('deletePhone') }}" method="post">
                                    @csrf
                                    <button type="submit" class=""
                                        type="button">Del</button>
                                </form>
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
                                                    <div class="">
                                                        <label for="newPhone" class="form-label">New phone number</label>
                                                        <input type="text" class="form-control"id="newPhone"
                                                            name="newPhone" required>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="">Save
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
                        <div class="" id="settingsRow">
                            {{-- Currency area --}}
                            <div class="">
                                <p class="">Current currency type: </p>
                                <form action="{{ route('changeCurrency') }}" method="POST">
                                    @csrf
                                    <select class="form-control" name="newCurrency" id="currency">
                                        <option value="" disabled selected>{{ $user->currency->name }}</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }} -
                                                {{ $currency->symbol }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="">Change currency</button>
                                </form>
                            </div>
                            {{-- Notification --}}
                            <div class="">
                                <p class="">Notifications:</p>
                                <form action="{{ route('enableNotification') }}" method="POST">
                                    @csrf
                                    @if (auth()->user()->notification == true && auth()->user()->timezone != null)
                                        <label>You are subscribed</label><br>
                                    @endif
                                    <button id="enableNotificationBtn" type="submit"
                                        class="">Enable / Disable
                                        notifications</button>
                                    <input type="hidden" id="timezone" name="timezone">
                                </form>
                            </div>
                        </div>
                        {{-- 4th row --}}
                        <div class="" id="settingsRow">
                            {{-- Change langage area --}}
                            {{-- Deactivate account --}}
                            <div class="">
                                <br>
                                <form action="{{ route('softDeleteAccount') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="">Deactivate
                                        account</button>
                                </form>
                            </div>
                            {{-- Family system area --}}
                            {{-- Add family member(s) --}}
                            <div class="">
                                {{-- We only show this if user doesn't have family --}}
                                @if (!$user->family_id)
                                    <form action="{{ route('createFamily') }}" method="POST">
                                        @csrf
                                        <p>Create family <button class="" type="submit"
                                                id="createFamily">+</button></p>
                                    </form>
                                    {{-- If they have we show the delete option --}}
                                @else
                                    @if ($user->family->creator_id === $user->id)
                                        <form action="{{ route('deleteFamily') }}" method="POST">
                                            @csrf
                                            <p>Delete family <button class="" type="submit"
                                                    id="deleteFamily">-</button></p>
                                        </form>
                                        <form action="{{ route('addFamilyMember') }}" method="POST"
                                            id="addfamilymemberinput">
                                            @csrf
                                            <div>
                                                <input class="form-control mb-2" oninput="checkIfUserExists(this.value);"
                                                    type="search" name="familymember" id="familymember" required>
                                                <button type="submit" id="addFamilyMemberBTN"
                                                    class="">Add family member</button>
                                                <div id="responseText"></div>
                                            </div>
                                        </form>
                                        @foreach ($family as $member)
                                            @if ($member->id !== $user->id && $member->family_id !== null)
                                                <form action="{{ route('deleteFamilyMember', ['id' => $member->id]) }}"
                                                    method="GET">
                                                    @csrf
                                                    <p class="mt-3">{{ $member->fullname }}: <button
                                                            class="" type="submit"
                                                            id="deleteFamilyMember">-</button></p>
                                                </form>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>You are the member of the {{ $user->family?->name }} family.</p>
                                        <form action="{{ route('leaveFamily') }}" method="POST">
                                            @csrf
                                            <p><button class="" type="submit"
                                                    id="leaveFamily">Leave family</button></p>
                                        </form>
                                    @endif
                                @endif
                                {{-- We list out the family members --}}
                            </div>
                        </div>

                        {{-- Add finance from file --}}
                        <div class="">
                            <h4>Add finance from file</h4>
                            <form action="{{ route('settings') }}" method="POST" id="fileForm"
                                enctype="multipart/form-data">
                                @csrf
                                <label id="fileLabel" for="fileInput">Select a file: </label>
                                <input type="file" name="fileInput" id="fileInput">
                            </form>
                        </div>
                        <div class="">
                            <h4>Download finances (csv):</h4>
                            <form action="{{ route('downloadFinances') }}" method="POST">
                                @csrf
                                <button class="" type="submit">Download</button>
                            </form>
                        </div>
                        @if ($errors->any())
                            <div class="">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class=""></div>
        </div>
    </div>

    <script>
        //notification handler
        document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.getElementById('notification');
            document.getElementById('enableNotificationBtn').addEventListener('click', function(event) {
                var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                document.getElementById('timezone').value = userTimezone;
            });
        });

        // Get a reference to the file input element
        const fileInput = document.getElementById('fileInput');



        // Add an event listener for the change event on the file input element
        fileInput.addEventListener('change', (event) => {
            document.getElementById('fileForm').submit();
        });

        function checkIfUserExists(input) {
            $.ajax({
                type: 'POST',
                url: '/checkIfUserExists',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'username': input
                },
                //we need to fix this later bcs of the removal of bs5!!!!
                success: function(data) {
                    if (data.status === "failed") {
                        $('#responseText').removeClass('text-success').addClass('text-danger').html(data
                            .message);
                        $('#addFamilyMemberBTN').prop('disabled', true)
                    } else if (data.status === "failed2") {
                        $('#responseText').removeClass('text-success').addClass('text-danger').html(data
                            .message);
                        $('#addFamilyMemberBTN').prop('disabled', true)
                    } else {
                        // If the user exists, you may choose not to display any message
                        $('#responseText').removeClass('text-danger').removeClass('text-success').html('');
                        $('#addFamilyMemberBTN').prop('disabled', false);
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
