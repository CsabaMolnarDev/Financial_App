@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3>Use the buttons for the user manual</h3>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-3"><button id="spendingsBtn" class="btn btn-outline-info"
                                    onclick="handleButtonClick('spendings')">Manage
                                    spendings</button>
                            </div>
                            <div class="col-3"><button id="incomesBtn" class="btn btn-outline-info"
                                    onclick="handleButtonClick('incomes')">Manage
                                    incomes</button>
                            </div>
                            <div class="col-3"><button id="familyBtn" class="btn btn-outline-info"
                                    onclick="handleButtonClick('family')">Manage
                                    family</button>
                            </div>
                            <div class="col-3"><button id="accountBtn" class="btn btn-outline-info"
                                    onclick="handleButtonClick('account')">Manage
                                    account</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div id="spendings" style="display: none;">
                                <h3>Manage spendings</h3>
                                <ul>
                                    <li>On the <u>Spendings page</u> click on the button</li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Manage spending/AddNewSpending.png') }}"
                                    alt="Add new spending">
                                <ul>
                                    <li>Fill in the necessary field, and then submit </li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Manage spending/Fill_inCard.png') }}"
                                    alt="Fill in every input field">
                            </div>

                            <div id="incomes" style="display: none;">
                                Income Content
                            </div>

                            <div id="family" style="display: none;">
                                <h3>Manage family</h3>
                                <ul>
                                    <li>The first step to create family on the settings page.</li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Manage family/Create_family.png') }}"
                                    alt="Create Family">
                                <ul>
                                    <li>Right after you created a family, an input field will appear there, where you can
                                        invite
                                        family
                                        members
                                        by username.</li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Manage Family/SendJoinRequest.png') }}"
                                    alt="Send Join Request">
                                <ul>
                                    <li>This will send a join request to the invited user’s email.</li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Manage family/AcceptRequest.png') }}"
                                    alt="Accept Request">
                                <ul>
                                    <li>Click ont he accept invitation link, which will redirect you and you will be the
                                        part of the
                                        family.
                                    </li>
                                </ul>
                                <ul>
                                    <ul>
                                        <li>Delete option</li>
                                        <ul>
                                            <li>You can kick the members if you want or delete the whole family itself.</li>
                                            <img class="docu-image"
                                                src="{{ asset('storage/documentation_pictures/Manage family/DeleteOptions.png') }}"
                                                alt="Delete Options">
                                        </ul>
                                        <li>The family members can leave the family themself if they would like.</li>
                                        <img class="docu-image"
                                            src="{{ asset('storage/documentation_pictures/Manage family/LeaveFamily.png') }}"
                                            alt="Leave Family">
                                    </ul>
                                </ul>
                            </div>

                            <div id="account" style="display: none;">
                                Account Content
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        <script>
            var activeButtonId = null;

            function handleButtonClick(buttonType) {
                var contentDiv = document.getElementById(buttonType);
                var button = document.getElementById(buttonType + 'Btn');

                if (buttonType === activeButtonId) {

                    contentDiv.style.display = contentDiv.style.display === 'none' ? 'block' : 'none';
                } else {

                    if (activeButtonId) {
                        document.getElementById(activeButtonId).style.display = 'none';
                    }
                    contentDiv.style.display = 'block';
                    if (activeButtonId) {
                        document.getElementById(activeButtonId + 'Btn').classList.remove('active');
                    }
                    button.classList.add('active');
                    activeButtonId = buttonType;
                }
            }
        </script>
    @endsection
