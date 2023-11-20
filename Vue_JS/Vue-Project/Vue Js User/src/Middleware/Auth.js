export default function (to, from, next, router) {

    const isAuthenticated = parseInt(localStorage.getItem('isLogin') ?? "0");
    console.log("isAuth", isAuthenticated)
    if (isAuthenticated) {
        console.log("entered");
        next();
    } else {
        router.push({ path: '/login' });
    }

}