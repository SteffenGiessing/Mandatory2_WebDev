<header>
<div class="img-title">
    <?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] === 1){ ?>
        <h1> Steffens Music Store - Admin <h1>
    <?php } else { ?>
        <h1> Steffens Music Store </h1>
    <?php } ?>
<nav>
    <div class="headers-icons">
    <a href="home.php">
        <i class="fas fa-compact-disc fa-3x" id="home-btn"></i>
    </a>
    <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === 1)  { ?>
        <i class="fas fa-plus-square fa-3x" id="admin-add-btn"></i>
    <?php } ?>
    <?php if(!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] === 0){ ?>
    <a href="purchase.php">
        <i class="fas fa-shopping-cart fa-3x h-icon" id="shopping-cart-btn"></i>
    </a>
    <?php } ?>
    <?php if((!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] === 0) && (isset($_SESSION["userId"]) && $_SESSION["userId"] != 0)) { ?>
        <a href="profile.php">
        <i class="far fa-user fa-3x h-icon" id="profile-btn"></i>
        </a>
    <?php } ?>
    <?php if(isset($_SESSION["userId"])) { ?>
        <i class="fas fa-sign-out-alt fa-3x h-icon" id="sign-out-btn"></i>
        <?php } else { ?>
        <i class="fas fa-sign-in-alt fa-3x h-icon" id="sign-in-btn"></i>
        <?php } ?> 
    </div>
</nav>
</div>

</header>

