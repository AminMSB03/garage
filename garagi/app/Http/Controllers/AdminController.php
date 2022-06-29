<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function getTechniciens(){
        $techniciens = User::where('role','technicien')->get();
        $response = response([
            "techniciens"=>$techniciens
        ],201);

        return $response;
    }


    public function getClilents(){
        $clients = User::where('role','client')->get();
        $response = response([
            "clients"=>$clients
        ],201);
        
        return $response;
    }

    public function getCommands()
    {
        
    }
}
