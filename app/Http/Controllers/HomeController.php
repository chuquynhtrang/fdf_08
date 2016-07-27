<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Models\User;
use Response;
use App\Http\Requests\LoginRequest;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
