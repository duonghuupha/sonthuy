const images = [
  { src: 'images/image1.jpg', loaded: false },
  { src: 'images/image2.jpg', loaded: false },
  { src: 'images/image3.jpg', loaded: false },
  { src: 'images/image4.jpg', loaded: false },
  { src: 'images/image5.jpg', loaded: false },
  { src: 'images/image6.jpg', loaded: false },
  { src: 'images/image7.jpg', loaded: false },
  { src: 'images/image8.jpg', loaded: false },
  { src: 'images/image9.jpg', loaded: false },
  { src: 'images/image10.jpg', loaded: false }
];

let currentIndex = 0;
const imgElement = document.getElementById('current-page');

function updatePage(direction) {
  const book = document.querySelector('.book img');
  book.style.transform = direction === 'next' ? 'rotateY(-90deg)' : 'rotateY(90deg)';
  setTimeout(() => {
    const currentImage = images[currentIndex];
    if (!currentImage.loaded) {
      const tempImg = new Image();
      tempImg.src = currentImage.src;
      tempImg.onload = () => {
        currentImage.loaded = true;
        imgElement.src = currentImage.src;
      };
      imgElement.src = '';
    } else {
      imgElement.src = currentImage.src;
    }
    book.style.transform = 'rotateY(0deg)';
  }, 300);
}

function nextPage() {
  if (currentIndex < images.length - 1) {
    currentIndex++;
    updatePage('next');
  }
}

function prevPage() {
  if (currentIndex > 0) {
    currentIndex--;
    updatePage('prev');
  }
}

// Hàm giả lập các nút góc
function openPlayMedia() {
  alert("Bạn đã nhấn Play Media!");
}

function openFlashCard() {
  alert("Bạn đã mở Flash Card!");
}

function openQuestion() {
  alert("Bạn đã mở Question!");
}

function openOther() {
  alert("Bạn đã nhấn nút Other!");
}
