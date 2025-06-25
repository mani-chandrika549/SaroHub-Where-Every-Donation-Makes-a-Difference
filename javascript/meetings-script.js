document.addEventListener("DOMContentLoaded", () => {
    const meetingCards = document.querySelectorAll(".meeting-card");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            } else {
                entry.target.classList.remove("visible");
            }
        });
    }, { threshold: 0.2 });

    meetingCards.forEach((card) => observer.observe(card));
});