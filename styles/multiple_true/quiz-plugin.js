(function ($) {
	$.fn.multiCorrectQuiz = function (options) {
		const settings = $.extend({ questions: [] }, options);
		const originalQuestions = JSON.parse(JSON.stringify(settings.questions));
		return this.each(function () {
			const container = $(this).empty();
			function renderQuiz() {
				container.empty();
				originalQuestions.forEach((q, index) => {
					/*let optionsHTML = '';
					q.options.forEach((opt, i) => {
						optionsHTML += `<label class="option-label">
						<input type="checkbox" name="q${index}" value="${opt.index}" class="quiz-checkbox"/>
						${opt.text.title}
						</label>`;
					});*/
					const shuffled = q.options.map((opt, i) => ({ text: opt, index: i }));
					for (let i = shuffled.length - 1; i > 0; i--) {
						const j = Math.floor(Math.random() * (i + 1));
						[shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
					}
					let optionsHTML = '';
					shuffled.forEach((opt, i) => {
						if(opt.text.file_detail.length > 0) {
							optionsHTML += `
								<label class="option-label">
									<input type="checkbox" name="q${index}" value="${opt.index}" class="quiz-checkbox"/>
									<img src="${q.url_file}/${opt.text.file_detail}" class="img_responsive" style="max-height:50px"/>
									${opt.text.title}
								</label>
							`;
						}else{
							optionsHTML += `
								<label class="option-label">
									<input type="checkbox" name="q${index}" value="${opt.index}" class="quiz-checkbox"/>
									${opt.text.title}
								</label>
							`;
						}
					});
					let questionBox = '';
					if(q.file.length > 0){
						if(q.file.length != 0){
							var ext_file = q.file.split(".").pop();
							if(ext_file == 'mp4' || ext_file == 'webm' || ext_file == 'ogg'){
								var content_file = `
									<div class="question_img">
										<video controls class="img_responsive" style="max-height:200px">
											<source src="${q.url_file}/${q.file}" type="video/${ext_file}">
											Trình duyệt của bạn không hỗ trợ thẻ video.
										</video>
									</div>
								`;
							}else if(ext_file == 'mp3' || ext_file == 'wav' || ext_file == 'ogg'){
								var content_file = `
									<div class="question_img">
										<audio controls class="img_responsive" style="max-height:200px">
											<source src="${q.url_file}/${q.file}" type="audio/${ext_file}">
											Trình duyệt của bạn không hỗ trợ thẻ audio.
										</audio>
									</div>
								`;
							}else if(ext_file == 'png' || ext_file == 'jpg' || ext_file == 'jpeg' || ext_file == 'gif' || ext_file == 'bmp' || ext_file == 'svg'){
								var content_file = `
									<div class="question_img">
										<img src="${q.url_file}/${q.file}" class="img_responsive" style="max-height:200px"/>
									</div>
								`;
							}
						}else{
							var content_file = '';
						}
						questionBox = $(`
							<div class="question-box" data-index="${index}">
							<div class="question">${q.question}</div>
							${content_file}
							<div class="option-container">${optionsHTML}</div>
							<div class="feedback"></div>
							</div>
						`);
					}else{
						questionBox = $(`
							<div class="question-box" data-index="${index}">
							<div class="question">${q.question}</div>
							<div class="option-container">${optionsHTML}</div>
							<div class="feedback"></div>
							</div>
						`);
					}
					container.append(questionBox);
				});
				container.append(`
					<div class="quiz-controls">
						<button id="check-answers" class="quiz-button">Kiểm tra</button>
						<button id="reset-quiz" class="quiz-button">Làm lại</button>
					</div>
				`);
			}
			renderQuiz();
			container.on('click', '#check-answers', function () {
				container.find('.question-box').each(function () {
					const box = $(this);
					const qIndex = box.data('index');
					const correctAnswers = originalQuestions[qIndex].answers.map(String);
					const selectedAnswers = box.find('input.quiz-checkbox:checked').map(function () { return this.value; }).get();
					const feedback = box.find('.feedback');
					const isCorrect = selectedAnswers.length === correctAnswers.length &&
						selectedAnswers.every(val => correctAnswers.includes(val));
					feedback
						.text(isCorrect ? "✅ Chính xác!" : "❌ Sai rồi!")
						.removeClass("correct incorrect")
						.addClass(isCorrect ? "correct" : "incorrect");
					box.find('input').prop('disabled', true);
				});
			});
			container.on('click', '#reset-quiz', function () {
				renderQuiz();
			});
		});
	};
})(jQuery);
