<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Shopping;

class ShoppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Truncate the shoppings table to start fresh
        DB::table('shoppings')->truncate(); 

        // Define the shopping items array
        $shoppings = [
            [
                'name' => 'Glory AK47',
                'director' => 'Rare Rust Skin',
                'poster' => 'photo/Glory AK47.jfif',
                'price' => 400,
            ],
            [
                'name' => 'Polymer MP5',
                'director' => 'Rare Rust Skin',
                'poster' => 'photo/Polymer MP5.jpg',
                'price' => 500,
            ],
            [
                'name' => 'Alien Rek SMG',
                'director' => 'Rare Rust Skin',
                'poster' => 'photo/Alien Rek SMG.jfif',
                'price' => 1000,
            ],
            [
                'name' => 'Punishment Mask',
                'director' => 'Rare Rust Skin',
                'poster' => 'photo/Punishment Mask.jpg',
                'price' => 699,
            ],
            [
                'name' => 'Big Grin Mask',
                'director' => 'Rare Rust Skin',
                'poster' => 'photo/Big Grin Mask.jpg',
                'price' => 649,
            ],
            [
                'name' => 'Fire Jacket',
                'director' => 'Rare Rust Skin',
                'poster' => 'photo/jacket.jpg',
                'price' => 649,
            ],
            [
                'name' => 'Metal Tree Door',
                'director' => 'Rare Rust Skin',
                'poster' => 'photo/Metal Tree Door.jpg',
                'price' => 100,
            ],
            [
                'name' => 'Neon Scrap Box',
                'director' => 'Rare Rust Skin',
                'poster' => 'photo/Scrap.png',
                'price' => 100,
            ],
            [
                'name' => 'Rust Base Building Skin | Frontier',
                'director' => 'Building Skin DLC',
                'poster' => 'photo/Frontier.jpg',
                'price' => 100,
            ],
        ];

        // Use updateOrInsert for each shopping item.
        foreach ($shoppings as $items) {
            DB::table('shoppings')->updateOrInsert(
                ['name' => $items['name']], // Unique field(s) to check
                $items // Data to insert if not exists
            );
        }
    }
}
