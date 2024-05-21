<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class DashboardController extends Controller
{
 
    public function getVerifiedParticipantsCount()
    {
        // Adjust the query to check the 'email_verification_status' column for the 'verified' value
        $verifiedParticipantsCount = User::where('email_verification_status', 'verified')->count();
        
        // Return the count as a JSON response
        return response()->json(['verifiedParticipants' => $verifiedParticipantsCount]);
    }
    
}
