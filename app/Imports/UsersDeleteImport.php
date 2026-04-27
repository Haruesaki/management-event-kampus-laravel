<?php
namespace App\Imports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersDeleteImport implements ToModel, WithHeadingRow
{
    public function model(array $row) {
        $user = User::where('email', $row['email'])->first();
        if ($user && in_array($user->role->role_name, ['Panitia', 'Peserta'])) {
            $user->delete();
        }
        return null;
    }
}