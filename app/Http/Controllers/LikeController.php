<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Status;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Status $status)
    {
        $status->like();
     
    }

    public function destroy(Status $status)
    {
        $status->unlike();
     
    }

}
