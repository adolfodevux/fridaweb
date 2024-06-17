document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.nav-link');
    const pages = document.querySelectorAll('.page');

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            // Remove active class from all pages
            pages.forEach(page => page.classList.remove('active'));

            // Add active class to the target page
            const target = e.target.getAttribute('data-target');
            document.getElementById(target).classList.add('active');

            // Remove active class from all links
            links.forEach(link => link.classList.remove('active'));

            // Add active class to the clicked link
            e.target.classList.add('active');
        });
    });
});
