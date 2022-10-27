<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index(){
        $announcements = Announcement::all();
        return $announcements;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'schedule' => 'required',
        ]);
        Announcement::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Announcement successfully added!'
        ]);
    }
}
