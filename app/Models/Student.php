<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $guarded = [];
    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agama()
    {
        return ([
            'islam' => 'Islam',
            'kristen' => 'Kristen',
            'katolik' => 'Katolik',
            'hindu' => 'Hindu',
            'budha' => 'Budha',
            'konghucu' => 'Konghucu',
        ]);
    }

    public function jenis_kelamin()
    {
        return ([
            'laki-laki' => 'Laki-laki',
            'perempuan' => 'Perempuan',
        ]);
    }

    public function alat_transportasi()
    {
        return ([
            'jalan kaki' => 'Jalan kaki',
            'angkuta umum' => 'Angkutan umum',
            'ojek' => 'Ojek',
            'bus' => 'Bus',
            'sepeda motor' => 'Sepeda Motor',
            'mobil pribadi' => 'Mobil pribadi',
            'lainnya' => 'Lainnya',
        ]);

    }

    public function tinggal()
    {
        return ([
            'orang tua' => 'Orang tua',
            'kost' => 'Kost',
            'wali' => 'Wali',
            'pesantren' => 'Pesantren',
            'lainnya' => 'Lainnya',
        ]);
    }

    public function pendidikan()
    {
        return ([
            'tidak tamat sd/sederajat' => 'Tidak Tamat SD/Sederajat',
            'tamat sd/sederajat' => 'SD/Sederajat',
            'smp/sederajat' => 'SMP/Sederajat',
            'sma/sederajat' => 'SMA/Sederajat',
            'd1' => 'D1',
            'd2' => 'D2',
            'd3' => 'D3',
            'D-IV/S1' => 'D-IV/S1',
            's2' => 'S2',
            's3' => 'S3',
        ]);
    }

    public function pekerjaan()
    {
        return ([
            'tidak bekerja' => 'Tidak Bekerja',
            'buruh' => 'Buruh',
            'karyawan swasta' => 'Karyawan Swasta',
            'pedagang' => 'Pedagang',
            'pensiunan' => 'Pensiunan',
            'petani' => 'Petani',
            'peternak' => 'Peternak',
            'pns' => 'PNS/TNI/POLRI',
            'sudah meninggal' => 'Sudah Meninggal',
            'tki' => 'Tenaga Kerja Indonesia',
            'wirausaha' => 'Wirausaha',
        ]);

    }

    public function penghasilan()
    {
        return ([
            'kurang' => 'Kurang dari Rp. 500.000',
            '500' => 'Rp. 500.000 s/d Rp. 999.000',
            '1juta' => 'Rp. 1 jt s/d Rp 2jt',
            '2juta' => 'Rp. 2jt s/d Rp. 4 jt',
            '5juta' => 'Rp. 5 jt s/d Rp. 20 jt',
            'tidak berpenghasilan' => 'Tidak Berpenghasilan',
        ]);
    }

    public function baju()
    {
        return ([
            's' => 'S',
            'm' => 'M',
            'l' => 'L',
            'xl' => 'XL',
            'xxl' => 'XXL',
            '3xl' => '3XL',
        ]);
    }
}
