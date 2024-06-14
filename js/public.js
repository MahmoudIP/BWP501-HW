let button = document.getElementById("but-nav");

let list = document.getElementById("navbar-but");
button.addEventListener("click", (e) => {
  list.classList.toggle("navbar-but-clicked");
  //   list.classList.toggle("navbar-but-clicked");
  console.log("done");
});

list.addEventListener("mouseout", (e) => {
  list.classList.toggle("navbar-but-clicked");
});
