document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab-selector");
  const contents = document.querySelectorAll(".tab-content");

  const showContent = () => {
    contents.forEach((content) => (content.style.display = "none"));

    tabs.forEach((tab) => {
      if (tab.checked) {
        const tabId = tab.id;
        const contentId = tabId + "-content";
        document.getElementById(contentId).style.display = "block";
      }
    });
  };
  showContent();
  tabs.forEach((tab) => {
    tab.addEventListener("change", showContent);
  });
});
