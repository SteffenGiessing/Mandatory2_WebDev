$(document).ready(function () {
    getTableInfo(0,1);
$("#infoButton").click(function() {
    
})
$("#searchBtn").click(function () {
    let searchOpt = $("#searchOption").val();

    if (searchOpt === "Albums"){
        console.log("Hitting Albums");
        getTableInfo();
    } else if (searchOpt === "Tracks") {
        console.log("Hitting Tracks");
        getTableInfo();
    } else if (searchOpt === "Artists") {
        console.log("Hitting Artist");
        getTableInfo();
    } else {

    }
    });
});

function searchArtists() {
    $.ajax({
        url: "../Api/api.php",
        type: "POST",
        data:  {
            entity: "artists",
            action: "getArtists"  
        },
        success: function (data){
        const artistsInfo = JSON.parse(data);
        var artists = ''; 
        trackInfo.forEach(element => {
            artists += '<li>' + element.Name + '</li>'
    
        });       
     $('#albumTitle').html(artists);

    }
    
});
}

function getTableInfo(from , currentPage) {
    console.log("htting")
    let entity = $("#searchOption").val();
    let offset = $(".rowPrPage").val();
    let searchVal = $("#searchVal").val();
    console.log(offset + "   " + from);
    let action;
    if (searchVal.length === 0){
        action ="getAll";
    } else {
        action = "search";
    }
    console.log(entity + "   " + action);
    let apiUrl = setApiUrl(entity, action);
    $.ajax({
        url: apiUrl,
        type: GET,
        data:  {
            searchVal: searchVal,
            offset: offset,
            from: from
        },
        success: function (data){
        console.log(data)
        switch (entity) {
            case "track":
                console.log("TRACK SEARCH");
                $("#trackThead").show();
                $("#artistThead").hide();
                $("#albumThead").hide();
                $("#musicInfo").text("tracks");
                setUpTrackTable(data);
            break;
            case "album":
                console.log("ALBUM SEARCH");
                $("#track-thead").hide();
                $("#album-thead").show();
                $("#artist-thead").hide();
                $("#info-title").text("Albums");
                setupAlbumTable(data);
            break;
            case "artist":
                console.log("ARTIST SEARCH");
                $("#track-thead").hide();
                $("#album-thead").hide();
                $("#artist-thead").show();
                $("#info-title").text("Artists");
                setupArtistTable(data);
            break;
        }
        updatePagination(data[data.length - 1], offset, currentPage);
    }, failure: function(e) {
        console.log('failure: ' + e);
    }, error: function(e) {
        console.log('error: ' + e);
        console.log(JSON.stringify(e));
    }
    
});
}

function searchAlbums() {
    let searchVal = $("#searchVal").val();
    let offset = $(".rowPrPage").val();
    
    $.ajax({
        url: "../Api/api.php",
        type: "POST",
        data:  {
            entity: "album",
            action: "getAlbum",
            searchVal: searchVal  
        },
        success: function (data){
            let trackInfo = JSON.parse(data);
            console.log(data);
            setupFrontPageTable(trackInfo);
        }
    });
}
