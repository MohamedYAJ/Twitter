<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tweeter</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
      <h1 class="text-2xl font-bold text-center text-[#0eb6f4] mb-6" >Registration</h1>
        <form action="/" method="POST" class="space-y-4">
            <div>
                <input type="text" name="firstname" placeholder="Firstname"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none" required>
            </div>
            <div>
                <input type="text" name="lastname" placeholder="Lastname"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none" required>
            </div>
            <div>
                <input type="text" name="username" placeholder="username"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none" required>
            </div>
            <div>
                <input type="date" name="birthdate" placeholder="Birthdate"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none" required>
            </div>
            <div>
                <input type="email" name="email" placeholder="Email"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="password"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none" required>
            </div>
            <div>
                <input type="submit" value="Register" name="submit"
                class="w-full p-3 bg-[#0eb6f4] text-white rounded-lg font-semibold hover:bg-[#0aa0d8] cursor-pointer">
            </div>
            <p class="mt-4 text-center text-gray-600">Déjà un compte ? <a href="/?view=login" class="text-[#0eb6f4] hover:underline">Se connecter</a></p>
        </form>
    </div>
   <?php
   ?>
</body>
</html>