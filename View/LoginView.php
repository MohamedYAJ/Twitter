<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter - Tweeter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold text-center text-[#0eb6f4] mb-6">Connexion</h1>
        <form method="POST" action="/" class="space-y-4">
            <div>
                <input type="email" name="email" placeholder="Email"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Mot de passe"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none" required>
            </div>
            <div>
                <input type="submit" name="submit" value="Se connecter"
                       class="w-full bg-[#0eb6f4] text-white p-3 rounded-lg font-semibold hover:bg-[#0aa0d8] cursor-pointer">
            </div>
        </form>
        <p class="mt-4 text-center text-gray-600">
            Pas encore membre ? <a href="/" class="text-[#0eb6f4] hover:underline">Inscrivez-vous gratuitement.</a>
        </p>
    </div>
</body>
</html>
 