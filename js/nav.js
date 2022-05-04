function menu() {
    var x = document.getElementById("mobile-nav");
      if (x.className === "nav-wrapper") {
        x.className += "responsive";
      } else {
        x.className = "nav-wrapper";
      }
    }