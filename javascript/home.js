$(document).ready(function () {
    getTableInfo(0,1);
    enableMusicSearch();
    enableModalAction();
    signOut();
    signIn();
});

function enableMusicSearch() {
    $('#artistThead').hide();
    $('#albumThead').hide();
    $('#searchBtn').click(function () {
        getTableInfo(0, 1);
    });
    $("#searchOption").on("change", function () {

        switch(this.value){
            case "album":
                console.log("Hitting Albums");
                getTableInfo(0,1);
            break;
            case "track":
                console.log("Hitting Tracks");
                getTableInfo(0,1);
            break;
            case "artist":
                console.log("Hitting Artist");
                getTableInfo(0,1);
            break;
        }
    });
}


function getTableInfo(from , currentPage) {
    let offset = $(".rowPrPage").val();
    let entity = $.trim($("#searchOption").val());
    let searchVal = $.trim($("#searchVal").val());
    let action;
    if (searchVal.length === 0){
        action ="getAll";
    } else {
        action = "search";
    }
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
                $("#info-title").text("Tracks");
                setUpTrackTable(data);
            break;
            case "album":
                console.log("ALBUM SEARCH");
                $("#trackThead").hide();
                $("#albumThead").show();
                $("#artistThead").hide();
                $("#info-title").text("Albums");
                setupAlbumTable(data);
            break;
            case "artist":
                console.log("ARTIST SEARCH");
                $("#trackThead").hide();
                $("#albumThead").hide();
                $("#artistThead").show();
                $("#info-title").text("Artists");
                setupArtistTable(data);
            break;
        }   
        updatePagination(data[data.length - 1], offset, currentPage);

        //make last table-row unclickable
        $("#musicInfo").on("click", "td:last-child", function(e){
            e.stopPropagation();
        });
    }, failure: function(e) {
        console.log('failure: ' + e);
    }, error: function(e) {
        console.log('error: ' + e);
        console.log(JSON.stringify(e));
    }
});

$(document).on('click', '.pagination-page-left, .pagination-page-right', function () {
    var i = ($(this).hasClass('pagination-page-left')) ? -1 : 1;
    var newCurrentPage = parseInt($('.current-page').attr('data-current')) + i;
    var offset = $(".rowPrPage").val();
    var from = (newCurrentPage - 1) * offset;


    getTableInfo(from, newCurrentPage);
});

$(document).on('change', '.showPerPage', function () {
    $('.navigator-number').val($(this).val());
    if ($(this).closest('.pagination').hasClass('pagination-bottom')) $('html, body').scrollTop(0);
    getTableInfo(0, 1);
});


}
function enableModalAction() {
    $("#musicInfo").on("click", "tr", function() {
        let trackId = $(this).attr("data-id");
        let entity = $(this).attr("id");
        let action ="getById";
        let apiUrl = setApiUrl(entity, action);
        $.ajax({
            url: apiUrl,
            type: GET,
            data: {
                id: trackId
            },
            success: function(data) {
                switch(entity) {
                    case "track":
                        setupTrackModal(data);
                    break;
                    case "album":
                        setupAlbumModal(data);
                    break;
                    case "artist":
                        setupArtistModal(data);
                    break;
                }
            }, failure: function(e) {
                console.log("Failure: " + e);
            }, error: function(e){
                console.log("error: " + e);
                console.log(JSON.stringify(e));
            }
        });
    });
    //When clicking X in modal
    $(".close").on("click", function(){
        $(".modal").hide();
    });

    //When user clicks outside of modal
    $(window).click(function(e){
        var track = document.getElementById("trackModal");
        var album = document.getElementById('albumModal');
        var artist = document.getElementById('artistModal');

        switch(e.target) {
            case track:
                $('#trackModal').hide();
                break;
            case album:
                $('#albumModal').hide();
                break;
            case artist:
                $('#artistModal').hide();
                break;
            default:
                break;
        }
    });

}

