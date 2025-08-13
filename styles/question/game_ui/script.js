const audio = document.getElementById("audioPlayer");
const playBtn = document.querySelector(".btn-play");
const progressBar = document.getElementById("progressBar");
const timeDisplay = document.getElementById("timeDisplay");

document.querySelector(".title").classList.add("fade-in-up", "delay-1");
document.querySelector(".instruction").classList.add("fade-in-up", "delay-2");
document.querySelector(".audio-bar").classList.add("fade-in-up", "delay-3");
document.querySelector(".scene-frame").classList.add("zoom-in", "delay-4");
document.querySelector(".btn-nav.left").classList.add("fly-in-left", "delay-5");
document.querySelector(".btn-nav.right").classList.add("fly-in-right", "delay-5");
document.querySelector(".btn-exit").classList.add("fly-in-left", "delay-5");

function formatTime(seconds) {
    const min = Math.floor(seconds / 60);
    const sec = Math.floor(seconds % 60);
    return `${String(min).padStart(2, '0')}:${String(sec).padStart(2, '0')}`;
}

playBtn.addEventListener("click", () => {
    if (audio.paused) {
        audio.play();
        playBtn.querySelector("img").src = "assets/pause.png";
    } else {
        audio.pause();
        playBtn.querySelector("img").src = "assets/btn-play.png";
    }
});

audio.addEventListener("timeupdate", () => {
    const progress = (audio.currentTime / audio.duration) * 100;
    progressBar.value = progress;
    timeDisplay.textContent = `${formatTime(audio.currentTime)} / ${formatTime(audio.duration)}`;
});

progressBar.addEventListener("input", () => {
    audio.currentTime = (progressBar.value / 100) * audio.duration;
});

audio.addEventListener("ended", () => {
    playBtn.querySelector("img").src = "assets/btn-play.png";
});
