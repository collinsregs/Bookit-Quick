window.onload = function() {
    const grid = document.querySelector(".masonry_wrapper");
    console.log(grid);
    const masonry = new Masonry(grid, {
        itemSelector: '.card',
        gutter: 10,
        percentPosition: true
    });
    console.log(masonry)
};
