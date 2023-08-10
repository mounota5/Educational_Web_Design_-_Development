// script.js

const thumbnails = document.querySelectorAll('.thumbnail');
const lightbox = document.querySelector('.lightbox');
const lightboxImage = document.querySelector('.lightbox-image');
const closeBtn = document.querySelector('.close');

thumbnails.forEach(thumbnail => {
  thumbnail.addEventListener('click', () => {
    const fullImage = thumbnail.querySelector('.overlay img').src;
    lightboxImage.src = fullImage;
    lightbox.style.display = 'flex';
  });
});

closeBtn.addEventListener('click', () => {
  lightbox.style.display = 'none';
});
