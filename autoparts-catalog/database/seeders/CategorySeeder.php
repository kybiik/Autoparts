<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Акумулятори',
                'slug' => 'akumulyatory',
                'description' => 'Автомобільні акумуляторні батареї різних виробників та ємностей',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Лампочки',
                'slug' => 'lampochky',
                'description' => 'Галогенові, ксенонові та світлодіодні лампи для автомобілів',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Електрика',
                'slug' => 'elektryka',
                'description' => 'Стартери, генератори, датчики та інші електричні компоненти',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Аксесуари',
                'slug' => 'aksesuary',
                'description' => 'Автомобільні аксесуари та додаткове обладнання',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Запобіжники',
                'slug' => 'zapobizhnyky',
                'description' => 'Автомобільні запобіжники та блоки запобіжників',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Проводка',
                'slug' => 'provodka',
                'description' => 'Електричні дроти, коси проводки та з\'єднувачі',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
