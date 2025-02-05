<?php

namespace Database\Seeders;

use App\Models\Phone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mobileModels = [
            ["model" => "iPhone 15 Pro Max"],
            ["model" => "iPhone 15 Pro"],
            ["model" => "iPhone 15"],
            ["model" => "iPhone 14 Pro Max"],
            ["model" => "iPhone 14"],
            ["model" => "Samsung Galaxy S24 Ultra"],
            ["model" => "Samsung Galaxy S24"],
            ["model" => "Samsung Galaxy Z Fold 5"],
            ["model" => "Samsung Galaxy Z Flip 5"],
            ["model" => "Samsung Galaxy A54"],
            ["model" => "OnePlus 12"],
            ["model" => "OnePlus 11"],
            ["model" => "OnePlus Nord 3"],
            ["model" => "Google Pixel 8 Pro"],
            ["model" => "Google Pixel 8"],
            ["model" => "Google Pixel 7a"],
            ["model" => "Xiaomi 14 Ultra"],
            ["model" => "Xiaomi 13 Pro"],
            ["model" => "Xiaomi Redmi Note 12 Pro"],
            ["model" => "Xiaomi Redmi Note 11"],
            ["model" => "Realme GT 5"],
            ["model" => "Realme 11 Pro+"],
            ["model" => "Realme 10"],
            ["model" => "Vivo X100 Pro"],
            ["model" => "Vivo V29 Pro"],
            ["model" => "Vivo Y100"],
            ["model" => "Oppo Find X6 Pro"],
            ["model" => "Oppo Reno 10 Pro+"],
            ["model" => "Oppo A78"],
            ["model" => "Asus ROG Phone 8"],
            ["model" => "Asus Zenfone 10"],
            ["model" => "Nothing Phone (2)"],
            ["model" => "Motorola Edge 40 Pro"],
            ["model" => "Motorola Razr 40 Ultra"],
            ["model" => "Sony Xperia 1 V"],
            ["model" => "Sony Xperia 5 V"],
            ["model" => "Huawei P60 Pro"],
            ["model" => "Huawei Mate 50 Pro"]
        ];

        Phone::insert($mobileModels);
    }
}
