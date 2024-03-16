@extends('layouts.app')
@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                {{-- Card --}}
                <div class="card">
                    {{-- Card tittle --}}
                    <div class="card-tittle">
                        <h3 class="card-title">Profile Details</h3>
                    </div>
                    {{-- Card body --}}
                    <div class="card-body">
                        {{-- Fullname area --}}
                        <div>
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
                        <div>
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
                        {{-- Email area --}}
                        <div>
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
                        {{-- Currency area --}}
                        <div>
                            <p class="card-text"><strong>Current currency type: {{ $user->currency->name }}</strong></p>
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
                        {{-- Notification --}}
                        <div>
                            <p class="card-text"><strong>Notification: </strong></p>
                            <form action="{{ route('enableNotification') }}" method="POST">
                                @csrf
                                <input type="checkbox" id="notification" name="notification">
                                <label for="notification"> I want to get notified to log my spendings</label><br>
                                <button id="enableNotificationBtn" type="submit" class="btn btn-primary">Enable
                                    notification</button>
                                <input type="hidden" id="timezone" name="timezone">
                                {{--  <div id="setTime">
                                <label for="appt">Select a time:</label>
                                <input type="time" id="appt" name="appt">
                                <button id="enableNotificationBtn" type="submit" class="btn btn-primary">Enable notification</button>
                            </div>
                            <input type="hidden" id="timezone" name="timezone"> --}}
                            </form>
                        </div>
                        {{-- CSV --}}
                        <div>
                            <p class="card-text"><strong>Download spendings in csv: </strong></p>
                            <button id="downloadButton" type="submit" class="btn btn-primary">Download</button>
                            {{-- https://www.npmjs.com/package/json-to-csv-export --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>



    <script>
        /* Change background image */
        document.body.style.backgroundImage = "url('../storage/pictures/settings.jpg')";
        /* TODO: what is this???????  */
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

            /* var setTime = document.getElementById('setTime'); */

            /* checkbox.addEventListener('change', function(){
                if (this.checked) {
                    setTime.style.display = 'block';
                } else {
                    setTime.style.display = 'none';
                }
            }); */
            document.getElementById('enableNotificationBtn').addEventListener('click', function(event) {
                var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                document.getElementById('timezone').value = userTimezone;
            });
            /* TODO: what is this???????  */
            // Move the AJAX call into a separate function
            /*  function sendTimezoneToServer() {
                 var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                 console.log(userTimezone);
                 $.ajax({
                     url: '/enableNotification',
                     method: 'POST',
                     data: {
                         timezone: userTimezone,
                         _token: '{{ csrf_token() }}'
                     },
                     headers: { // Add this section to include CSRF token in the request headers
                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                     },

                     success: function(response) {
                         console.log('Timezone set successfully');
                     },
                     error: function(xhr, status, error){
                         console.error('Error setting timezone:', error);
                         console.log(xhr.responseText);
                     }
                 });
             } */
            /* TODO: what is this???????  */
            /*
                        $(document).ready(function() {
                            $('#notification').change(function() {
                                // This function is called whenever the checkbox is changed
                                var isChecked = $(this).is(':checked'); // true if checked, false if unchecked
                                var valueToSend = isChecked ? 1 :
                                0; // Determine the value to send based on the checkbox state

                                // Now, send this value to the server using AJAX
                                $.ajax({
                                    url: '/enableNotification', // The URL to your controller
                                    type: 'POST', // or GET, depending on your requirements
                                    data: {
                                        myCheckboxValue: valueToSend,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(response) {

                                        console.log('Success:', response);
                                    },
                                    error: function(xhr) {
                                        console.log('Error:', xhr.responseText);
                                    }
                                });
                            });
                        }); */

        });
    </script>
    {{-- if we don't want button, we can use ajax --}}
@endsection
