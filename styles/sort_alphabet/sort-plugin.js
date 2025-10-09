(function ($) {
	$.fn.sortQuiz = function (options) {
		const settings = $.extend({
			data: null,
			soundCorrect: null,
			soundWrong: null,
			onComplete: function (isCorrect) { }
		}, options);

		function shuffle(array) {
			for (let i = array.length - 1; i > 0; i--) {
				const j = Math.floor(Math.random() * (i + 1));
				[array[i], array[j]] = [array[j], array[i]];
			}
		}

		// ham phat am thanh tư link hoac file
		function playsound(url){
			try{
				if(url && typeof url === "string"){
					const audio = new Audio(url);
					audio.play().catch(() => {});
				}
			}catch(e){
				console.warn("Không thể phát âm thanh", e);
			}
		}

		return this.each(function () {
			const container = $(this);
			container.addClass("sort-container");

			function render(data) {
				const correctWord = data.word.toUpperCase();
				const letters = correctWord.split("");
				const shuffled = [...letters];
				shuffle(shuffled);

				if(data.file.length > 0){
					var ext_file = data.file.split(".").pop();
					if(ext_file == 'mp4' || ext_file == 'webm' || ext_file == 'ogg'){
						var content_file = `
							<div class="question_img">
								<video controls class="img_responsive" style="max-height:200px">
									<source src="${data.url_file}/${data.file}" type="video/${ext_file}">
									Trình duyệt của bạn không hỗ trợ thẻ video.
								</video>
							</div>
						`;
					}else if(ext_file == 'mp3' || ext_file == 'wav' || ext_file == 'ogg'){
						var content_file = `
							<div class="question_img">
								<audio controls class="img_responsive" style="max-height:200px">
									<source src="${data.url_file}/${data.file}" type="audio/${ext_file}">
									Trình duyệt của bạn không hỗ trợ thẻ audio.
								</audio>
							</div>
						`;
					}else if(ext_file == 'png' || ext_file == 'jpg' || ext_file == 'jpeg' || ext_file == 'gif' || ext_file == 'bmp' || ext_file == 'svg'){
						var content_file = `
							<div class="question_img">
								<img src="${data.url_file}/${data.file}" class="img_responsive" style="max-height:200px"/>
							</div>
						`;
					}
					container.html(`
						<h2>${data.instruction || 'Sắp xếp các chữ cái sau thành từ đúng:'}</h2>
						${content_file}
						<div class="letter-bank"></div>
						<div class="answer-area"></div>
						<button class="check-btn">Kiểm tra</button>
						<button class="reset-btn">Làm lại</button>
						<div class="result"></div>
					`);
				}else{
					container.html(`
						<h2>${data.instruction || 'Sắp xếp các chữ cái sau thành từ đúng:'}</h2>
						<div class="letter-bank"></div>
						<div class="answer-area"></div>
						<button class="check-btn">Kiểm tra</button>
						<button class="reset-btn">Làm lại</button>
						<div class="result"></div>
					`);
				}

				const bank = container.find(".letter-bank");
				const answer = container.find(".answer-area");

				shuffled.forEach((ch, i) => {
					bank.append(`<div class="letter-tile" draggable="true" id="tile-${i}" data-char="${ch}">${ch}</div>`);
				});

				for (let i = 0; i < letters.length; i++) {
					answer.append(`<div class="drop-slot" data-index="${i}"></div>`);
				}

				// --- Drag events (desktop) ---
				container.find(".letter-tile").on("dragstart", function (e) {
					e.originalEvent.dataTransfer.setData("text/plain", this.id);
				});

				container.find(".drop-slot").on("dragover", function (e) {
					e.preventDefault();
				});

				container.find(".drop-slot").on("drop", function (e) {
					e.preventDefault();
					const id = e.originalEvent.dataTransfer.getData("text/plain");
					const tile = $('#' + id);
					const cloned = tile.clone().removeAttr("id").removeAttr("draggable").css("cursor", "default");
					tile.remove();
					$(this).html(cloned);
				});

				// --- Mobile / Touch support (click chọn tile rồi chọn slot) ---
				let selectedTile = null;

				// chọn chữ cái
				container.find(".letter-tile").on("click", function () {
					container.find(".letter-tile").removeClass("selected");
					selectedTile = $(this);
					selectedTile.addClass("selected");
				});

				// click vào ô trống -> gán chữ
				container.find(".drop-slot").on("click", function () {
					if (selectedTile && $(this).is(":empty")) {
						const cloned = selectedTile.clone().removeAttr("id").removeAttr("draggable").css("cursor", "default");
						$(this).html(cloned);
						selectedTile.remove();
						selectedTile = null;
						container.find(".letter-tile").removeClass("selected");
					} else if (!$(this).is(":empty")) {
						// nếu slot đã có chữ -> trả về bank
						const char = $(this).text().trim();
						bank.append(`<div class="letter-tile" draggable="true" data-char="${char}">${char}</div>`);
						$(this).empty();

						// gắn lại sự kiện cho chữ vừa trả về
						bank.find(".letter-tile").off("click dragstart").on("click", function () {
							container.find(".letter-tile").removeClass("selected");
							selectedTile = $(this);
							selectedTile.addClass("selected");
						}).on("dragstart", function (e) {
							e.originalEvent.dataTransfer.setData("text/plain", this.id);
						});
					}
				});

				// --- Nút kiểm tra ---
				container.find(".check-btn").on("click", function () {
					let answerWord = "";
					container.find(".drop-slot").each(function () {
						const char = $(this).text().trim();
						answerWord += char;
					});

					const isCorrect = answerWord === correctWord;
					container.find(".result").text(isCorrect ? "Chính xác!" : "Chưa đúng, thử lại nhé.")
						.css("color", isCorrect ? "green" : "red");

					// ✅ Phát âm thanh tùy theo kết quả
					if (isCorrect) {
						playsound(settings.soundCorrect);
					} else {
						playsound(settings.soundWrong);
					}
					
					settings.onComplete(isCorrect);
				});

				// --- Nút làm lại ---
				container.find(".reset-btn").on("click", function () {
					render(data);
				});
			}

			if (typeof settings.data === 'string') {
				$.getJSON(settings.data, render);
			} else {
				render(settings.data);
			}
		});
	};
})(jQuery);
