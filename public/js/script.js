window.onload = function() {

    const grid = document.querySelector(".masonry_wrapper");

    const masonry = new Masonry(grid, {
        itemSelector: '.card',
        gutter: 10,
        percentPosition: true
    });
};


window.addEventListener('scroll', function() {
    var navbar = document.getElementById('navbar');
    if (window.pageYOffset > 0) {
      navbar.classList.remove('top');
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
      navbar.classList.add('top');
    }
  });
// Get the dropdown menu element
var dropdownMenu = document.querySelector('.dropdown-menu');


// Get the button that toggles the dropdown
var dropdownToggle = document.querySelector('.dropdown-toggle');
console.log(dropdownToggle)

// Add a click event listener to the button
dropdownToggle.addEventListener('click', function(event) {
    // Prevent the default action
    event.preventDefault();

    // Toggle the 'show' class on the dropdown menu
    dropdownMenu.classList.toggle('show');
});


