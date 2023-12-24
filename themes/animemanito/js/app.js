document.addEventListener('DOMContentLoaded', () => {
    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {
        // Add a click event on each of them
        $navbarBurgers.forEach(el => {
            el.addEventListener('click', () => {
                // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementById(target);
                // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
            });
        });
    }
});

function readURL(input, image_id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        var image_element = document.getElementById(image_id);
        /*var source_width = image_element.width;
        var source_height = image_element.height;*/

        image_element.src = e.target.result;
        /*image_element.width = source_width;
        image_element.height = source_height;*/
    };
    reader.readAsDataURL(input.files[0]);
  }
}
