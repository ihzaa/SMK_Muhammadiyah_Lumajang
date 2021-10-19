<?php

namespace Database\Seeders;

use App\Models\Master\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::create([
            'img_path' => 'assets/images/picture.svg',
            'body' => '<p>Halaman About Us</p>'
        ]);
    }
}
