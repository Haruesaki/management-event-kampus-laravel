<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class UserManagementController extends Controller
{
    public function index(){
        $users = [
            [
                'nama' => 'Kandar',
                'npm' => '2447009821',
                'jurusan' => 'ilkom',
                'prodi' => 'S1 ilkom'
            ],
            [
                'nama' => 'Hairi',
                'npm' => '083168421918',
                'jurusan' => 'ilkom',
                'prodi' => 'S1 ilkom'
            ],
            [
                'nama' => 'Mamat',
                'npm' => '085278690032',
                'jurusan' => 'ilkom',
                'prodi' => 'S1 ilkom'
            ],
            [
                'nama' => 'Simin',
                'npm' => '089669739200',
                'jurusan' => 'ilkom',
                'prodi' => 'S1 ilkom'
            ]
        ];
        return view('user-management', compact('users'));
    }
}
