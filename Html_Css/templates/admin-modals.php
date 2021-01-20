<div class="modal" id="admin-add-modal">
    <div class="form" id="admin-add">
        <span class="close"><i class="far fa-times-circle"></i></span>
        <div class="modal-add-selector">
            <h3>Add new</h3>
            <select name="add-music-opt" id="add-music-opt">
                <option value="track">Track</option>
                <option value="album">Album</option>
                <option value="artist">Artist</option>
            </select>
        </div>
        <div class="track-modal-add">    
            <input type="text" id="add-track-name" placeholder="Track Title" />
            <input type="text" id="add-track-albumId" placeholder="Album" />
            <input type="text" id="add-track-mediaTypeId" placeholder="Media" />
            <input type="text" id="add-track-genreId" placeholder="Genre" />
            <input type="text" id="add-track-composer" placeholder="Composer/Composers" />
            <input type="text" id="add-track-milliseconds" placeholder="Playtime" />
            <input type="text" id="add-track-bytes" placeholder="Size" />
            <input type="text" id="add-track-unitPrice" placeholder="Price"/>
        </div>
        <div class="album-modal-add">    
            <input type="text" id="add-album-title" placeholder="Album Title" />
            <input type="text" id="add-album-artistId" placeholder="Artist" />
        </div>
        <div class="artist-modal-add">    
            <input type="text" id="add-artist-name" placeholder="Artist Name" />
        </div>
        <button id="add-music-btn" type="button">Add New Music</button>
    </div>
</div>

<div class="modal" id="admin-update-track-modal">
    <div class="form">
        <span class="close"><i class="far fa-times-circle"></i></span>
        <h3 id="update-trackId" data-id="trackId">Update Track</h3>
        <div class="update-modal-content">
            <p>Title</p>
            <input type="text" id="update-track-name" placeholder="Track Title" />
        </div>
        <div class="update-modal-content">
            <p>Album</p>
            <input type="text" id="update-track-albumId" placeholder="Album" />
        </div>
        <div class="update-modal-content">
            <p>Media</p>
            <input type="text" id="update-track-mediaTypeId" placeholder="Media" />
        </div>
        <div class="update-modal-content">
            <p>Genre</p>
            <input type="text" id="update-track-genreId" placeholder="Genre" />
        </div>
        <div class="update-modal-content">
        <p>Composer</p>
        <input type="text" id="update-track-composer" placeholder="Composer/Composers" />
        </div>
        <div class="update-modal-content">
            <p>Playtime</p>
            <input type="text" id="update-track-milliseconds" placeholder="Playtime" />
        </div>
        <div class="update-modal-content">
            <p>File Size</p>
            <input type="text" id="update-track-bytes" placeholder="Size" />
        </div>
        <div class="update-modal-content">
            <p>Price</p>
            <input type="text" id="update-track-unitPrice" placeholder="Price"/>
        </div>
        <button id="update-track-btn" type="button">Update Track</button>
        <button class="delete-btn" id="delete-track-btn" type="button">Delete Track</button>
        
    </div>
</div>

<div class="modal" id="admin-update-album-modal">
    <div class="form">
        <span class="close"><i class="far fa-times-circle"></i></span>
        <h3 id="update-albumId" data-id="albumId">Update Album</h3>
        <div class="update-modal-content">
            <p>Title</p>
            <input type="text" id="update-album-title" placeholder="Album Title" />
        </div>
        <div class="update-modal-content">
            <p>Artist</p>
            <input type="text" id="update-album-artistId" placeholder="Artist" />
        </div>
        <button id="update-album-btn" type="button">Update Album</button>
        <button class="delete-btn" id="delete-album-btn" type="button">Delete Album</button>
    </div>
</div>

<div class="modal" id="admin-update-artist-modal">
    <div class="form">
        <span class="close"><i class="far fa-times-circle"></i></span>
        <h3 id="update-artistId" data-id="artistId">Update Artist</h3>
        <div class="update-modal-content">
            <p>Name</p>
            <input type="text" id="update-artist-name" placeholder="Artist Name" />
        </div>
        <button id="update-artist-btn" type="button">Update Artist</button>
        <button class="delete-btn" id="delete-artist-btn" type="button">Delete Artist</button>
    </div>
</div>