@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3>Use the buttons for the user manual</h3>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mt-2"><button id="spendingsBtn" class="btn btn-outline-info"
                                    onclick="handleButtonClick('spendings')">Manage
                                    spendings</button>
                            </div>
                            <div class="col-md-3 mt-2"><button id="incomesBtn" class="btn btn-outline-info"
                                    onclick="handleButtonClick('incomes')">Manage
                                    incomes</button>
                            </div>
                            <div class="col-md-3 mt-2"><button id="familyBtn" class="btn btn-outline-info"
                                    onclick="handleButtonClick('family')">Manage
                                    family</button>
                            </div>
                            <div class="col-md-3 mt-2"><button id="accountBtn" class="btn btn-outline-info"
                                    onclick="handleButtonClick('account')">Graphicon explainer</button>
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
                                <br>
                                <ul style="list-style: none; padding: 0;">
                                    <li style="display: flex; align-items: center; justify-content: center;">
                                        <span style="margin-right: 5px;">&bull;</span>
                                        <span>If you check the checkbox, you can set your spending monthly</span>
                                    </li>
                                </ul>
                            </div>
                            <div id="incomes" style="display: none;">
                                <h3>Manage incomes</h3>
                                <ul>
                                    <li>On the <u>Incomes page</u> click on the button</li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Manage income/AddNewIncome.png') }}"
                                    alt="Add new income">
                                <ul>
                                    <li>Fill in the necessary field, and then submit </li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Manage income/Fill_inCard.png') }}"
                                    alt="Fill in every input field">
                                <br>
                                <ul style="list-style: none; padding: 0;">
                                    <li style="display: flex; align-items: center; justify-content: center;">
                                        <span style="margin-right: 5px;">&bull;</span>
                                        <span>If you check the checkbox, you can set your income monthly</span>
                                    </li>
                                </ul>
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
                                <h3>Graphicon explainer</h3>
                                <ul>
                                    <li>
                                        <h4>Home page</h4>
                                    </li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Account explainer/Homepage.png') }}"
                                    alt="Home Page">
                                <ul>
                                    <li>
                                        On the home page, we can inspect four possible graphics.
                                        If we also include income and spending for this month, we can see the top two
                                        graphics.
                                        Additionally, if we have family members who have added data for the month, we can
                                        see the rate of each family member represented by the two bottom graphics.
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <h4>Spending/income page</h4>
                                    </li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Account explainer/SpendingPage.png') }}"
                                    alt="Spending page">
                                <ul>
                                    <li>
                                        On the spending page we can see our overall spendings.
                                    </li>
                                </ul>
                                <img class="docu-image"
                                    src="{{ asset('storage/documentation_pictures/Account explainer/Edit.png') }}"
                                    alt="Editing data">
                                <ul>
                                    <li>
                                        If you scroll down a bit you can see your logs, you can edit whatever you want here,
                                        you need to double click on the data to edit.
                                    </li>
                                </ul>
                                <br>
                                <ul>
                                    <li>
                                        The income page is the same, excpect on that page we can see our incomes.
                                    </li>
                                </ul>
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
