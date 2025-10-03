(function ($) {
	$.fn.mcqQuiz = function (options) {
		const settings = $.extend({ questions: [] }, options);
		let originalQuestions = JSON.parse(JSON.stringify(settings.questions));
		return this.each(function () {
			const container = $(this).empty();
			function renderQuestions(questions) {
				container.empty();
				questions.forEach((q, index) => {
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
									<input type="radio" name="q${index}" value="${opt.index}" class="quiz-radio"/>
									<img src="${q.url_file}/${opt.text.file_detail}" class="img_responsive" style="max-height:50px"/>
									${opt.text.title}
								</label>
							`;
						}else{
							optionsHTML += `
								<label class="option-label">
									<input type="radio" name="q${index}" value="${opt.index}" class="quiz-radio"/>
									${opt.text.title}
								</label>
							`;
						}
					});
					let questionBox = '';
					if(q.file.length > 0) {
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
					<button id="check-answers" class="quiz-button control-button">Kiểm tra</button>
					<button id="reset-quiz" class="quiz-button control-button">Làm lại</button>
				</div>
				`);
			}
			renderQuestions(originalQuestions);
			container.on('click', '#check-answers', function () {
				container.find('.question-box').each(function () {
					const box = $(this);
					const qIndex = box.data('index');
					const selected = box.find('input.quiz-radio:checked').val();
					const correct = originalQuestions[qIndex].answer;
					const feedback = box.find('.feedback');
					if (selected == correct) {
						feedback.text('✅ Chính xác!').removeClass('incorrect').addClass('correct');
					} else {
						feedback.text('❌ Sai rồi!').removeClass('correct').addClass('incorrect');
					}
					box.find('input').prop('disabled', true);
				});
			});
			container.on('click', '#reset-quiz', function () {
				renderQuestions(originalQuestions); // Gọi lại để xáo trộn lại
			});
		});
	};
})(jQuery);
