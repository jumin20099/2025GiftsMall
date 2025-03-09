// 모든 이미지에 마우스를 올렸을 때 동적으로 div를 생성하도록 이벤트 추가
document.querySelectorAll('.motos').forEach(motos => {
    motos.addEventListener('mouseenter', function() {
        // 이미지에서 data-image-url 속성으로 이미지 URL을 받아옴
        const motosUrl = motos.getAttribute('data-image-url');

        // 새로운 div 요소 생성
        const newDiv = document.createElement('div');

        // div 스타일 설정
        newDiv.style.width = '1620px';  // 너비 설정
        newDiv.style.height = '700px'; // 높이 설정
        newDiv.style.backgroundImage = `url(${motosUrl})`;  // 동적으로 받은 URL로 배경 이미지 설정
        newDiv.style.backgroundSize = 'cover';  // 이미지가 div에 맞게 덮어지도록 설정
        newDiv.style.backgroundPosition = 'center'; // 이미지 위치 중앙으로 설정
        newDiv.style.position = 'absolute';
        // newDiv.style.zIndex = '11230';

        motos.style.display = 'hidden';

        // div를 container에 추가
        document.getElementById('moto-container').appendChild(newDiv);
    });

    motos.addEventListener('mouseleave', function() {
        // 마우스가 떠날 때 새로운 div를 삭제
        const motoContainer = document.getElementById('moto-container');
        if (motoContainer.hasChildNodes()) {
            motoContainer.removeChild(motoContainer.lastChild);
        }
    });
});


const video = document.getElementById('ad-video');
const playPauseBtn = document.getElementById('play-pause');
const stopBtn = document.getElementById('stop');
const rewindBtn = document.getElementById('rewind');
const fastForwardBtn = document.getElementById('fast-forward');
const slowDownBtn = document.getElementById('slow-down');
const speedUpBtn = document.getElementById('speed-up');
const resetSpeedBtn = document.getElementById('reset-speed');
const toggleControlsBtn = document.getElementById('toggle-controls');
const toggleLoopBtn = document.getElementById('toggle-loop');
const toggleAutoplayBtn = document.getElementById('toggle-autoplay');

let isPlaying = false;
let isControlsVisible = true;
let isLooping = false;
let isAutoplay = false;

// 재생 / 일시정지
playPauseBtn.addEventListener('click', () => {
  if (video.paused) {
    video.play();
    playPauseBtn.textContent = '일시정지';
  } else {
    video.pause();
    playPauseBtn.textContent = '재생';
  }
});

// 정지
stopBtn.addEventListener('click', () => {
  video.pause();
  video.currentTime = 0;
  playPauseBtn.textContent = '재생';
});

// 되감기 (10초씩)
rewindBtn.addEventListener('click', () => {
  video.currentTime = Math.max(0, video.currentTime - 10);
});

// 빨리감기 (10초씩)
fastForwardBtn.addEventListener('click', () => {
  video.currentTime = Math.min(video.duration, video.currentTime + 10);
});

// 감속 (0.1배씩)
slowDownBtn.addEventListener('click', () => {
  video.playbackRate = Math.max(0.1, video.playbackRate - 0.1);
});

// 배속 (0.1배씩)
speedUpBtn.addEventListener('click', () => {
  video.playbackRate += 0.1;
});

// 배속 원래대로 돌리기
resetSpeedBtn.addEventListener('click', () => {
  video.playbackRate = 1;
});

// 컨트롤러 보이기/숨기기
toggleControlsBtn.addEventListener('click', () => {
    isControlsVisible = !isControlsVisible;
    const controls = document.querySelector('.controls');
    const buttons = controls.querySelectorAll('button');
  
    if (isControlsVisible) {
      // 컨트롤러가 보일 때는 모든 버튼을 보이게
      buttons.forEach(button => button.style.display = 'inline-block');
      toggleControlsBtn.textContent = '컨트롤러 숨기기'
    } else {
      // 컨트롤러가 숨겨졌을 때는 '컨트롤러 보이기' 버튼만 보이게 하고 나머지 버튼들은 숨기기
      buttons.forEach(button => {
        if (button !== toggleControlsBtn) {
          button.style.display = 'none';
          toggleControlsBtn.textContent = '컨트롤러 보이기'
        }
      });
    }
  });
  

// 반복 켜기/끄기
toggleLoopBtn.addEventListener('click', () => {
    isLooping = !isLooping;
    video.loop = isLooping;
    // 버튼 텍스트를 '반복 켜기'와 '반복 끄기'로 변경
    toggleLoopBtn.textContent = isLooping ? '반복 끄기' : '반복 켜기';
  });

// 자동재생 켜기/끄기
toggleAutoplayBtn.addEventListener('click', () => {
    isAutoplay = !isAutoplay;
    video.autoplay = isAutoplay;
    // 버튼 텍스트를 '자동재생 켜기'와 '자동재생 끄기'로 변경
    toggleAutoplayBtn.textContent = isAutoplay ? '자동재생 끄기' : '자동재생 켜기';
  });