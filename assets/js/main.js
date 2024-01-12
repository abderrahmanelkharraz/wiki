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

const loginform = document.getElementById("loginForm");

if (loginform) {
  loginform.addEventListener("submit", function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch("index.php?page=login", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data.trim() === 'Login successful') {
          console.log('Login successful');
          alertComponent(data.trim());
          setTimeout(() => {
            window.location.href = "index.php?page=home";
          }, 9000);
        } else {
          console.log('Login not successful');
          // Handle other cases (invalid email, email not registered, invalid password)
          alertComponent(data.trim());
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        // Handle errors here
      });
  });
}

function alertComponent(type) {
  console.log(type);
  switch (type) {
    case 'Login successful':
      Swal.fire({
        title: "Good job!",
        text: "Login successful !",
        icon: "success"
      });
      break;
    default:
      // Handle unexpected cases
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: type,
      });
      break;
  }
};
