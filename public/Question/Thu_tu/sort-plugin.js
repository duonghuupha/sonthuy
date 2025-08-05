(function ($) {
  $.fn.sortQuiz = function (options) {
    const settings = $.extend({
      data: null,
      onComplete: function (isCorrect) {}
    }, options);

    function shuffle(array) {
      for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
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

        container.html(`
          <h2>${data.instruction || 'Sắp xếp các chữ cái sau thành từ đúng:'}</h2>
          <div class="letter-bank"></div>
          <div class="answer-area"></div>
          <button class="check-btn">Kiểm tra</button>
          <button class="reset-btn">Làm lại</button>
          <div class="result"></div>
        `);

        const bank = container.find(".letter-bank");
        const answer = container.find(".answer-area");

        shuffled.forEach((ch, i) => {
          bank.append(`<div class="letter-tile" draggable="true" id="tile-${i}" data-char="${ch}">${ch}</div>`);
        });

        for (let i = 0; i < letters.length; i++) {
          answer.append(`<div class="drop-slot" data-index="${i}"></div>`);
        }

        // Drag events
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

        container.find(".check-btn").on("click", function () {
          let answerWord = "";
          container.find(".drop-slot").each(function () {
            const char = $(this).text().trim();
            answerWord += char;
          });

          const isCorrect = answerWord === correctWord;
          container.find(".result").text(isCorrect ? "Chính xác!" : "Chưa đúng, thử lại nhé.")
            .css("color", isCorrect ? "green" : "red");

          settings.onComplete(isCorrect);
        });

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
