(function ($) {
	$.fn.trueFalseQuiz = function (options) {
		const settings = $.extend({ 
			questions: [],
			soundCorrect: null,
			soundWrong: null
		}, options);
		const originalQuestions = JSON.parse(JSON.stringify(settings.questions));

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
			const container = $(this).empty();

			function renderQuiz() {
				container.empty();

				originalQuestions.forEach((q, index) => {
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
					const box = $(`
						<div class="question-box" data-index="${index}">
						<div class="question">${q.question}</div>
						${content_file}
						<div class="button-container">
							<label><input type="radio" name="q${index}" value="true" class="quiz-radio"> Đúng</label>
							<label><input type="radio" name="q${index}" value="false" class="quiz-radio"> Sai</label>
						</div>
						<div class="feedback"></div>
						</div>
					`);
					container.append(box);
				});

				container.append(`
				<div class="quiz-controls">
					<button id="check-answers" class="quiz-button control-button">Kiểm tra</button>
					<button id="reset-quiz" class="quiz-button control-button">Làm lại</button>
				</div>
				`);
			}

			renderQuiz();

			container.on('click', '#check-answers', function () {
				container.find('.question-box').each(function () {
					const box = $(this);
					const qIndex = box.data('index');
					const userAnswer = box.find('input.quiz-radio:checked').val();
					const correctAnswer = String(originalQuestions[qIndex].answer);
					const feedback = box.find('.feedback');

					if (userAnswer === correctAnswer) {
						feedback.text("✅ Chính xác!").removeClass("incorrect").addClass("correct");
						playsound(settings.soundCorrect);
					} else {
						feedback.text("❌ Sai rồi!").removeClass("correct").addClass("incorrect");
						playsound(settings.soundWrong);
					}

					box.find('input').prop('disabled', true);
				});
			});

			container.on('click', '#reset-quiz', function () {
				renderQuiz();
			});
		});
	};
})(jQuery);
