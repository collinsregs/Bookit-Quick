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
// Get all the dropdown menu elements
var dropdownMenus = document.querySelectorAll('.dropdown-menu');
console.log(dropdownMenus)

// Get all the buttons that toggle the dropdown
var dropdownToggles = document.querySelectorAll('.dropdown-toggle');

// Loop over each dropdown toggle
dropdownToggles.forEach(function(dropdownToggle) {
    // Add a click event listener to the button
    dropdownToggle.addEventListener('click', function(event) {
        // Prevent the default action
        event.preventDefault();
        var dropdownMenu = dropdownToggle.parentElement.querySelector('.dropdown-menu');
        // Toggle the 'show' class on the corresponding dropdown menu
        dropdownMenu.classList.toggle('show');
    });
});

$(document).ready(function() {
    $('#submitBtn').click(function(e) {
        e.preventDefault(); // Prevent the default form submission
        var eventId = $('#updateForm').data('event-id'); // Get the event ID from the form's data-* attribute
        $.ajax({
            url: '/updateEvent/' + eventId, // Get the URL from the form action
            type: 'PUT',
            data: $('#updateForm').serialize(), // Serialize the form data for the AJAX request
            success: function(response) {
               // Check if a redirect URL was returned
    if(response.redirect_url) {
        // Redirect to the returned URL
        console.log("redirect found")
        window.location.href = response.redirect_url;
    }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any errors
                console.log(textStatus, errorThrown);
            }
        });
    });
});




