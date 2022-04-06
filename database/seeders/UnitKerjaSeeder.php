<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit_kerja')->insert([
            [
                'unit'  => 'Kepala BSN',
                'singkatan'   => 'Ka. BSN',
                'eselon_satu' => null
            ],
            [
                'unit'  => 'Sekretaris Utama',
                'singkatan'   => 'Sestama',
                'eselon_satu' => null
            ],
            [
                'unit'  => 'Inspektorat',
                'singkatan'   => 'Inspektorat',
                'eselon_satu' => 'Sestama'
            ],
            [
                'unit'  => 'Biro Perencanaan, Keuangan dan Umum',
                'singkatan'   => 'PKU',
                'eselon_satu' => 'Sestama'
            ],
            [
                'unit'  => 'Biro Sumber Daya Manusia, Organisasi dan Hukum',
                'singkatan'   => 'SDMOH',
                'eselon_satu' => 'Sestama'
            ],
            [
                'unit'  => 'Biro Hubungan Masyarakat, Kerja Sama dan Layanan Informasi',
                'singkatan'   => 'HKLI',
                'eselon_satu' => 'Sestama'
            ],
            [
                'unit'  => 'Pusat Data dan Sistem Informasi',
                'singkatan'   => 'Pusdatin',
                'eselon_satu' => 'Sestama'
            ],
            [
                'unit'  => 'Pusat Riset dan Pengembangan Sumber Daya Manusia',
                'singkatan'   => 'Pusrisbang',
                'eselon_satu' => 'Sestama'
            ],
            [
                'unit'  => 'Deputi Bidang Pengembangan Standar',
                'singkatan'   => 'Deputi PS',
                'eselon_satu' => null
            ],
            [
                'unit'  => 'Direktorat Pengembangan Standar Agro, Kimia, Kesehatan dan Halal',
                'singkatan'   => 'AKKH',
                'eselon_satu' => 'Deputi Pengembangan'
            ],
            [
                'unit'  => 'Direktorat Pengembangan Standar Mekanika, Energi, Elektroteknik, Transportasi dan Teknologi Informasi',
                'singkatan'   => 'MEETTI',
                'eselon_satu' => 'Deputi Pengembangan'
            ],
            [
                'unit'  => 'Direktorat Pengembangan Standar Infrastruktur, Penilaian Kesesuaian, Personal dan Ekonomi Kreatif',
                'singkatan'   => 'IPPE',
                'eselon_satu' => 'Deputi Pengembangan'
            ],
            [
                'unit'  => 'Deputi Bidang Penerapan Standar dan Penilaian Kesesuaian',
                'singkatan'   => 'Deputi P-SPK',
                'eselon_satu' => null
            ],
            [
                'unit'  => 'Direkorat Sistem Penerapan Standar dan Penilaian Kesesuaian',
                'singkatan'   => 'SPSPK',
                'eselon_satu' => 'Deputi Penerapan'
            ],
            [
                'unit'  => 'Direkorat Penguatan Penerapan Standar dan Penilaian Kesesuaian',
                'singkatan'   => 'PPSPK',
                'eselon_satu' => 'Deputi Penerapan'
            ],
            [
                'unit'  => 'Deputi Bidang Akreditasi',
                'singkatan'   => 'Deputi Akreditasi',
                'eselon_satu' => null
            ],
            [
                'unit'  => 'Direktorat Sistem dan Harmonisasi Akreditasi',
                'singkatan'   => 'SISHAR',
                'eselon_satu' => 'Deputi Akreditasi'
            ],
            [
                'unit'  => 'Direktorat Akreditasi Laboratorium',
                'singkatan'   => 'AL',
                'eselon_satu' => 'Deputi Akreditasi'
            ],
            [
                'unit'  => 'Direktorat Akreditasi Lembaga Inspeksi dan Lembaga Sertifikasi',
                'singkatan'   => 'ALIS',
                'eselon_satu' => 'Deputi Akreditasi'
            ],
            [
                'unit'  => 'Deputi Bidang Standar Nasional Satuan Ukuran',
                'singkatan'   => 'Deputi SNSU',
                'eselon_satu' => null
            ],
            [
                'unit'  => 'Direktorat Standar Nasional Satuan Ukuran Mekanika, Radiasi, dan Biologi',
                'singkatan'   => 'SNSU-MRB',
                'eselon_satu' => 'Deputi SNSU'
            ],
            [
                'unit'  => 'Direktorat Standar Nasional Satuan Ukuran Termoelektrik dan Kimia',
                'singkatan'   => 'SNSU-TK',
                'eselon_satu' => 'Deputi SNSU'
            ],
            [
                'unit'  => 'Kantor Layanan Teknis BSN - Riau',
                'singkatan'   => 'KLT-Riau',
                'eselon_satu' => 'KLT'
            ],
            [
                'unit'  => 'Kantor Layanan Teknis BSN - Sumatera Selatan',
                'singkatan'   => 'KLT-Sumsel',
                'eselon_satu' => 'KLT'
            ],
            [
                'unit'  => 'Kantor Layanan Teknis BSN - Jawa Barat',
                'singkatan'   => 'KLT-Jabar',
                'eselon_satu' => 'KLT'
            ],
            [
                'unit'  => 'Kantor Layanan Teknis BSN - Jawa Timur',
                'singkatan'   => 'KLT-Jatim',
                'eselon_satu' => 'KLT'
            ],
            [
                'unit'  => 'Kantor Layanan Teknis BSN - Sulawesi Selatan',
                'singkatan'   => 'KLT-Sulsel',
                'eselon_satu' => 'KLT'
            ]
        ]);
    }
}
