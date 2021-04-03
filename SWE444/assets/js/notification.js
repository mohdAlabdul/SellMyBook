/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  const the_dropdown = document.getElementById("myDropdown");

  if (window.innerWidth < 767){
      /* for small devices show only tontifction number  */
      the_dropdown.classList.remove("show");

  } else {
      the_dropdown.classList.toggle("show");
  }


   // check the aside list
 }

// Close the dropdown if the user clicks outside of it
