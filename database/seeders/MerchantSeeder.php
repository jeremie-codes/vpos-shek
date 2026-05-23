<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Merchant;
use App\Models\MerchantUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MerchantSeeder extends Seeder
{
    /**
     * Exécute les insertions en base de données.
     */
    public function run(): void
    {
        // 1. Création d'un Marchand de test
        $merchant = Merchant::create([
            'code' => 'MCH-' . Str::upper(Str::random(5)),
            'shortcode' => 'FLX001',
            'flexsms_username' => 'admin_flex',
            'flexsms_password' => Hash::make('flexremit'), // Sécurisé [cite: 119]
        ]);

        // 2. Création d'un utilisateur pour ce marchand (pour tester la connexion)
        MerchantUser::create([
            'merchant_id' => $merchant->id, // Liaison avec le marchand [cite: 105, 112]
            'code' => 'USR-' . Str::upper(Str::random(5)),
            'name' => 'Jeremie Marchand',
            'email' => 'jrmmianda@example.com',
            'username' => 'marchand01', // Champ utilisé pour auth [cite: 150]
            'password' => Hash::make('password123'), // Identifiant de test
        ]);

        $this->command->info('Marchand et utilisateur de test créés avec succès !');
        $this->command->warn('Identifiants de connexion : marchand01 / password123');
    }
}
