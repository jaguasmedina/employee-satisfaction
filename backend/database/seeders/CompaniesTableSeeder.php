<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name' => 'Apple Inc.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
            ],
            [
                'name' => 'Microsoft Corporation',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg',
            ],
            [
                'name' => 'Google LLC',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg',
            ],
            [
                'name' => 'Amazon.com, Inc.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg',
            ],
            [
                'name' => 'Facebook, Inc. (Meta Platforms, Inc.)',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Meta_Platforms_Logo.svg',
            ],
            [
                'name' => 'Tesla, Inc.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/e/e8/Tesla_Motors_logo.png',
            ],
            [
                'name' => 'IBM Corporation',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/5/51/IBM_logo.svg',
            ],
            [
                'name' => 'Intel Corporation',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/e/e8/Intel_logo_2020.svg',
            ],
            [
                'name' => 'Netflix, Inc.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_Logo.svg',
            ],
            [
                'name' => 'Adobe Inc.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/a4/Adobe_Corporate_Logo.png',
            ],
        ]);
    }
}
