<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class StudentController extends Controller
{
    public function index()
    {
        $users = User::with('student')
            ->whereHas('student', function (Builder $query) {
                $query->where('verifikasi', '1');
            })->get();
        return view('welcome', compact('users'));
    }

    public function edit($id)
    {
        $user = User::with('student')
            ->whereHas('student')
            ->findOrFail($id);
        //dd($user);
        $student = new Student();
        $agama = $student->agama();
        $jenis_kelamin = $student->jenis_kelamin();
        $alat_transportasi = $student->alat_transportasi();
        $tinggal = $student->tinggal();
        $pendidikan = $student->pendidikan();
        $pekerjaan = $student->pekerjaan();
        $penghasilan = $student->penghasilan();
        $baju = $student->baju();
        return view('validasi.edit', compact('user', 'agama', 'jenis_kelamin', 'alat_transportasi',
            'tinggal', 'pendidikan', 'pekerjaan', 'penghasilan', 'baju'));
    }

    public function update(EditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
        ]);
        $student = Student::findOrFail($id);
        $student->update($request->validated());
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function validasi($id)
    {
        $student = Student::findOrFail($id);
        $student->update([
            'valid' => 1,
        ]);
        return redirect()->back()->with('success', 'Data berhasil di Validasi');
    }

    public function unvalidasi($id)
    {
        $student = Student::findOrFail($id);
        $student->update([
            'valid' => 0,
        ]);
        return redirect()->back()->with('success', 'Data berhasil di Validasi');
    }

}
