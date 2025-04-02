<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link rel="stylesheet" href="../DarkModeToggle.css">

    <title>Document</title>
</head>
<body class="bg-gray-100 text-gray-800">

     <!-- Dark Mode Toggle -->

     <div class="button">
    <input type="checkbox" class="checkbox" id="checkbox">
    <label for="checkbox" class="checkbox-label">
        <i class="fas fa-moon"></i>
        <i class="fas fa-sun"></i>
        <span class="ball"></span>
    </label>
    </div>

  <div class="max-w-7xl mx-auto p-6 flex space-x-6">

     <div id="tweet" class="w-64 bg-white shadow-lg p-4 rounded-lg">

            <h1 class="text-2xl font-bold mb-6 text-center">Menu</h1>
 
            <!-- Search bar -->

            <div class="mt-6 flex justify-between item s-center">
                 <form method="GET" action="?view=home" class="flex space-x-1">

                    <input type="text" name="searchbar" placeholder="Search"
                        class="p-2 border border-gray-300 rounded-md ms-3 focus:outline-none w-50" />
                </form>
            </div>
 
            <!-- Pages buttons -->
            <a href="/?view=home" class="mt-5 block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 mt-3 rounded-md mb-4"><i class="fa-solid fa-house"></i> Home</a>
            <a href="/?view=profile" class="block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md mb-4"><i class="fa-solid fa-user"></i> Profile</a>
            <a href="/?view=message" class="block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md"><i class="fa-solid fa-envelope"></i> Messages</a>

          </div>

        <!-- Follow buttons and update profile button -->

      <div id="tweet" class="flex-1 bg-white p-6 shadow-lg rounded-lg">

      <div class="container flex space-x-4 mb-6">
        <button class="btn text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md" data-target="#modal1">Followers</button>
        <button class="btn text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md" data-target="#modal2">Followings</button>
        <button class="btn text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md"><a href="/?view=edit_profile">Update profile</a></button>
      </div>
 
      <!-- Display follows in modals -->
 
      <div class="modal" id="modal1">
        <div class="header">
          <div class="title">Followers</div>
          <button class="btn close-modal">&times;</button>
        </div>
        <div class="body">
        <?php if (isset($followers) && !empty($followers)){ ?>
            <?php foreach($followers as $follower){?>
               <ul><?php echo $follower['username']; }?></ul>
          <?php } ?>
       
        </div>
      </div>
      <div class="modal" id="modal2">
        <div class="header">
          <div class="title">Followings</div>
          <button class="btn close-modal">&times;</button>
        </div>
        <div class="body">
        
          <?php if (isset($followings) && !empty($followings)){ ?>
            <?php foreach($followings as $following){?>
               <ul><?php echo  $following['username']; }?></ul>
          <?php } ?>
 
        </div>
      </div>
      <div id="overlay"></div>
 
      <!-- Display retweet in profile -->
 
          <?php
          if (isset($retweets) && !empty($retweets)) { ?>
                  <div class="mt-8 space-y-4">
                      <?php foreach ($retweets as $retweet) {?>
                        
                          <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                          <p class="italic"><i class="fa-solid fa-retweet"></i>Vous avez reposté</p>
                          <?php
                          $the_tweet = $retweet['content'];
                          $extracted_hash = preg_replace('/(?:^|\s)#(\w+)/', ' <a class="text-blue-400 underline" href="/?searchbar=$1">#$1</a>', $the_tweet);
                            ?>
                          <h6 class="text-1xl italic font-bold"><a class="hover:text-[#0aa0d8]" 
                          href="/?user=<?php echo $retweet['id_user']?>"><?php echo  $retweet['username']; ?></a></h6>
                          <p class="text-lg my-3"><?php echo $extracted_hash ?></p>
                              <div class="grid grid-cols-2">
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <?php if (!empty($retweet["media$i"])): ?>
                                           <img src="<?php echo htmlspecialchars($retweet["media$i"]);?>">
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                              <div class="flex justify-evenly">
                                <form>
                                  <button type="submit" name="comment" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-regular fa-comment"></i></button>
                                </form>
                                <form method="POST" action="?view=home">
                                  <button type="submit" name="retweet" value="<?php echo $retweet['id'];?>" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-solid fa-retweet"></i></button>
                                </form>
                              </div>
                          </div>
                          
                      <?php } ?>
                  </div>
              <?php } ?>
        
            <!-- Display tweets in profile  -->
 
          <?php if (isset($tweets) && !empty($tweets)) { ?>
                  <div class="mt-8 space-y-4">
                      <?php foreach ($tweets as $tweet) {?>
                          <div id="tweet-form" class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <?php
                            $the_tweet = $tweet['content'];
                            $extracted_hash = preg_replace('/(?:^|\s)#(\w+)/', ' <a class="text-blue-400 underline" href="/?searchbar=$1">#$1</a>', $the_tweet);
                             ?>
                            <h6 class="text-1xl italic font-bold"><a class="hover:text-[#0aa0d8]" 
                            href="/?user=<?php echo $tweet['id_user']?>"><?php echo  $tweet['username']; ?></a></h6>
                            <p class="text-lg my-3"><?php echo $extracted_hash ?></p>
                              <div class="grid grid-cols-2">
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <?php if (!empty($tweet["media$i"])): ?>
                                           <img src="<?php echo htmlspecialchars($tweet["media$i"]);?>">
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                              <div class="flex justify-evenly">
                                <form><button type="submit" name="comment" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-regular fa-comment"></i></button></form>
                                <form method="POST" action="?view=home"><button type="submit" name="retweet" value="<?php echo $tweet['id'];?>" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-solid fa-retweet"></i></button></form>
                              </div>
                          </div>
                          
                      <?php } ?>
                  </div>
              <?php } ?>
    </div>
         
              
<script defer src="../script.js"></script>
<script src="DarkModeToggle.js"></script>

</body>
</html>
 