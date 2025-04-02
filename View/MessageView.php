<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../DarkModeToggle.css">
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

    <!-- Sidebar  -->
    <div id="tweet" class="w-64 bg-white shadow-lg p-4 rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Menu</h1>

        <!-- Search Bar -->
        <form method="GET" action="?view=home" class="mb-4">
            <input type="text" name="searchbar" placeholder="Search"
                class="p-2 border border-gray-300 rounded-md w-full focus:outline-none">
        </form>

        <!-- Page Buttons -->
        <a href="/?view=home" class="mt-5 block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md mb-4"><i class="fa-solid fa-house"></i> Home</a>
        <a href="/?view=profile" class="block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md mb-4"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="/?view=message" class="block text-lg text-[#0eb6f4] hover:bg-gray-200 py-2 px-4 rounded-md"><i class="fa-solid fa-envelope"></i> Messages</a>
    </div>

  

        <!-- User List -->
        <div class="mb-4">
            <h4 class="text-lg font-semibold mb-2">Select a user to chat with:</h4>
            <div class="space-y-2">
                <?php if (isset($result) && !empty($result)) {
                    foreach ($result as $res) {
                        $user = $res["username"];
                        $id_receiver = $res["id"];
                        echo "<a href='/?id_receiver=$id_receiver&receiver=$user'>
                                <button class=' flex flex-col bg-[#0eb6f4] text-white mt-4 p-2 rounded-md hover:bg-[#0aa0d8]'>$user</button></a>";
                    }
                } ?>
            </div>
        </div>

        <!-- Display Chat If User is Selected -->
        <?php 
        $showChatBox = isset($_GET['id_receiver']) && isset($_GET['receiver']);
        if ($showChatBox): 
            $selectedUser = $_GET['receiver'];
            $selectedUserId = $_GET['id_receiver'];
        ?>
        <div id="tweet" class="bg-gray-50 p-4 rounded-md">
            
            <!-- Select le user  -->
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <!-- Username du user select -->
                <h2 class="text-2xl font-bold"><?php echo htmlspecialchars($selectedUser); ?></h2>
            </div>

            <!-- Chat  -->
            <div class="h-80 overflow-y-auto space-y-3">
                <?php if (isset($convs) && !empty($convs)) { 
                    foreach ($convs as $conv) { ?>
                        <div class="flex <?php echo ($_SESSION['id_user'] == $conv['id_sender']) ? 'justify-end' : 'justify-start'; ?>">
                            <p class="p-2 rounded-lg max-w-xs
                                <?php echo ($_SESSION['id_user'] == $conv['id_sender']) 
                                    ? 'bg-[#0eb6f4] text-white' 
                                    : 'bg-gray-200'; ?>">
                                <?php echo htmlspecialchars($conv['content']); ?>
                                <span id="datetime" class="block text-xs mt-1 text-gray-500"><?php echo $conv['LEFT(TIME(date), 5)']; ?></span>
                            </p>
                        </div>
                <?php } } ?>
            </div>

            <form class="mt-4 flex space-x-2" method="POST">
                <input type="hidden" name="sender" value="<?php echo $_SESSION['id_user']; ?>">
                <input type="hidden" name="receiver" value="<?php echo $selectedUserId; ?>">
                <input type="text" name="msg" placeholder="Type your message..." required
                    class="flex-1 border border-gray-300 p-2 rounded-md focus:outline-none">
                <button type="submit" name="send" 
                    class="bg-[#0eb6f4] text-white px-4 py-2 rounded-md hover:bg-[#0aa0d8]">
                    Send
                </button>
            </form>

        </div>
        <?php endif; ?>


</div>
    <script src="DarkModeToggle.js"></script>

</body>
</html>

