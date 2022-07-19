<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
    public function unverifikasi($id)
    {
        $student = Student::findOrFail($id);
        $student->update([
            'verifikasi' => 0,
        ]);
        return redirect()->back()->with('success', 'Data berhasil di Validasi');
    }

    public function download()
    {
        $users = User::with('student')
            ->whereHas('student', function (Builder $query) {
                $query->where('verifikasi', '1');
            })->get();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', "NO");
        $sheet->setCellValue('B1', "Nama Lengkap");
        $sheet->setCellValue('C1', "Jenis Kelamin");
        $sheet->setCellValue('D1', "NISN");
        $sheet->setCellValue('E1', "Asal Sekolah");
        $sheet->setCellValue('F1', "NPSN Sekolah");
        $sheet->setCellValue('G1', "NIK");
        $sheet->setCellValue('H1', "NO KK");
        $sheet->setCellValue('I1', "Tempat Lahir");
        $sheet->setCellValue('J1', "Tanggal Lahir");
        $sheet->setCellValue('K1', "Agama");
        $sheet->setCellValue('L1', "Tempat Tinggal");
        $sheet->setCellValue('M1', "Moda Transportasi");
        $sheet->setCellValue('N1', "Anak Ke-");
        $sheet->setCellValue('O1', "Alamat");
        $sheet->setCellValue('P1', "RT");
        $sheet->setCellValue('Q1', "RW");
        $sheet->setCellValue('R1', "Desa");
        $sheet->setCellValue('S1', "Kecamatan");
        $sheet->setCellValue('T1', "Kabupaten");
        $sheet->setCellValue('U1', "Provinsi");
        $sheet->setCellValue('V1', "Nama Ayah");
        $sheet->setCellValue('W1', "NIK Ayah");
        $sheet->setCellValue('X1', "Tahun Lahir Ayah");
        $sheet->setCellValue('Y1', "Pendidikan Ayah");
        $sheet->setCellValue('Z1', "Pekerjaan Ayah");
        $sheet->setCellValue('AA1', "Penghasilan Ayah");
        $sheet->setCellValue('AB1', "Nama Ibu");
        $sheet->setCellValue('AC1', "NIK Ibu");
        $sheet->setCellValue('AD1', "Tahun Lahir Ibu");
        $sheet->setCellValue('AE1', "Pendidikan Ibu");
        $sheet->setCellValue('AF1', "Pekerjaan Ibu");
        $sheet->setCellValue('AG1', "Penghasilan Ibu");
        $sheet->setCellValue('AH1', "Tinggi Badan");
        $sheet->setCellValue('AI1', "Berat Badan");
        $sheet->setCellValue('AJ1', "Jarak");
        $sheet->setCellValue('AK1', "Waktu");
        $sheet->setCellValue('AL1', "Jumlah Saudara");
        $sheet->setCellValue('AL1', "VALIDASI");

        $column = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $column, $column - 1);
            $sheet->setCellValue('B' . $column, $user->name);
            $sheet->setCellValue('C' . $column, $user->student->jenis_kelamin);
            $sheet->setCellValue('D' . $column, $user->student->nisn);
            $sheet->setCellValue('E' . $column, $user->student->asal_sekolah);
            $sheet->setCellValue('F' . $column, $user->student->npsn_asal);
            $sheet->setCellValue('G' . $column, 'nik'.$user->student->nik);
            $sheet->setCellValue('H' . $column, 'nokk'.$user->student->no_kk);
            $sheet->setCellValue('I' . $column, $user->student->tempat);
            $sheet->setCellValue('J' . $column, $user->student->tanggal_lahir);
            $sheet->setCellValue('K' . $column, $user->student->agama);
            $sheet->setCellValue('L' . $column, $user->student->tinggal);
            $sheet->setCellValue('M' . $column, $user->student->mobil);
            $sheet->setCellValue('N' . $column, $user->student->anak_ke);
            $sheet->setCellValue('O' . $column, $user->student->alamat);
            $sheet->setCellValue('P' . $column, $user->student->rt);
            $sheet->setCellValue('Q' . $column, $user->student->rw);
            $sheet->setCellValue('R' . $column, $user->student->desa_siswa);
            $sheet->setCellValue('S' . $column, $user->student->kec_siswa);
            $sheet->setCellValue('T' . $column, $user->student->kab_siswa);
            $sheet->setCellValue('U' . $column, $user->student->prov_siswa);
            $sheet->setCellValue('V' . $column, $user->student->nama_ayah);
            $sheet->setCellValue('W' . $column, 'nik'.$user->student->nik_ayah);
            $sheet->setCellValue('X' . $column, $user->student->tahun_ayah);
            $sheet->setCellValue('Y' . $column, $user->student->pend_ayah);
            $sheet->setCellValue('Z' . $column, $user->student->pekerjaan_ayah);
            $sheet->setCellValue('AA' . $column, $user->student->penghasilan_ayah);
            $sheet->setCellValue('AB' . $column, $user->student->nama_ibu);
            $sheet->setCellValue('AC' . $column, 'nik'.$user->student->nik_ibu);
            $sheet->setCellValue('AD' . $column, $user->student->tahun_ibu);
            $sheet->setCellValue('AE' . $column, $user->student->pend_ibu);
            $sheet->setCellValue('AF' . $column, $user->student->pekerjaan_ibu);
            $sheet->setCellValue('AG' . $column, $user->student->penghasilan_ibu);
            $sheet->setCellValue('AH' . $column, $user->student->tinggi_badan);
            $sheet->setCellValue('AI' . $column, $user->student->berat_badan);
            $sheet->setCellValue('AJ' . $column, $user->student->jarak);
            $sheet->setCellValue('AK' . $column, $user->student->waktu);
            $sheet->setCellValue('AL' . $column, $user->student->jumlah_saudara);
            $sheet->setCellValue('AL' . $column, $user->student->valid);
            $column++;
        }
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);
        $sheet->getColumnDimension('T')->setAutoSize(true);
        $sheet->getColumnDimension('U')->setAutoSize(true);
        $sheet->getColumnDimension('V')->setAutoSize(true);
        $sheet->getColumnDimension('W')->setAutoSize(true);
        $sheet->getColumnDimension('X')->setAutoSize(true);
        $sheet->getColumnDimension('Y')->setAutoSize(true);
        $sheet->getColumnDimension('Z')->setAutoSize(true);
        $sheet->getColumnDimension('AA')->setAutoSize(true);
        $sheet->getColumnDimension('AB')->setAutoSize(true);
        $sheet->getColumnDimension('AC')->setAutoSize(true);
        $sheet->getColumnDimension('AD')->setAutoSize(true);
        $sheet->getColumnDimension('AE')->setAutoSize(true);
        $sheet->getColumnDimension('AF')->setAutoSize(true);
        $sheet->getColumnDimension('AG')->setAutoSize(true);
        $sheet->getColumnDimension('AH')->setAutoSize(true);
        $sheet->getColumnDimension('AI')->setAutoSize(true);
        $sheet->getColumnDimension('AJ')->setAutoSize(true);
        $sheet->getColumnDimension('AK')->setAutoSize(true);
        $sheet->getColumnDimension('AL')->setAutoSize(true);
        $sheet->getStyle('A1:AL1')->getFont()->setBold(true);
        $sheet->getStyle('A1:AL1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:AL1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');
        $sheet->setTitle("Laporan Data Siswa");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Validadi PPDB 2022.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

    }

}
