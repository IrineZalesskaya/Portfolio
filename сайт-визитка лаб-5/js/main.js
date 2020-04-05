let slideItems = document.querySelectorAll('.slide'),
    indContainer = document.querySelector('.indicators'),
    indItems = document.querySelectorAll('.indicators-item'),
    currentSlide = 0;

const LEFT_ARROW = 37;
const RIGHT_ARROW = 39;
const SPACE = 32;
const FA_PAUSE = '<i class="fas fa-pause"></i>';
const FA_PLAY = '<i class="fas fa-play-circle"></i>';

indContainer.style.display = 'flex'; 
document.querySelector('.controls').style.display = 'block';

let gotoSlide = (n) => {
  slideItems[currentSlide].classList.toggle('active');
  indItems[currentSlide].classList.toggle('active');
  currentSlide = (n + slideItems.length) % slideItems.length;
  slideItems[currentSlide].classList.toggle('active');
  indItems[currentSlide].classList.toggle('active');
};

let nextSlide = () => {
  gotoSlide(currentSlide + 1);
};

let previousSlide = () => {
  gotoSlide(currentSlide - 1);
};

let pauseSlideShow = () => {
  pauseBtn.innerHTML = FA_PAUSE;
  playbackStatus = false;
  clearInterval(slideInterval);
};

let playSlideShow = () => {
  pauseBtn.innerHTML = FA_PLAY;
  playbackStatus = true;
  slideInterval = setInterval(nextSlide, 2000);
};

let slideInterval = setInterval(nextSlide, 2000);

let playbackStatus = true,
    pauseBtn = document.querySelector('.indicators-pause'),
    nextBtn  = document.querySelector('.controls-next'),
    prevBtn  = document.querySelector('.controls-prev');

let pauseClickHandler = () => {
  playbackStatus ? pauseSlideShow() : playSlideShow();
};

let nextClickHandler = () => {
  pauseSlideShow();
  nextSlide();
};

let prevClickHandler = () => {
  pauseSlideShow();
  previousSlide();
};

pauseBtn.addEventListener('click', pauseClickHandler);
nextBtn.addEventListener('click', nextClickHandler);
prevBtn.addEventListener('click', prevClickHandler);

let indClickHandler = (e) => {
  let target = e.target;

  if ( target.classList.contains('indicators-item') ) {
    let n = +target.getAttribute('data-slide-to');
    pauseSlideShow();
    gotoSlide(n);
  }
};

indContainer.addEventListener('click', indClickHandler);
let keyControlHandler = (e) => {
  if (e.keyCode === LEFT_ARROW) { prevClickHandler(); }
  if (e.keyCode === RIGHT_ARROW) { nextClickHandler(); }
  if (e.keyCode === SPACE) { pauseClickHandler(); }
};

document.addEventListener('keydown', keyControlHandler);