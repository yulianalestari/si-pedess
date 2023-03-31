<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\pengurus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignkeyConstraints();
        pengurus::truncate();
        Schema::enableForeignkeyConstraints();

        $data = [
            ['nis' => '0890', 'nama' => 'Yuli', 'jurusan' => 'Multimedia'],
            ['nis' => '1001', 'nama' => 'Anggre', 'jurusan' => 'Multimedia'],
        ];

        foreach ($data as $value) {
            pengurus::insert([
                'nis' => $value['nis'],
                'nama' => $value['nama'],
                'jurusan' => $value['jurusan'],
            ]);
        }
    }
}
