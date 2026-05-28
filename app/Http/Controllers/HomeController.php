<?php

namespace App\Http\Controllers;

use App\Models\Residence;
use Illuminate\Http\Request;

use App\Models\Review;

class HomeController extends Controller
{
    public function HomePage()
    {


        return view('welcome');
    }
}
