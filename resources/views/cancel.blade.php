<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Paiement annulé') }} - Vpos</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (Outfit si utilisé dans votre projet) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4 bg-slate-50">

    <div class="relative w-full max-w-md p-8 overflow-hidden text-center bg-white border shadow-xl rounded-2xl">

        <!-- Indicateur visuel d'échec -->
        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 text-3xl text-orange-500 bg-orange-100 border border-orange-200 rounded-full shadow-inner">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>

        <!-- Titre principal -->
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">
           {{ __('Paiement annulé') }}
        </h1>

        <!-- Message d'explication textuel -->
        <p class="px-2 mt-3 text-sm leading-relaxed text-slate-500">
            {{ __("Votre paiement a fait l'objet d'une annulation. Cela peut être dû à une action de votre part (annulation volontaire) ou à une interruption du processus de paiement (fermeture de la fenêtre, problème de connexion, etc.). Aucun fonds n'a été prélevé. Veuillez réessayer ou contacter notre support si le problème persiste.") }}
        </p>

        <!-- Boutons d'actions -->
        <div class="flex flex-col gap-2 mt-7">
            <!-- Bouton principal pour retourner au formulaire de don -->
            <a href="{{ route('index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center justify-center w-full px-4 py-3 text-xs font-bold text-white transition-colors shadow-sm rounded-xl bg-slate-900 hover:bg-slate-800">
                <i class="mr-2 fa-solid fa-arrow-rotate-left"></i> {{ __('Réessayer un autre paiement') }}
            </a>

            <!-- Lien secondaire pour contacter le support au besoin -->
            <a href="mailto:info@flexpaie.com" class="inline-flex items-center justify-center w-full px-4 py-3 text-xs font-semibold transition-colors bg-white border rounded-xl border-slate-200 text-slate-600 hover:bg-slate-50">
                <i class="mr-2 fa-solid fa-headset"></i> {{ __("Contacter l'assistance") }}
            </a>
        </div>

        <!-- Note de pied de page discrète -->
        <div class="mt-6 text-[10px] text-slate-400">
            &copy; 2023 {{ __('Plateforme Sécurisée VPOS') }}
        </div>

    </div>

</body>
</html>
