// Video play button

document.querySelectorAll(".video-play-button").forEach((button) => {
  button.addEventListener("click", function () {
    this.style.display = "none"; // Hide the button

    const video = this.previousElementSibling; // Get the previous sibling video element

    if (video && video.tagName.toLowerCase() === "video") {
      video.pause(); // Pause first to reset playback
      video.currentTime = 0; // Restart from the beginning
      video.muted = false; // Unmute the video
      video.setAttribute("controls", "true"); // Add controls
      video.play();
    }
  });
});
