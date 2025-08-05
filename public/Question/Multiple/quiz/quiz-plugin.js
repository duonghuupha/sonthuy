(function($){
  $.fn.multiCorrectQuiz = function(options) {
    const settings = $.extend({ questions: [] }, options);
    const originalQuestions = JSON.parse(JSON.stringify(settings.questions));

    return this.each(function(){
      const container = $(this).empty();

      function renderQuiz() {
        container.empty();

        originalQuestions.forEach((q, index) => {
          let optionsHTML = '';
          q.options.forEach((opt, i) => {
            optionsHTML += `<label class="option-label">
              <input type="checkbox" name="q${index}" value="${i}" class="quiz-checkbox"/>
              ${opt}
            </label>`;
          });

          const questionBox = $(`
            <div class="question-box" data-index="${index}">
              <div class="question">${q.question}</div>
              <div class="option-container">${optionsHTML}</div>
              <div class="feedback"></div>
            </div>
          `);
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

      container.on('click', '#check-answers', function() {
        container.find('.question-box').each(function(){
          const box = $(this);
          const qIndex = box.data('index');
          const correctAnswers = originalQuestions[qIndex].answers.map(String);
          const selectedAnswers = box.find('input.quiz-checkbox:checked').map(function(){ return this.value; }).get();
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

      container.on('click', '#reset-quiz', function() {
        renderQuiz();
      });
    });
  };
})(jQuery);
