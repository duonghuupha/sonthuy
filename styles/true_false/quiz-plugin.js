(function ($) {
	$.fn.trueFalseQuiz = function (options) {
		const settings = $.extend({ questions: [] }, options);
		const originalQuestions = JSON.parse(JSON.stringify(settings.questions));

		return this.each(function () {
			const container = $(this).empty();

			function renderQuiz() {
				container.empty();

				originalQuestions.forEach((q, index) => {
					var ext_file = '', html = '';
					if(q.file.length > 0){
						ext_file = q.file.split(".").pop();
						if(ext_file == 'png' || ext_file == 'PNG' || ext_file == 'jpg' || ext_file == 'JPG' || ext_file == 'jpeg' || ext_file == 'JPEG'){
							html += '<div class="question-img">';
								html += '<img src="'+baseUrl+'/public/lesson/'+q.lesson_id+'/question/'+q.file+'" class="img_responsive"/>'
							html += '</div>';
						}
					}else{
						html = '';
					}
					const box = $(`
						<div class="question-box" data-index="${index}">
						<div class="question">${q.question}</div>
						${html}
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
