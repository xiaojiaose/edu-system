<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function list(Request $request)
    {
        dump($request);
    }
}
