<?php

namespace App\Http\Livewire;

use App\Http\Traits\useUniqueValidation;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EmployeeEditForm extends Component
{
    use useUniqueValidation;

    public $employees;
    public Collection $roles;
    public Collection $positions;

    public function mount(Collection $employees)
    {
        $this->employees = []; // reset, karena ada data employees sebelumnya

        foreach ($employees as $employee) {
            $this->employees[] = [
                'id' => $employee->id,
                'name' => $employee->name,
                'email' => $employee->email,
                'original_email' => $employee->email, // untuk cek validasi unique
                'phone' => $employee->phone,
                'original_phone' => $employee->phone, // untuk cek validasi unique nanti
                'nip' => $employee->nip, // Add this line for NIP
                'role_id' => $employee->role_id,
                'position_id' => $employee->position_id
            ];
        }
        $this->roles = Role::all();
        $this->positions = Position::all();
    }
    public function saveEmployees()
{
    $roleIdRuleIn = join(',', $this->roles->pluck('id')->toArray());
    $positionIdRuleIn = join(',', $this->positions->pluck('id')->toArray());

    $validationRules = [];

    foreach ($this->employees as $key => $employee) {
        $validationRules["employees.{$key}.name"] = 'required';
        $validationRules["employees.{$key}.email"] = 'required|email';
        $validationRules["employees.{$key}.phone"] = 'required';
        $validationRules["employees.{$key}.nip"] = 'required|unique:users,nip,' . $employee['id'];
        $validationRules["employees.{$key}.password"] = '';
        $validationRules["employees.{$key}.role_id"] = 'required|in:' . $roleIdRuleIn;
        $validationRules["employees.{$key}.position_id"] = 'required|in:' . $positionIdRuleIn;
    }

    $this->validate($validationRules);

    if (!$this->isUniqueOnLocal('phone', $this->employees)) {
        $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
        return session()->flash('failed', 'Pastikan input No. Telp tidak mengandung nilai yang sama dengan input lainnya.');
    }

    if (!$this->isUniqueOnLocal('email', $this->employees)) {
        $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
        return session()->flash('failed', 'Pastikan input Email tidak mengandung nilai yang sama dengan input lainnya.');
    }

    $affected = 0;
    foreach ($this->employees as $employee) {
        $employeeBeforeUpdated = User::find($employee['id']);

        if (!$this->isUniqueOnDatabase($employeeBeforeUpdated, $employee, 'phone', User::class)) {
            $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
            return session()->flash('failed', "No. Telp dari data karyawan {$employee['id']} sudah terdaftar. Silahkan masukkan email yang berbeda!");
        }

        if (!$this->isUniqueOnDatabase($employeeBeforeUpdated, $employee, 'email', User::class)) {
            $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
            return session()->flash('failed', "Email dari data karyawan {$employee['id']} sudah terdaftar. Silahkan masukkan email yang berbeda!");
        }

        $affected += $employeeBeforeUpdated->update([
            'name' => $employee['name'],
            'email' => $employee['email'],
            'nip' => $employee['nip'],
            'phone' => $employee['phone'],
            'role_id' => $employee['role_id'],
            'position_id' => $employee['position_id'],
        ]);
    }

    $message = $affected === 0 ?
        "Tidak ada data karyawan yang diubah." :
        "Ada $affected data karyawan yang berhasil diedit.";

    return redirect()->route('employees.index')->with('success', $message);
}

    

    public function render()
    {
        return view('livewire.employee-edit-form');
    }
}
