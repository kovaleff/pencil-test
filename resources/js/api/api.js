// import axios from 'axios';
// const axiosParams = {
//     baseURL:  '/api/expense/test/',
// };
// const axiosInstance = axios.create(axiosParams);
// const api = (axios) => {
//     return {
//         get: (url, config) => axios.get(url, config),
//         post: (url, body, config) => axios.post(url, body, config),
//         patch: (url, body, config) => axios.patch(url, body, config),
//         delete: (url, config) => axios.delete(url, config),
//     };
// };

const baseURL=  '/api/expense/test'
const api = (params) => {
    fetch(baseURL+params.url,{
        method: params.method,
        headers:params.headers,
        body: params.body
    }).then(params.action)
}
export default api;
