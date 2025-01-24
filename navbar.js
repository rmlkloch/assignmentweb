// Toggle menu for mobile
function toggleMenu() {
    const menuItems = document.getElementById("menuItems");
    menuItems.classList.toggle("active");
}

// Toggle dropdown visibility when clicked
function toggleDropdown() {
    const dropdown = event.target.parentElement; // Get the clicked dropdown item
    dropdown.classList.toggle("active"); // Toggle the 'active' class to show/hide the dropdown
}
