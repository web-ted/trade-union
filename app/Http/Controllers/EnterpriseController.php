<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enterprise;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EnterpriseController extends Controller
{
    public function index()
    {
        return Enterprise::all();
    }
}
