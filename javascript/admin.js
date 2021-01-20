$(document).ready(function(){
    enableAddModal();
    addNewMusic();
    switchAddModalContent();
    enableAdminModal();
});


function enableAddModal(){
    $('#admin-add-btn').on('click', function(){
        console.log("CLICKED");
        $('#admin-add-modal').show();
    })
}

function addNewMusic() {
    $('#add-music-btn').on('click', function(){
        const entity = $('#add-music-opt').val();
        const action = 'create';
        apiUrl = setAdminApiUrl(entity, action);
        var data = getCreateData(entity);
        console.log("hitting" + entity);
        $.ajax({
            url: apiUrl,
            type: POST,
            data: data,
            success: function(data){
                switch(entity) {
                    case 'track':
                        if(data.isTrackCreated) {
                            $('div#snackbar').text('Track was successfully added!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-add-modal').hide();
                            getTableInfo(0, 1);
                        } else {
                            $('div#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                    case 'album':
                        if(data.isAlbumCreated) {
                            $('#snackbar').text('Album was successfully added!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-add-modal').hide();
                            getTableInfo(0, 1);
                        } else {
                            $('#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                    case 'artist':
                        if(data.isArtistCreated) {
                            $('#snackbar').text('Artist was successfully added!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-add-modal').hide();
                            getTableInfo(0, 1);
                        } else {
                            $('div#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                }
            }
        });
    });
}

//Saving edited music to db
//Used in enableAdminModal()
function updateMusic(buttonId, entity) {
    $(buttonId).on('click', function(){
        const action = 'update';
        apiUrl = setAdminApiUrl(entity, action);
        var data = getUpdateData(entity);
        $.ajax({
            url: apiUrl,
            type: POST,
            data: data,
            success: function(data){
                switch(entity) {
                    case 'track':
                        if(data.isTrackUpdated) {
                            $('div#snackbar').text('Track was successfully updated!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-update-track-modal').hide();
                            getTableInfo(0, 1);
                        } else {
                            $('div#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                    case 'album':
                        if(data.isAlbumUpdated) {
                            $('#snackbar').text('Album was successfully updated!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-update-album-modal').hide();
                            getTableInfo(0, 1);
                        } else {
                            $('#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                    case 'artist':
                        if(data.isArtistUpdated) {
                            $('#snackbar').text('Artist was successfully updated!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-update-artist-modal').hide();
                            getTableInfo(0, 1);
                        } else {
                            $('div#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                }
            }
        });
    });
}

function switchAddModalContent(){
    $("#add-music-opt").on('change', function () {
        switch(this.value) {
            case 'track':
                $('.track-modal-add').show();
                $('.album-modal-add').hide();
                $('.artist-modal-add').hide();
                break;
            case 'album':
                $('.track-modal-add').hide();
                $('.album-modal-add').show();
                $('.artist-modal-add').hide();
                break;
            case 'artist':
                $('.track-modal-add').hide();
                $('.album-modal-add').hide();
                $('.artist-modal-add').show();
                break;
        }
    });
}

// Modal for both deleting & Updating
function enableAdminModal(){
    $("#musicInfo").on("click", "tr", function () {
        let id = $(this).attr("data-id");
        let entity = $(this).attr("id");
        let action = 'getById';
        let apiUrl = setApiUrl(entity, action);
        $.ajax({
            url: apiUrl,
            type: GET,
            data: {
                id: id
            },
            success: function(data) {
                switch (entity) {
                    case "track":
                        trackModalUpdate(data);
                        updateMusic('#update-track-btn', entity);
                        enableDeleteBtn('#delete-track-btn', entity)
                        break;
                    case "album":
                        albumModalUpdate(data);
                        updateMusic('#update-album-btn', entity);
                        enableDeleteBtn('#delete-album-btn', entity)
                        break;
                    case "artist":
                        artistModalUpdate(data);
                        updateMusic('#update-artist-btn', entity);
                        enableDeleteBtn('#delete-artist-btn', entity)
                        break;
                }
            }, failure: function(e) {
                console.log('failure: ' + e);
            }, error: function(e) {
                console.log('error: ' + e);
                console.log(JSON.stringify(e));
            }
        });
    });
}