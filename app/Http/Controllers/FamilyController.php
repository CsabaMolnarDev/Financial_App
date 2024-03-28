<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyInvitations;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function acceptInvitation($token)
    {
        $invitation = FamilyInvitations::where('token', $token)->first();
        
        if (!$invitation) {
            // No invitation found with this token
            return redirect('/')->with('error', 'Invalid invitation token.');
        }

        if ($invitation->status !== 'pending') {
            // Invitation is not in a pending state
            return redirect('/')->with('error', 'This invitation has already been processed.');
        }

        // Check if the user is logged in
        if (!Auth::check()) {
            // Store the token in the session to use after login
            session(['invitation_token' => $token]);

            // Redirect to login page with a callback to this route after login
            return redirect()->route('login')->with('info', 'Please log in to accept the invitation.');
        }

        $user = Auth::user();
        if ($user->family_id) {
            // User is already part of a family
            return redirect('/')->with('error', 'You are already part of a family.');
        }

        $user->family_id = $invitation->family_id;
        $user->save();

        // Update the invitation to mark it as accepted
        $invitation->status = 'accepted';
        $invitation->save();

        // Redirect with a success message
        toastr()->success('You have successfully joined the family');
        return redirect('/');
    }
}