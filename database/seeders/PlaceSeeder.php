<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = [
            [
                'name' => 'SANTIKA',
                'price' => 0,
                'address' => 'Jalan Letjen Sutoyo Nomor 79 Malang 65141',
                'longitude' => '112.63694223137537',
                'latitude' => '-7.958046135052048',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '+62341-405405',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'TUGU PARK',
                'price' => 0,
                'address' => 'Jalan Tugu Nomor 3 Malang',
                'longitude' => '112.63340571205534',
                'latitude' => '-7.977226719199643',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '+62341-363891',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GAJAHMADA GRAHA',
                'price' => 0,
                'address' => 'Jalan Dr. Cipto 17 Malang',
                'longitude' => '112.63597485438537',
                'latitude' => '-7.968741218544407',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GRAHA CAKRA',
                'price' => 0,
                'address' => 'Jalan Cerme 16 Malang',
                'longitude' => '112.6252136120554',
                'latitude' => '-7.969759064083942',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '+62341-326989',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GRAND PALACE',
                'price' => 0,
                'address' => 'Jalan Ade Irma Suryani 23 Malang',
                'longitude' => '112.62927695438546',
                'latitude' => '-7.984630497822733',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '+62341-332900',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KARTIKA GRAHA',
                'price' => 0,
                'address' => 'Jalan Jakgung Suprapto 17 Malang',
                'longitude' => '112.63022226791806',
                'latitude' => '-7.973133241629165',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '+62341 - 361900',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'REGENT\'S PARK',
                'price' => 0,
                'address' => 'Jalan Jakgung Suprapto 12 - 17 Malang',
                'longitude' => '112.63277429671541',
                'latitude' => '-7.969588389181105',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '+62341-363388',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MONTANA I',
                'price' => 0,
                'address' => 'Jalan Kahuripan 9 Malang',
                'longitude' => '112.63286535254063',
                'latitude' => '-7.9768477685377075',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '+62341-328370',
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'RICHE',
                'price' => 0,
                'address' => 'Jalan Basuki Rachmad 1',
                'longitude' => '112.63029434089049',
                'latitude' => '-7.981120771455829',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '+62341-326950',
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SPLENDID INN',
                'price' => 0,
                'address' => 'Jalan Majapahit 2 - 4 Malang',
                'longitude' => '112.63320599487058',
                'latitude' => '-7.97737509402992',
                'operational_start' => '08:00:00',
                'operational_end' => '22:00:00',
                'telephone' => '+62341-366860',
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Place::insert($places);
    }
}
