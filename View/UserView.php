<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

    <title>Document</title>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="max-w-7xl mx-auto p-6 flex space-x-6">

     <div class="w-64 bg-white shadow-lg p-4 rounded-lg">
      
            <h1 class="text-2xl font-bold mb-6 text-center">Menu</h1>

            <!-- Search bar -->

            <div class="mt-6 flex justify-between items-center">
                <form method="GET" action="?view=home" class="flex space-x-1">
                    <input type="text" name="searchbar" placeholder="Search"
                        class="p-2 border border-gray-300 rounded-md ms-3 focus:outline-none w-50" />
                </form>
            </div>

            <!-- Pages buttons -->

            <a href="/?view=home" class="block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 mt-3 rounded-md mb-4"><i class="fa-solid fa-house"></i> Home</a>
            <a href="/?view=profile" class="block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md mb-4"><i class="fa-solid fa-user"></i> Profile</a>
            <a href="/?view=message" class="block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md"><i class="fa-solid fa-envelope"></i> Messages</a>
        </div>

        <!-- Follow buttons and update profile button -->

      <div class="flex-1 bg-white p-6 shadow-lg rounded-lg">
      <div class="container flex space-x-4 mb-6">
        <button class="btn text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md" data-target="#modal1">Followers</button>
        <button class="btn text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md" data-target="#modal2">Followings</button>
        <form method="POST" action="">
            <button type="submit" name="follow" value="<?php echo $_GET['user'] ?>"
                class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110">Follow  <i
                    class="fa-solid fa-user-plus"></i></button>
        </form>
      </div>

      <!-- Display follows in modals -->

      <div class="modal" id="modal1">
        <div class="header">
          <div class="title">Followers</div>
          <button class="btn close-modal">&times;</button>
        </div>
        <div class="body">
        <?php if (isset($Userfollowers) && !empty($Userfollowers)){ ?>
            <?php foreach($Userfollowers as $Userfollower){?>
               <ul><?php echo $Userfollower['username']; }?></ul>
          <?php } ?>
       
        </div>
      </div>
      <div class="modal" id="modal2">
        <div class="header">
          <div class="title">Followings</div>
          <button class="btn close-modal">&times;</button>
        </div>
        <div class="body">
        
          <?php if (isset($Userfollowings) && !empty($Userfollowings)){ ?>
            <?php foreach($Userfollowings as $Userfollowing){?>
               <ul><?php echo  $Userfollowing['username']; }?></ul>
          <?php } ?>

        </div>
      </div>
      <div id="overlay"></div>

      <!-- Display retweet in profile -->
                  <div class="mt-8 space-y-4">
                      <?php
                      foreach ($getUser as $username)
                      {
                        $name = $username['username'];
                      }
                       foreach ($Userretweets as $Userretweet) {?>
                        
                          <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                          <p class="italic"><i class="fa-solid fa-retweet"></i><?php echo $name?> a reposté</p>
                            <?php
                            $the_tweet = $Userretweet['content'];
                            $extracted_hash = preg_replace('/(?:^|\s)#(\w+)/', ' <a class="text-blue-400 underline" href="/?searchbar=$1">#$1</a>', $the_tweet);
                              ?>
                            <h6 class="text-1xl italic font-bold"><a class="hover:text-[#0aa0d8]" 
                            href="/?user=<?php echo $Userretweet['id_user']?>"><?php echo  $Userretweet['username']; ?></a></h6>
                            <p class="text-lg my-3"><?php echo $extracted_hash ?></p>
                              <div class="flex justify-evenly">
                                <form>
                                  <button type="submit" name="comment" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-regular fa-comment"></i></button>
                                </form>
                                <form method="POST" action="?view=home">
                                  <button type="submit" name="retweet" value="<?php echo $Userretweet['id'];?>" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-solid fa-retweet"></i></button>
                                </form>
                              </div>
                          </div>
                          
                      <?php } ?>
                  </div>        
            <!-- Display tweets in profile  -->

          <?php if (isset($Usertweets) && !empty($Usertweets)) { ?>
                  <div class="mt-8 space-y-4">
                    <?php
                    foreach ($Usertweets as $Usertweet)
                    {?>
                          <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                             <?php
                              $the_tweet = $Usertweet['content'];
                              $extracted_hash = preg_replace('/(?:^|\s)#(\w+)/', ' <a class="text-blue-400 underline" href="/?searchbar=$1">#$1</a>', $the_tweet);
                            ?>
                          <h6 class="text-1xl italic font-bold"><a class="hover:text-[#0aa0d8]" 
                          href="/?user=<?php echo $Usertweet['id_user']?>"><?php echo  $Usertweet['username']; ?></a></h6>
                          <p class="text-lg my-3"><?php echo $extracted_hash ?></p>
                              <div class="flex justify-evenly">
                                <form><button type="submit" name="comment" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-regular fa-comment"></i></button></form>
                                <form method="POST" action="?view=home"><button type="submit" name="retweet" value="<?php echo $Usertweet['id'];?>" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-solid fa-retweet"></i></button></form>
                              </div>
                          </div>
                          
                      <?php } } ?>
                  </div>
    </div>
         
              
<script defer src="../script.js"></script>   
</body>
</html>