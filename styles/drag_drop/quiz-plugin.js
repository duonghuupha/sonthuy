(function ($) {
	$.fn.dragDropQuiz = function (options) {
		const settings = $.extend({
			data: null,
			onComplete: function (correct, total) { }
		}, options);

		function shuffleArray(array) {
			for (let i = array.length - 1; i > 0; i--) {
				const j = Math.floor(Math.random() * (i + 1));
				[array[i], array[j]] = [array[j], array[i]];
			}
		}

		return this.each(function () {
			const container = $(this);
			container.addClass("quiz-container");
			// phát hiện mobile
			var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

			function renderQuiz(data) {
				shuffleArray(data.options);
				if(data.file.length > 0){
					container.html(`
						<h2>${data.question}</h2>
						<div class="img_question"><img src="${data.url_file}/${data.file}" class="img_responsive" style="max-height:200px;"/></div>
						<div class="drag-area"></div>
						<div class="drop-area"></div>
						<div class="btn-group">
							<button class="submit-btn">Kiểm tra</button>
							<button class="reset-btn">Làm lại</button>
						</div>
						<div class="result"></div>
					`);
				}else{
					container.html(`
						<h2>${data.question}</h2>
						<div class="drag-area"></div>
						<div class="drop-area"></div>
						<div class="btn-group">
							<button class="submit-btn">Kiểm tra</button>
							<button class="reset-btn">Làm lại</button>
						</div>
						<div class="result"></div>
					`);
				}

				data.options.forEach((item, i) => {
					var content;
					if(item.image.length > 0){
						content = `<img src="${item.url_file}/${item.image}" alt="image" class="opt-img"/>${item.text}`;
					}else{
						content = item.text;
					}

					container.find('.drag-area').append(`
						<div class="draggable" draggable="true" id="drag-${i}" data-match="${item.match}">
							${content}
						</div>
					`);
				});

				data.targets.forEach((target, i) => {
					var content_t;
					if(target.file.length > 0){
						content_t = `
						<div class="img_target"><img src="${target.url_file}/${target.file}" class="img_responsive" style="max-height:50px;"/></div>
						<div class="droppable" data-accept="${target.accept}">${target.text}<div class="answer-wrap"></div></div>
						`;
					}else{
						content_t = `<div class="droppable" data-accept="${target.accept}">${target.text}<div class="answer-wrap"></div></div>`;
					}
					container.find('.drop-area').append(`${content_t}`);
				});
				if (!isMobile) {
					// PC: dùng drag & drop như cũ
					container.find(".draggable").on("dragstart", function (e) {
						e.originalEvent.dataTransfer.setData("text", $(this).attr("id"));
					});
					container.find(".droppable").on("dragover", function (e) {
						e.preventDefault();
					});
					container.find(".droppable").on("drop", function (e) {
						e.preventDefault();
						const id = e.originalEvent.dataTransfer.getData("text");
						const $el = $('#' + id);
						const clone = $el.clone();
						clone.removeAttr("id").removeAttr("draggable").css({ cursor: "default" });
						$el.remove();
						$(this).find(".answer-wrap").append(clone);
					});
				} else {
					// Mobile: click chọn -> click thả
					let selected = null;
					container.on("click", ".draggable", function(){
						if($(this).closest(".droppable").length){
							const $target = $(this).closest(".droppable");
							// xóa đáp án khỏi matches
							let matches = $target.data("matches") || [];
							matches = matches.filter(m => m !== $(this).data("match"));
							$target.data("matches", matches);
							container.find(".drag-area").append($(this));
							return;
						}
						$(".draggable", container).removeClass("selected");
						selected = $(this).addClass("selected");
					});
					container.on("click", ".droppable", function(){
						if(selected){
							const $target = $(this);
							$target.find(".answer-wrap").append(selected.removeClass("selected"));

							// cập nhật lại matches
							let matches = $target.data("matches") || [];
							matches.push(selected.data("match"));
							$target.data("matches", matches);

							selected = null;
						}
					});
				}

				container.find(".submit-btn").on("click", function () {
					let correct = 0;
					const total = data.targets.length;
					container.find(".droppable").each(function () {
						const expected = $(this).data("accept");
						const given = [];
						// Lấy toàn bộ đáp án đã bỏ vào ô này
						$(this).find(".answer-wrap .draggable").each(function () {
							given.push($(this).data("match"));
						});
						const hasAnswer = given.length > 0;
						const allCorrect = hasAnswer && given.every(m => m === expected);
						if (allCorrect) {
							correct++;
							$(this).css("border-color", "green");
						} else {
							$(this).css("border-color", "red");
						}
					});
					container.find(".result").text(`Bạn làm đúng ${correct} / ${total}`);
					settings.onComplete(correct, total);
				});

				container.find(".reset-btn").on("click", function () {
					renderQuiz(data);
				});
			}

			if (typeof settings.data === 'string') {
				$.getJSON(settings.data, renderQuiz);
			} else {
				renderQuiz(settings.data);
			}
		});
	};
})(jQuery);
