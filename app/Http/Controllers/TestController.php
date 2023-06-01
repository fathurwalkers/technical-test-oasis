<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function soal_one()
    {
        $nilai = 20;
        for ($i = 1; $i <= $nilai; $i++) {
            if ($i % 6 == 0) {
                echo "DIGITAL OASIS\n";
            } else if ($i % 2 == 0) {
                echo "DI\n";
            } else if ($i % 3 == 0) {
                echo "OS\n";
            } else {
                echo $i."\n";
            }
        }
        return Inertia::render('SoalOne', [
            'nilai' => $nilai
        ]);
    }
}
