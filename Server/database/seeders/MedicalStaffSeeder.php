<?php

namespace Database\Seeders;

use App\Models\MedicalStaff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MedicalStaffSeeder extends Seeder
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
        MedicalStaff::truncate();
        Schema::enableForeignKeyConstraints();
        
        $users = [
            ['1', 'NV01', '225678924','Nữ', '0123456789', 'images/staff/staff01.jpg'],
            ['2', 'NV02', '225678924','Nam', '0123456789', 'images/staff/staff02.jpg'],
            ['3', 'NV03', '225678924','Nữ', '0123456789', 'images/staff/staff03.jpg'],
            ['4', 'NV04', '225678924','Nam', '0123456789', 'images/staff/staff04.jpg'],
            ['5', 'NV05', '225678924','Nữ', '0123456789', 'images/staff/staff05.jpg'],
            ['6', 'NV06', '225678924','Nam', '0123456789', 'images/staff/staff06.jpg'],
            ['7', 'NV07', '225678924','Nữ', '0123456789', 'images/staff/staff07.jpg'],
            ['8', 'NV08', '225678924','Nam', '0123456789', 'images/staff/staff08.jpg'],
            ['9', 'NV09', '225678924','Nữ', '0123456789', 'images/staff/staff09.jpg'],
            ['10', 'NV10', '225678924','Nam', '0123456789', 'images/staff/staff10.jpg'],
            ['11', 'NV11', '225678924','Nữ', '0123456789', 'images/staff/staff11.jpg'],
            ['12', 'NV12', '225678924','Nam', '0123456789', 'images/staff/staff12.jpg'],
            ['13', 'NV13', '225678924','Nữ', '0123456789', 'images/staff/staff13.jpg'],
            ['14', 'NV14', '225678924','Nam', '0123456789', 'images/staff/staff14.jpg'],
       ];
       foreach ($users as $user) {
        MedicalStaff::create([
            'user_id' => $user[0],
            'code_id' => $user[1],
            'citizen_id' => $user[2],
            'gender' => $user[3],
            'tel' => $user[4],
            'img' => $user[5],
           
        ]);
    }
        Schema::enableForeignKeyConstraints();
    }
}
