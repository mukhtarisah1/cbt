<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class AdminController extends Controller
{
    
    public function addSubject(Request $request)
    {
        try {
            Subject::insert([
                'subject' => $request->subject,
                
            ]);
            
            // Return a success response
            return response()->json(['success' => 'Subject added Successfully']);
        } catch (\Exception $e) {
            // Log the exception
            //\Log::error($e);

            // Return an error response
            return response()->json(['success' =>false, 'msg'=> $e->getMessage()]);
        }
    }
}