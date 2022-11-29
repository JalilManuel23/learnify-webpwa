<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\Mail;

class ExampleController extends Controller
{
    public function index()
    {
        Mail::to('ejemplo@ejemplo.com')->send(new UserEmail);
    }
}
