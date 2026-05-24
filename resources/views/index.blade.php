<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flexpaie - Vpos</title>
    {{-- Icons --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('img/card/icon-r.png') }}">

    <!-- Tailwind CSS v3 via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f5ff',
                            100: '#e0ebff',
                            650: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- FontAwesome v6 pour les icônes professionnelles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            font-size: 14px;
        }

        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        /* Personnalisation de l'affichage de la méthode sélectionnée */
        .option-card-radio:checked+.option-card-label {
            border-color: #2563eb;
            background-color: #f8faff;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.08);
        }

        .option-card-radio:checked+.option-card-label .radio-custom-dot {
            border-color: #2563eb;
            background-color: #2563eb;
            box-shadow: inset 0 0 0 3px #ffffff;
        }

        .operator-radio:checked+.operator-label {
            border-color: #10b981;
            background-color: #f0fdf4;
            transform: scale(1.02);
        }

        /* Masquage des sections conditionnelles en fonction des validations */
        .dynamic-view-panel {
            display: none;
            animation: paneFadeIn 0.3s ease-out forwards;
        }

        .dynamic-view-panel.active {
            display: block;
        }

        @keyframes paneFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 bg-slate-50 text-slate-100 md:p-8">

    <div class="grid w-full max-w-6xl grid-cols-1 overflow-hidden gap-x-4 text-slate-800 lg:grid-cols-12">

        <!-- COLONNE GAUCHE (ILLUSTRATION, CONFIANCE & STATUTS SECURE) -->
        <div
            class="relative flex flex-col justify-between p-8 mb-2 overflow-hidden text-white border shadow-md lg:col-span-5 bg-slate-950 md:p-10 shadow-slate-200 rounded-3xl">
            <!-- Arrière-plan stylisé -->
            <div
                class="absolute inset-0 bg-gradient-to-br border border-slate-white from-slate-950 via-[#0d1630] to-slate-950 z-0">
            </div>
            <div class="absolute top-0 z-0 rounded-full -left-10 w-80 h-80 bg-blue-600/10 blur-3xl"></div>
            <div class="absolute bottom-0 z-0 rounded-full -right-10 w-80 h-80 bg-indigo-600/10 blur-3xl"></div>

            <div class="relative z-10 dynamic-view-panel active">
                <!-- Organisation Header -->
                 <div class="flex items-center justify-center md:items-start md:justify-start gap-3 mb-4">
                    <img src="{{ asset('img/shek.png') }}" alt="icon" class="h-24 w-42">
                </div>

                <h2 class="text-center md:text-left mt-6 text-2xl font-semibold leading-tight tracking-tight text-white md:text-3xl font-outfit">
                    Dons pour la reconstruction
                    {{-- Contribuez activement aux activités de la communauté Shekinah. --}}
                </h2>
                <p class="text-center md:text-left mt-4 text-sm leading-relaxed text-slate-300">
                    Soutenez activement les activités en quelques clics avec VPOS-Flexpaie en toute sécurité.
                </p>
            </div>

            <!-- Trust Badge Section at bottom -->
            <div class="relative z-10 mt-10 filter dynamic-view-panel active">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <a href="https://www.flexpaie.com" target="_blank" class="inline-flex items-center gap-2">
                        <span
                            class="flex items-center justify-center h-10 gap-2 px-5 text-blue-400 border rounded-xl bg-blue-600/20 border-blue-500/30">
                            <img src="{{ asset('img/card/icon-r.png') }}" alt="icon" class="w-6 h-6">
                            <img src="{{ asset('img/card/logo.png') }}" alt="Flexpaie Logo" class="w-24 h-auto -ml-1">
                        </span>
                    </a>
                </div>

                <div class="h-px bg-slate-800/60"></div>
                <p class="text-white text-center gap-1.5 my-3">
                    Méthodes de paiement disponible
                </p>

                <div class="flex items-center gap-4 text-xs text-slate-700">
                    <img src="{{ asset('img/p-ways.png') }}" alt="SSL Secure"
                        class="w-full h-auto border rounded-md border-slate-700/50">
                </div>
            </div>
        </div>

        <!-- COLONNE DROITE (LE FORMULAIRE TECHNIQUE INTERACTIF) -->
        <div
            class="relative flex flex-col justify-between p-6 mb-2 bg-white border shadow-md lg:col-span-7 md:p-10 shadow-slate-200 rounded-3xl">
            <!-- Main Interactive Form -->
            <form id="donationForm" onsubmit="event.preventDefault(); simulateProcess();" class="space-y-6">

                <!-- STEP 1: Vos Coordonnées -->
                <div class="transition-all duration-300">
                    <h3 class="flex items-center gap-2 pb-2 mb-3 text-sm font-bold tracking-wider uppercase border-b text-slate-700 border-slate-100">
                        <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-800 text-[11px] font-bold flex items-center justify-center">1</span>
                        <span>Coordonnées du Donateur</span>
                    </h3>

                    <!-- CASE À COCHER : FAIRE UN DON ANONYME -->
                    <div class="mb-4 p-3 bg-slate-50 border border-slate-200 rounded-xl flex items-start gap-3 hover:bg-slate-100/70 transition-all">
                        <div class="flex items-center h-5">
                            <!-- Ajout du onclick pour l'action de masquage complet -->
                            <input id="anonymous_donation" type="checkbox" onchange="toggleAnonymousDonation(this.checked)"
                                class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500/30 focus:ring-2 transition-all cursor-pointer">
                        </div>
                       <div class="text-xs">
                            <label for="anonymous_donation" class="font-bold text-slate-700 cursor-pointer select-none">Contribuer de manière anonyme?</label>
                                <p class="text-slate-500 font-normal mt-0.5">Cochez cette case si vous ne souhaitez pas renseigner vos informations personnelles.</p>
                        </div>
                    </div>

                    <!-- CONTENEUR DES CHAMPS PERSONNELS (Masqué complètement si anonyme) -->
                    <div id="personal_fields_container" class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="dynamic-view-panel active">
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Prénom : <span class="text-red-500">*</span></label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-700">
                                    <i class="text-xs fa-regular fa-user"></i>
                                </div>
                                <input type="text" id="donor_name" required placeholder="Jean-Claude"
                                    class="block w-full pl-9 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                            </div>
                        </div>

                        <div class="dynamic-view-panel active">
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nom : <span class="text-red-500">*</span></label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-700">
                                    <i class="text-xs fa-regular fa-user"></i>
                                </div>
                                <input type="text" id="donor_last_name" required placeholder="Kabongo"
                                    class="block w-full pl-9 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                            </div>
                        </div>

                        <div class="dynamic-view-panel active">
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Adresse e-mail (optionnel) : </label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-700">
                                    <i class="text-xs fa-regular fa-envelope"></i>
                                </div>
                                <input type="email" id="donor_email" placeholder="jean.claude@gmail.com"
                                    class="block w-full pl-9 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                            </div>
                        </div>

                        <div class="dynamic-view-panel active">
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Organisation : <span class="text-red-500">*</span></label>
                            <div class="relative rounded-lg shadow-sm">
                                <select id="donor_org" required
                                    class="block w-full pl-9 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                                    <option value="">Choisir une organisation</option>
                                    <option value="CD">Shekinah</option>
                                    <option value="FR">Autres</option>
                                </select>
                            </div>
                        </div>

                        <div class="dynamic-view-panel active">
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Pays : <span class="text-red-500">*</span></label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-700">
                                    <i class="text-xs fa-solid fa-globe"></i>
                                </div>
                                <select id="donor_country" required
                                    class="block w-full pl-9 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                                    <option value="">Choisir un pays</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="dynamic-view-panel active">
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Ville : <span class="text-red-500">*</span></label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-700">
                                    <i class="text-xs fa-solid fa-globe"></i>
                                </div>
                                <input type="text" id="donor_city" required placeholder="Ville"
                                    class="block w-full pl-9 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: Montant du don -->
                <div>
                    <div class="flex items-center pb-2 mb-3 border-b border-slate-100 ">
                        <h3 class="flex items-center gap-2 text-sm font-bold tracking-wider uppercase text-slate-700">
                            <span
                                class="w-5 h-5 rounded-full bg-blue-100 text-blue-800 text-[11px] font-bold flex items-center justify-center">2</span>
                            <span>Définir le Montant</span>
                        </h3>
                    </div>

                    <div id="preset_amounts_container" class="grid grid-cols-5 gap-2 mb-3.5 ">
                        <button type="button" onclick="setPresetValue(10, this)"
                            class="p-1 text-sm font-semibold transition-all border preset-btn dynamic-view-panel active bg-slate-50 border-slate-200 rounded-xl hover:bg-slate-100">10
                            <span class="currency-label">$</span></button>
                        <button type="button" onclick="setPresetValue(25, this)"
                            class="p-1 text-sm font-semibold text-blue-800 transition-all border-blue-500 shadow-inner preset-btn dynamic-view-panel active bg-blue-50 rounded-xl ring-1 ring-blue-500/20">25
                            <span class="currency-label">$</span></button>
                        <button type="button" onclick="setPresetValue(50, this)"
                            class="p-1 text-sm font-semibold transition-all border preset-btn dynamic-view-panel active bg-slate-50 border-slate-200 rounded-xl hover:bg-slate-100">50
                            <span class="currency-label">$</span></button>
                        <button type="button" onclick="setPresetValue(100, this)"
                            class="p-1 text-sm font-semibold transition-all border preset-btn dynamic-view-panel active bg-slate-50 border-slate-200 rounded-xl hover:bg-slate-100">100
                            <span class="currency-label">$</span></button>
                        <button type="button" onclick="setPresetValue(250, this)"
                            class="p-1 text-sm font-semibold transition-all border preset-btn dynamic-view-panel active bg-slate-50 border-slate-200 rounded-xl hover:bg-slate-100">250
                            <span class="currency-label">$</span></button>
                    </div>

                    <div class="grid items-center grid-cols-3 gap-4">
                        <div class="col-span-2 dynamic-view-panel active">
                            <label id="amount_input_label" class="block mb-1 text-xs font-semibold text-slate-500">Ou
                                saisir un montant sur-mesure (<span class="currency-label">USD</span>)</label>
                            <div class="relative rounded-lg shadow-sm">
                                <div id="input_currency_sign"
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm font-bold pointer-events-none text-slate-500">
                                    $</div>
                                <input type="number" id="custom_amount_input" min="1"
                                    placeholder="Saisir le montant..." oninput="updateCustomAmountValue(this.value)"
                                    class="block w-full pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all"
                                    value="25">
                            </div>
                        </div>
                        <div class="dynamic-view-panel active">
                            <label for="currency_selector" class="text-xs font-bold text-slate-500">Devise :</label>
                            <select id="currency_selector" onchange="updateCurrency(this.value)"
                                class="block w-full pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                                <option value="USD">USD ($)</option>
                                <option value="CDF">CDF (FC)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: Moyen de Paiement -->
                <div>
                    <h3
                        class="flex items-center gap-2 pb-2 mb-3 text-sm font-bold tracking-wider uppercase border-b text-slate-700 border-slate-100">
                        <span
                            class="w-5 h-5 rounded-full bg-blue-100 text-blue-800 text-[11px] font-bold flex items-center justify-center">3</span>
                        <span>Moyen de paiement de confiance</span>
                    </h3>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <label class="relative block cursor-pointer dynamic-view-panel active">
                            <input type="radio" name="payment_method" value="mobile" checked
                                onclick="togglePaymentSection('mobile')" class="sr-only peer option-card-radio">
                            <div
                                class="option-card-label flex items-center justify-between p-3.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50/40">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex items-center justify-center text-blue-800 bg-blue-100 rounded-lg w-9 h-9">
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800">Mobile Money</p>
                                        <p class="text-[10.5px] text-slate-500 font-normal">M-pesa, Orange, Airtel</p>
                                    </div>
                                </div>
                                <div
                                    class="w-4.5 h-4.5 rounded-full border border-slate-300 flex items-center justify-center radio-custom-dot">
                                </div>
                            </div>
                        </label>

                        <label class="relative block cursor-pointer dynamic-view-panel active">
                            <input type="radio" name="payment_method" value="card"
                                onclick="togglePaymentSection('card')" class="sr-only peer option-card-radio">
                            <div
                                class="option-card-label flex items-center justify-between p-3.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50/40">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex items-center justify-center rounded-lg w-9 h-9 bg-slate-100 text-slate-600">
                                        <i class="fa-solid fa-credit-card"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800">Carte de crédit</p>
                                        <p class="text-[10.5px] text-slate-500 font-normal">Visa, Mastercard, etc.</p>
                                    </div>
                                </div>
                                <div
                                    class="w-4.5 h-4.5 rounded-full border border-slate-300 flex items-center justify-center radio-custom-dot">
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- SECTION CONDITIONNELLE : MOBILE MONEY -->
                <div id="section_mobile" class="dynamic-view-panel active">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Numéro de téléphone mobile :
                            <span class="text-red-500">*</span></label>
                        <div class="relative rounded-lg shadow-sm">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pr-2 text-xs font-bold border-r pointer-events-none text-slate-900 border-slate-200">
                                +243</div>
                            <input type="tel" id="mobile_phone" maxlength="9" required placeholder="812345678"
                                class="block w-full pl-16 pr-3 py-2.5 bg-white border border-slate-200 rounded-lg text-sm font-mono text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all">
                        </div>
                        <span class="block text-[10px] text-slate-700 mt-1">Saisir les 9 chiffres restants sans le
                            premier 0 (exemple : 812345678).</span>
                    </div>
                </div>

                <!-- SECTION CONDITIONNELLE : CARTE BANCAIRE -->
                <div id="section_card" class="dynamic-view-panel">
                    <div class="p-4 space-y-4 border border-blue-100 bg-blue-50 rounded-2xl md:p-5">
                        <p class="block mb-1 text-xs font-semibold text-slate-600">
                            Vous serez redirigé vers une page de paiement sécurisée pour saisir les détails de votre
                            carte bancaire (numéro, date d'expiration, CVV).
                        </p>
                    </div>
                </div>

                <!-- SUBMIT BUTTON AND SECURITY FOOTER -->
                <div class="pt-2">
                    <button type="submit" id="submit_donation_button"
                        class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 active:shadow-sm transform active:scale-[0.99] transition-all text-sm flex items-center justify-center gap-2">
                        <span>Confirmer <span id="display_amount_button">25</span> <span
                                id="display_currency_button">USD</span></span>
                    </button>
                </div>
            </form>
            <!-- SIMULATOR STATE OVERLAY -->
            <div id="simulator_modal"
                class="absolute inset-0 z-30 flex flex-col items-center justify-center hidden p-6 text-center bg-white/95 backdrop-blur-sm animate-fade-in">

                <!-- BLOC D'ÉTAT GLOBAL DU PAIEMENT (affiché hors loading) -->
                <div id="modal_status_view" class="flex-col items-center hidden">
                    <div id="status_icon_container"
                        class="flex items-center justify-center w-16 h-16 mb-3 text-2xl border rounded-full shadow-inner">
                        <i id="status_icon" class=""></i>
                    </div>
                    <!-- Correction : h4 ciblé correctement et ID corrigé -->
                    <h4 class="text-xl font-semibold text-slate-900 font-outfit" id="status_message_title">Don reçu
                        avec succès !</h4>

                    <!-- Séparation : Le texte général ne doit pas englober le span de montant pour éviter d'être écrasé -->
                    <p class="max-w-sm mt-2 text-xs leading-relaxed text-slate-500" id="status_message_text"></p>

                    <div
                        class="bg-slate-50 border border-slate-100 p-4 rounded-xl mt-5 w-full max-w-sm text-left font-mono text-[11px] text-slate-500 space-y-1.5 shadow-sm">
                        <p class="flex justify-between"><span>RÉFÉRENCE :</span> <span
                                class="font-bold text-slate-800" id="modal_receipt_ref">TXN-764923</span></p>
                        <p class="flex justify-between"><span>DONATEUR :</span> <span class="text-slate-800"
                                id="modal_receipt_donor">Jean-Claude</span></p>
                        <p class="flex justify-between"><span>CANAL :</span> <span class="text-slate-800"
                                id="modal_receipt_channel">Mobile Money M-PESA</span></p>
                        <p class="flex justify-between"><span>MONTANT :</span> <span class="font-bold text-blue-800"
                                id="modal_receipt_amount">0.00 $</span></p>
                        <p class="flex justify-between"><span>STATUT :</span> <span id="modal_receipt_status"
                                class="font-bold"><i class="fa-solid fa-circle text-[8px] mr-1"></i>VALIDÉ</span></p>
                    </div>
                    <button onclick="closeSimulatorModal()"
                        class="mt-6 px-6 py-2.5 bg-slate-900 text-white rounded-lg text-xs font-bold hover:bg-slate-800 transition-colors">
                        Faire une nouvelle transaction
                    </button>
                </div>

                <!-- TIMEOUT MODULE -->
                <div id="modal_timeout_view" class="flex-col items-center hidden">
                    <div class="mb-1 text-3xl font-bold text-amber-500">⏱</div>
                    <div class="text-base font-semibold text-red-500">Le délai de vérification a expiré</div>
                    <!-- Correction : Ajout de la classe "timeout-message" attendue par le JS et retrait du code template string brut -->
                    <p class="px-4 mt-2 text-xs timeout-message text-slate-500">
                        Vous n'avez pas validé la transaction à temps ou la confirmation de l'opérateur tarde à nous
                        parvenir.
                    </p>
                    <div class="flex flex-col w-full max-w-xs gap-2 pt-4 mx-auto">
                        <!-- Correction : Utilisation dynamique via variable globale dans le JS plutôt que l'injection brute dans le HTML -->
                        <button type="button" onclick="retryVerification()"
                            class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition-all bg-blue-600 border border-transparent shadow-sm rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fa-solid fa-rotate-right mr-2 mt-0.5"></i> Réessayer la vérification
                        </button>
                        <button type="button" onclick="closeSimulatorModal()"
                            class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium transition-all bg-white border shadow-sm rounded-xl border-slate-200 text-slate-600 hover:bg-slate-50">
                            Fermer la fenêtre
                        </button>
                    </div>
                </div>

                <!-- LOADING/PROCESSING MODULE -->
                <div id="modal_loading_view" class="flex flex-col items-center">
                    <div class="w-16 h-16 mb-3 border-4 rounded-full border-slate-200 border-t-blue-600 animate-spin">
                    </div>
                    <h4 class="font-bold text-md text-slate-900 font-outfit">Saisie PIN Mobile Money requise...</h4>
                    <p class="text-slate-500 text-xs max-w-sm mt-1.5 leading-relaxed">
                        Un push d'autorisation a été émis sur votre mobile. Saisissez votre code PIN secret sur le
                        téléphone pour valider le transfert.
                    </p>
                    <div id="loading_notice"
                        class="mt-4 bg-slate-50 animate-pulse text-[10px] text-slate-700 border border-slate-200 px-3.5 py-2 rounded-lg font-mono">
                        En attente de la réponse de l'opérateur...
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPT DE COMPORTEMENT EXÉCUTABLE DE LA PAGE -->
    <script>
        // Variables globales du formulaire
        let chosenPaymentAmount = 25;
        let activePaymentMethod = 'mobile';
        let chosenCurrency = 'USD';

        // Table de correspondance pour les symboles de devises
        const currencySymbols = {
            'USD': '$',
            'CDF': 'FC',
        };

        function toggleAnonymousDonation(isAnonymous) {
            const container = document.getElementById('personal_fields_container');
            const fieldsToToggle = [
                'donor_name',
                'donor_last_name',
                'donor_email',
                'donor_org',
                'donor_country',
                'donor_city'
            ];

            if (isAnonymous) {
                // 1. Cache complètement le conteneur et libère l'espace
                container.classList.add('hidden');

                // 2. Supprime l'attribut 'required' et vide les champs
                fieldsToToggle.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) {
                        el.removeAttribute('required');
                        el.value = ''; // Optionnel : nettoie le champ pour le back-end
                    }
                });
            } else {
                // 1. Réaffiche le conteneur
                container.classList.remove('hidden');

                // 2. Remet l'obligation de remplissage (sauf pour l'email qui est optionnel)
                fieldsToToggle.forEach(id => {
                    const el = document.getElementById(id);
                    if (el && id !== 'donor_email') {
                        el.setAttribute('required', 'required');
                    }
                });
            }
        }

        // Fonction pour mettre à jour la devise globalement et gérer l'affichage des boutons
        function updateCurrency(currency) {
            chosenCurrency = currency;

            const presetContainer = document.getElementById('preset_amounts_container');
            const inputLabel = document.getElementById('amount_input_label');

            if (currency === 'USD') {
                presetContainer.classList.remove('hidden');
                inputLabel.textContent = "Ou saisir un montant sur-mesure (USD)";
            } else {
                presetContainer.classList.add('hidden');
                inputLabel.textContent = "Saisir le montant de votre choix (" + currency + ")";
            }

            const labels = document.querySelectorAll('.currency-label');
            labels.forEach(label => {
                label.textContent = currency === 'USD' ? '$' : currency;
            });

            document.getElementById('input_currency_sign').textContent = currencySymbols[currency] || currency;
            updateSubmitButtonText();
        }

        // Initialiser le montant au chargement ou clic sur preset
        function setPresetValue(amount, buttonElement) {
            chosenPaymentAmount = amount;

            const buttons = document.querySelectorAll('.preset-btn');
            buttons.forEach(btn => {
                btn.className =
                    "preset-btn py-2.5 px-2 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 transition-all";
            });

            if (buttonElement) {
                buttonElement.className =
                    "preset-btn py-2.5 px-2 text-sm font-bold bg-blue-50 border-blue-500 text-blue-800 rounded-xl transition-all font-semibold shadow-inner ring-1 ring-blue-500/20";
            }

            document.getElementById('custom_amount_input').value = amount;
            updateSubmitButtonText();
        }

        // Gestion de l'input personnalisé
        function updateCustomAmountValue(value) {
            const amount = parseFloat(value);
            chosenPaymentAmount = isNaN(amount) || amount <= 0 ? 0 : amount;

            if (chosenCurrency === 'USD') {
                const presetAmounts = [10, 25, 50, 100, 250];
                const buttons = document.querySelectorAll('.preset-btn');

                buttons.forEach((btn, idx) => {
                    if (presetAmounts[idx] === chosenPaymentAmount) {
                        btn.className =
                            "preset-btn py-2.5 px-2 text-sm font-bold bg-blue-50 border-blue-500 text-blue-800 rounded-xl transition-all font-semibold shadow-inner ring-1 ring-blue-500/20";
                    } else {
                        btn.className =
                            "preset-btn py-2.5 px-2 text-sm font-bold bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 transition-all";
                    }
                });
            }

            updateSubmitButtonText();
        }

        // Basculement des sections (Mobile Money vs Carte Bancaire)
        function togglePaymentSection(method) {
            activePaymentMethod = method;

            const secMobile = document.getElementById('section_mobile');
            const secCard = document.getElementById('section_card');

            if (method === 'mobile') {
                secMobile.classList.add('active');
                secCard.classList.remove('active');
                document.getElementById('mobile_phone').setAttribute('required', 'required');
            } else {
                secCard.classList.add('active');
                secMobile.classList.remove('active');
                document.getElementById('mobile_phone').removeAttribute('required');
            }
        }

        // Mise à jour du libellé du bouton principal
        function updateSubmitButtonText() {
            document.getElementById('display_amount_button').textContent = chosenPaymentAmount;
            document.getElementById('display_currency_button').textContent = chosenCurrency;
        }

        // -------------------------------------------------------------------------
        // IMPLEMENTATION PRODUCTION : INITIALISATION ET POLLING DE PAIEMENT
        // -------------------------------------------------------------------------

        // Variable globale pour mémoriser le numéro de commande en cas de Retry
        let currentOrderNumber = null;

        // Fonction passerelle pour gérer proprement le clic de retry sans injection de chaînes dans le HTML
        window.retryVerification = function() {
            if (currentOrderNumber) {
                checkTransactionStatus(currentOrderNumber, 1);
            }
        };

        window.simulateProcess = function() {
            if (chosenPaymentAmount <= 0) {
                showModalError("Montant invalide", "Veuillez saisir un montant de don supérieur à 0.");
                return;
            }

            // 1. Récupérer si le don est anonyme
            const isAnonymous = document.getElementById('anonymous_donation')?.checked || false;

            // 2. Récupération des valeurs (qui seront vides si anonyme)
            const donorName = isAnonymous ? null : document.getElementById('donor_name').value;
            const donorLastName = isAnonymous ? null : document.getElementById('donor_last_name').value;
            const donorEmail = isAnonymous ? null : document.getElementById('donor_email').value;
            const donorOrg = isAnonymous ? null : document.getElementById('donor_org').value;
            const donorCountry = isAnonymous ? null : document.getElementById('donor_country').value;
            const donorCity = isAnonymous ? null : document.getElementById('donor_city').value;
            const phone = document.getElementById('mobile_phone').value;

            if (activePaymentMethod === 'mobile' && phone.length !== 9) {
                showModalError("Numéro invalide", "Le numéro de téléphone doit contenir exactement 9 chiffres.");
                return;
            }

            const modal = document.getElementById('simulator_modal');
            const modalLoading = document.getElementById('modal_loading_view');
            const modalStatus = document.getElementById('modal_status_view');
            const modalTimeout = document.getElementById('modal_timeout_view');

            modal.classList.remove('hidden');
            modalLoading.classList.add('flex');
            modalLoading.classList.remove('hidden');
            modalStatus.classList.add('hidden');
            modalStatus.classList.remove('flex');
            modalTimeout.classList.add('hidden');
            modalTimeout.classList.remove('flex');

            const processingNotice = document.getElementById('loading_notice');
            if (processingNotice) processingNotice.textContent = "Initialisation du paiement en cours...";

            fetch("{{ route('vpos.purchase') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        amount: chosenPaymentAmount,
                        currency: chosenCurrency,
                        payment_method: activePaymentMethod,
                        phone: activePaymentMethod === 'mobile' ? phone : null,
                        is_anonymous: isAnonymous, // <-- On envoie l'information clé au Back-end
                        firstname: donorName,
                        lastname: donorLastName,
                        email: donorEmail,
                        org: donorOrg,
                        country: donorCountry,
                        city: donorCity
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.status) {
                        showModalError("Échec de l'initialisation", data.message ||
                            "Impossible de créer la transaction sur le serveur.");
                        return;
                    }

                    currentOrderNumber = data.orderNumber;

                    if (activePaymentMethod === 'card' && data.redirect) {
                        window.location.href = data.url;
                        return;
                    }

                    if (activePaymentMethod === 'mobile') {
                        if (processingNotice) processingNotice.textContent =
                            "Veuillez valider le message push envoyé sur votre téléphone...";
                        checkTransactionStatus(currentOrderNumber, 1);
                    }
                })
                .catch(err => {
                    console.error(err);
                    showModalError("Erreur serveur",
                        "Une erreur est survenue lors de la communication avec le serveur.");
                });
        }

        async function checkTransactionStatus(orderNumber, attempt) {
            const maxAttempts = 4; // Augmenté à 12 pour atteindre ~60s réelles si delay = 5s
            const delay = 5000;

            const modalLoading = document.getElementById('modal_loading_view');
            const modalTimeout = document.getElementById('modal_timeout_view');
            const modalStatus = document.getElementById('modal_status_view');
            const processingNotice = document.getElementById('loading_notice');

            // Assurer que la vue loading est active pendant le polling
            modalLoading.classList.remove('hidden');
            modalLoading.classList.add('flex');
            modalTimeout.classList.add('hidden');
            modalStatus.classList.add('hidden');

            if (processingNotice) {
                processingNotice.innerHTML =
                    `<span class="inline-block mr-2 animate-spin">⏳</span> Vérification du statut (${attempt}/${maxAttempts})...`;
            }

            try {
                const res = await fetch(`/vpos/check-payment/${orderNumber}`);
                const data = await res.json();

                if (data.status === "success") {
                    showModalFinalState(true, "Merci pour votre don !", orderNumber);
                    return;
                }

                if (data.status === "failed" || data.status === "cancelled") {
                    showModalFinalState(false, "Paiement échoué ou annulé", orderNumber,
                        "La transaction a été rejetée par l'opérateur mobile.");
                    return;
                }

                if (data.status === "not_found") {
                    showModalFinalState(false, "Transaction introuvable", orderNumber,
                        "Le numéro de référence n'existe pas sur le serveur.");
                    return;
                }

                if (data.status === "pending") {
                    if (attempt < maxAttempts) {
                        setTimeout(() => {
                            checkTransactionStatus(orderNumber, attempt + 1);
                        }, delay);
                    } else {
                        showModalTimeoutState(orderNumber);
                    }
                }

            } catch (error) {
                console.error("Erreur lors de la vérification :", error);
                if (attempt < maxAttempts) {
                    setTimeout(() => {
                        checkTransactionStatus(orderNumber, attempt + 1);
                    }, delay);
                } else {
                    showModalTimeoutState(orderNumber, "Erreur de connexion réseau lors du contrôle.");
                }
            }
        }

        function showModalFinalState(isSuccess, title, orderNumber, errorMessage = "") {
            const modal = document.getElementById('simulator_modal');
            const modalLoading = document.getElementById('modal_loading_view');
            const modalStatus = document.getElementById('modal_status_view');
            const modalTimeout = document.getElementById('modal_timeout_view');

            modal.classList.remove('hidden');
            modalLoading.classList.add('hidden');
            modalLoading.classList.remove('flex');
            modalStatus.classList.remove('hidden');
            modalStatus.classList.add('flex');
            modalTimeout.classList.add('hidden');
            modalTimeout.classList.remove('flex');

            const iconContainer = document.getElementById('status_icon_container');
            const icon = document.getElementById('status_icon');
            const statusText = document.getElementById('modal_receipt_status');
            const statusMessageText = document.getElementById('status_message_text');
            const modalTitle = document.getElementById('status_message_title');

            let iconClass = 'fa-solid fa-circle-check';
            let iconColor = 'bg-emerald-100 text-emerald-600 border-emerald-200';
            let statusLabel = '<i class="fa-solid fa-circle text-[8px] mr-1"></i> VALIDÉ';
            let statusLabelColor = 'text-emerald-600';

            const symbol = typeof currencySymbols !== 'undefined' ? (currencySymbols[chosenCurrency] || chosenCurrency) :
                '$';
            let message = `Le Fonds de Solidarité vous remercie chaleureusement pour votre don humanitaire.`;

            if (isSuccess === false) {
                iconClass = 'fa-solid fa-circle-xmark';
                iconColor = 'bg-red-100 text-red-600 border-red-200';
                statusLabel = '<i class="fa-solid fa-circle-xmark text-[8px] mr-1"></i> ÉCHOUÉ';
                statusLabelColor = 'text-red-600';
                message = errorMessage || "Le paiement a échoué. Veuillez réessayer.";
            } else if (isSuccess === 'pending') {
                iconClass = 'fa-solid fa-clock';
                iconColor = 'bg-amber-100 text-amber-500 border-amber-200';
                statusLabel = '<i class="fa-solid fa-clock text-[8px] mr-1"></i> EN ATTENTE';
                statusLabelColor = 'text-amber-500';
                message = "Votre paiement est en attente de validation.";
            }

            if (iconContainer && icon) {
                iconContainer.className =
                    `w-16 h-16 rounded-full flex items-center justify-center text-2xl mb-3 border shadow-inner ${iconColor}`;
                icon.className = iconClass;
            }
            if (statusText) {
                statusText.className = `font-bold ${statusLabelColor}`;
                statusText.innerHTML = statusLabel;
            }
            if (statusMessageText) {
                statusMessageText.innerHTML = message;
            }
            if (modalTitle) {
                modalTitle.textContent = title;
            }

            // Remplissage sécurisé du ticket de reçu (sans casser la structure DOM externe)
            const amountElement = document.getElementById('modal_receipt_amount');
            if (amountElement) {
                amountElement.textContent = chosenPaymentAmount.toFixed(2) + " " + symbol;
            }

            const donorElement = document.getElementById('modal_receipt_donor');
            if (donorElement) {
                donorElement.textContent = document.getElementById('donor_name').value || "Anonyme";
            }

            const refElement = document.getElementById('modal_receipt_ref');
            if (refElement) {
                refElement.textContent = orderNumber;
            }

            const channelElement = document.getElementById('modal_receipt_channel');
            if (channelElement) {
                channelElement.textContent = activePaymentMethod === 'mobile' ?
                    "Mobile Money (+243 " + document.getElementById('mobile_phone').value + ")" :
                    "Carte de Crédit / Débit";
            }
        }

        function showModalTimeoutState(orderNumber, customMsg = "") {
            const modal = document.getElementById('simulator_modal');
            const modalLoading = document.getElementById('modal_loading_view');
            const modalTimeout = document.getElementById('modal_timeout_view');
            const modalStatus = document.getElementById('modal_status_view');

            modal.classList.remove('hidden');
            modalLoading.classList.add('hidden');
            modalLoading.classList.remove('flex');
            modalStatus.classList.add('hidden');
            modalStatus.classList.remove('flex');
            modalTimeout.classList.remove('hidden');
            modalTimeout.classList.add('flex');

            if (customMsg) {
                const timeoutMsg = modalTimeout.querySelector('.timeout-message');
                if (timeoutMsg) timeoutMsg.textContent = customMsg;
            }
        }

        function showModalError(title, message) {
            showModalFinalState(false, title, "N/A", message);
        }

        function closeSimulatorModal() {
            document.getElementById('simulator_modal').classList.add('hidden');

            const modalLoading = document.getElementById('modal_loading_view');
            const labelContainer = document.getElementById('loading_notice');
            if (labelContainer) {
                labelContainer.className =
                    "mt-4 bg-slate-50 animate-pulse text-[10px] text-slate-700 border border-slate-200 px-3.5 py-2 rounded-lg font-mono";
                labelContainer.innerHTML = "En attente de la réponse de l'opérateur...";
            }

            document.getElementById('modal_status_view').classList.add('hidden');
            document.getElementById('modal_status_view').classList.remove('flex');

            modalLoading.classList.remove('hidden');
            modalLoading.classList.add('flex');

            const donationForm = document.getElementById('donationForm');
            if (donationForm) {
                donationForm.reset();
                document.getElementById('currency_selector').value = chosenCurrency;
                if (typeof updateCurrency === 'function') updateCurrency(chosenCurrency);
                if (typeof setPresetValue === 'function') setPresetValue(25);
            }
        }
    </script>
</body>

</html>
