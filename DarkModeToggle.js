// On page load or when changing themes, best to add inline in `head` to avoid FOUC

const checkbox = document.getElementById("checkbox")
checkbox.addEventListener("change", () => {
  document.body.classList.toggle("dark")
})

// function toggleFunc()
// {
//    document.documentElement.classList.toggle(
//     "dark",
//     localStorage.theme === "dark" ||
//       (!("theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches),
//   );
// }
// // Whenever the user explicitly chooses light mode
// localStorage.theme = "white";
// // Whenever the user explicitly chooses dark mode
// localStorage.theme = "dark";
// // Whenever the user explicitly chooses to respect the OS preference
// localStorage.removeItem("theme");
