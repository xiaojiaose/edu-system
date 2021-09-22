<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers;


use function OpenApi\scan;

class IndexController
{
    public function api()
    {
        return redirect('/dashboard/index.html');
    }
}