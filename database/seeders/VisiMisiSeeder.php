<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VisiMisi;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        VisiMisi::truncate();

        $visiMisiData = [
            // VISI
            [
                'type' => VisiMisi::TYPE_VISI,
                'title' => 'Visi Dinas Perumahan dan Permukiman',
                'content' => 'Terwujudnya perumahan dan permukiman yang layak huni, berkelanjutan, dan terjangkau bagi seluruh masyarakat menuju kehidupan yang sejahtera dan bermartabat.',
                'description' => null,
                'icon' => null,
                'color_class' => null,
                'order_position' => 1,
                'is_active' => true,
            ],

            // MISI
            [
                'type' => VisiMisi::TYPE_MISI,
                'title' => 'Misi 1',
                'content' => 'Menyelenggarakan perencanaan dan pembangunan perumahan yang berkualitas, terjangkau, dan berkelanjutan',
                'description' => null,
                'icon' => null,
                'color_class' => null,
                'order_position' => 1,
                'is_active' => true,
            ],
            [
                'type' => VisiMisi::TYPE_MISI,
                'title' => 'Misi 2',
                'content' => 'Mengembangkan kawasan permukiman yang layak huni dengan infrastruktur yang memadai dan berwawasan lingkungan',
                'description' => null,
                'icon' => null,
                'color_class' => null,
                'order_position' => 2,
                'is_active' => true,
            ],
            [
                'type' => VisiMisi::TYPE_MISI,
                'title' => 'Misi 3',
                'content' => 'Memberikan pelayanan prima dalam bidang pertanahan untuk menjamin kepastian hukum kepemilikan tanah',
                'description' => null,
                'icon' => null,
                'color_class' => null,
                'order_position' => 3,
                'is_active' => true,
            ],
            [
                'type' => VisiMisi::TYPE_MISI,
                'title' => 'Misi 4',
                'content' => 'Melakukan pembinaan dan pengawasan terhadap pembangunan perumahan dan permukiman sesuai standar yang ditetapkan',
                'description' => null,
                'icon' => null,
                'color_class' => null,
                'order_position' => 4,
                'is_active' => true,
            ],
            [
                'type' => VisiMisi::TYPE_MISI,
                'title' => 'Misi 5',
                'content' => 'Meningkatkan kapasitas kelembagaan dan sumber daya manusia untuk memberikan pelayanan yang profesional dan transparan',
                'description' => null,
                'icon' => null,
                'color_class' => null,
                'order_position' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($visiMisiData as $data) {
            VisiMisi::create($data);
        }

        $this->command->info('VisiMisi seeder completed successfully!');
        $this->command->info('Created ' . count($visiMisiData) . ' visi misi items.');
    }
}
