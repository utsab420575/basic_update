<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function AllPortfolio(){
        //ORDER BY created_at DESC
        $allPortfolio=Portfolio::latest()->get();
        return view('admin.protfolio.protfolio_all',['allPortfolio'=>$allPortfolio]);
    }
}
