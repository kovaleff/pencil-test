import api from './api';

export const createProduct = (product) => {
    return api.post('products', product).then(function (response) {
        console.log(response);
    }).catch(function (error) {
        console.log(error);
    });
};
