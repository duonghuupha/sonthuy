(function ($) {
	$.fn.matchingQuiz = function (options) {
		const settings = $.extend({
			dataUrl: null,
			soundCorrect: null,
			soundWrong: null
		}, options);
		let $container = $(this);
		let connections = [];
		let selected = { left: null, right: null };
		// Load data
		$.getJSON(settings.dataUrl, function (data) {
			renderQuiz(data);
		});
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
		function renderQuiz(data) {
			$container.empty();
			connections = [];
			// Thêm phần nội dung câu hỏi (title)
			if (data.questionText) {
				$container.append('<div class="quiz-title">' + data.questionText + '</div>');
				if(data.file_question.length > 0){
					var ext_file = data.file_question.split(".").pop();
					if(ext_file == 'mp4' || ext_file == 'webm' || ext_file == 'ogg'){
						var content_file = `
							<div class="question_img" style="text-align:center">
								<video controls class="img_responsive" style="max-height:200px">
									<source src="${data.url_file}/${data.file_question}" type="video/${ext_file}">
									Trình duyệt của bạn không hỗ trợ thẻ video.
								</video>
							</div>
						`;
					}else if(ext_file == 'mp3' || ext_file == 'wav' || ext_file == 'ogg'){
						var content_file = `
							<div class="question_img" style="text-align:center">
								<audio controls class="img_responsive" style="max-height:200px">
									<source src="${data.url_file}/${data.file_question}" type="audio/${ext_file}">
									Trình duyệt của bạn không hỗ trợ thẻ audio.
								</audio>
							</div>
						`;
					}else if(ext_file == 'png' || ext_file == 'jpg' || ext_file == 'jpeg' || ext_file == 'gif' || ext_file == 'bmp' || ext_file == 'svg'){
						var content_file = `
							<div class="question_img" style="text-align:center">
								<img src="${data.url_file}/${data.file_question}" class="img_responsive" style="max-height:200px"/>
							</div>
						`;
					}
					$container.append(`${content_file}`);
				}
			}
			// shuffle arrays
			let leftItems = shuffle([...data.questions]);
			let rightItems = shuffle([...data.answers]);
			let $columns = $('<div class="quiz-columns"></div>');
			let $left = $('<div class="column left"><h3>A</h3></div>');
			let $right = $('<div class="column right"><h3>B</h3></div>');
			let $svg = $('<svg class="connection-layer"></svg>');
			leftItems.forEach(q => {
				let $item = $('<div class="item"></div>').attr("data-id", q.id);
				if(q.file_a.length > 0){
					$item.append(`<img src="${q.url_file}/${q.file_a}" class="img_responsive" style="max-height:50px">`);
				}
				$item.append(q.content);
				//if (q.type === "image") $item.append(`<img src="${q.content}" style="max-width:100%">`);
				//if (q.type === "audio") $item.append(`<audio controls src="${q.content}"></audio>`);
				$left.append($item);
			});
			rightItems.forEach(a => {
				let $item = $('<div class="item"></div>').attr("data-id", a.id);
				if(a.file_b.length > 0){
					$item.append(`<img src="${a.url_file}/${a.file_b}" class="img_responsive" style="max-height:50px">`);
				}
				$item.append(a.content);
				$right.append($item);
			});
			$columns.append($left).append($right).append($svg);
			$container.append($columns);
			let $actions = $('<div class="quiz-actions"></div>');
			let $checkBtn = $('<button>Kiểm tra</button>');
			let $resetBtn = $('<button>Làm lại</button>');
			$actions.append($checkBtn).append($resetBtn);
			$container.append($actions);
			$container.append('<div class="quiz-result"></div>');
			bindEvents(data, $svg, leftItems, rightItems, $checkBtn, $resetBtn);
		}
		function bindEvents(data, $svg, leftItems, rightItems, $checkBtn, $resetBtn) {
			$container.find('.left .item').click(function () {
				$container.find('.left .item').removeClass('selected');
				$(this).addClass('selected');
				selected.left = $(this).data('id');
				tryConnect($svg);
			});
			$container.find('.right .item').click(function () {
				$container.find('.right .item').removeClass('selected');
				$(this).addClass('selected');
				selected.right = $(this).data('id');
				tryConnect($svg);
			});
			$checkBtn.click(function () {
				let correctPairs = data.correct;
				let allCorrect = true;
				correctPairs.forEach(pair => {
					let found = connections.find(c => c.left == pair.left && c.right == pair.right);
					if (!found) allCorrect = false;
				});
				if (connections.length !== correctPairs.length) allCorrect = false;

				if (allCorrect) {
					$container.find('.quiz-result').text("✅ Chính xác!").removeClass("incorrect").addClass("correct");
					playsound(settings.soundCorrect);
				} else {
					$container.find('.quiz-result').text("❌ Chưa chính xác!").removeClass("correct").addClass("incorrect");
					playsound(settings.soundWrong);
				}
			});
			$resetBtn.click(function () {
				renderQuiz(data); // reset + shuffle lại
			});
		}
		function tryConnect($svg) {
			if (selected.left && selected.right) {
				connections.push({ left: selected.left, right: selected.right });
				drawConnections($svg);
				$container.find('.item').removeClass('selected');
				selected.left = null;
				selected.right = null;
			}
		}
		function drawConnections($svg) {
			$svg.empty();
			connections.forEach(c => {
				let $left = $container.find(`.left .item[data-id='${c.left}']`);
				let $right = $container.find(`.right .item[data-id='${c.right}']`);
				if ($left.length && $right.length) {
					let leftPos = $left[0].getBoundingClientRect();
					let rightPos = $right[0].getBoundingClientRect();
					let svgPos = $svg[0].getBoundingClientRect();
					let x1 = leftPos.right - svgPos.left;
					let y1 = leftPos.top + leftPos.height / 2 - svgPos.top;
					let x2 = rightPos.left - svgPos.left;
					let y2 = rightPos.top + rightPos.height / 2 - svgPos.top;
					let path = document.createElementNS("http://www.w3.org/2000/svg", "path");
					path.setAttribute("d", `M${x1},${y1} C${(x1 + x2) / 2},${y1} ${(x1 + x2) / 2},${y2} ${x2},${y2}`);
					path.setAttribute("stroke", "#4caf50");
					path.setAttribute("stroke-width", "3");
					path.setAttribute("fill", "none");
					$svg.append(path);
				}
			});
		}
		function shuffle(array) {
			return array.sort(() => Math.random() - 0.5);
		}
	}
})(jQuery);
