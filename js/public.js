let button = document.getElementById("nav-but");

let list = document.getElementById("navbar-but");
button.addEventListener("click", (e) => {
  list.classList.toggle("navbar-but-clicked");
  //   list.classList.toggle("navbar-but-clicked");
  console.log("done");
});
