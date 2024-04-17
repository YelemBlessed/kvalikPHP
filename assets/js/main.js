// кнопки 
const prev = document.querySelector('.prev-btn')
const next = document.querySelector('.next-btn')
// трек со всеми слайдами
const track = document.querySelector('.slider-track')

// массив со всеми слайдами (нумируется 0, 1, 2 ...)
const slides = document.querySelectorAll('.slide')

// наш текущий слайд
let currentSlide = 0;


// если нажат вперёд
next.addEventListener('click', () => {
    // если текущий салйд (нумирается 0, 1, 2) больше или равен длинне массива слайдов (длина нумерации 1, 2, 3 ...)
    
    if (currentSlide >= slides.length - 1) {
        // то поставить текущий слайд
        currentSlide = 0
        track.style.left = currentSlide * -100 + '%';
    }
    // если нет то слайд + 1
    else {
        currentSlide++
        track.style.left = currentSlide * -100 + '%';
    }
})

// если нажат назад
prev.addEventListener('click', () => {
    // если текущий салйд (нумирается 0, 1, 2) меньше или равен нулю
    if (currentSlide <= 0) {
        // то поставить текущий слайд как максимальный
        currentSlide = slides.length - 1
        track.style.left = currentSlide * -100 + '%';
    }
    // если нет то слайд - 1
    else {
        currentSlide--
        track.style.left = currentSlide * -100 + '%';
    }
})