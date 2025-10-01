(function ($) {
	$.fn.trueFalseQuiz = function (options) {
		const settings = $.extend({ questions: [] }, options);
		const originalQuestions = JSON.parse(JSON.stringify(settings.questions));

		return this.each(function () {
			const container = $(this).empty();

			function renderQuiz() {
				container.empty();

				originalQuestions.forEach((q, index) => {
					const box = $(`
						<div class="question-box" data-index="${index}">
						<div class="question">${q.question}</div>
						<div class="question_img">
							<img src="${q.url_file}/${q.file}" class="img_responsive" style="max-height:200px"/>
						</div>
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
					} else {
						feedback.text("❌ Sai rồi!").removeClass("correct").addClass("incorrect");
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
