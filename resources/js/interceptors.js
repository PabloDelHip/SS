import axios from "axios";

axios.interceptors.request.use((req) => {
    // `req` is the Axios request config, so you can modify
    // the `headers`.
    let data_user = localStorage.getItem("data_user");
    data_user = JSON.parse(data_user);
    let token = "invalid";
    if (data_user) {
        token = data_user.token;
    }
    req.headers.Authorization = `Bearer ${token}`;
    return req;
});

const responseStatuses = (err) => {
    if (
        err.response.status === 401 &&
        err.response.config.url != "/api/v1/auth/login"
    ) {
        localStorage.removeItem("data_user");
        window.location.href = "/login";
    } else {
        return Promise.reject(err);
    }
    throw err;
};

axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (err) => {
        return responseStatuses(err);
    }
); 