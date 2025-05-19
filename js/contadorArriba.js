function counteoArriba(el, target) {
    let data = { count: 0 };
    anime({
      targets: data,
      count: [0, target],
      duration: 2000,//tiempo de animacion en milisegundos(1000ms = 1s)
      round: 1, //redondeo
      delay: 100, 
      easing: 'easeOutCubic',
      update() {
        el.innerText = data.count.toLocaleString();
      }
    });
  }
  
  function makeCountup(el) {
    const text = el.textContent;
    const target = parseInt(text, 10);
  
    const io = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.intersectionRatio > 0) {
        counteoArriba(el, target);
          io.unobserve(entry.target);
        }
      });
    });
  
    io.observe(el);
  }
  
  const els = document.querySelectorAll('[data-countup]');
  
  els.forEach(makeCountup);