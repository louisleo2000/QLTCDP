<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('vaccines')->truncate();

        $vaccines = [
            ['Viêm gan B', 'tháng', '0-2', 'Vaccine viêm gan B cho trẻ sơ sinh từ 0 đến 2 tháng tuổi'],
            ['Lao', 'tháng', '2-8', 'Vaccine Lao cho trẻ em dưới 1 tuổi'],
            ['Bạch hầu', 'tháng', '2-8', 'Vaccine bạch hầu cho trẻ em dưới 1 tuổi'],
            ['Ho gà', 'tháng', '2-8', 'Vaccine ho gà cho trẻ em dưới 1 tuổi'],
            ['Uốn ván',  'tháng', '2-8', 'Vaccine uốn ván cho trẻ em dưới 1 tuổi'],
            ['Bại liệt', 'tháng', '2-8', 'Vaccine bại liệt cho trẻ em dưới 1 tuổi'],
        ];

        foreach ($vaccines as $vaccine) {
            DB::table('vaccines')->insert([
                'name' => $vaccine[0],
                'age_type' => $vaccine[1],
                'age_distance' => $vaccine[2],
                'description' => $vaccine[3],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
