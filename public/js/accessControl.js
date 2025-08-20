document.addEventListener('DOMContentLoaded', function () {
    const roleId = localStorage.getItem('role_id'); 
    if (!roleId) return; 

    let path = window.location.pathname.replace(/\/$/, '');

    const prohibitedForRole3 = [
        '/dashboardAdmin',
    ];

    const prohibitedForRole1 = [
        '/role/create',
        '/role/createRole',
        '/roles/findById',
        '/role/delete',
        '/role/edit',
        '/role/update',
        '/roles',
        '/roles/list',
        '/admin',
        '/dashboardAdmin',
        '/dashboardVendedor',
        '/users/view',
        '/user/findById',
        '/user/edit',
        '/user/delete',
        '/users',
        '/persons',
        '/persons/findById',
        '/persons/delete',
        '/products/create',
        '/products/createProduct',
        '/products/delete',
        '/products/edit',
        '/products/update',
        '/products/dashboard',
        '/tickets',
        '/tickets/show',
        '/tickets/edit',
        '/tickets/update',
        '/tickets/list',
        '/orders/show',
        '/orders/updateStatus',
        '/orders/list',
        '/shipments/create',
        '/shipments/createShipment',
        '/shipments/show',
        '/shipments/updateStatus',
        '/shipments/list'
    ];

    if (roleId === '3' && prohibitedForRole3.includes(path)) {
        window.location.href = '/products/list'; 
    }

    if (roleId === '1' && prohibitedForRole1.includes(path)) {
        window.location.href = '/products/list'; 
    }
});
