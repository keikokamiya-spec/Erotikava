(function () {
  const header = document.querySelector("[data-header]");
  const toggle = document.querySelector("[data-menu-toggle]");
  const nav = document.querySelector("[data-nav]");

  function updateHeader() {
    if (!header) return;
    header.classList.toggle("is-scrolled", window.scrollY > 20);
  }

  updateHeader();
  window.addEventListener("scroll", updateHeader, { passive: true });

  if (toggle && nav && header) {
    toggle.addEventListener("click", () => {
      const isOpen = nav.classList.toggle("is-open");
      toggle.classList.toggle("is-active", isOpen);
      header.classList.toggle("is-open", isOpen);
      document.body.classList.toggle("menu-open", isOpen);
      toggle.setAttribute("aria-expanded", String(isOpen));
    });

    nav.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", () => {
        nav.classList.remove("is-open");
        toggle.classList.remove("is-active");
        header.classList.remove("is-open");
        document.body.classList.remove("menu-open");
        toggle.setAttribute("aria-expanded", "false");
      });
    });
  }

  const hero = document.querySelector("[data-hero-slider]");
  if (hero) {
    const slides = Array.from(hero.querySelectorAll(".hero-slide"));
    const prev = hero.querySelector("[data-hero-prev]");
    const next = hero.querySelector("[data-hero-next]");
    const dotsRoot = hero.querySelector("[data-hero-dots]");
    let current = 0;
    let timer = null;

    const dots = slides.map((_, index) => {
      const dot = document.createElement("button");
      dot.type = "button";
      dot.setAttribute("aria-label", `${index + 1}枚目のスライド`);
      dot.addEventListener("click", () => {
        showSlide(index);
        restart();
      });
      dotsRoot.appendChild(dot);
      return dot;
    });

    function showSlide(index) {
      current = (index + slides.length) % slides.length;
      slides.forEach((slide, slideIndex) => {
        slide.classList.toggle("is-active", slideIndex === current);
      });
      dots.forEach((dot, dotIndex) => {
        dot.classList.toggle("is-active", dotIndex === current);
      });
    }

    function restart() {
      window.clearInterval(timer);
      timer = window.setInterval(() => showSlide(current + 1), 5000);
    }

    prev.addEventListener("click", () => {
      showSlide(current - 1);
      restart();
    });
    next.addEventListener("click", () => {
      showSlide(current + 1);
      restart();
    });

    showSlide(0);
    restart();
  }

  const slider = document.querySelector("[data-card-slider]");
  const scrollPrev = document.querySelector("[data-scroll-prev]");
  const scrollNext = document.querySelector("[data-scroll-next]");
  if (slider && scrollPrev && scrollNext) {
    const scrollByCard = () => Math.min(380, slider.clientWidth * 0.85);
    scrollPrev.addEventListener("click", () => slider.scrollBy({ left: -scrollByCard(), behavior: "smooth" }));
    scrollNext.addEventListener("click", () => slider.scrollBy({ left: scrollByCard(), behavior: "smooth" }));
  }

  document.querySelectorAll("[data-tabs]").forEach((tabs) => {
    const buttons = Array.from(tabs.querySelectorAll("[data-tab-button]"));
    const panels = Array.from(tabs.querySelectorAll("[data-tab-panel]"));

    buttons.forEach((button) => {
      button.addEventListener("click", () => {
        const target = button.dataset.tabButton;
        buttons.forEach((item) => {
          const active = item === button;
          item.classList.toggle("is-active", active);
          item.setAttribute("aria-selected", String(active));
        });
        panels.forEach((panel) => {
          panel.classList.toggle("is-active", panel.dataset.tabPanel === target);
        });
      });
    });
  });

  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", (event) => {
      const target = document.querySelector(anchor.getAttribute("href"));
      if (!target) return;
      event.preventDefault();
      target.scrollIntoView({ behavior: "smooth", block: "start" });
    });
  });

  function setupScrollCounter(scroller, counter, itemSelector) {
    if (!scroller || !counter) return;
    const items = Array.from(scroller.querySelectorAll(itemSelector));
    const total = items.length;
    if (!total) return;

    function updateCounter() {
      const cardWidth = scroller.scrollWidth / total;
      const current = Math.min(total, Math.max(1, Math.round(scroller.scrollLeft / cardWidth) + 1));
      counter.textContent = current + " / " + total;
    }

    scroller.addEventListener("scroll", updateCounter, { passive: true });
    updateCounter();
  }

  const eventSearchInput = document.querySelector("[data-event-search-input]");
  const eventSearchStatus = document.querySelector("[data-event-search-status]");
  const eventCards = Array.from(document.querySelectorAll(".calendar-event-card"));
  if (eventSearchInput && eventSearchStatus && eventCards.length) {
    const total = eventCards.length;

    const normalize = (value) => value.toLowerCase().replace(/\s+/g, "");

    const updateSearch = () => {
      const query = normalize(eventSearchInput.value);
      let visible = 0;

      eventCards.forEach((card) => {
        const haystack = normalize([
          card.dataset.eventDate || "",
          card.dataset.eventStatus || "",
          card.textContent || "",
        ].join(" "));
        const matches = !query || haystack.includes(query);
        card.hidden = !matches;
        if (matches) visible += 1;
      });

      eventSearchStatus.textContent = query
        ? `${visible}件ヒット / 全${total}件`
        : `${total}件表示中`;
    };

    eventSearchInput.addEventListener("input", updateSearch);
    eventSearchInput.addEventListener("search", updateSearch);
    updateSearch();
  }

  setupScrollCounter(document.querySelector(".gallery-grid"), document.querySelector("[data-gallery-counter]"), "figure");
  setupScrollCounter(document.querySelector(".event-grid"), document.querySelector("[data-event-counter]"), "figure");
  setupScrollCounter(document.querySelector(".food-menu-board-grid"), document.querySelector("[data-food-menu-counter]"), "figure");
  setupScrollCounter(document.querySelector(".menu-image-grid"), document.querySelector("[data-drink-menu-counter]"), "figure");

  // News carousel counter
  setupScrollCounter(document.querySelector(".news-slider"), document.querySelector("[data-news-counter]"), ".news-card");
})();
