<?php

namespace App\Http\Controllers\Linguist;

use App\Events\IncomingMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function handle(Request $request)
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        event(new IncomingMessage($data));
    }
}
