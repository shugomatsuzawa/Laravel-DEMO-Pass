<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Thenextweb\PassGenerator;
use App\Services\DashboardService;
use Response;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function pass()
    {
        $dashboardService = new DashboardService();

        $pass_identifier = auth()->id();  // This, if set, it would allow for retrieval later on of the created Pass
        $pkpass = PassGenerator::getPass($pass_identifier);
        if (!$pkpass) {
            $pkpass = $dashboardService->createWalletPass($pass_identifier);
        }

        // return new Response($pkpass, 200, [
        //     'Content-Transfer-Encoding' => 'binary',
        //     'Content-Description' => 'File Transfer',
        //     'Content-Disposition' => 'attachment; filename="pass.pkpass"',
        //     'Content-length' => strlen($pkpass),
        //     'Content-Type' => PassGenerator::getPassMimeType(),
        //     'Pragma' => 'no-cache',
        // ]);

        $filePath = storage_path('app/passgenerator') . '/' . $pass_identifier . '.pkpass';
        $fileName = 'pass.pkpass';
        $headers = [
            'Content-Type' => PassGenerator::getPassMimeType(),
        ];
        return response()->download($filePath, $fileName, $headers);
    }
}
