<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../javascript/jquery-3.5.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script type="text/javascript" src="../javascript/functions.js"></script>
    <script type="text/javascript" src="../javascript/home.js"></script>
    <script type="text/javascript" src="../javascript/function-admin.js"></script>
    <script type="text/javascript" src="../javascript/admin.js"></script>
</head>
<body>
    <?php
    session_start();
    include ("header.php");
    require_once("templates/add-to-cart.php");
    require_once("header.php");
    ?>
  
<main>      
    <div class="flex-title">
        <h2 id="info-title">Tracks</h2>
    </div>
    <div class="searchField">
        <select id="searchOption" name="searchOption" class="searchOption">
            <option id="tracks" value="track">Tracks</option>
            <option id="albums" value="album">Albums</option>
            <option id="artists" value="artist">Artists</option>
        </select>
    <input id="searchVal" class="searchBar" type="text" placeholder="search">
    <button type="button" class="searchBtn" name="search" id="searchBtn">Search</button>
    <div class="search-result-box">
    <p class="searchResults"></p>
    </div>
    </div>
    <div class="pagination">
    <div class="page-count">
        <div class="showPerPage">
            <label>Show per page:</label>
            <select class="rowPrPage">
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="1000">1000</option>
            </select>
        </div>
        <div class="paginationInfo"></div>
        </div>
    </div> 
    <table id="musicInfoTable">
        <thead id="trackThead">
            <tr>
                <th>Title</th>
                <th>Artists</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Playtime</th>
            </tr>
        </thead>
        <thead id="albumThead">
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Numbers of songs</th>
                <th>Price</th>
            </tr>
        </thead>
        <thead id="artistThead">
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Number of albums</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody id="musicInfo">
        </tbody>
    </tables>
    <?php if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] === 0) { ?>
    <form method="POST">
    <div class="modal" id="trackModal">
        <div class="modal-content">
            <div class="title" id="trackModalTitle">
                <h3>Track Title - minutes</h3>
                <span class="close"><i class="far fa-times-circle"></i></span>
            </div>
                <div id="album" name="album"><p>Album:</p><p></p></div>
                <div id="genre" name="genre"><p>Genre:</p><p></p></div>
                <div id="playTime" name="playtime"><p>Playtime:</p><p></p></div>
                <div id="composer" name="composer"><p>Composer:</p><p></p></div>
                <div id="mediaType" name="mediatype"><p>Media Type:</p><p></p></div>
                <div id="fileSize" name="filesize"><p>Size:</p> <p></p></div>
                <input type="hidden" id="hiddenId" name="hidden_id" value="">
                <input type="hidden" name="hidden_album" id="hidden_album" value="">
                <input type="hidden" name="hidden_genre" id="hidden_genre" value="">
                <input type="hidden" name="hidden_composer" id="hidden_composer" value="">
                <input type="hidden" name="hidden_price" id="hidden_price" value=""> 
                <input type="hidden" name="quantity" value="1"/>
                <button type="submit" name="purchase" id="purchase"><p>Purchase</p><p></p></button>
            </div>
        </div>
    </form>
    <div class="modal" id="albumModal">
        <div class="modal-content">
            <div class="title" id="albumModalTitle">
                <h3>Album Title - artist</h3>
                <span class="close"><i class="far fa-times-circle"></i></span>
            </div>
                <div id="albumTracks"><p>Tracks:</p><p></p></div>
                <div id="albumGenre"><p>Genre:</p><p></p></div>
                <div id="albumPlayTime"><p>Playtime:</p><p></p></div>
                <div id="albumComposer"><p>Composer:</p> <p></p></div>
                <div id="albumMediaType"><p>Media Type:</p><p></p></div>
                <div id="albumFileSize"><p>Size:</p> <p></p></div>
             
            </div>
        </div>
    <div class="modal" id="artistModal">
        <div class="modal-content">
            <div class="title" id="artistModalTitle">
                <h3>artist Name</h3>
                <span class="close"><i class="far fa-times-circle"></i></span>
            </div> 
            <div id="artistAlbums"><p>Albums:</p><p></p></div>
            <div id="artistTracks"><p>Tracks:</p><p></p></div>
            <div id="artistGenre"><p>Genre:</p><p></p></div>
        </div>
    </div>
    <?php
        } else if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === 1) {
            include_once("templates/admin-modals.php");
        }
    ?>
    <div id="snackbar">Successfully Added!</div>
</main>
</body>
</html>