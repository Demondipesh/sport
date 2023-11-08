<?php
$loginLink = "login.php";
$signUpLink = "signup.php";

?>

<nav class="relative px-4 py-4 flex justify-between items-center bg-white">
        <a class="text-3xl font-bold leading-none" href="./index.php">
            <img src="Logo.gif" class="h-10 " alt="">
        </a>
        <div class="lg:hidden">
            <button class="navbar-burger flex items-center text-blue-600 p-3">
                <svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Mobile menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                </svg>
            </button>
        </div>
        <ul class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
            <li><a class="text-sm text-blue-400  font-bold hover:text-blue-500" href="./index.php">Home</a></li>
            <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">About Us</a></li>
            <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Services</a></li>
            <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Contact</a></li>
        </ul>
        <div class="pt-6">
            <?php if (isset($_SESSION['user_id'])) {
                echo '<div class="flex gap-2">';

                echo '<a class="block px-2 py-2 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700 rounded-xl" href="post-upload.php">Post</a>';
                echo '<a class="block px-2 py-2 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700 rounded-xl" href="userdashboard.php">' . ucfirst(strtolower($_SESSION["user_name"])) . '</a>';
                echo '</div>';

            } else {
                echo '<div class="flex gap-2">';
                echo '<a class="block px-2 py-2 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700 rounded-xl" href="' . $loginLink . '">Sign in</a>';
                echo '<a class="block px-2 py-2 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl" href="' . $signUpLink . '">Sign Up</a>';
                echo '</div>';
            } ?>
        </div>
    </nav>
    <div class="navbar-menu relative z-50 hidden">
        <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
        <nav class="fixed top-0 left-0 bottom-0 flex flex-col w-full py-6 px-6 bg-white border-r overflow-y-auto">
            <div class="flex items-center mb-8">
                <a class="mr-auto text-3xl font-bold leading-none" href="#">
                    <img src="Logo.gif" class="h-10 " alt="">
                </a>
                <button class="navbar-close">
                    <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div>
                <ul class="flex flex-col">
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Home</a>
                    </li>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">About Us</a>
                    </li>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Services</a>
                    </li>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col gap-2">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a href="userdashboard.php" style="text-decoration: none;">
                        <?php echo ucfirst(strtolower($_SESSION['user_name'])); ?>
                    </a>
                <?php else : ?>
                    <div class="pt-6">
                        <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl" href="<?php echo $loginLink; ?>">Sign in</a>
                        <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl" href="<?php echo $signUpLink; ?>">Sign Up</a>
                    </div>
                <?php endif; ?>


            </div>
        </nav>
    </div>