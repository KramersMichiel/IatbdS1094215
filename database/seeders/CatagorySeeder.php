<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exclusive = array("electric","unpowered");
        $inclusive = array("diy","lawn","kitchen","pool","clothing");

        foreach($exclusive as $catagory){
            DB::table('catagories')->insert([
                "name" => $catagory,
                "type" => "exclusive",
            ]);
        }

        foreach($inclusive as $catagory){
            DB::table('catagories')->insert([
                "name" => $catagory,
                "type" => "inclusive",
            ]);
        }
    }
}
