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

  function setupScrollCounter(scroller, counter, itemSelector) {
    if (!scroller || !counter) return;

    const items = Array.from(scroller.querySelectorAll(itemSelector));
    const total = items.length;

    if (!total) {
      counter.hidden = true;
      return;
    }

    counter.hidden = false;

    function updateCounter() {
      const scrollLeft = scroller.scrollLeft;
      let current = 1;

      items.forEach((item, index) => {
        if (scrollLeft >= item.offsetLeft - item.clientWidth / 2) {
          current = index + 1;
        }
      });

      counter.textContent = `${current} / ${total}`;
    }

    scroller.addEventListener("scroll", updateCounter, { passive: true });
    window.addEventListener("resize", updateCounter);
    updateCounter();
  }

  document.querySelectorAll("[data-hero-slider]").forEach((hero) => {
    const slides = Array.from(hero.querySelectorAll(".hero-slide"));
    const prev = hero.querySelector("[data-hero-prev]");
    const next = hero.querySelector("[data-hero-next]");
    const dotsRoot = hero.querySelector("[data-hero-dots]");
    let current = 0;
    let timer = null;
    const dots = [];

    function showSlide(index) {
      if (!slides.length) return;
      current = (index + slides.length) % slides.length;
      slides.forEach((slide, slideIndex) => {
        slide.classList.toggle("is-active", slideIndex === current);
      });
      dots.forEach((dot, dotIndex) => {
        dot.classList.toggle("is-active", dotIndex === current);
      });
    }

    function restart() {
      if (slides.length <= 1) return;
      window.clearInterval(timer);
      timer = window.setInterval(() => showSlide(current + 1), 5000);
    }

    if (dotsRoot) {
      dotsRoot.textContent = "";
      slides.forEach((_, index) => {
        const dot = document.createElement("button");
        dot.type = "button";
        dot.setAttribute("aria-label", `${index + 1}枚目のスライド`);
        dot.addEventListener("click", () => {
          showSlide(index);
          restart();
        });
        dotsRoot.appendChild(dot);
        dots.push(dot);
      });
    }

    if (slides.length <= 1) {
      if (prev) prev.hidden = true;
      if (next) next.hidden = true;
      if (dotsRoot) dotsRoot.hidden = true;
      showSlide(0);
      return;
    }

    if (prev) {
      prev.addEventListener("click", () => {
        showSlide(current - 1);
        restart();
      });
    }

    if (next) {
      next.addEventListener("click", () => {
        showSlide(current + 1);
        restart();
      });
    }

    showSlide(0);
    restart();
  });

  document.querySelectorAll("[data-card-slider]").forEach((slider) => {
    const root = slider.closest(".section-inner") || slider.parentElement;
    const prev = root ? root.querySelector("[data-scroll-prev]") : null;
    const next = root ? root.querySelector("[data-scroll-next]") : null;
    const counter = root ? root.querySelector("[data-news-counter]") : null;
    const cards = slider.querySelectorAll(".news-card");

    if (prev && next) {
      if (cards.length <= 1) {
        prev.hidden = true;
        next.hidden = true;
      } else {
        const scrollByCard = () => Math.min(380, slider.clientWidth * 0.85);
        prev.addEventListener("click", () => slider.scrollBy({ left: -scrollByCard(), behavior: "smooth" }));
        next.addEventListener("click", () => slider.scrollBy({ left: scrollByCard(), behavior: "smooth" }));
      }
    }

    setupScrollCounter(slider, counter, ".news-card");
  });

  document.querySelectorAll("[data-tabs]").forEach((tabs) => {
    const buttons = Array.from(tabs.querySelectorAll("[data-tab-button]"));
    const panels = Array.from(tabs.querySelectorAll("[data-tab-panel]"));
    const buttonGroup = tabs.querySelector(".tab-buttons");

    if (buttons.length <= 1 && buttonGroup) {
      buttonGroup.hidden = true;
    }

    if (buttons.length) {
      const firstButton = buttons[0];
      const firstTarget = firstButton.dataset.tabButton;
      buttons.forEach((item, index) => {
        const active = index === 0;
        item.classList.toggle("is-active", active);
        item.setAttribute("aria-selected", String(active));
      });
      panels.forEach((panel) => {
        panel.classList.toggle("is-active", panel.dataset.tabPanel === firstTarget);
      });
    }

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

  document.querySelectorAll(".event-search-panel").forEach((panel) => {
    const root = panel.closest(".section-inner") || document;
    const eventSearchInput = panel.querySelector("[data-event-search-input]");
    const eventSearchStatus = panel.querySelector("[data-event-search-status]");
    const eventCards = Array.from(root.querySelectorAll(".calendar-event-card"));

    if (!eventSearchInput || !eventSearchStatus || !eventCards.length) return;

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
  });

  document.querySelectorAll("[data-gallery-counter]").forEach((counter) => {
    setupScrollCounter(counter.parentElement?.querySelector(".gallery-grid"), counter, "figure");
  });
  document.querySelectorAll("[data-food-menu-counter]").forEach((counter) => {
    setupScrollCounter(counter.parentElement?.querySelector(".food-menu-board-grid"), counter, "figure");
  });
  document.querySelectorAll("[data-drink-menu-counter]").forEach((counter) => {
    setupScrollCounter(counter.parentElement?.querySelector(".menu-image-grid"), counter, "figure");
  });
  document.querySelectorAll(".profile-category").forEach((category) => {
    setupScrollCounter(category.querySelector(".profile-grid"), category.querySelector("[data-profile-counter]"), "figure");
  });
})();
