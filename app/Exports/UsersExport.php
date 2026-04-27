<?php
namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection() {
        return User::with('role')->get()->map(fn($u) => [
            'name'  => $u->name,
            'email' => $u->email,
            'role'  => $u->role->role_name,
            'aktif' => $u->is_active ? 'Ya' : 'Tidak',
        ]);
    }
    public function headings(): array {
        return ['Nama', 'Email', 'Role', 'Aktif'];
    }
}