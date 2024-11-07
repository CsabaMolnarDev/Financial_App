@extends('layouts.app')
@section('content')
    <div class="">
        <div class="">
            <form action="{{ route('addSavingGoal') }}" method="post">
                @csrf
                <h4 class="">Set saving goal(s)</h4>
                <p class="">Name</p>
                <input type="text" name="savingGoalName" id="savingGoalName">
                <p class="">Amount</p>
                <input  type="number" name="savingGoalAmount" id="savingGoalAmount" min="1">
                <br>
                <button class="" type="submit">Save</button>
            </form>
        </div>
    </div>
    <div class="">
        <div class="">
            <form action="{{ route('addSaving') }}" method="post">
                @csrf
                <h4 class="">Add money to your goal</h4>
                <p class="">Name</p>
                <select name="goals" id="goals">
                @foreach ($unfinishedGoals as $goal)
                    <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                @endforeach
                </select>
                <p class="">Amount</p>
                <input  type="number" name="savingAmount" id="savingAmount" min="1">
                <br>
                <button class="" type="submit">Save</button>
            </form> 
        </div>
    </div>
    
@endsection