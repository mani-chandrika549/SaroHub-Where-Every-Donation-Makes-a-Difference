document.addEventListener("DOMContentLoaded", () => {
    const infoCards = document.querySelectorAll(".info-card");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            } else {
                entry.target.classList.remove("visible");
            }
        });
    }, { threshold: 0.1 });

    infoCards.forEach((card) => observer.observe(card));
});