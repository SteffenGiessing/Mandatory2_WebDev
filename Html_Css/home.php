<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../javascript/jquery-3.5.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../javascript/functions.js"></script>
    <script type="text/javascript" src="../javascript/home.js"></script>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    <?php
    include ("header.php");
    ?>
    <main>      

    <div>
        <select id="searchOption">
        <option id="tracks" value="track">Tracks</option>

        <option id="albums" value="album">Albums</option>
            <option id="artists" value="artist">Artists</option>
        </select>

        <input id="searchVal" type="text" placeholder="search">

        <button type="button" name="search" id="searchBtn">Search</button>
    </div>
    <div class="pagination">
        <div class="search-result-box">
            <p class="search-results"></p>
        </div>
    
    <div class="page-count">
        <div class="show-per-page">
            <label>Show per page:</label>
            <select class="rowPrPage">
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="1000">1000</option>
            </select>
            </div>
            <div class="pagination-info"></div>
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
                <th>Actions</th>
            </tr>
        </thead>
        <thead id="albumThead" hidden>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th></th>
                <th></th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <thead id="artistThead" hidden>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th></th>
                <th></th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="musicInfo">
        </tbody>
    </tables>
    <div class="modal" id="track-modal">
            <div class="modal-content">
                <div class="title" id="track-modal-title">
                    <h3>Track Title - minutes</h3>
                    <span class="close"><i class="far fa-times-circle"></i></span>
                </div>
                <div id="album"><p>Album:</p><p></p></div>
                <div id="genre"><p>Genre:</p><p></p></div>
                <div id="playTime"><p>Playtime:</p><p></p></div>
                <div id="composer"><p>Composer:</p><p></p></div>
                <div id="mediaType"><p>Media Type:</p><p></p></div>
                <div id="fileSize"><p>Size:</p> <p></p></div>
            </div>
        </div>
        <div class="modal" id="album-modal">
            <div class="modal-content">
                <div class="title" id="album-modal-title">
                    <h3>Album Title - artist</h3>
                    <span class="close"><i class="far fa-times-circle"></i></span>
                </div>
                <div id="album-tracks"><p>Tracks:</p><p></p></div>
                <div id="album-genre"><p>Genre:</p><p></p></div>
                <div id="album-playTime"><p>Playtime:</p><p></p></div>
                <div id="album-composer"><p>Composer:</p> <p></p></div>
                <div id="album-mediaType"><p>Media Type:</p><p></p></div>
                <div id="album-fileSize"><p>Size:</p> <p></p></div>
            </div>
        </div>
        <div class="modal" id="artist-modal">
            <div class="modal-content">
                <div class="title" id="artist-modal-title">
                    <h3>artist Name</h3>
                    <span class="close"><i class="far fa-times-circle"></i></span>
                </div> 
                <div id="artist-albums"><p>Albums:</p><p></p></div>
                <div id="artist-tracks"><p>Tracks:</p><p></p></div>
                <div id="artist-genre"><p>Genre:</p><p></p></div>
            </div>
        </div>
</main>
</body>
</html>