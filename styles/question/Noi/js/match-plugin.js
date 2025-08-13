
(function($) {
  $.fn.matchImageToText = function(options) {
    const settings = $.extend({
      pairs: [],
      onCheck: function(result) {}
    }, options);

    return this.each(function() {
      const $container = $(this);
      $container.html(`
        <div class="match-container">
          <svg class="svg-overlay"></svg>
          <div class="columns">
            <div class="col colA"></div>
            <div class="col colB"></div>
          </div>
          <div class="buttons">
            <button class="btn btn-reset">🔄 Làm lại</button>
            <button class="btn btn-check">✅ Kiểm tra</button>
          </div>
        </div>
      `);

      const $colA = $container.find(".colA");
      const $colB = $container.find(".colB");
      const $svg = $container.find("svg")[0];
      let connections = [];
      let selectedA = null;

      const shuffle = (array) => array.slice().sort(() => Math.random() - 0.5);
      const shuffledB = shuffle(settings.pairs.map(p => p.b));

      settings.pairs.forEach(pair => {
        const $div = $(`<div class="item" data-a="${pair.a}"><img src="${pair.a}" /></div>`);
        $div.click(() => {
          $container.find("[data-a]").removeClass("selected");
          $div.addClass("selected");
          selectedA = pair.a;
        });
        $colA.append($div);
      });

      shuffledB.forEach(text => {
        const $div = $(`<div class="item" data-b="${text}">${text}</div>`);
        $div.click(() => {
          if (!selectedA) return;
          if (connections.some(c => c.a === selectedA || c.b === text)) return;
          connections.push({ a: selectedA, b: text });
          selectedA = null;
          $container.find(".item").removeClass("selected");
          drawLines();
        });
        $colB.append($div);
      });

      function drawLines() {
        $svg.innerHTML = "";
        const rectC = $container[0].getBoundingClientRect();
        connections.forEach(conn => {
          const elA = $container.find(`[data-a='${conn.a}']`)[0];
          const elB = $container.find(`[data-b='${conn.b}']`)[0];
          if (!elA || !elB) return;
          const rA = elA.getBoundingClientRect();
          const rB = elB.getBoundingClientRect();
          const x1 = rA.right - rectC.left;
          const y1 = rA.top + rA.height/2 - rectC.top;
          const x2 = rB.left - rectC.left;
          const y2 = rB.top + rB.height/2 - rectC.top;
          const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
          path.setAttribute("d", `M ${x1} ${y1} C ${(x1+x2)/2} ${y1}, ${(x1+x2)/2} ${y2}, ${x2} ${y2}`);
          path.setAttribute("stroke", "#3498db");
          path.setAttribute("stroke-width", "4");
          path.setAttribute("fill", "none");
          path.style.cursor = "pointer";
          path.onclick = () => {
            connections = connections.filter(c => !(c.a === conn.a && c.b === conn.b));
            drawLines();
          };
          $svg.appendChild(path);
        });
        $svg.setAttribute("width", $container.width());
        $svg.setAttribute("height", $container.height());
      }

      function check() {
        const results = connections.map(c => ({
          a: c.a,
          b: c.b,
          correct: settings.pairs.some(p => p.a === c.a && p.b === c.b)
        }));
        settings.onCheck(results);
        drawLines();
      }

      $container.find(".btn-reset").click(() => {
        $container.matchImageToText(settings); // Re-render
      });
      $container.find(".btn-check").click(check);
      $(window).on("resize", drawLines);
    });
  };
})(jQuery);
