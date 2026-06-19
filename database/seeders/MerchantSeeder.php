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

        /*
            SET FOREIGN_KEY_CHECKS = 0;

            TRUNCATE TABLE countries;

            SET FOREIGN_KEY_CHECKS = 1;

            DELETE FROM countries;

            ALTER TABLE countries AUTO_INCREMENT = 1;

            -- countries_seed.sql
            -- Exemple de script SQL pour réinsérer les pays
            -- Adapte ou complète la liste selon tes besoins.

            SET FOREIGN_KEY_CHECKS = 0;
            DELETE FROM countries;
            ALTER TABLE countries AUTO_INCREMENT = 1;
            SET FOREIGN_KEY_CHECKS = 1;

            INSERT INTO countries (id, name, name_en) VALUES
            (1, 'Congo Kinshasa', 'Democratic Republic of the Congo'),
            (2, 'Congo Brazzaville', 'Republic of the Congo'),
            (3, 'France', 'France'),
            (4, 'Belgique', 'Belgium'),
            (5, 'Gabon', 'Gabon'),
            (6, 'Afrique du Sud', 'South Africa'),
            (7, 'Canada', 'Canada'),
            (8, 'Etats Unis', 'United States'),
            (9, 'Luxembourg', 'Luxembourg'),
            (11, 'Allemagne', 'Germany'),
            (12, 'Espagne', 'Spain'),
            (13, 'Tchad', 'Chad'),
            (14, 'Burkina Faso', 'Burkina Faso'),
            (16, 'Japon', 'Japan'),
            (17, 'Italie', 'Italy'),
            (19, 'Corée du sud', 'South Korea'),
            (20, 'Corée du nord', 'North Korea'),
            (24, 'Libye', 'Libya'),
            (25, 'Mali', 'Mali'),
            (26, 'Kenya', 'Kenya'),
            (27, 'Ghana', 'Ghana'),
            (28, 'Cote d''Ivoire', 'Ivory Coast'),
            (29, 'Burundi', 'Burundi'),
            (30, 'Namibie', 'Namibia'),
            (31, 'Angola', 'Angola'),
            (32, 'Cameroun', 'Cameroon'),
            (33, 'République centrafricaine', 'Central African Republic'),
            (35, 'Botswana', 'Botswana'),
            (36, 'Benin', 'Benin'),
            (37, 'République de Guinée', 'Guinea'),
            (38, 'Djibouti', 'Djibouti'),
            (39, 'Algerie', 'Algeria'),
            (40, 'Egypte', 'Egypt'),
            (41, 'Guinée équatoriale', 'Equatorial Guinea'),
            (42, 'Ethiopie', 'Ethiopia'),
            (43, 'Guinée-Bissau', 'Guinea-Bissau'),
            (44, 'Gambie', 'Gambia'),
            (45, 'Madagascar', 'Madagascar'),
            (46, 'Niger', 'Niger'),
            (47, 'Nigeria', 'Nigeria'),
            (48, 'Sénégal', 'Senegal'),
            (49, 'Rwanda', 'Rwanda'),
            (50, 'Togo', 'Togo'),
            (52, 'Zambie', 'Zambia'),
            (53, 'Zimbabwe', 'Zimbabwe'),
            (54, 'Ouganda', 'Uganda'),
            (56, 'Tunisie', 'Tunisia'),
            (57, 'Union des Comores', 'Union of the Comoros'),
            (58, 'Émirats arabes unis', 'United Arab Emirates'),
            (59, 'Sultanat d''Oman', 'Oman'),
            (60, 'Royaume d''Arabie saoudite', 'Saudi Arabia'),
            (61, 'République du Yémen', 'Yemen'),
            (62, 'Royaume hachémite de Jordanie', 'Jordan'),
            (63, 'Maroc', 'Morocco'),
            (64, 'Liban', 'Lebanon'),
            (65, 'République de l''Inde', 'India'),
            (66, 'Chine', 'China'),
            (67, 'Papua New Guinea', 'Papua New Guinea'),
            (69, 'Eswatini', 'Eswatini'),
            (70, 'Érythrée', 'Eritrea'),
            (71, 'Lesotho', 'Lesotho'),
            (72, 'Comores', 'Comoros'),
            (73, 'Liberia', 'Liberia'),
            (74, 'République du Cap-Vert', 'Cape Verde'),
            (75, 'Guinée', 'Guinea'),
            (76, 'Maurice', 'Mauritius'),
            (77, 'Mauritanie', 'Mauritania'),
            (78, 'São Tomé-et-Principe', 'Sao Tome and Principe'),
            (80, 'Somalie', 'Somalia'),
            (81, 'Soudan', 'Sudan'),
            (82, 'Soudan du Sud', 'South Sudan'),
            (84, 'Tanzanie', 'Tanzania'),
            (85, 'Mozambique', 'Mozambique'),
            (86, 'Malawi', 'Malawi'),
            (87, 'Albanie', 'Albania'),
            (88, 'Andorre', 'Andorra'),
            (89, 'Autriche', 'Austria'),
            (90, 'Biélorussie', 'Belarus'),
            (91, 'Bosnie-Herzégovine', 'Bosnia and Herzegovina'),
            (92, 'Bulgarie', 'Bulgaria'),
            (93, 'Chypre', 'Cyprus'),
            (94, 'Croatie', 'Croatia'),
            (95, 'Danemark', 'Denmark'),
            (96, 'Estonie', 'Estonia'),
            (97, 'Finlande', 'Finland'),
            (98, 'Grèce', 'Greece'),
            (99, 'Hongrie', 'Hungary'),
            (100, 'Irlande', 'Ireland'),
            (101, 'Islande', 'Iceland'),
            (102, 'Liechtenstein', 'Liechtenstein'),
            (103, 'Lituanie', 'Lithuania'),
            (104, 'Macédoine', 'North Macedonia'),
            (105, 'Malte', 'Malta'),
            (106, 'Moldavie', 'Moldova'),
            (107, 'Monaco', 'Monaco'),
            (108, 'Monténégro', 'Montenegro'),
            (109, 'Norvège', 'Norway'),
            (110, 'Pays-Bas', 'Netherlands'),
            (111, 'Pologne', 'Poland'),
            (112, 'Portugal', 'Portugal'),
            (113, 'République tchèque', 'Czech Republic'),
            (114, 'Roumanie', 'Romania'),
            (115, 'Royaume-Uni', 'United Kingdom'),
            (116, 'Russie', 'Russia'),
            (117, 'Saint-Marin', 'San Marino'),
            (118, 'Serbie', 'Serbia'),
            (119, 'Slovaquie', 'Slovakia'),
            (120, 'Slovénie', 'Slovenia'),
            (121, 'Suède', 'Sweden'),
            (122, 'Suisse', 'Switzerland'),
            (123, 'Ukraine', 'Ukraine'),
            (124, 'Vatican', 'Vatican City'),
            (125, 'Afghanistan', 'Afghanistan'),
            (126, 'Arabie Saoudite', 'Saudi Arabia'),
            (127, 'Arménie', 'Armenia'),
            (128, 'Azerbaïdjan', 'Azerbaijan'),
            (129, 'Bahreïn', 'Bahrain'),
            (130, 'Bangladesh', 'Bangladesh'),
            (131, 'Bhoutan', 'Bhutan'),
            (132, 'Birmanie', 'Myanmar'),
            (133, 'Brunei', 'Brunei'),
            (134, 'Cambodge', 'Cambodia'),
            (135, 'Géorgie', 'Georgia'),
            (136, 'Indonésie', 'Indonesia'),
            (137, 'Irak', 'Iraq'),
            (138, 'Iran', 'Iran'),
            (139, 'Israël', 'Israel'),
            (141, 'Jordanie', 'Jordan'),
            (142, 'Kazakhstan', 'Kazakhstan'),
            (143, 'Kirghizistan', 'Kyrgyzstan'),
            (144, 'Koweït', 'Kuwait'),
            (145, 'Laos', 'Laos'),
            (147, 'Malaisie', 'Malaysia'),
            (148, 'Maldives', 'Maldives'),
            (149, 'Mongolie', 'Mongolia'),
            (150, 'Népal', 'Nepal'),
            (151, 'Oman', 'Oman'),
            (152, 'Ouzbékistan', 'Uzbekistan'),
            (153, 'Palestine', 'Palestine'),
            (154, 'Pakistan', 'Pakistan'),
            (155, 'Philippines', 'Philippines'),
            (156, 'Qatar', 'Qatar'),
            (157, 'Singapour', 'Singapore'),
            (158, 'Sri Lanka', 'Sri Lanka'),
            (159, 'Syrie', 'Syria'),
            (160, 'Tadjikistan', 'Tajikistan'),
            (161, 'Thaïlande', 'Thailand'),
            (162, 'Timor oriental', 'East Timor'),
            (163, 'Turkménistan', 'Turkmenistan'),
            (165, 'Turquie', 'Turkey'),
            (166, 'Viêt Nam', 'Vietnam'),
            (168, 'Antigua-et-Barbuda', 'Antigua and Barbuda'),
            (169, 'Argentine', 'Argentina'),
            (177, 'Bahamas', 'Bahamas'),
            (178, 'Barbade', 'Barbados'),
            (179, 'Belize', 'Belize'),
            (180, 'Bolivie', 'Bolivia'),
            (181, 'Brésil', 'Brazil'),
            (183, 'Chili', 'Chile'),
            (184, 'Colombie', 'Colombia'),
            (185, 'Costa Rica', 'Costa Rica'),
            (186, 'Cuba', 'Cuba'),
            (187, 'République Dominicaine', 'Dominican Republic'),
            (188, 'Dominique', 'Dominica'),
            (189, 'Équateur', 'Ecuador'),
            (191, 'Grenade', 'Grenada'),
            (192, 'Guatemala', 'Guatemala'),
            (193, 'Guyana', 'Guyana'),
            (194, 'Haïti', 'Haiti'),
            (196, 'Honduras', 'Honduras'),
            (197, 'Jamaïque', 'Jamaica'),
            (198, 'Mexique', 'Mexico'),
            (199, 'Nicaragua', 'Nicaragua'),
            (200, 'Panama', 'Panama'),
            (201, 'Paraguay', 'Paraguay'),
            (202, 'Pérou', 'Peru'),
            (203, 'Saint-Kitts-et-Nevis', 'Saint Kitts and Nevis'),
            (204, 'Saint-Vincent-et-les-Grenadines', 'Saint Vincent and the Grenadines'),
            (205, 'Sainte-Lucie', 'Saint Lucia'),
            (206, 'Salvador', 'El Salvador'),
            (207, 'Suriname', 'Suriname'),
            (208, 'Trinité-et-Tobago', 'Trinidad and Tobago'),
            (209, 'Uruguay', 'Uruguay'),
            (210, 'Venezuela', 'Venezuela'),
            (211, 'Australie', 'Australia'),
            (212, 'Îles Cook', 'Cook Islands'),
            (213, 'Fidji', 'Fiji'),
            (214, 'Kiribati', 'Kiribati'),
            (215, 'Îles Marshall', 'Marshall Islands'),
            (216, 'Micronésie', 'Micronesia'),
            (217, 'Nauru', 'Nauru'),
            (218, 'Niue', 'Niue'),
            (219, 'Nouvelle-Zélande', 'New Zealand'),
            (220, 'Palaos', 'Palau'),
            (221, 'Salomon', 'Solomon Islands'),
            (222, 'Samoa', 'Samoa'),
            (223, 'Tonga', 'Tonga'),
            (225, 'Tuvalu', 'Tuvalu'),
            (226, 'Vanuatu', 'Vanuatu');
        */
    }
}
