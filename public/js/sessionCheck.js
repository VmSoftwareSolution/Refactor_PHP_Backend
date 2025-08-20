(function() {
    const expireAfter = 2 * 60 * 1000; // 5 segundos

    function clearSessionAndRedirect() {
        localStorage.removeItem('loginTime');
        localStorage.removeItem('role_id');
        localStorage.removeItem('id_person');
        localStorage.removeItem('id_user');
        alert('Tu sesión ha expirado');
        window.location.href = 'http://localhost:8000/user/login';
    }

    function checkSession() {
        const loginTime = Number(localStorage.getItem('loginTime'));
        if (!loginTime || isNaN(loginTime) || (Date.now() - loginTime > expireAfter)) {
            clearSessionAndRedirect();
        }
    }

    checkSession();

    setInterval(checkSession, 1000);
})();
