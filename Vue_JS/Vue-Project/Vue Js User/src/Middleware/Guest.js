export default function (to, from, next, router) {

    const isAuthenticated = parseInt(localStorage.getItem('isLogin') ?? "0");
    console.log("isAuth 2", isAuthenticated)
    if (isAuthenticated) {
        router.push({ path: '/' });
    } else {
        next();
    }

}