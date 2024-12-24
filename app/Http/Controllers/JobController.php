<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class JobController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Job::with('skills');

        if ($request->title) {
            $query->where('title','like','%'.$request->title.'%');
        }
        if ($request->location) {
            $query->where('location','like','%'.$request->location.'%');
        }
        return response()->json($query->get());
    }

}
