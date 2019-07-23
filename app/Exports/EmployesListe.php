<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\User;

class EmployesListe implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}