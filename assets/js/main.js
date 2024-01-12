// Execute when the DOM content is fully loaded
window.addEventListener('DOMContentLoaded', () => {
  let scrollPos = 0;
  const mainNav = document.getElementById('mainNav');
  const headerHeight = mainNav.clientHeight;
  window.addEventListener('scroll', function () {
    const currentTop = document.body.getBoundingClientRect().top * -1;
    if (currentTop < scrollPos) {
      // Scrolling Up
      if (currentTop > 0 && mainNav.classList.contains('is-fixed')) {
        mainNav.classList.add('is-visible');
      } else {
        console.log(123);
        mainNav.classList.remove('is-visible', 'is-fixed');
      }
    } else {
      // Scrolling Down
      mainNav.classList.remove(['is-visible']);
      if (currentTop > headerHeight && !mainNav.classList.contains('is-fixed')) {
        mainNav.classList.add('is-fixed');
      }
    }
    scrollPos = currentTop;
  });
})

// Handle login_form submission for login
const loginform = document.getElementById("login_Form");

if (loginform) {
  loginform.addEventListener("submit", function (event) {
    // Prevent the default form submission
    event.preventDefault();

    // Create a FormData object with the form data
    const formData = new FormData(this);

    // Send a POST request to the server
    fetch("index.php?page=login", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data.trim() === 'Login successful') {
          // If login is successful, display success message
          alertComponent(data.trim());
          // Redirect to the home page after a delay
          setTimeout(() => {
            window.location.href = "index.php?page=home";
          }, 1000);
        } else {
          // If login is not successful, display an error message
          alertComponent(data.trim());
        }
      })
      .catch((error) => {
        // Handle errors from the fetch request
        console.error('Error:', error);
        // Handle errors here
      });
  });
}


// Handle form submission for login
const registerform = document.getElementById("register_Form");

if (registerform) {
  registerform.addEventListener("submit", function (event) {
    // Prevent the default form submission
    event.preventDefault();

    // Create a FormData object with the form data
    const formData = new FormData(this);

    // Send a POST request to the server
    fetch("index.php?page=register", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data.trim() === 'Registration successful') {
          // If register is successful, display success message
          alertComponent(data.trim());
          // Redirect to the home page after a delay

          setTimeout(() => {
            window.location.href = "index.php?page=login";
          }, 1000);
        } else {
          // If login is not successful, display an error message
          alertComponent(data.trim());
        }
      })
      .catch((error) => {
        // Handle errors from the fetch request
        console.error('Error:', error);
        // Handle errors here
      });
  });
}

// Display a message using SweetAlert
function alertComponent(type) {
  switch (type) {
    case 'Login successful':
      Swal.fire({
        title: "Good job!",
        text: "Login successful!",
        icon: "success"
      });
      break;
    case 'Registration successful':
      Swal.fire({
        title: "Good job!",
        text: "Login successful!",
        icon: "success"
      });
      break;
    default:
      // If login is not successful, display an error message
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: type,
      });
      break;
  }
};