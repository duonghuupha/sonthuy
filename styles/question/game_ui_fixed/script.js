// DOM elements
const audio = document.getElementById('audioPlayer');
const playBtn = document.querySelector('.btn-play');
const playIcon = document.getElementById('playIcon');
const progressBar = document.getElementById('progressBar');
const timeDisplay = document.getElementById('timeDisplay');

// Add entry animations
document.querySelector('.title').classList.add('fade-in-up','delay-1');
document.querySelector('.instruction').classList.add('fade-in-up','delay-2');
document.querySelector('.audio-bar').classList.add('fade-in-up','delay-3');
document.querySelector('.scene-frame').classList.add('zoom-in','delay-4');
document.querySelector('.btn-nav.left').classList.add('fly-in-left','delay-5');
document.querySelector('.btn-nav.right').classList.add('fly-in-right','delay-5');
document.querySelector('.btn-exit').classList.add('fly-in-left','delay-5');

// Format time helper
function formatTime(s){ if (!isFinite(s)) return '00:00'; const m=Math.floor(s/60); const sec=Math.floor(s%60); return String(m).padStart(2,'0')+':'+String(sec).padStart(2,'0'); }

// Play/pause toggle
playBtn.addEventListener('click', ()=>{
  if (audio.paused){ audio.play(); playIcon.src='assets/pause.svg'; }
  else { audio.pause(); playIcon.src='assets/btn-play.svg'; }
});

// Update progress/time while playing
audio.addEventListener('timeupdate', ()=>{
  if (audio.duration){ progressBar.value = (audio.currentTime/audio.duration)*100; }
  timeDisplay.textContent = formatTime(audio.currentTime)+' / '+formatTime(audio.duration);
});

// Seek when user drags
progressBar.addEventListener('input', ()=>{
  if (audio.duration) audio.currentTime = (progressBar.value/100)*audio.duration;
});

// Swap icon when audio ends
audio.addEventListener('ended', ()=>{ playIcon.src='assets/btn-play.svg'; });

// Initialize display once metadata loaded
audio.addEventListener('loadedmetadata', ()=>{
  timeDisplay.textContent = '00:00 / '+formatTime(audio.duration);
});
