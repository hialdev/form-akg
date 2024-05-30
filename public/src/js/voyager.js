document.addEventListener("DOMContentLoaded", function() {
    // Select the anchor element inside the site-footer-right div
    var footerLink = document.querySelector('.site-footer-right a');
    
    // Change the href attribute
    footerLink.href = "https://elangmerah.com";
    
    // Change the text inside the anchor tag
    footerLink.textContent = "Elang Merah Api";
});