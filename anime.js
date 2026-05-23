// Կոճակների լիստեներները (եթե anime.js-ը չի աշխատում)
        document.addEventListener('DOMContentLoaded', function() {
            // HOME
            document.querySelector('.home')?.addEventListener('click', function() {
                window.location.href = 'home.php';
            });
            
            // CHARACTERS
            document.querySelector('.characters')?.addEventListener('click', function() {
                window.location.href = 'characters.php';
            });
            
            // FILMS
            document.querySelector('.films')?.addEventListener('click', function() {
                window.location.href = 'films.php';
            });
            
            // ABOUT
            document.querySelector('.about')?.addEventListener('click', function() {
                window.location.href = 'about.php';
            });
            
            // REGISTER
            document.querySelector('.register')?.addEventListener('click', function() {
                window.location.href = 'register.php';
            });
            
            // ACCOUNT
            document.querySelector('.account')?.addEventListener('click', function() {
                window.location.href = 'account.php';
            });
            
            // ADMIN PANEL
            document.querySelector('.Admin_Panel')?.addEventListener('click', function() {
                window.location.href = 'Admin_Panel.php';
            });
        });