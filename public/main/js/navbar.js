// function setActiveLink() {
//     // Get the current hash
//     const currentHash = window.location.hash;

//     // Get all navigation links
//     const navLinks = document.querySelectorAll('.cs_nav_list a');

//     // Remove 'active' class from all links
//     navLinks.forEach(link => {
//         link.classList.remove('active');
//     });

//     // Add 'active' class to the link matching the current hash
//     if (currentHash) {
//         const activeLink = document.querySelector(`a[href="${currentHash}"]`);
//         if (activeLink) {
//             activeLink.classList.add('active');
//         }
//     }
//     const blogLink = document.querySelector('.cs_nav_list a[href=""]');
//     if (blogLink) {
//         if (window.location.pathname.split('/')[1] === 'blog') {
//             blogLink.classList.add('active');
//         }
//     }
// }

// // Set active link on page load
// window.addEventListener('DOMContentLoaded', setActiveLink);

// // Set active link on hash change (when clicking on a link)
// window.addEventListener('hashchange', setActiveLink);

function setActiveLink() {
    // Get all navigation links
    const navLinks = document.querySelectorAll('.cs_nav_list a');

    // Remove 'active' class from all links
    navLinks.forEach(link => {
        link.classList.remove('active');
    });

    // Get the current hash
    const currentHash = window.location.hash;
    
    // Add 'active' class to the link matching the current hash
    if (currentHash) {
        const activeLink = document.querySelector(`a[href="${currentHash}"]`);
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }

    // Special case for blog links
    const blogLink = document.querySelector('.cs_nav_list a[href=""]');
    if (blogLink) {
        if (window.location.pathname.split('/')[1] === 'blog') {
            blogLink.classList.add('active');
        }
    }
}

// Use IntersectionObserver to detect which section is in view
function observeSections() {
    const sections = document.querySelectorAll('section[id]');
    const options = {
        root: null, // Use the viewport as the root
        rootMargin: '0px',
        threshold: 0.5 // Trigger when 50% of the section is in view
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const sectionId = entry.target.getAttribute('id');
            const navLink = document.querySelector(`.cs_nav_list a[href="#${sectionId}"]`);

            if (entry.isIntersecting) {
                // Add 'active' class to the current section's nav link
                if (navLink) {
                    navLink.classList.add('active');
                }
            } else {
                // Remove 'active' class when section is not in view
                if (navLink) {
                    navLink.classList.remove('active');
                }
            }
        });
    }, options);

    // Observe each section
    sections.forEach(section => {
        observer.observe(section);
    });
}

// Set active link on page load
window.addEventListener('DOMContentLoaded', () => {
    setActiveLink();
    observeSections();
});

// Set active link on hash change (when clicking on a link)
window.addEventListener('hashchange', setActiveLink);
