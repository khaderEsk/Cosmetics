<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'شامبو',
            'description' =>
            'طبیعي ٪100
                خالي من المواد الكیمیائیة والإضافات الضارة
                درجة حموضه غير مهيجه
                ناعم ومرطب
                مثالي للبشرة الحساس',
            'imageCenter' => 'assets/images/150Sh/150centerSh.jpg',
            'imageLeft' => 'assets/images/150Sh/150leftSh.jpg',
            'price' => 100,
            'point' => 10
        ]);
        Product::create([
            'name' => 'شامبو',
            'description' =>
            'طبیعي ٪100
                خالي من المواد الكیمیائیة والإضافات الضارة
                درجة حموضه غير مهيجه
                ناعم ومرطب
                مثالي للبشرة الحساس',
            'imageCenter' => 'assets/images/250Sh/250centerSh.jpg',
            'imageLeft' => 'assets/images/250Sh/250leftSh.jpg',
            'price' => 100,
            'point' => 10
        ]);

        Product::create([
            'name' => 'كلينزر',
            'description' =>
            'طبیعي ٪100
                خالي من المواد الكیمیائیة والإضافات الضارة
                درجة حموضه غير مهيجه
                مثالي للبشره الحساسة
                تنظيف فوري',
            'imageCenter' => 'assets/images/150Kl/150CenterKl.jpg',
            'imageLeft' => 'assets/images/150Kl/150LeftKl.jpg',
            'price' => 100,
            'point' => 10
        ]);
        Product::create([
            'name' => 'كلينزر',
            'description' =>
            'طبیعي ٪100
                خالي من المواد الكیمیائیة والإضافات الضارة
                درجة حموضه غير مهيجه
                مثالي للبشره الحساسة
                تنظيف فوري',
            'imageCenter' => 'assets/images/250Kl/250CenterKl.jpg',
            'imageLeft' => 'assets/images/250Kl/250LeftKl.jpg',
            'price' => 100,
            'point' => 10
        ]);

        Product::create([
            'name' => 'لوشن',
            'description' =>
            'طبیعي ٪100
            خالي من المواد الكیمیائیة والإضافات الضار
            درجة حموضه غير مهيجه
            ترطیب دائم
            ناعم ومرطب
            مثالي للبشره الحساس',
            'imageCenter' => 'assets/images/150Lo/150CenterLo.jpg',
            'imageLeft' => 'assets/images/150Lo/150LeftLo.jpg',
            'price' => 100,
            'point' => 10
        ]);
        Product::create([
            'name' => 'لوشن',
            'description' =>
            'طبیعي ٪100
            خالي من المواد الكیمیائیة والإضافات الضار
            درجة حموضه غير مهيجه
            ترطیب دائم
            ناعم ومرطب
            مثالي للبشره الحساس',
            'imageCenter' => 'assets/images/250Lo/250CenterLo.jpg',
            'imageLeft' => 'assets/images/250Lo/250LeftLo.jpg',
            'price' => 100,
            'point' => 10
        ]);
    }
}
