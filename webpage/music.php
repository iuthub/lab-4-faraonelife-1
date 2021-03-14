<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Music Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="viewer.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
$playlist = (isset($_REQUEST["playlist"]))?$_REQUEST["playlist"]:NULL;
$shuffle = (isset($_REQUEST["shuffle"]))?$_REQUEST["shuffle"]:NULL;
function songSize($filesize) {
    if($filesize > 0 && $filesize < 1024){
        return $filesize . " b";}
    elseif ($filesize > 1048577) {
        return round($filesize/1048576, 2) . " mb";}
    elseif ($filesize > 1023 && $filesize < 1048576){
        return round($filesize/1024, 2) . " kb";}

}

?>
<div id="header">
    <p><a href="music.php">Main Page</a>    <a href="music.php?shuffle=on">Shuffle</a></p>
    <h1>190M Music Playlist Viewer</h1>
    <h2>Search Through Your Playlists and Music</h2>
</div>


<div id="listarea">
    <ul id="musiclist">

        <?php
        if($playlist)
        {
            $songs = file("songs/$playlist", FILE_IGNORE_NEW_LINES);
        }
        else if($shuffle)
        {
            $songs = glob("songs/*.mp3");
            shuffle($songs);
        }
        else
        {
            $songs = glob("songs/*.mp3");
        }

        foreach ( $songs as $song) {
            if(strstr($song, ".mp3")){
                ?>
                <li class="mp3item" ><a href="<?= 'songs/'.basename($song)?> "> <?= basename($song) ?></a> (<?= songSize(filesize("songs/". basename($song))) ?>)</li>
            <?php } }

        $set = glob("songs/*.m3u");
        if(!($playlist))
        {
            foreach ( $set as $song) {
                ?>
                <li class="playlistitem" ><a href="music.php?playlist=<?= basename($song)?>"> <?= basename($song) ?>   </a> </li>

            <?php } } ?>

    </ul>
</div>
</body>
</html>