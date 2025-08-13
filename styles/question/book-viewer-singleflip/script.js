
document.addEventListener('DOMContentLoaded', function(){
  const pages = [
    'images/page1.png',
    'images/page2.png',
    'images/page3.png',
    'images/page4.png',
    'images/page5.png'
  ];
  let idx = 0;
  const pageEl = document.getElementById('page');
  const imgEl = document.getElementById('page-img');
  const btnNext = document.getElementById('btnNext');
  const btnPrev = document.getElementById('btnPrev');
  const dlg = document.getElementById('dialog');
  const dlgContent = document.getElementById('dlgContent');
  const dlgClose = document.getElementById('dlgClose');

  function showPage(i){
    idx = Math.max(0, Math.min(i, pages.length-1));
    imgEl.src = pages[idx];
  }

  function flipTo(newIndex, direction){
    // direction: 'next' or 'prev'
    // rotate to 90deg, swap image, then rotate back to 0
    pageEl.style.transition = 'transform 300ms ease';
    pageEl.style.transform = (direction==='next') ? 'rotateY(-90deg)' : 'rotateY(90deg)';
    pageEl.classList.add('flipping');
    setTimeout(()=>{
      // swap image
      showPage(newIndex);
      // flip back
      pageEl.style.transition = 'transform 300ms ease';
      pageEl.style.transform = (direction==='next') ? 'rotateY(0deg)' : 'rotateY(0deg)';
      // remove flipping after transition
      setTimeout(()=>{ pageEl.classList.remove('flipping'); }, 320);
    }, 320);
  }

  btnNext.addEventListener('click', ()=>{
    if(idx < pages.length-1) flipTo(idx+1, 'next');
  });
  btnPrev.addEventListener('click', ()=>{
    if(idx > 0) flipTo(idx-1, 'prev');
  });

  // dialogs content
  const data = {
    media: { title: 'Media demo', url: 'media_sample.gif' },
    flashcard: { title: 'Flash Card', content: '<b>Apple</b> — Quả táo<br><br>Ví dụ: I eat an apple.' },
    question: { title: 'Câu hỏi', content: 'Apple có nghĩa là gì?<br>A. Quả táo<br>B. Quả cam<br>C. Quả chuối' }
  };

  document.getElementById('btnMedia').addEventListener('click', ()=>{
    let html = `<h3>${data.media.title}</h3><img src="${data.media.url}" style="width:100%; max-height:60vh; object-fit:contain" />`;
    openDlg(html);
  });
  document.getElementById('btnFlash').addEventListener('click', ()=>{
    openDlg(`<h3>${data.flashcard.title}</h3><div style="text-align:left">${data.flashcard.content}</div>`);
  });
  document.getElementById('btnQuestion').addEventListener('click', ()=>{
    openDlg(`<h3>${data.question.title}</h3><div style="text-align:left">${data.question.content}</div>`);
  });

  function openDlg(html){ dlgContent.innerHTML = html; dlg.classList.remove('hidden'); }
  function closeDlg(){ dlg.classList.add('hidden'); dlgContent.innerHTML = ''; }
  dlgClose.addEventListener('click', closeDlg);
  dlg.addEventListener('click', (e)=>{ if(e.target===dlg) closeDlg(); });

  // keyboard support
  document.addEventListener('keydown', (e)=>{
    if(e.key==='ArrowRight') btnNext.click();
    if(e.key==='ArrowLeft') btnPrev.click();
    if(e.key==='Escape') closeDlg();
  });

  // init
  showPage(0);
});
