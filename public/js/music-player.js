function playMp3(id) {
    const progressArea = document.querySelector(`.progress-area${id}`),
        progressBar = progressArea.querySelector(`.progress-bar`),
        mainAudio = document.querySelector(`#main-audio${id}`),
        moreMusicBtn = document.querySelector(`#music-info${id}`),
        musicInfo = document.querySelector(`.music-info${id}`),
        closemoreMusic = document.querySelector(`#close${id}`),
        iconBtn = document.querySelector(`.main-audio${id} i`);

    moreMusicBtn.addEventListener("click", () => {
        musicInfo.classList.toggle("show");
    });

    closemoreMusic.addEventListener("click", () => {
        moreMusicBtn.click();
    });
    if (mainAudio.classList.contains("paused")) {
        mainAudio.classList.remove("paused");
        iconBtn.classList.remove("fa-pause");
        iconBtn.classList.add("fa-play");
        mainAudio.pause();
    } else {
        mainAudio.classList.add("paused");
        iconBtn.classList.remove("fa-play");
        iconBtn.classList.add("fa-pause");
        mainAudio.play();
    }


    // update progress bar width according to music current time
    mainAudio.addEventListener("timeupdate", (e) => {
        const currentTime = e.target.currentTime; //getting playing song currentTime
        const duration = e.target.duration; //getting playing song total duration
        let progressWidth = (currentTime / duration) * 100;
        progressBar.style.width = `${progressWidth}%`;

        let musicCurrentTime = document.querySelector(`.current-time${id}`),
            musicDuartion = document.querySelector(`.max-duration${id}`);
        // update song total duration
        let mainAdDuration = mainAudio.duration;
        let totalMin = Math.floor(mainAdDuration / 60);
        let totalSec = Math.floor(mainAdDuration % 60);
        if (totalSec < 10) { //if sec is less than 10 then add 0 before it
            totalSec = `0${totalSec}`;
        }
        musicDuartion.innerText = `${totalMin}:${totalSec}`;
        // update playing song current time
        let currentMin = Math.floor(currentTime / 60);
        let currentSec = Math.floor(currentTime % 60);
        if (currentSec < 10) { //if sec is less than 10 then add 0 before it
            currentSec = `0${currentSec}`;
        }
        musicCurrentTime.innerText = `${currentMin}:${currentSec}`;
        // update playing song currentTime on according to the progress bar width
    });
}