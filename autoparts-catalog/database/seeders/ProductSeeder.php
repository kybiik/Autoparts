<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Отримуємо категорії
        $akumulyatory = Category::where('slug', 'akumulyatory')->first();
        $lampochky = Category::where('slug', 'lampochky')->first();
        $elektryka = Category::where('slug', 'elektryka')->first();
        $aksesuary = Category::where('slug', 'aksesuary')->first();
        $zapobizhnyky = Category::where('slug', 'zapobizhnyky')->first();
        $provodka = Category::where('slug', 'provodka')->first();

        $products = [
            // Акумулятори
            [
                'category_id' => $akumulyatory->id,
                'name' => 'Акумулятор Varta Blue Dynamic 60Ah',
                'slug' => 'akumulyator-varta-blue-dynamic-60ah',
                'description' => 'Надійний акумулятор Varta Blue Dynamic з ємністю 60Ah. Ідеально підходить для легкових автомобілів середнього класу. Забезпечує стабільний пуск двигуна навіть у холодну погоду.',
                'specifications' => 'Ємність: 60Ah\nПусковий струм: 540A\nНапруга: 12V\nПолярність: права\nРозміри: 242x175x190 мм',
                'sku' => 'VARTA-BD-60',
                'price' => 2850.00,
                'old_price' => 3200.00,
                'stock' => 15,
                'manufacturer' => 'Varta',
                'country' => 'Німеччина',
                'warranty' => '24 місяці',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $akumulyatory->id,
                'name' => 'Акумулятор Bosch S4 74Ah',
                'slug' => 'akumulyator-bosch-s4-74ah',
                'description' => 'Потужний акумулятор Bosch S4 з підвищеною ємністю 74Ah. Відмінний вибір для автомобілів з великою кількістю електроприладів.',
                'specifications' => 'Ємність: 74Ah\nПусковий струм: 680A\nНапруга: 12V\nПолярність: права\nРозміри: 278x175x190 мм',
                'sku' => 'BOSCH-S4-74',
                'price' => 3450.00,
                'stock' => 10,
                'manufacturer' => 'Bosch',
                'country' => 'Німеччина',
                'warranty' => '24 місяці',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $akumulyatory->id,
                'name' => 'Акумулятор Mutlu SFB 55Ah',
                'slug' => 'akumulyator-mutlu-sfb-55ah',
                'description' => 'Якісний турецький акумулятор Mutlu SFB. Оптимальне співвідношення ціни та якості для компактних автомобілів.',
                'specifications' => 'Ємність: 55Ah\nПусковий струм: 500A\nНапруга: 12V\nПолярність: права\nРозміри: 242x175x190 мм',
                'sku' => 'MUTLU-SFB-55',
                'price' => 2350.00,
                'stock' => 20,
                'manufacturer' => 'Mutlu',
                'country' => 'Туреччина',
                'warranty' => '18 місяців',
                'is_active' => true,
            ],

            // Лампочки
            [
                'category_id' => $lampochky->id,
                'name' => 'Лампа галогенова Philips H7 12V 55W',
                'slug' => 'lampa-galogenova-philips-h7',
                'description' => 'Стандартна галогенова лампа Philips для фар ближнього/дальнього світла. Надійне та яскраве освітлення дороги.',
                'specifications' => 'Тип цоколя: H7\nНапруга: 12V\nПотужність: 55W\nСвітловий потік: 1500 лм\nТемпература: 3200K',
                'sku' => 'PHILIPS-H7-STD',
                'price' => 185.00,
                'stock' => 50,
                'manufacturer' => 'Philips',
                'country' => 'Нідерланди',
                'warranty' => '6 місяців',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $lampochky->id,
                'name' => 'Лампа LED Osram H4 12V 20W',
                'slug' => 'lampa-led-osram-h4',
                'description' => 'Сучасна світлодіодна лампа Osram H4. Яскраве біле світло та довгий термін служби. Економить електроенергію автомобіля.',
                'specifications' => 'Тип цоколя: H4\nНапруга: 12V\nПотужність: 20W\nСвітловий потік: 2500 лм\nТемпература: 6000K',
                'sku' => 'OSRAM-LED-H4',
                'price' => 850.00,
                'old_price' => 950.00,
                'stock' => 25,
                'manufacturer' => 'Osram',
                'country' => 'Німеччина',
                'warranty' => '12 місяців',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $lampochky->id,
                'name' => 'Лампа ксенонова D2S 35W 4300K',
                'slug' => 'lampa-ksenonova-d2s-35w',
                'description' => 'Ксенонова лампа D2S з теплим білим світлом. Забезпечує потужне освітлення та довгий термін експлуатації.',
                'specifications' => 'Тип цоколя: D2S\nНапруга: 85V\nПотужність: 35W\nСвітловий потік: 3200 лм\nТемпература: 4300K',
                'sku' => 'XENON-D2S-4300',
                'price' => 1250.00,
                'stock' => 12,
                'manufacturer' => 'Philips',
                'country' => 'Нідерланди',
                'warranty' => '12 місяців',
                'is_active' => true,
            ],

            // Електрика
            [
                'category_id' => $elektryka->id,
                'name' => 'Стартер Bosch 1.4 кВт',
                'slug' => 'starter-bosch-1-4-kvt',
                'description' => 'Якісний стартер Bosch потужністю 1.4 кВт. Підходить для більшості легкових автомобілів з бензиновим двигуном.',
                'specifications' => 'Потужність: 1.4 кВт\nНапруга: 12V\nКількість зубів: 9\nНапрямок обертання: за годинниковою\nВага: 3.5 кг',
                'sku' => 'BOSCH-STARTER-14',
                'price' => 4500.00,
                'stock' => 8,
                'manufacturer' => 'Bosch',
                'country' => 'Німеччина',
                'warranty' => '24 місяці',
                'is_active' => true,
            ],
            [
                'category_id' => $elektryka->id,
                'name' => 'Генератор Valeo 90A',
                'slug' => 'generator-valeo-90a',
                'description' => 'Надійний генератор Valeo з силою струму 90A. Забезпечує стабільне живлення всіх електросистем автомобіля.',
                'specifications' => 'Сила струму: 90A\nНапруга: 14V\nКількість проводів: 3\nДіаметр шківа: 55 мм\nВага: 5.2 кг',
                'sku' => 'VALEO-GEN-90',
                'price' => 5200.00,
                'old_price' => 5800.00,
                'stock' => 6,
                'manufacturer' => 'Valeo',
                'country' => 'Франція',
                'warranty' => '24 місяці',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $elektryka->id,
                'name' => 'Датчик кисню (лямбда-зонд) Bosch',
                'slug' => 'datchyk-kysnju-bosch',
                'description' => 'Оригінальний датчик кисню Bosch. Контролює склад вихлопних газів та забезпечує оптимальну роботу двигуна.',
                'specifications' => 'Тип: універсальний\nКількість проводів: 4\nДовжина кабелю: 450 мм\nРобоча температура: -40°C до +850°C',
                'sku' => 'BOSCH-LAMBDA',
                'price' => 1850.00,
                'stock' => 15,
                'manufacturer' => 'Bosch',
                'country' => 'Німеччина',
                'warranty' => '12 місяців',
                'is_active' => true,
            ],

            // Аксесуари
            [
                'category_id' => $aksesuary->id,
                'name' => 'Зарядний пристрій для акумулятора 12V',
                'slug' => 'zaryadnyj-prystrij-12v',
                'description' => 'Інтелектуальний зарядний пристрій для автомобільних акумуляторів. Автоматично визначає стан батареї та підбирає оптимальний режим зарядки.',
                'specifications' => 'Напруга: 12V\nСила струму: 6A\nЄмність АКБ: 20-120 Ah\nРежими: звичайний, швидкий, відновлення\nЗахист від перезарядки',
                'sku' => 'CHARGER-12V-6A',
                'price' => 1450.00,
                'stock' => 18,
                'manufacturer' => 'Ring',
                'country' => 'Великобританія',
                'warranty' => '12 місяців',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $aksesuary->id,
                'name' => 'USB зарядка подвійна 12V 3.1A',
                'slug' => 'usb-zaryadka-podvijna',
                'description' => 'Компактна подвійна USB зарядка в прикурювач. Швидка зарядка двох пристроїв одночасно.',
                'specifications' => 'Напруга входу: 12-24V\nВихід USB 1: 5V 2.1A\nВихід USB 2: 5V 1A\nМатеріал: алюміній\nРозміри: 25x25x70 мм',
                'sku' => 'USB-DUAL-31A',
                'price' => 250.00,
                'stock' => 40,
                'manufacturer' => 'Hama',
                'country' => 'Німеччина',
                'warranty' => '6 місяців',
                'is_active' => true,
            ],
            [
                'category_id' => $aksesuary->id,
                'name' => 'Відеореєстратор Full HD 1080p',
                'slug' => 'videorejestrator-full-hd',
                'description' => 'Автомобільний відеореєстратор з записом у якості Full HD. Широкий кут огляду 170 градусів. Нічний режим зйомки.',
                'specifications' => 'Роздільна здатність: 1920x1080\nКут огляду: 170°\nЕкран: 3 дюйми\nПам\'ять: до 32GB\nG-сенсор, датчик руху',
                'sku' => 'DASH-CAM-FHD',
                'price' => 1850.00,
                'old_price' => 2100.00,
                'stock' => 22,
                'manufacturer' => 'Xiaomi',
                'country' => 'Китай',
                'warranty' => '12 місяців',
                'is_active' => true,
            ],

            // Запобіжники
            [
                'category_id' => $zapobizhnyky->id,
                'name' => 'Набір автомобільних запобіжників 120 шт',
                'slug' => 'nabir-zapobizhnykiv-120',
                'description' => 'Універсальний набір плавких запобіжників різних номіналів. Підходить для більшості легкових автомобілів.',
                'specifications' => 'Тип: ножовий (mini, standard, maxi)\nНомінали: 5A, 7.5A, 10A, 15A, 20A, 25A, 30A\nКількість: 120 шт\nУпаковка: пластикова коробка',
                'sku' => 'FUSE-SET-120',
                'price' => 350.00,
                'stock' => 30,
                'manufacturer' => 'Hella',
                'country' => 'Німеччина',
                'warranty' => '-',
                'is_active' => true,
            ],
            [
                'category_id' => $zapobizhnyky->id,
                'name' => 'Блок запобіжників універсальний 8-місний',
                'slug' => 'blok-zapobizhnykiv-8',
                'description' => 'Додатковий блок запобіжників для встановлення додаткового обладнання. Вологозахищений корпус.',
                'specifications' => 'Кількість місць: 8\nМаксимальний струм: 30A\nЗахист: IP65\nМатеріал: ABS пластик\nКомплект: з проводами',
                'sku' => 'FUSE-BOX-8',
                'price' => 450.00,
                'stock' => 12,
                'manufacturer' => 'Carpoint',
                'country' => 'Нідерланди',
                'warranty' => '12 місяців',
                'is_active' => true,
            ],

            // Проводка
            [
                'category_id' => $provodka->id,
                'name' => 'Комплект проводів для підключення сабвуфера',
                'slug' => 'provody-dlya-sabvufera',
                'description' => 'Повний комплект проводів та аксесуарів для підключення автомобільного підсилювача та сабвуфера.',
                'specifications' => 'Перетин силового кабелю: 8 AWG (8 мм²)\nДовжина силового: 5 м\nДовжина міжблочного: 5 м\nДодатково: запобіжник 60A, кріплення',
                'sku' => 'WIRE-KIT-SUB',
                'price' => 850.00,
                'stock' => 14,
                'manufacturer' => 'Kicx',
                'country' => 'Корея',
                'warranty' => '12 місяців',
                'is_active' => true,
            ],
            [
                'category_id' => $provodka->id,
                'name' => 'Клеми акумуляторні латунні (пара)',
                'slug' => 'klemy-akumulyatorni',
                'description' => 'Якісні латунні клеми для підключення проводів до акумулятора. Надійний контакт та тривалий термін служби.',
                'specifications' => 'Матеріал: латунь\nПокриття: нікель\nДіаметр отвору: 17 мм\nМаксимальний струм: 500A\nКомплект: плюс і мінус',
                'sku' => 'CLAMP-BRASS',
                'price' => 180.00,
                'stock' => 45,
                'manufacturer' => 'Elegant',
                'country' => 'Україна',
                'warranty' => '6 місяців',
                'is_active' => true,
            ],
            [
                'category_id' => $provodka->id,
                'name' => 'Ізолента ПВХ чорна 19мм х 20м',
                'slug' => 'izolenta-pvh-chorna',
                'description' => 'Професійна ізоляційна стрічка для автомобільної проводки. Стійка до температур та вологи.',
                'specifications' => 'Ширина: 19 мм\nДовжина: 20 м\nМатеріал: ПВХ\nТемпература: -10°C до +80°C\nКолір: чорний',
                'sku' => 'TAPE-PVC-BLK',
                'price' => 45.00,
                'stock' => 100,
                'manufacturer' => '3M',
                'country' => 'США',
                'warranty' => '-',
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
