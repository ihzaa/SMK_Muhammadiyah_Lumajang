<?php

namespace Database\Seeders;

use App\Models\Master\FooterVideo as MasterFooterVideo;
use Illuminate\Database\Seeder;

class FooterVideo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterFooterVideo::create([
            'url' => '<iframe width="300" height="200" src="https://www.youtube.com/embed/R1Jv5CzwsUc"
                style="margin-top: 36px;margin-bottom: 36px;" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>'
        ]);
    }
}
