@extends('layouts.app')
@section('content')
    <div class="card text-start">
        <div class="card-body">
            <form action="{{ route('addSavingGoal') }}" method="post">
                @csrf
                <h4 class="card-title">Set saving goal(s)</h4>
                <p class="card-text">Name</p>
                <input type="text" name="savingGoalName" id="savingGoalName">
                <p class="card-text">Amount</p>
                <input  type="number" name="savingGoalAmount" id="savingGoalAmount" min="1">
                <br>
                <button class="btn-btn-outline" type="submit">Save</button>
            </form>
            
        </div>
    </div>
    <div class="card text-start">
        <div class="card-body">
            <form action="{{ route('addSaving') }}" method="post">
                @csrf
                <h4 class="card-title">Add money to your goal</h4>
                <p class="card-text">Name</p>
                <select name="goals" id="goals">
                @foreach ($unfinishedGoals as $goal)
                    <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                @endforeach
                </select>
                <p class="card-text">Amount</p>
                <input  type="number" name="savingAmount" id="savingAmount" min="1">
                <br>
                <button class="btn-btn-outline" type="submit">Save</button>
            </form>
            
        </div>
    </div>
    
@endsection