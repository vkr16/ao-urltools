<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Qrgenerator extends BaseController
{
    public function generator()
    {
        $data = [
            'current_nav' => 'qr'
        ];
        return view('qr-generator', $data);
    }
}
