var video = document.getElementById("myVideo");
    var videoPlayer = document.getElementById("videoPlayer");

    function showVideoPlayer() {
        videoPlayer.style.display = "block";
        video.pause();
        document.querySelector('.play-button').style.display = 'none';
    }

    function closeVideoPlayer() {
        videoPlayer.style.display = "none";
        video.play();
        document.querySelector('.play-button').style.display = 'block';
    }

    function previousVideo() {
        var mainVideo = document.getElementById("mainVideo");
        mainVideo.pause();
        // Add logic to change video source to previous video
    }

    function nextVideo() {
        var mainVideo = document.getElementById("mainVideo");
        mainVideo.pause();
        // Add logic to change video source to next video
    }