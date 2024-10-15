const images = document.querySelectorAll('.photo-item img');
const sliderModal = document.getElementById('slider-modal');
const sliderImg = document.getElementById('slider-img');
const closeBtn = document.querySelector('.close');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');
const likeBtn = document.getElementById('like-btn');
const dislikeBtn = document.getElementById('dislike-btn');

let currentIndex = 0;
let likes = []; // Array to track liked images

// Show the slider modal when an image is clicked
images.forEach((img, index) => {
    img.addEventListener('click', () => {
        currentIndex = index;
        showImage(currentIndex);
        sliderModal.style.display = 'block';
    });
});

// Close the modal when the close button is clicked
closeBtn.addEventListener('click', () => {
    sliderModal.style.display = 'none';
});

// Show the previous image
prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
    showImage(currentIndex);
});

// Show the next image
nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
    showImage(currentIndex);
});

// Like button logic
likeBtn.addEventListener('click', () => {
    if (!likes[currentIndex]) {
        likes[currentIndex] = true; // Mark the image as liked
        likeBtn.style.color = "#ff6b6b"; // Change color to indicate liked
        dislikeBtn.style.color = "#fff"; // Reset dislike color
    }
});

// Dislike button logic
dislikeBtn.addEventListener('click', () => {
    if (likes[currentIndex]) {
        likes[currentIndex] = false; // Mark the image as not liked
        dislikeBtn.style.color = "#ff6b6b"; // Change color to indicate disliked
        likeBtn.style.color = "#fff"; // Reset like color
    }
});

// Show the image in the slider
function showImage(index) {
    sliderImg.src = images[index].src;

    // Update like and dislike button states based on whether the image is liked
    if (likes[index]) {
        likeBtn.style.color = "#ff6b6b";
        dislikeBtn.style.color = "#fff";
    } else {
        likeBtn.style.color = "#fff";
        dislikeBtn.style.color = "#ff6b6b";
    }
}