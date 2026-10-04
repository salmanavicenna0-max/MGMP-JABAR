<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Struktur;

class StrukturSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [ 'name' => "Dr. Asep Totoh, SE., MM", 'role' => "Ketua", 'image' => "assets/struktur/Dr. Asep Totoh,SE.,MM.jpeg", 'education' => "S3 Manajemen, M.M.", 'unit' => "SMK Bakti Nusantara 666 Kab. Bandung", 'order_num' => 1 ],
            [ 'name' => "Iman Firmansyah, S.Pd", 'role' => "Sekretaris", 'image' => "assets/struktur/Iman Firmansyah,.S.Pd.jpeg", 'education' => "S1 Pendidikan, S.Pd.", 'unit' => "SMKN 4 Kota Bandung", 'order_num' => 2 ],
            [ 'name' => "Winny Febrianti, SE", 'role' => "Sekretaris", 'image' => "assets/struktur/Winny Febrianti,SE.jpeg", 'education' => "S1 Ekonomi, S.E.", 'unit' => "SMK Madani Bandung", 'order_num' => 3 ],
            [ 'name' => "Anni Supriatin S.Pd., M.M.Pd", 'role' => "Bendahara", 'image' => "assets/struktur/Anni Supriatin,S.Pd.,M.Pd.jpeg", 'education' => "S2 Manajemen Pendidikan, M.M.Pd.", 'unit' => "SMKN 1 Kota Badung", 'order_num' => 4 ],
            [ 'name' => "Anggita Septiani S.T.P., M.Pd", 'role' => "Bendahara", 'image' => "assets/struktur/Anggita Septiani,STP.,M.Pd.jpeg", 'education' => "S2 Pendidikan, M.Pd.", 'unit' => "SMKN 13 Kota Bandung", 'order_num' => 5 ],
            [ 'name' => "Dina Agustin, S.Pd", 'role' => "Bendahara", 'image' => "assets/struktur/Dina Agustin, S.E., Gr SMK MVP ARS INTR.jpeg", 'education' => "S1 Pendidikan, S.Pd.", 'unit' => "SMK MVP ARS Bandung", 'order_num' => 6 ],
            [ 'name' => "Drs. Sugiyo, MM", 'role' => "Kepala Bidang DIKLAT", 'image' => "assets/struktur/Sugiyo, S. Sos, MM.jpeg", 'education' => "S2 Manajemen, M.M.", 'unit' => "SMK ICB Cinta Teknika Bandung", 'order_num' => 7 ],
            [ 'name' => "Emma Mulyaningsih, S.Pd., MM", 'role' => "Kepala Bidang DIKLAT", 'image' => "assets/struktur/Emma Mulyaningsih,S.Pd. M.M..jpeg", 'education' => "S2 Manajemen, M.M.", 'unit' => "SMKN 2 Sukabumi", 'order_num' => 8 ],
            [ 'name' => "Dr. Deden Sukirman, SE., MM", 'role' => "Humas & Kerja Sama", 'image' => "assets/struktur/Dr. Deden Sukirman smkn 2 bdg .jpeg", 'education' => "S3 Manajemen, M.M.", 'unit' => "SMKN 2 Kota Bandung", 'order_num' => 9 ],
            [ 'name' => "Neni Dewi M, SP", 'role' => "Humas & Kerja Sama", 'image' => "assets/struktur/Neni Dewi.M, S.P.jpeg", 'education' => "S1 Pertanian, S.P.", 'unit' => "SMK PPN Tanjungsari", 'order_num' => 10 ],
            [ 'name' => "Yudi Hermawan MM", 'role' => "Kepala Bidang DIKLAT", 'image' => "", 'education' => "S2 Manajemen, M.M.", 'unit' => "SMK Plus Ashabulyamin Cianjur", 'order_num' => 11 ],
            [ 'name' => "Cempaka Dewi SE", 'role' => "Humas & Kerja Sama", 'image' => "", 'education' => "S1 Ekonomi, S.E.", 'unit' => "SMKN Padaherang Pangandaran", 'order_num' => 12 ],
            [ 'name' => "H. Aan Subhan, MM., MPd", 'role' => "Pengembangan Organisasi", 'image' => "", 'education' => "S2 Manajemen Pendidikan", 'unit' => "SMK Bina Putra Nusantara Tasikmalaya", 'order_num' => 13 ],
            [ 'name' => "Dadan Syarifudin, S.Pd", 'role' => "Pengembangan Organisasi", 'image' => "", 'education' => "S1 Pendidikan, S.Pd.", 'unit' => "SMKN 3 Kota Bandung", 'order_num' => 14 ],
        ];

        foreach ($data as $item) {
            Struktur::create($item);
        }
    }
}
