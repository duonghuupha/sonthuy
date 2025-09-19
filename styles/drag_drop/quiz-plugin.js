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

			function renderQuiz(data) {
				shuffleArray(data.options);

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

				data.options.forEach((item, i) => {
					const content = item.text
						? item.text
						: `<img src="${item.image}" alt="image" class="opt-img"/>`;
					container.find('.drag-area').append(
						`<div class="draggable" draggable="true" id="drag-${i}" data-match="${item.match}">${content}</div>`
					);
				});

				data.targets.forEach((target, i) => {
					container.find('.drop-area').append(
						`<div class="droppable" data-accept="${target.accept}">
               ${target.text}
               <div class="answer-wrap"></div>
             </div>`
					);
				});

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
					const match = $el.data("match");

					const clone = $el.clone();
					clone.removeAttr("id").removeAttr("draggable").css({ cursor: "default" });
					$el.remove();

					const $target = $(this);
					if (!$target.data("matches")) $target.data("matches", []);
					$target.data("matches").push(match);

					$target.find('.answer-wrap').append(clone);
				});

				container.find(".submit-btn").on("click", function () {
					let correct = 0;
					const total = data.targets.length;

					container.find(".droppable").each(function () {
						const expected = $(this).data("accept");
						const matches = $(this).data("matches") || [];
						const allCorrect = matches.every(m => m === expected);
						const hasAnswer = matches.length > 0;

						if (allCorrect && hasAnswer) {
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
