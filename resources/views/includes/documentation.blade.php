@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card bg-dark text-light">
                <div class="card-body">
                    <h1 class="text-info">Use the buttons for the user manual</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card bg-dark text-light">
                <div class="card-body d-flex justify-content-between">
                    <button id="spendingsBtn" class="btn btn-info" onclick="handleButtonClick('spendings')">Manage spendings</button>
                    <button id="incomesBtn" class="btn btn-info" onclick="handleButtonClick('incomes')">Manage incomes</button>
                    <button id="familyBtn" class="btn btn-info" onclick="handleButtonClick('family')">Manage family</button>
                    <button id="accountBtn" class="btn btn-info" onclick="handleButtonClick('account')">Manage account</button>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
    
    <div id="spendings" style="display: none;">
        Spending Content
    </div>
    
    <div id="incomes" style="display: none;">
        Income Content
    </div>
    
    <div id="family" style="display: none;">
        <h3>Manage family</h3>
        <ul>
            <li>The first step to create family on the settings page.</li>
        </ul>
        <img class="docu-image" src="{{ asset('storage/documentation_pictures/Manage family/Create_family.png') }}" alt="Create Family">
        <ul>
            <li>Right after you created a family, an input field will appear there, where you can invite family members by username.</li>
        </ul>
        <img class="docu-image" src="{{ asset('storage/documentation_pictures/Manage Family/SendJoinRequest.png') }}"  alt="Send Join Request">
        <ul>
            <li>This will send a join request to the invited user’s email.</li>
        </ul>
        <img class="docu-image" src="{{ asset('storage/documentation_pictures/Manage family/AcceptRequest.png') }}" alt="Accept Request">
        <ul>
            <li>Click ont he accept invitation link, which will redirect you and you will be the part of the family.</li>
        </ul>
        <ul>
            <ul>
                <li>Delete option</li>
                <ul>
                    <li>You can kick the members if you want or delete the whole family itself.</li>
                    <img class="docu-image" src="{{ asset('storage/documentation_pictures/Manage family/DeleteOptions.png') }}" alt="Delete Options">
                </ul>
                <li>The family members can leave the family themself if they would like.</li>
                <img class="docu-image" src="{{ asset('storage/documentation_pictures/Manage family/LeaveFamily.png') }}" alt="Leave Family">
            </ul>
        </ul>
    </div>
    
    <div id="account" style="display: none;">
        Account Content
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
