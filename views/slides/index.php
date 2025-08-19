<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ebook 9:16 - Sidebar + Nút góc (Fixed)</title>
    <link rel="stylesheet" href="<?php echo URL.'/styles/slides/' ?>style.css" />
</head>

<body>
    <div class="app">
        <!-- Sidebar (trái) -->
        <aside class="sidebar">
            <h4>📚 Danh mục bài giảng</h4>
            <input id="search" class="search" placeholder="Tìm kiếm... (ví dụ: 'Bài 1')" />
            <div id="tree" class="tree"></div>
        </aside>

        <!-- Viewer (phải) -->
        <section class="viewer-wrap">
            <!-- Nút góc gắn theo KHUNG HIỂN THỊ -->
            <button class="corner-btn top-left btn-media" title="Media">🎵</button>
            <button class="corner-btn top-right btn-flash" title="Flash Cards">🃏</button>
            <button class="corner-btn bottom-left btn-question" title="Question">❓</button>

            <!-- Điều hướng trang -->
            <div class="nav-btn prev-btn" title="Trang trước">⟨</div>
            <div class="nav-btn next-btn" title="Trang sau">⟩</div>

            <!-- Khung sách (9:16, không cuộn) -->
            <div class="book">
                <div class="book-inner"><!-- page will be injected here --></div>
            </div>

            <div class="toolbar">Trang 1/1</div>
        </section>
    </div>

    <!-- Dialog -->
    <div id="dialog" class="dialog">
        <div class="dialog-content">
            <button id="dialog-close" class="dialog-close">✖</button>
            <div id="dialog-title" class="dialog-title">Dialog</div>
            <div id="dialog-body"></div>
        </div>
    </div>

    <script src="<?php echo URL.'/styles/slides/' ?>script.js"></script>
</body>

</html>