
const GRID = document.getElementById('grid');
const prevBtn = document.getElementById('prevPage');
const nextBtn = document.getElementById('nextPage');
const pageInfo = document.getElementById('pageInfo');
const backBtn = document.getElementById('btnBack');

// Configuration
const PAGE_SIZE = 6; // 3x2 grid per page
let topics = [];
let page = 0;

// Fallback topics in case loading topics.json via fetch fails (file:// restrictions)
const FALLBACK = [
  {"title":"Từ vựng ngày lễ","image":"assets/topic1.svg","type":"FREE"},
  {"title":"Từ vựng nơi chốn","image":"assets/topic2.svg","type":"FREE"},
  {"title":"[Movers] Từ vựng 1","image":"assets/topic3.svg","type":"PRO"},
  {"title":"Từ vựng làng quê","image":"assets/topic4.svg","type":"FREE"},
  {"title":"[Movers] Từ vựng 2","image":"assets/topic5.svg","type":"PRO"},
  {"title":"[Movers] Từ vựng 3","image":"assets/topic6.svg","type":"PRO"},
  {"title":"Animals","image":"assets/topic7.svg","type":"FREE"},
  {"title":"Food","image":"assets/topic8.svg","type":"FREE"},
  {"title":"School","image":"assets/topic9.svg","type":"PRO"}
];

function loadTopics(){
  fetch('topics.json').then(r=>r.json()).then(data=>{
    topics=data; init();
  }).catch(err=>{
    console.warn('Could not fetch topics.json, using fallback.', err);
    topics=FALLBACK; init();
  });
}

function init(){
  page = 0;
  renderPage();
  attachListeners();
}

function renderPage(){
  GRID.innerHTML='';
  const start = page * PAGE_SIZE;
  const slice = topics.slice(start, start+PAGE_SIZE);
  slice.forEach((t,i)=>{
    const idx = start + i + 1;
    const card = document.createElement('div');
    card.className='card';
    // create content
    card.innerHTML = `
      <div class="num">${idx}</div>
      <div class="meta">
        <div class="title">${t.title}</div>
        <div class="subtitle">${t.type === 'PRO' ? 'Yêu cầu mua PRO' : 'Miễn phí'}</div>
      </div>
      <div class="thumb"><img src="${t.image}" alt="${t.title}"></div>
      <div class="tag ${t.type==='PRO'?'pro':''}">${t.type}</div>
    `;
    // click handler
    card.addEventListener('click', ()=>{
      alert('Bạn chọn: ' + t.title);
    });
    GRID.appendChild(card);
    // staggered reveal
    setTimeout(()=> card.classList.add('show'), 120 * i + 80);
  });

  const totalPages = Math.ceil(topics.length / PAGE_SIZE) || 1;
  pageInfo.textContent = (page+1) + '/' + totalPages;
  prevBtn.disabled = page===0;
  nextBtn.disabled = page >= totalPages-1;
}

function attachListeners(){
  prevBtn.addEventListener('click', ()=>{
    if (page>0){ page--; renderPage(); }
  });
  nextBtn.addEventListener('click', ()=>{
    const totalPages = Math.ceil(topics.length / PAGE_SIZE);
    if (page < totalPages-1){ page++; renderPage(); }
  });
  backBtn.addEventListener('click', ()=>{
    alert('Trở về (bạn có thể gắn hành động ở đây).');
  });
}

// load sequence
loadTopics();
