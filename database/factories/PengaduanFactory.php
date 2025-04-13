<?php

namespace Database\Factories;

use App\Models\pengaduan;
use App\Models\pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengaduanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = pengaduan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenisOptions = ['pelayanan', 'fasilitas', 'dokter'];

        return [
            // If you have a Pasien factory, this will create a new Pasien and use its id.
            // Alternatively, replace this with a valid patient ID from your application.
            'Pasien_id' => pasien::factory(),

            'phone' => $this->faker->e164PhoneNumber,
            'jenisPengaduan' => $this->faker->randomElement($jenisOptions),
            'isiPengaduan' => $this->faker->paragraph,
            // Optionally, you can simulate an image file path by uncommenting the line below.
            // For testing purposes, you might leave it as null.
            'gambarPengaduan' => null,
        ];
    }
}
