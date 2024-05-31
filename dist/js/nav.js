// Setup links in menu to mark the currently shown page link
const configureNav = () => {
    const links = document.querySelectorAll('#main-nav menu a');
    const pageURL = window.location.href;
    
    // Check if link == pageURL, with or without trailing /s
    links.forEach(link => { 
        if (link.href == pageURL || link.href == pageURL.replace(/\/+$/, '')) {
            link.ariaCurrent = 'page';
        }
    });
}

