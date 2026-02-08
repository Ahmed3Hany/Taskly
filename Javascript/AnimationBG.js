// -----------------------------------------------------------------------------------------------Background stars

const canvas = document.getElementById("stars");
const ctx = canvas.getContext("2d");

// Fullscreen canvas
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const numStars = 300;
const stars = [];

// Create stars
for (let i = 0; i < numStars; i++) {
    stars.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        radius: Math.random() * 2,
        speedX: (Math.random() - 0.5) * 1, // random X movement
        speedY: (Math.random() - 0.5) * 1  // random Y movement
    });
}

function drawStars() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = "white";

    stars.forEach(star => {
        ctx.beginPath();
        ctx.arc(star.x, star.y, star.radius, 0, Math.PI * 2);
        ctx.fill();

        // Move star
        star.x += star.speedX;
        star.y += star.speedY;

        // Wrap around screen edges
        if (star.x < 0) star.x = canvas.width;
        if (star.x > canvas.width) star.x = 0;
        if (star.y < 0) star.y = canvas.height;
        if (star.y > canvas.height) star.y = 0;
    });

    requestAnimationFrame(drawStars);
}
drawStars();

// Resize canvas dynamically
window.addEventListener("resize", () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
});
