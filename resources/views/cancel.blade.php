<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Échec du paiement - Fonds de Solidarité</title>
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
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl border shadow-xl p-8 max-w-md w-full text-center relative overflow-hidden">

        <!-- Indicateur visuel d'échec -->
        <div class="w-16 h-16 rounded-full bg-orange-100 border border-orange-200 text-orange-500 flex items-center justify-center text-3xl mx-auto mb-4 shadow-inner">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>

        <!-- Titre principal -->
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
            Paiement annulé
        </h1>

        <!-- Message d'explication textuel -->
        <p class="text-slate-500 text-sm mt-3 leading-relaxed px-2">
            Votre paiement a fait l'objet d'une annulation. Cela peut être dû à une action de votre part (annulation volontaire) ou à une interruption du processus de paiement (fermeture de la fenêtre, problème de connexion, etc.). Aucun fonds n'a été prélevé. Veuillez réessayer ou contacter notre support si le problème persiste.
        </p>

        <!-- Boutons d'actions -->
        <div class="mt-7 flex flex-col gap-2">
            <!-- Bouton principal pour retourner au formulaire de don -->
            <a href="{{ route('index') }}" class="w-full inline-flex justify-center items-center rounded-xl px-4 py-3 bg-slate-900 text-white text-xs font-bold hover:bg-slate-800 transition-colors shadow-sm">
                <i class="fa-solid fa-arrow-rotate-left mr-2"></i> Réessayer un autre paiement
            </a>

            <!-- Lien secondaire pour contacter le support au besoin -->
            <a href="mailto:support@fonds-solidarite.org" class="w-full inline-flex justify-center items-center rounded-xl px-4 py-3 bg-white border border-slate-200 text-slate-600 text-xs font-semibold hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-headset mr-2"></i> Contacter l'assistance
            </a>
        </div>

        <!-- Note de pied de page discrète -->
        <div class="mt-6 text-[10px] text-slate-400">
            Fonds de Solidarité — Plateforme Sécurisée VPOS
        </div>

    </div>

</body>
</html>
