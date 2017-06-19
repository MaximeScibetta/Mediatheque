<?php
    return[
        'default'       =>  'GET/auth/getLogin',
        'login'         =>  'POST/auth/postLogin',
        'logout'        =>  'GET/auth/getLogout',
        'guest'         =>  'POST/auth/postGuestUser',

        'inscription'   => 'GET/auth/getInscription',
        'postInscription' => 'POST/auth/postInscription',

        'addArtist'    => 'GET/artist/getAddArtist',
        'postArtist'   => 'POST/artist/postNewArtist',

        'addLabel'    => 'GET/label/getAddLabel',
        'postLabel'   => 'POST/label/postNewLabel',

        'addAlbum'    => 'GET/album/getAddAlbum',
        'postAlbum'   => 'POST/album/postNewAlbum',

        'addMusic'    => 'GET/album/addMusic',

        'addFavorites' => 'POST/user/postFavorites',
        'listingFavorites' => 'GET/user/getFavorites',
        'deleteFavorites' => 'POST/user/deleteFavorites',

        'listingAlbums' =>  'GET/album/getAllAlbums',
        'listingArtists' =>  'GET/artist/getAllArtists',
        'listingLabels' =>  'GET/label/getAllLabels',

        'listingAlbumInfo'  =>  'GET/album/getInfos',
        'listingLabelInfo'  =>  'GET/label/getInfos',
        'listingArtistInfo'  =>  'GET/artist/getInfos',

        'listingArtistAlbums' => 'GET/album/getArtistAlbums',
    ];