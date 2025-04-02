<!DOCTYPE html> 
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../DarkModeToggle.css">
    

</head>

<body class="text-gray-800">    

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

        <div id="menu" class="w-64 shadow-lg p-4 rounded-lg">
            <h1 class="text-2xl font-bold mb-6 text-center">Menu</h1>


        <!-- Search bar -->

            <div class="mt-6 flex justify-between items-center">
                <form method="GET" action="?view=home" class="flex space-x-1">
                    <input type="text" name="searchbar" placeholder="Search"
                     class="p-2 border border-gray-300 placeholder-gray-300 rounded-md ms-3 focus:outline-none w-50" />
                </form>
            </div>


        <!-- Pages buttons -->

            <a href="/?view=home" class="mt-5 block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md mb-4"><i
                    class="fa-solid fa-house"></i> Home</a>
            <a href="/?view=profile" class="block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md mb-4"><i
                    class="fa-solid fa-user"></i> Profile</a>
            <a href="/?view=message" class="block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md"><i
                    class="fa-solid fa-envelope"></i> Messages</a>
           
        </div>


        <!-- Reply Form -->

        <div id="tweet" class="flex-1 p-6 shadow-lg rounded-lg">

            <?php if (isset($_GET["reply"]) && $_GET["reply"] == "writing") {
                echo "Répondre au message : " . $_POST["comment"];
                ?>
                <form method="POST" action="/?view=home&reply=true" class="space-y-4">
                    <input name="tweet_id" hidden value="<?php echo $_POST["tweet_id"]; ?>" />
                    <textarea class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="comment" placeholder="What's Up?" maxlength="140" rows="5"
                        style="resize:none;"></textarea>
                    <button type="submit"
                        class="w-full py-2 bg-[#0eb6f4] rounded-md hover:bg-[#0aa0d8]">Reply</button>
                </form>
            <?php } else ?>

        <!-- Contenu principal -->
        <div id="tweet" class="flex-1 bg-white p-6 shadow-lg rounded-lg">
            <?php if (isset($_GET["reply"]) && $_GET["reply"] == "writing") { ?>
            <?php } else { ?>
                <form method="POST" action="/?view=home" enctype="multipart/form-data" class="space-y-4">
                    <textarea name="content" placeholder="What's Up?" maxlength="140" rows="5"
                        class="w-full p-3 border placeholder-gray-300 rounded-md focus:outline-none"
                        style="resize:none;"></textarea>
                    
                    <div class="flex flex-col space-y-2">
                        <label id="label-images" class="text-sm text-gray-600">Ajouter jusqu'à 4 images :</label>
                        <input type="file" name="media[]" multiple accept="image/*" id="input-file" class="border p-2 rounded-md" aria-describedby="file-upload">
                    </div>

                    <button type="submit" name="post_tweet"
                        class="w-full py-2 bg-[#0eb6f4] rounded-md hover:bg-[#0aa0d8]">Post Tweets</button>

                </form>

                <!-- Display Tweets -->
                 <?php
                if (isset($tweets) && !empty($tweets) && !(isset($_GET['searchbar']))) { ?>
                <div class="mt-8 space-y-4">

                    <?php foreach ($tweets as $tweet) { ?>
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
                                <form method="POST" action="?view=home&reply=writing">
                                    <input hidden value="<?php echo $tweet['id']; ?>" name="tweet_id" />
                                    <button type="submit" name="comment" value="<?php echo $tweet['content']; ?>"
                                        class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8]  transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i
                                            class="fa-regular fa-comment"></i></button>
                                </form>
                                <form method="POST" action="?view=home"><button type="submit" name="retweet" value="<?php echo $tweet['id'];?>" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-solid fa-retweet"></i></button></form>

                                <form method="POST" action="?view=home">
                                    <button type="submit" name="follow" value="<?php echo $tweet['id_user']; ?>"
                                        class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i
                                            class="fa-solid fa-user-plus"></i></button>
                                </form>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            <?php } ?>
            <?php
            if (isset($hashtag_res) && !empty($hashtag_res) && isset($_GET['searchbar'])) { ?>

                <div class="mt-8 space-y-4">
                    <?php foreach ($hashtag_res as $hashtag) { ?>
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <?php
                            $the_tweet = $hashtag['content'];
                            $extracted_hash = preg_replace('/(?:^|\s)#(\w+)/', ' <a class="text-blue-400 underline" href="/?searchbar=$1">#$1</a>', $the_tweet);
                             ?>
                            <h6 class="text-1xl italic font-bold"><a class="hover:text-[#0aa0d8]" 
                            href="/?user=<?php echo $hashtag['id_user']?>"><?php echo  $hashtag['username']; ?></a></h6>
                            <p class="text-lg my-3"><a><?php echo $extracted_hash ?></a></p>
                            <div class="flex justify-evenly">
                                <form method="POST" action="?view=home&reply=writing">
                                    <input hidden value="<?php echo $hashtag['id']; ?>" name="tweet_id" />
                                    <button type="submit" name="comment" value="<?php echo $hashtag['content']; ?>"

                                        class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8]  transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i
                                            class="fa-regular fa-comment"></i></button>
                                </form>
                                <form method="POST" action="?view=home"><button type="submit" name="retweet" value="<?php echo $hashtag['id'];?>" class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i class="fa-solid fa-retweet"></i></button></form>

                                <form method="POST" action="?view=home">
                                    <button type="submit" name="follow" value="<?php echo $hashtag['id_user']; ?>"
                                        class="text-[#0eb6f4] hover:text-white hover:bg-[#0aa0d8] transition-all duration-300 p-1 rounded-md transform hover:scale-110"><i
                                            class="fa-solid fa-user-plus"></i></button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } }?>
        </div>
    </div>
    <script src="DarkModeToggle.js"></script>
</body>
</html>