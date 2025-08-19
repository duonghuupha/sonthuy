
let pages = [];
let current = 1;
let total = 0;
let flipping = false;
let lessonMap = {};
let tocData = [];

const $ = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

async function loadData() {
	const res = await fetch("../styles/slides/data.json");
	const data = await res.json();
	total = data.pages || 1;
	pages = Array.from({ length: total }, (_, i) => `../styles/slides/assets/page${i + 1}.jpg`);
	tocData = data.toc || [];
	lessonMap = data.lessons || {};
}

function renderInitialPage() {
	const book = $(".book-inner");
	book.innerHTML = "";
	const page = document.createElement("div");
	page.className = "page";
	const img = new Image();
	img.src = pages[0];
	page.appendChild(img);
	book.appendChild(page);
	updateToolbar();
}

function updateToolbar() {
	$(".toolbar").textContent = `Trang ${current}/${total}`;
}

function setPage(n) {
	if (n < 1 || n > total || n === current || flipping) return;
	const book = $(".book-inner");
	flipping = true;
	const front = document.createElement("div");
	front.className = "flip-layer";
	front.appendChild(new Image());
	front.firstChild.src = pages[current - 1];
	const back = document.createElement("div");
	back.className = "flip-layer back";
	back.appendChild(new Image());
	back.firstChild.src = pages[n - 1];
	book.appendChild(back);
	book.appendChild(front);
	requestAnimationFrame(() => {
		front.style.transform = "rotateY(0deg)";
		back.style.transform = "rotateY(-180deg)";
		requestAnimationFrame(() => {
			front.style.transform = "rotateY(-180deg)";
			back.style.transform = "rotateY(0deg)";
		});
	});
	setTimeout(() => {
		book.innerHTML = "";
		const page = document.createElement("div");
		page.className = "page";
		const img = new Image();
		img.src = pages[n - 1];
		page.appendChild(img);
		book.appendChild(page);
		current = n;
		flipping = false;
		updateToolbar();
	}, 700);
}

function buildTOC() {
	const container = $("#tree");
	container.innerHTML = "";
	const ul = document.createElement("ul");
	container.appendChild(ul);
	buildNodes(tocData, ul);
}
function buildNodes(nodes, parentUL) {
	nodes.forEach(node => {
		const li = document.createElement("li");
		const row = document.createElement("div");
		row.className = "node";
		const icon = document.createElement("span");
		icon.className = "icon";
		const label = document.createElement("span");
		label.textContent = " " + node.name;
		if (node.type === "folder") {
			icon.textContent = "▸";
			row.appendChild(icon);
			row.appendChild(label);
			li.appendChild(row);
			const childUL = document.createElement("ul");
			childUL.style.display = "none";
			li.appendChild(childUL);
			row.addEventListener("click", () => {
				const open = childUL.style.display !== "none";
				childUL.style.display = open ? "none" : "block";
				icon.textContent = open ? "▸" : "▾";
			});
			if (node.children) buildNodes(node.children, childUL);
		} else {
			icon.textContent = "•";
			row.appendChild(icon);
			row.appendChild(label);
			const badge = document.createElement("span"); badge.className = "badge";
			badge.textContent = "tr." + (node.page ?? "?");
			row.appendChild(badge);
			row.addEventListener("click", () => {
				if (typeof node.page === "number") setPage(node.page);
			});
			li.appendChild(row);
		}
		parentUL.appendChild(li);
	});
}

function setupSearch() {
	const input = $("#search");
	input.addEventListener("input", () => {
		const term = input.value.toLowerCase();
		$$("#tree li").forEach(li => {
			li.style.display = li.textContent.toLowerCase().includes(term) ? "" : "none";
		});
	});
}

function openDialog(type) {
	const dialog = $("#dialog");
	const title = $("#dialog-title");
	const body = $("#dialog-body");
	title.textContent = (type === "media") ? "Media liên quan" : (type === "flashcard") ? "Flash Cards" : "Câu hỏi";
	body.innerHTML = "";
	const lesson = lessonMap[String(current)] || {};

	if (type === "media") {
		const wrap = document.createElement("div"); wrap.className = "media-list";
		(lesson.media || []).forEach(m => {
			const item = document.createElement("div");
			const label = document.createElement("div"); label.textContent = "• " + (m.label || m.src);
			item.appendChild(label);
			if (m.type === "audio") {
				const el = document.createElement("audio"); el.controls = true; el.src = m.src;
				item.appendChild(el);
			} else if (m.type === "video") {
				const el = document.createElement("video"); el.controls = true; el.width = 560;
				const src = document.createElement("source"); src.src = m.src;
				el.appendChild(src);
				item.appendChild(el);
				const note = document.createElement("div"); note.style.fontSize = "12px"; note.style.opacity = ".7";
				note.textContent = "Thay file video thật tại assets/";
				item.appendChild(note);
			}
			wrap.appendChild(item);
		});
		body.appendChild(wrap);
		if ((lesson.media || []).length === 0) { body.innerHTML = "<em>Chưa có media cho trang này.</em>"; }
	}

	if (type === "flashcard") {
		const grid = document.createElement("div"); grid.className = "flashcards";
		(lesson.flashcards || []).forEach(card => {
			const el = document.createElement("div"); el.className = "card"; el.textContent = `${card.front} — ${card.back}`;
			grid.appendChild(el);
		});
		body.appendChild(grid);
		if ((lesson.flashcards || []).length === 0) { body.innerHTML = "<em>Chưa có flashcard cho trang này.</em>"; }
	}

	if (type === "question") {
		const list = document.createElement("div"); list.className = "q-list";
		(lesson.questions || []).forEach((q, idx) => {
			const item = document.createElement("div"); item.className = "q-item";
			const title = document.createElement("div"); title.textContent = (idx + 1) + ". " + q.q; item.appendChild(title);
			(q.choices || []).forEach((c, i) => {
				const line = document.createElement("div"); line.className = "choice";
				const btn = document.createElement("button"); btn.textContent = c; btn.className = "btn";
				const res = document.createElement("div"); res.className = "result";
				btn.addEventListener("click", () => { res.textContent = (i === q.answer) ? "Đúng ✅" : "Sai ❌"; });
				line.appendChild(btn); item.appendChild(line); item.appendChild(res);
			});
			list.appendChild(item);
		});
		body.appendChild(list);
		if ((lesson.questions || []).length === 0) { body.innerHTML = "<em>Chưa có câu hỏi cho trang này.</em>"; }
	}

	dialog.classList.add("show");
}
function closeDialog() { $("#dialog").classList.remove("show"); }

function setupUI() {
	// Prev/Next (ensure they exist before binding)
	const prev = $(".prev-btn"); const next = $(".next-btn");
	prev.addEventListener("click", () => setPage(current - 1));
	next.addEventListener("click", () => setPage(current + 1));
	// corner buttons
	$(".btn-media").addEventListener("click", () => openDialog("media"));
	$(".btn-flash").addEventListener("click", () => openDialog("flashcard"));
	$(".btn-question").addEventListener("click", () => openDialog("question"));
	$("#dialog-close").addEventListener("click", closeDialog);
	// keyboard
	window.addEventListener("keydown", e => {
		if (e.key === "ArrowRight") setPage(current + 1);
		if (e.key === "ArrowLeft") setPage(current - 1);
		if (e.key === "Escape") closeDialog();
	});
	// TOC + search
	buildTOC();
	setupSearch();
}

async function bootstrap() {
	await loadData();
	renderInitialPage();
	setupUI();
}

window.addEventListener("DOMContentLoaded", bootstrap);
