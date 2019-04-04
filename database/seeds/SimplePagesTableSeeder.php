<?php

use App\Models\SimplePage;
use Illuminate\Database\Seeder;

class SimplePagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $fakeText = <<<EOT
**Bold text.**

*Italic text.*

# Title 1
## Title 2
### Title 3
#### Title 4
##### Title 5
###### Title 6

> Quote.

Unordered list :
* Item 1.
* Item 2.

Ordered list :
1. Item 1.
2. Item 2.

[Link](http://www.google.com).
EOT;
        (new SimplePage)->create([
            'slug'        => 'terms-of-service',
            'url'         => Str::slug('CGU et mentions légales'),
            'title'       => 'CGU et mentions légales',
            'description' => $fakeText,
            'active'      => true,
        ]);
        (new SimplePage)->create([
            'slug'        => 'rgpd',
            'url'         => Str::slug('Charte de respect de la vie privée - RGPD'),
            'title'       => 'Charte de respect de la vie privée - RGPD',
            'description' => $fakeText,
            'active'      => true,
        ]);
    }
}
