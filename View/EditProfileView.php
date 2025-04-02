  <?php 
// Démarre une nouvelle session ou reprend une session existante via l'indentifiant passé dans une requête GET, POST ou un cookie. Il initialise la variable $_SESSION et stocke les informations dedans

// Détermine si la variable $_SESSION est déclarée, si oui on accède aux informations de session (qu'on a défini autre part)
if (isset($_SESSION['username']) || isset($_SESSION['email']) && isset($_SESSION['password'])) {
// include "Controller/EditProfileController.php";

// class EditProfileView extends EditProfileModel {

// $user = getUserInfo($_SESSION['id'], $conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="https://cdn.tailwindcss.com"></script>
    <title>Tweeter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-initial-scale=1.0">
  </head>
  <body class="flex items-center justify-center min-h-screen bg-gray-100">

      <div class="bg-white p-8 rounded-lg shadow-lg w-96" >
        <form action="/?view=profile" method="POST" enctype="multipart/form-data" class=" space-y-4">
        
        <h3 class="text-2xl font-bold text-center text-[#0eb6f4] mb-6">Modifier votre profil :</h3>
        <div>
          
    
     
<p class="text-lg font-bold  text-[#0eb6f4] " >Prénom :</p>

          <input required type="text" name="firstname" placeholder="<?php echo $_SESSION['firstname']?>"
          class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none" value="" >

        </div> 

        <div>
        <p class="text-lg font-bold  text-[#0eb6f4] " >Nom :</p>

          <input required type="text"          name="lastname" 
          class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none" placeholder="<?php echo $_SESSION['lastname']?>" value="" >
        </div> 
        
        <div>
  
<p class="text-lg font-bold  text-[#0eb6f4] " >Pseudo :</p>

          <input required type="text"          name="username" 
          class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none" placeholder="<?php echo $_SESSION['username']?>" value="" >
        </div> 
        
        <div>
        <p class="text-lg font-bold  text-[#0eb6f4] " >Email :</p>

          <input required type="email"          name="email" 
          class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none" placeholder="<?php echo $_SESSION['email']?>" value="" >

   

        </div> 
        <div>
      <p class="text-lg font-bold  text-[#0eb6f4] " >Mot de passe :</p>
          <input required type="password"          name="password" 
          class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none" placeholder="..." value="" >

          
        </div> 

        <input  hidden type="text" value="PUT" name="PUT"/>

        <button type="submit" class="w-full p-3 bg-[#0eb6f4] text-white rounded-lg font-semibold hover:bg-[#0aa0d8] cursor-pointer">Modifier</button>
      
        <p class="mt-4 text-center text-gray-600">Retour au <a href="/?view=home" class="text-[#0eb6f4] hover:underline">Home</a>.</p>      
      </form>
      </div>
<?php } ?>
  </body>
</html>